// LOAD MORE POSTS FOR THE CATEGORY PAGE //

document.addEventListener('DOMContentLoaded', () => {
    loadmorePosts();
});


function loadmorePosts () {
    const loadmoreWrapper = document.querySelector('.loadmore-wrapper');
    const loadmoreButton = loadmoreWrapper.querySelector(".btn");
    let page = 1;  // a param to define a posts pagination page (offset)

    loadmoreButton.addEventListener('click', async (e) => {
        e.preventDefault();
        e.stopPropagation();

        // -------------------- PREPARE DATA FOR ASYNC REQUEST --------------------- //
        const type = 'video'; // any of Post::getTypes() or all
        const orderBy = 'created_at'; // ['created_at', 'popular']


        const queryString = `?page=${page}&type=${type}&orderBy=${orderBy}`;
        const uri = `/post/category/loadmore/${queryString}`;  // the load more route
        const encoded = encodeURI(uri);


        // -------------------- SENDING OF AN ASYNC REQUEST --------------------- //
        const fetchResponse = await fetch(encoded, {
           method: 'GET',
        });

        const result = await fetchResponse.json();

        //  -------------- IF WE GET A CORRECT ASYNC RESPONSE --------------------
        if (fetchResponse.ok) {
           console.log(result);
            ++page;  // after loading we need to increment the page parameter
        }
    });  // addEventListener('click')
}; // loadmorePosts()

