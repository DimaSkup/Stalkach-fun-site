document.addEventListener("DOMContentLoaded", function () {
    userDropDownMenu();
})

function userDropDownMenu()
{
    const menuElemsArray = document.querySelector(`.user-dropdown-menu`);


    menuElemsArray.addEventListener('click', (e) => {
        //console.log(e.target);
        //const usernameBtn = list.querySelector(`.username`);
        e.stopPropagation();


        if (menuElemsArray.classList.contains('open'))
        {
            menuElemsArray.classList.remove('open');
        }
        else
        {
            menuElemsArray.classList.add('open');
        }
    });
} // userDropDownMenu()