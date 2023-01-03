//  JS for the project documentation


document.addEventListener("DOMContentLoaded", function () {
    dropDownList();   // handle all the drop-down lists on the page
})


// handle all the drop-down lists on the page
function dropDownList()
{
    const listArray = document.querySelectorAll(`.drop-down-list`); // look for all the lists


    listArray.forEach(function (list) {
        const listTitle = list.querySelector(`.title`);  // look for the title of list

        // if the list was closed before so we open it after click on the title
        listTitle.addEventListener('click', (e) => {
            e.stopPropagation();

            if (list.classList.contains('open'))
            {
                list.classList.remove('open');
            }
            else
            {
                list.classList.add('open');
            }
        })
    }) // forEach
} // dropDownList()