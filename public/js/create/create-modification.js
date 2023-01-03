//
// there is a js-code for the modifications creation page
//
import {applicationForm} from '../async/modification-async-form-validation.js';

document.addEventListener('DOMContentLoaded', () => {

    chooseGameVersion();    // functional for choosing of a game version
    addDownloadLink();      // here we create functional for "add download source"
    addSocialLink();        // here we create functional for "add a link to social"

    //fakeFiller();         // fill in fields

    applicationForm();      // primary data validation and async request for saving form data into the database
}); // addEventListener()




// ------------------------------------------------------------------------------- //
//
//                                MAIN FUNCTIONS
//
// ------------------------------------------------------------------------------- //

// functional for choosing of a base game version (drop down menu)
function chooseGameVersion()
{
    const gameVersionOptionsContainer = document.querySelector(`[data-form-input="game"]`);
    const currentChosenOption = gameVersionOptionsContainer.querySelector(`[data-option="default"]`);


    // if we edit modification we have the current game version is already set
    if (currentChosenOption.dataset.optionCur)
    {
        // we set label of the current chosen game version button to be equal to a game version name to show that the version is already chosen
        currentChosenOption.innerHTML = gameVersionOptionsContainer.querySelector(`[data-option="${currentChosenOption.dataset.optionCur}"]`).innerHTML;
    }

    gameVersionOptionsContainer.addEventListener('click', function (event) {
        currentChosenOption.innerHTML = event.target.innerText;
        currentChosenOption.dataset.optionCur = event.target.dataset.option;
    })
} // chooseGameVersion()

// functional for adding of download sources
function addDownloadLink()
{
    const addDownloadSourceBlock = document.querySelector("[data-download='add_source']");            // our block
    const addSourceButton = addDownloadSourceBlock.querySelector("[data-download='download_links']"); // a drop down menu button
    const inputFieldsContainer = addDownloadSourceBlock.querySelector("[data-download='inputs']");    // a container with input fields

    // if we choose some option of the drop-down menu
    handleClickingOfMenuOption(addSourceButton, inputFieldsContainer)

    // for each "hiding button" we add functional
    addFunctionalForHidingButtons(inputFieldsContainer);

} // addDownloadLink()

// functional for adding of social links
function addSocialLink(mainBlockDataAttr, addButtonDataAttr, inputFieldsContainerDataAttr)
{
    const mainBlock = document.querySelector("[data-links='add_social_links_block']");     // our block
    const addButton = mainBlock.querySelector("[data-links='add_social_links_button']");   // a drop-down menu button
    const inputFieldsContainer = mainBlock.querySelector("[data-links='add_social_links_input_fields']");  // a container with input fields

    // if we choose some option of the drop-down menu
    handleClickingOfMenuOption(addButton, inputFieldsContainer)

    // for each "hiding button" we add functional
    addFunctionalForHidingButtons(inputFieldsContainer);
} // addSocialLink()







// ------------------------------------------------------------------------------- //
//
//                                 HELPERS
//
// ------------------------------------------------------------------------------- //

function handleClickingOfMenuOption(addButton, inputFieldsContainer)
{
    addButton.addEventListener('click', (event) => {
        const clickedOption = event.target.dataset.option; // a menu option which was chosen
        const inputBlock = inputFieldsContainer.querySelector(`[data-type=${clickedOption}]`);
        inputBlock.classList.remove("hide");
    })
} // handleClickingOfMenuOption()

function addFunctionalForHidingButtons(inputFieldsContainer)
{
    // all the buttons which are used to hide text input field
    const allHideInputButtons = inputFieldsContainer.querySelectorAll("[data-action='hide_element']");

    for (let button of allHideInputButtons)  // for each "hiding button" we add functional
    {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const parentBlock = event.target.parentElement;
            const inputField = parentBlock.querySelector(`[name="${parentBlock.dataset.type}"]`);

            inputField.value = "";             // clean the content of the input field
            parentBlock.classList.add("hide"); // hide this input field, hiding button, etc.
        });
    } // for
} // addFunctionalForHidingButtons()





// fill in fields with fake data
function fakeFiller()
{
    const nameInput = document.querySelector(`[data-form-input="name"]`);
    const descriptionInput = document.querySelector(`[data-form-input="description"]`);
    //const mainImageInput = document.querySelector(`[data-form-input="main-image"]`);
    //const screenshotsInput = document.querySelector(`[data-form-input="screenshots"]`);
    const youTubeLinkInput = document.querySelector(`[data-form-input="video-link"]`);
    const gameVersionSelector = document.querySelector(`[data-form-input="game"]`);

    const downloadLinksContainer = document.querySelector(`[data-download="inputs"]`);
    const googleDriveLinkInput = downloadLinksContainer.querySelector(`[data-form-input="google_drive_disk"]`);
    const yandexDiskLinkInput = downloadLinksContainer.querySelector(`[data-form-input="yandex_disk"]`);
    const cloudMailLinkInput = downloadLinksContainer.querySelector(`[data-form-input="cloud_mail_disk"]`);
    const tagsInput = document.querySelector(`[data-form-input="tags"]`);

    nameInput.value = "modification_1";
    descriptionInput.value = "description_1";
    youTubeLinkInput.value = "https://www.youtube.com/watch?v=6_uAAzbv4IE&ab_channel=PuriceSergiu";

    const chooseGameVersionButton = gameVersionSelector.querySelector(`[data-option="default"]`);

    chooseGameVersionButton.dataset.optionCur = "soc";
    chooseGameVersionButton.innerHTML = gameVersionSelector.querySelector(`[data-option="${chooseGameVersionButton.dataset.optionCur}"]`).innerHTML;

    googleDriveLinkInput.value = "https://www.youtube.com/watch?v=6_uAAzbv4IE&ab_channel=PuriceSergiu";
    yandexDiskLinkInput.value = "https://www.youtube.com/watch?v=6_uAAzbv4IE&ab_channel=PuriceSergiu";
    cloudMailLinkInput.value = "https://www.youtube.com/watch?v=6_uAAzbv4IE&ab_channel=PuriceSergiu";
    tagsInput.value = "tag_1 tag_2 tag_3";
}  // fakeFiller()