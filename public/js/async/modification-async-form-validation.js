//
// this is a js-code for the async form requests and primary data validation
//
import * as utils from './utils/form-validation-utils.js'

const applicationForm = () => {

    // ------------------------------- INPUT FIELDS ---------------------------------- //
    const form = document.getElementById('form');
    const inputFieldsList = document.querySelectorAll(`[data-form-input]`);

    const nameInput = document.querySelector(`[data-form-input="name"]`);
    const descriptionInput = document.querySelector(`[data-form-input="description"]`);
    const mainImageInput = document.querySelector(`[data-form-input="main-image"]`);
    const screenshotsInput = document.querySelector(`[data-form-input="screenshots"]`);
    const youTubeLinkInput = document.querySelector(`[data-form-input="video-link"]`);
    const gameVersionSelector = document.querySelector(`[data-form-input="game"]`);

    const downloadLinksContainer = document.querySelector(`[data-download="inputs"]`);
    const googleDriveLinkInput = downloadLinksContainer.querySelector(`[data-form-input="google_drive_disk"]`);
    const yandexDiskLinkInput = downloadLinksContainer.querySelector(`[data-form-input="yandex_disk"]`);
    const cloudMailLinkInput = downloadLinksContainer.querySelector(`[data-form-input="cloud_mail_disk"]`);
    const tagsInput = document.querySelector(`[data-form-input="tags"]`);

    const submitErrorBlock = document.querySelector(`.submit-block > .error-block`);

    // --------------------------- FORM LOGIC ---------------------------- //
    form.addEventListener('submit', async(e) => {
        e.preventDefault();
        e.stopPropagation();


        //             IF WE HAVE AN ERROR DURING THE PRIMARY VALIDATION
        //             WE RETURN FROM THE SUBMIT EVENT
        if (validationInputData())  // here we execute the primary validation of input data
        {
            submitErrorBlock.classList.remove('hide');
            console.log("Please, fill in all the necessary fields");
            return;
        }
        else
        {
            submitErrorBlock.classList.add('hide');
        }

        // -------------------- SENDING OF AN ASYNC REQUEST ---------------------
        // creation of the FormData object
        const fData = new FormData(form);
        const fAction = form.getAttribute('action');


        // prepare some data before sending
        fData.append('game', gameVersionSelector.querySelector(`.dropbtn`).getAttribute('data-option-cur'));

        // sending of the form data to the server
        const fetchResponse = await fetch(fAction, {
            method: 'POST',
            body: fData,
        });

        const result = await fetchResponse.json();

        //  -------------- IF WE GET A CORRECT ASYNC RESPONSE --------------------
        if (fetchResponse.ok)
        {
            console.log(result);

            // if we have some validation errors
            if (!result.success)
            {
                const errorMessages = result.errorMessages;
                const commonErrorMessage = result.message;

                setErrorsAccordingToBackendValidation(errorMessages, commonErrorMessage);   // set an error message near each field which didn't pass the validation
                utils.removeErrorStateByClick(inputFieldsList);         // removing of an error state from some clicked field
            } // if (!result.success)
            else // the modification was saved successfully into the database
            {
                window.location.replace(result.linkToThisModPage)// redirect to the page with this modification
            }
        } // if (fetchResponse.ok)
    }); // form.addEventListener()



    // here we call different validation functions
    function validationInputData()
    {
        const currentFormType = form.dataset.formType; // for definition if we are on an editing page
        let error = false;
        const ENABLE_VALIDATION = true;
        const IMAGES_VALIDATION = false;
        const LINKS_VALIDATION = false;

        if (ENABLE_VALIDATION)
        {
            // ------------------- PRIMARY VALIDATION OF THE INPUT FIELDS  ------------------

            // -------------------- name input validation --------------------------
            if (!utils.validationTextInput(nameInput)) { error = true; }

            // ------------------ description input validation ---------------------
            if (!utils.validationTextInput(descriptionInput)) { error = true; }


            if (IMAGES_VALIDATION)
            {
                // ------------------ images input validation ---------------------
                // main_image input validation
                if (!utils.validationImageField(mainImageInput, currentFormType)) { error = true; }

                // screenshots input validation
                if (!utils.validationImageField(screenshotsInput, currentFormType)) { error = true; }
            }

            if (LINKS_VALIDATION)
            {
                // --------------------- YouTube video link validation ----------------------
                if (!utils.validationYouTubeVideoLink(youTubeLinkInput)) { error = true; }

                // --------------------- game version validation -------------------------
                if (!utils.validationDropDownMenu(gameVersionSelector, ["soc", "cs", "cop", "hoc"])) { error = true;}

                // -------------------- download links input validation  ----------------------
                //                (google drive, yandex disk, cloud mail disk)
                const downloadLinkInputs = [googleDriveLinkInput, yandexDiskLinkInput, cloudMailLinkInput];
                if (!validationAllDownloadLinks(downloadLinkInputs)) { error = true; }
            }
        }   // if (ENABLE_VALIDATION)

        return error;
    }   // validationInputData()




    // validation of the download links (google drive, yandex disk, cloud mail disk)
    // return:  true - if everything is ok,
    //          false - in another case
    function validationAllDownloadLinks(downloadLinksInputsArray)
    {
        let someLinkIsCorrect = false;     // if we haven't got any download link

        // validate each of the download links
        for (const inputField of downloadLinksInputsArray)
        {
            const validationResult = utils.validationLink(inputField);

            if (validationResult)
            {
                someLinkIsCorrect = true; // we have some download link
            }
        }

        // if we haven't got any download link
        if (!someLinkIsCorrect)
        {
            //utils.setErrorState(document.querySelector(`[data-download="add_source"]`));
            utils.setErrorState(downloadLinksInputsArray[0])
        }
        else
        {
            utils.removeErrorState(document.querySelector(`[data-download="add_source"]`));
        }

        return someLinkIsCorrect;
    }

    // in case we have an error about some field data
    // we set this error message near this field
    function setErrorsAccordingToBackendValidation(errorMessages, commonErrorMessage)
    {
        const particularMessagesToFields =      // keys to fields for particular errors cases
        [
            ['name', nameInput],
            ['description', descriptionInput],
            ['main_image', mainImageInput],
            ['screenshots', screenshotsInput],
            ['video_id', youTubeLinkInput],
            ['video_link', youTubeLinkInput],
            ['game', gameVersionSelector],
            ['google_drive_disk', googleDriveLinkInput],
            ['yandex_disk', yandexDiskLinkInput],
            ['cloud_mail_disk', cloudMailLinkInput],
            ['tags', tagsInput],

            ['images', document.querySelector(`[data-common-errors="images"]`)],
            ['download_links', downloadLinksContainer],
        ];  // particularMessagesToFields[]

        // show an error message near the block with name which is placed in pair[0] variable
        for (const pair of particularMessagesToFields)
        {
            if (pair[0] in errorMessages)
            {
                utils.setErrorState(pair[1], errorMessages[pair[0]]);
            }
        }

        // show a common error message near the submit button
        utils.setErrorState(submitErrorBlock, commonErrorMessage);
    }   // setErrorsAccordingToBackendValidation()
}   // applicationForm()

export {applicationForm}