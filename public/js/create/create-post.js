//
// there is a js-code for the posts creation page
//
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form");
    const typeSelector =  form.querySelector("[data-select='type']");

    // a block with fields for the video post creation
    const videoPostFields = form.querySelector("[data-block-type='video']");
    // a block with fields for the usual post creation (not a video post)
    const usualPostFields = form.querySelector("[data-block-type='other']");


    // according to the option's value we change visibility of fields block
    function modifyFormBlock(option)
    {
        // we didn't choose any type
        if (option.innerText === 'type_of_post')
        {
            videoPostFields.classList.add("hide");
            usualPostFields.classList.add("hide");
        }
        // if we chose a video type
        else if (option.value === 'video')
        {
            videoPostFields.classList.remove("hide");
            usualPostFields.classList.add("hide");
        }
        // we chose not a video type
        else if (option.value !== 'video')
        {
            videoPostFields.classList.add("hide");
            usualPostFields.classList.remove("hide");
        }
    }

    // if we select some post type
    typeSelector.addEventListener('change', (event) => {
        const optionsList = event.currentTarget.children; // a list with options

        // go through each option and determine if it is selected
        for (let i = 0; i < optionsList.length; ++i)
        {
            if (optionsList[i].selected === true)
            {
                modifyFormBlock(optionsList[i]);
                break;
            }
        }
    });
});





