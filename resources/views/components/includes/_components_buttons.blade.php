{{--
    COMPONENTS:

    links, share items, default buttons, small/large/x-large buttons,
    custom buttons, tags
--}}

<b>Links</b>
<div class="row-demo">
    <div class="col-demo">
        <a href="#" class="link">Sample of link</a>
    </div>
    <div class="col-demo">
        <a href="#" class="link-with-arrow">Link with arrow</a>
    </div>
    <div class="col-demo">
        <a href="#" class="link-prev">Back to list</a>
    </div>
    <div class="col-demo">
        <a href="#" class="link-next">See more in the blog</a>
    </div>
</div>



<b>Share items</b>
<div class="row-demo">
    <div class="col-demo">
        <button class="btn-share">
            <span class="btn-icon material-icons">share</span>
            <span class="btn-text">Share</span>
            <ul class="social-icons">
                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={url}" target="_blank">
                        <span class="socicon socicon-facebook"></span>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?text={text}" target="_blank">
                        <span class="socicon socicon-twitter"></span>
                    </a>
                </li>
                <li>
                    <a href="https://t.me/share/url?url={url}&text={text}" target="_blank">
                        <span class="socicon socicon-telegram"></span>
                    </a>
                </li>
            </ul>
        </button>
    </div>
    <div class="col-demo">
        <button class="btn btn-with-icon like" onclick="this.classList.toggle('active'); document.querySelector('.text').innerText = this.classList.contains('active') ? 'Liked' : 'Like';">
            <span class="material-icons">favorite</span>
            <span class="text">Like</span>
        </button>
    </div>
</div>



<b>Default size buttons</b>
<div class="row-demo">
    <button class="btn">Default</button>
    <button class="btn primary">Primary</button>
    <button class="btn primary" loading>Loading</button>
    <button class="btn secondary">Secondary</button>
    <button class="btn secondary" disabled>Disabled</button>

    <button class="btn btn-icon">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-icon primary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-icon primary" loading>
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-icon secondary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-icon secondary" disabled>
        <span class="material-icons">place</span>
    </button>
</div>



<b>Small buttons</b>
<div class="row-demo">
    <button class="btn btn-sm">Default</button>
    <button class="btn btn-sm primary">Primary</button>
    <button class="btn btn-sm primary" loading>Loading</button>
    <button class="btn btn-sm secondary">Secondary</button>
    <button class="btn btn-sm secondary-outline">Secondary</button>
    <button class="btn btn-sm secondary" disabled>Disabled</button>

    <button class="btn btn-sm-icon">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-sm-icon primary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-sm-icon primary" loading>
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-sm-icon secondary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-sm-icon secondary" disabled>
        <span class="material-icons">place</span>
    </button>
</div>



<b>Large buttons</b>
<div class="row-demo">
    <button class="btn btn-lg">Default</button>
    <button class="btn btn-lg primary">Primary</button>
    <button class="btn btn-lg primary" loading>Loading</button>
    <button class="btn btn-lg secondary">Secondary</button>
    <button class="btn btn-lg secondary" disabled>Disabled</button>

    <button class="btn btn-lg-icon">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-lg-icon primary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-lg-icon primary" loading>
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-lg-icon secondary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-lg-icon secondary" disabled>
        <span class="material-icons">place</span>
    </button>
</div>



<b>X-Large buttons</b>
<div class="row-demo">
    <button class="btn btn-xl">Default</button>
    <button class="btn btn-xl primary">Primary</button>
    <button class="btn btn-xl primary" loading>Loading</button>
    <button class="btn btn-xl secondary">Secondary</button>
    <button class="btn btn-xl secondary" disabled>Disabled</button>

    <button class="btn btn-xl-icon">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-xl-icon primary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-xl-icon primary" loading>
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-xl-icon secondary">
        <span class="material-icons">place</span>
    </button>
    <button class="btn btn-xl-icon secondary" disabled>
        <span class="material-icons">place</span>
    </button>
</div>



<b>Custom</b>
<div class="row-demo">
    <button class="btn btn-with-icon">
        <span class="material-icons">place</span>
        <span class="text">Search</span>
    </button>

    <button class="btn btn-with-icon link">
        <span class="material-icons">place</span>
        <span class="text">Without border</span>
    </button>
</div>



<b>Tags</b>
<div class="row-demo">
    <a class="popular-tag" href="#tag-name" data-id="1">Anomalies</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Music</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Skupeiko</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Mecheniy</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Skupeiko</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Skupeiko</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
    <a class="popular-tag" href="#tag-name" data-id="1">Mecheniy</a>
</div>