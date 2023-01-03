// ******************************************************************************** //
//                                                                                  //
//  this is the file with validation utils which are using during async validation  //
//                                                                                  //
// ******************************************************************************** //

const urlValidation = "/https?:\\/\\/(www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b([-a-zA-Z0-9()@:%_\\+.~#?&//=]*)/";
const youTubeUrlValidation = "^(https?\\:\\/\\/)?(www\\.youtube\\.com|youtu\\.be)\\/.+$";
const errorEmptyFieldMessage = document.querySelector(`[data-empty-error]`).innerHTML;

// ------------------------- TEXT VALIDATION FUNCTIONS --------------------------- //
// here we validate text fields
function validationTextInput (textInput) {
    if (textInput.value == 0)   // if this input is empty
    {
        setErrorState(textInput);
        return false;           // validation is failed
    }
    else
    {
        removeErrorState(textInput);
        return true;            // validation is successful
    }
} // validationTextInput()

// ------------------------- IMAGE VALIDATION FUNCTIONS -------------------------- //
// 1. Validation of image files input fields
// 2. If currentFormType value is equal to "edit" we don't need to check image field
function validationImageField(imageInputField, currentFormType)
{
    console.log(`current form type: ${currentFormType}`);
    // if we don't edit some model we have to check that form image field is filled in
    if (currentFormType !== 'edit')
    {
        // if there are not any uploaded images
        if (!imageInputField.hasAttribute('autocompleted'))
        {
            setErrorState(imageInputField);
            return false;   // validation is failed
        }
        else
        {
            removeErrorState(imageInputField);
            return true;    // validation is successful
        }
    }
}   // validationImageField()

// -------------------- DROP DOWN MENU VALIDATION FUNCTIONS ---------------------- //
function validationDropDownMenu(menuSelector, allowedOptionValues)
{
    //const allowedOptionValues = ["soc", "cs", "cop", "hoc"];
    const currentOption = menuSelector.querySelector(`.dropbtn`).getAttribute('data-option-cur');
    if (!allowedOptionValues.includes(currentOption))
    {
        setErrorState(menuSelector);
        return false;       // we didn't get a correct game version
    }
    else
    {
        removeErrorState(menuSelector);
        return true;        // we have a correct game version
    }
}   // validationDropDownMenu()


// ------------------------- LINK VALIDATION FUNCTIONS --------------------------- //

// here we define if the link is not empty and is in the proper format
// according to the additionalValidationRule
function validationLink(linkInputField, additionalValidationRule = "")
{
    //const inputFieldContainer = linkInputField.closest(`.data-form-input-container`);

    if (linkInputField.value == 0)  // if this input is empty
    {
        return 0;                       // we have some error
    }
    // link is not empty but we have to do some additional validation
    else if (additionalValidationRule !== "" && !linkInputField.value.match(additionalValidationRule))
    {
        return "isNotCorrectLink";      // we have a link in incorrect format
    }
    else
    {
        return 1;                        // everything is ok
    }
}   // validationLink()

function validationYouTubeVideoLink(youTubeLinkInput)
{
    const videoLinkValidResult = validationLink(youTubeLinkInput, youTubeUrlValidation);

    switch (videoLinkValidResult)
    {
        case "isNotCorrectLink":
            setErrorState(youTubeLinkInput, "There is an incorrect YouTube link");
            return false;
        case 0:
            setErrorState(youTubeLinkInput, errorEmptyFieldMessage);
            return false;
        default:
            removeErrorState(youTubeLinkInput);
            return true;
    }
}   // validationYouTubeVideoLink


// ----------------------- SET/REMOVE FIELD ERROR STATE FUNCTIONS ------------------- //
// for particular inputField we set an error state
function setErrorState(inputField, errorMessages = [])
{
    const block = inputField.closest(`.data-form-input-container`);
    const errorBlock = block.querySelector(`.error-block`);

    inputField.classList.add('text-input-error');
    inputField.classList.add('error');
    errorBlock.classList.remove('hide');
    errorBlock.innerHTML = (errorMessages.length !== 0) ? errorMessages : errorEmptyFieldMessage;
}

// for particular inputField we remove an error state
function removeErrorState(inputField)
{
    const block = inputField.closest(`.data-form-input-container`);

    inputField.classList.remove('text-input-error');
    inputField.classList.remove('error');
    block.querySelector(`.error-block`).classList.add('hide');
}

// for each input field/drop-down menu/etc. we set removing of an error state
// in case of clicking at this particular field/block
function removeErrorStateByClick(inputFieldsList)
{
    inputFieldsList.forEach(function(currentValue, currentIndex, listObj) {
        currentValue.addEventListener('click', function(event) {
            event.stopPropagation();
            console.log(event.target);

            if (event.target.hasAttribute(`data-form-input`))
            {
                removeErrorState(event.target);
            }
            else
            {
                removeErrorState(event.target.closest(`[data-form-input]`));
            }
        });
    });
}   // removeErrorStateByClick

export {
    validationTextInput,
    validationDropDownMenu,
    validationImageField,
    validationLink,
    validationYouTubeVideoLink,
    setErrorState,
    removeErrorState,
    removeErrorStateByClick,
}