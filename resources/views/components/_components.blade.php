<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #151515;
            margin: 0;
            padding: 20px 40px;
        }

        b {
            display: block;
            background: none;
            border: none;
            text-transform: uppercase;
            font-family: "poppinsmedium", sans-serif;
            font-size: 12px;
            letter-spacing: 2px;
            color: #424242;
            transition: 0.3s;
            margin: 20px 0;
        }

        .row-demo {
            display: flex;
            justify-content: flex-start;
        }

        .row-demo:last-of-type {
            margin-bottom: 40px;
        }

        .col-demo {
            /*max-width: 300px;*/
            margin-right: 15px;
        }

        .btn {
            margin-right: 15px;
        }

        .btn-pagination {
            margin-right: 5px;
        }

        .s-group {
            margin-bottom: 15px;
        }

        .posts-grid {
            width: 100%;
            display: grid;
            grid-gap: 20px;
            grid-template-columns: repeat(4, 1fr);
        }
    </style>
</head>
<body>
    <b>HEADERS</b>
    <div class="row-demo">
        <div class="col-demo">
            <h1>The best game of the year</h1>
            <h2>The best game of the year</h2>
            <h3>The best game of the year</h3>
            <h4>The best game of the year</h4>
            <h5>The best game of the year</h5>
            <h6>The best game of the year</h6>
        </div>

        <div class="col-demo">
            <h1 class="alt">The best game of the year</h1>
            <h2 class="alt">The best game of the year</h2>
            <h3 class="alt">The best game of the year</h3>
            <h4 class="alt">The best game of the year</h4>
            <h5 class="alt">The best game of the year</h5>
            <h6 class="alt">The best game of the year</h6>
        </div>
    </div>
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

    <div class="row-demo">
        <div class="col-demo">
            <b>Inputs</b>
            <div class="s-group">
                <label class="s-control" for="test">Username</label>
                <input class="s-control"
                       type="text"
                       name="test"
                       id="test"
                       placeholder="I`m Skiff"
                >
            </div>

            <div class="s-group">
                <label class="s-control" for="city">City</label>
                <select class="s-control"
                        name="city"
                        id="city"
                >
                    <option>London</option>
                    <option>Berlin</option>
                    <option>Kyiv</option>
                    <option>Lviv</option>
                    <option>Herson</option>
                </select>
            </div>
        </div>
{{--READONLY--}}
        <div class="col-demo">
            <b>Readonly</b>
            <div class="s-group">
                <label class="s-control" for="test">Username</label>
                <input class="s-control"
                       type="text"
                       name="test"
                       id="test"
                       placeholder="I`m Skiff"
                       readonly
                >
            </div>

            <div class="s-group">
                <label class="s-control" for="city">City</label>
                <select class="s-control"
                        name="city"
                        id="city"
                >
                    <option disabled>London</option>
                    <option disabled>Berlin</option>
                    <option selected>Kyiv</option>
                    <option disabled>Lviv</option>
                    <option disabled>Herson</option>
                </select>
            </div>
        </div>

{{-- VALID --}}
        <div class="col-demo">
            <b>Valid</b>
            <div class="s-group">
                <label class="s-control" for="test">Username</label>
                <input class="s-control"
                       type="text"
                       name="test"
                       id="test"
                       placeholder="I`m Skiff"
                       valid
                >
                <span class="s-valid">Success! You’ve done it.</span>
            </div>

            <div class="s-group">
                <label class="s-control" for="city">City</label>
                <select class="s-control"
                        name="city"
                        id="city"
                        valid
                >
                    <option>London</option>
                    <option>Berlin</option>
                    <option>Kyiv</option>
                    <option>Lviv</option>
                    <option>Herson</option>
                </select>
                <span class="s-valid">Good job, man!</span>
            </div>
        </div>

{{--INVALID--}}
        <div class="col-demo">
            <b>Invalid</b>
            <div class="s-group">
                <label class="s-control" for="test">Username</label>
                <input class="s-control"
                       type="text"
                       name="test"
                       id="test"
                       placeholder="I`m Skiff"
                       invalid
                >
                <span class="s-invalid">Error! Try again?</span>
            </div>

            <div class="s-group">
                <label class="s-control" for="city">City</label>
                <select class="s-control"
                        name="city"
                        id="city"
                        invalid
                >
                    <option>London</option>
                    <option>Berlin</option>
                    <option>Kyiv</option>
                    <option>Lviv</option>
                    <option>Herson</option>
                </select>
                <span class="s-invalid">WTF? I hate you!</span>
            </div>
        </div>

        <div class="col-demo">
            <b>Pagination</b>
            <div class="s-group">
                <button class="btn btn-pagination primary">
                    1
                </button>
                <button class="btn btn-pagination secondary">
                    2
                </button>
                <button class="btn btn-pagination secondary">
                    3
                </button>
                <button class="btn btn-pagination secondary">
                    4
                </button>
                <button class="btn btn-icon secondary">
                    <span class="material-icons">double_arrow</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row-demo">
        <div class="col-demo">
            <b>Checkout</b>
            <label class="s-checkbox">
                <div class="check">
                    <input type="checkbox" id="demo-check"/>
                    <div class="box"></div>
                </div>
                <div class="s-label">Kyiv</div>
            </label>

            <label class="s-checkbox">
                <div class="check">
                    <input type="checkbox" id="demo-check1"/>
                    <div class="box"></div>
                </div>
                <div class="s-label">Lviv</div>
            </label>

            <label class="s-checkbox">
                <div class="check">
                    <input type="checkbox" id="demo-check2" disabled/>
                    <div class="box"></div>
                </div>
                <div class="s-label">Kharkiv</div>
            </label>
        </div>

        <div class="col-demo">
            <b>Radio button</b>
            <label class="s-radio">
                <div class="check">
                    <input name="demo-radio" type="radio" id="demo-radio"/>
                    <div class="box"></div>
                </div>
                <label class="s-control" for="demo-radio">France</label>
            </label>

            <label class="s-radio">
                <div class="check">
                    <input name="demo-radio" type="radio" id="demo-radio1"/>
                    <div class="box"></div>
                </div>
                <label class="s-control" for="demo-radio1">Germany</label>
            </label>

            <label class="s-radio">
                <div class="check">
                    <input name="demo-radio" type="radio" id="demo-radio2"/>
                    <div class="box"></div>
                </div>
                <label class="s-control" for="demo-radio2">Spain</label>
            </label>
        </div>

        <div class="col-demo">
            <b>Check list</b>
            <label class="s-checklist">
                <input type="checkbox" id="demo-checklist2"/>
                <div class="s-checklist__body">
                    <div class="check">
                        <div class="box"></div>
                    </div>
                    <div class="s-label">Nastya</div>
                </div>
            </label>

            <label class="s-checklist">
                <input type="checkbox" id="demo-checklist2"/>
                <div class="s-checklist__body">
                    <div class="check">
                        <div class="box"></div>
                    </div>
                    <div class="s-label">Vera</div>
                </div>
            </label>

            <label class="s-checklist">
                <input type="checkbox" id="demo-checklist2" disabled checked/>
                <div class="s-checklist__body">
                    <div class="check">
                        <div class="box"></div>
                    </div>
                    <div class="s-label">Sasha</div>
                </div>
            </label>
        </div>
    </div>

    <b>Radio categories</b>
    <form class="filters" method="GET" name="browse-mods">
        <div class="left-side baseline">
            <div class="categories-container">
                <label>
                    <input type="radio" class="category-item" name="content" value="all">
                    <span>All</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content" value="post">
                    <span>News</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content" value="mod">
                    <span>Modifications</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content" value="media">
                    <span>Media</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content" value="resourse">
                    <span>Resources</span>
                </label>
                <label>
                    <input type="radio" class="category-item" name="content" value="wiki">
                    <span>Gamepedia</span>
                </label>
            </div>
        </div>
        <div class="right-side">
            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                           checked
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="All difficults">
                        <span class="material-icons">emergency</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Hard difficult">
                        <span class="material-icons red">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Medium difficult">
                        <span class="material-icons yellow">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Easy difficult">
                        <span class="material-icons blue">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="For novices">
                        <span class="material-icons green">trip_origin</span>
                    </div>
                </label>
            </div>
            <div class="s-mini-loader"></div>
        </div>
    </form>

    <b>Mix categories</b>
    <form class="filters" method="GET" name="browse-mods">
        <div class="left-side">
            <div class="s-group s-search ">
                <input class="s-control"
                       type="search"
                       name="search-mod"
                       id="search-mod"
                       placeholder="Search"
                >
            </div>
            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="S.T.A.L.K.E.R Shadow of Chernobyl">
                        <img src="{{ asset('images/icons/games/soc.ico') }}">
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="S.T.A.L.K.E.R Clear Sky">
                        <img src="{{ asset('images/icons/games/cs.ico') }}">
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="S.T.A.L.K.E.R Call of Pripyat">
                        <img src="{{ asset('images/icons/games/cop.ico') }}">
                    </div>
                </label>
            </div>

            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="With new story">
                        <span class="material-icons">auto_stories</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Graphic improvements">
                        <span class="material-icons">add_photo_alternate</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Bestsellers">
                        <span class="material-icons">star_border</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="With voice acting">
                        <span class="material-icons">mic</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="With new guns">
                        <span class="material-icons">backpack</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="checkbox"
                           name="test"
                           id="test"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="For old computers">
                        <span class="material-icons">speed</span>
                    </div>
                </label>
            </div>

            <div class="s-group">
                <select class="s-control" name="city" id="city">
                    <option>All categories</option>
                    <option>Berlin</option>
                    <option>Kyiv</option>
                    <option>Lviv</option>
                    <option>Herson</option>
                </select>
            </div>

            <div class="s-group">
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                           checked
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="All difficults">
                        <span class="material-icons">emergency</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Hard difficult">
                        <span class="material-icons red">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Medium difficult">
                        <span class="material-icons yellow">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="Easy difficult">
                        <span class="material-icons blue">trip_origin</span>
                    </div>
                </label>
                <label class="s-radio-block">
                    <input class="s-control"
                           type="radio"
                           name="difficult"
                           id="difficult"
                    >
                    <div class="box" data-mdb-toggle="tooltip" title="For novices">
                        <span class="material-icons green">trip_origin</span>
                    </div>
                </label>
            </div>
        </div>
        <div class="right-side">
            <div class="s-mini-loader"></div>
        </div>
    </form>

    <div class="row-demo">
        <div class="col-demo">
            <b>Checkout block</b>
            <div class="s-card-grid">
                <label class="s-card">
                    <input class="s-card__input" type="checkbox">
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="https://i.ibb.co/zXmHzBk/category-a.png">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Category A</b>
                            <p class="s-card__body-header-subtitle">Motorcycles</p>
                        </div>
                    </div>
                </label>
                <label class="s-card">
                    <input class="s-card__input" type="checkbox">
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="https://i.ibb.co/cXjw2Gz/category-b.png">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Category B</b>
                            <p class="s-card__body-header-subtitle">Cars and ATVs</p>
                        </div>
                    </div>
                </label>
                <label class="s-card">
                    <input class="s-card__input" type="checkbox">
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="https://i.ibb.co/nDbfH9B/category-c.png">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Category C</b>
                            <p class="s-card__body-header-subtitle">Large goods vehicle</p>
                        </div>
                    </div>
                </label>
                <label class="s-card">
                    <input class="s-card__input" type="checkbox">
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="https://i.ibb.co/7gSQMmm/category-d.png">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Category D</b>
                            <p class="s-card__body-header-subtitle">Buses</p>
                        </div>
                    </div>
                </label>
                <label class="s-card">
                    <input class="s-card__input" type="checkbox">
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="https://i.ibb.co/0F3SdsX/category-t.png">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Category T</b>
                            <p class="s-card__body-header-subtitle">Tractors and SMV</p>
                        </div>
                    </div>
                </label>
                <label class="s-card">
                    <input class="s-card__input" type="checkbox" disabled="disabled">
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="https://i.ibb.co/WDwmPy5/other.png">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Other</b>
                            <p class="s-card__body-header-subtitle">Additional categories</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
    <div class="row-demo">
        <div class="col-demo">
            <b>Posts block</b>
            <div class="posts-grid pb-5">
                @foreach([1,2,3,4] as $p)
                    <article class="article">
                        <a href="#" class="thumb-img">
                            <img src="https://picsum.photos/300/180?random=1">
                        </a>
                        <div class="text">
                            <div class="tags">
                                <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
                                <a class="popular-tag" href="#tag-name" data-id="1">Illa</a>
                                <a class="popular-tag" href="#tag-name" data-id="1">Crewtw</a>
                            </div>
                            <a href="#">
                                <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                            </a>
                            <div class="subtitle">
                                <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row-demo">
        <div class="col-demo">
            @foreach([1,2,3,4] as $key => $p)
                <article class="article article--compact" style="max-width: 300px">
                    <a href="#" class="thumb-img">
                        <img src="https://picsum.photos/200/200?random={{ $key }}">
                    </a>
                    <div class="text">
                        <a href="#">
                            <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                        </a>
                        <div class="subtitle">
                            <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="col-demo">
            @foreach([1,2,3,4] as $key => $p)
                <article class="article article--compact reverse" style="max-width: 300px">
                    <a href="#" class="thumb-img">
                        <img src="https://picsum.photos/200/200?random={{ $key + 4 }}">
                    </a>
                    <div class="text">
                        <a href="#">
                            <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                        </a>
                        <div class="subtitle">
                            <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
    <div class="row-demo">
        <div class="col-demo">
            <article class="article article--primary">
                <a href="#" class="thumb-img">
                    <img src="https://picsum.photos/600/350?random=12">
                </a>
                <div class="text">
                    <a href="#">
                        <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                    </a>
                    <p>
                        Pellentesque efficitur libero eget justo tempor venenatis. Fusce lorem dolor, laoreet a consequat ut, imperdiet nec massa.
                    </p>
                    <div class="subtitle">
                        <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                    </div>
                    <div class="tags">
                        <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
                        <a class="popular-tag" href="#tag-name" data-id="1">Illa</a>
                        <a class="popular-tag" href="#tag-name" data-id="1">Crewtw</a>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-demo">
            @foreach([1,2,3] as $key => $p)
                <article class="article article--compact reverse" style="max-width: 300px">
                    <a href="#" class="thumb-img">
                        <img src="https://picsum.photos/200/200?random={{ $key + 4 }}">
                    </a>
                    <div class="text">
                        <a href="#">
                            <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                        </a>
                        <div class="subtitle">
                            <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
    <div class="row-demo" style="flex-direction: column; max-width: 900px">
        @foreach([1,2,3] as $key => $p)
            <article class="article article--list">
                <a href="#" class="thumb-img">
                    <img src="https://picsum.photos/400/240?random=12">
                </a>
                <div class="text">
                    <a href="#">
                        <h3>Григорович ми чекаємо твою гру як хуй знає хто</h3>
                    </a>
                    <p>
                        Pellentesque efficitur libero eget justo tempor venenatis. Fusce lorem dolor, laoreet a consequat ut, imperdiet nec massa.
                    </p>
                    <div class="subtitle">
                        <time datetime="2020-05-25 12:00:00">Mon 2 ▶ <a href="#">gaming.net</a></time>
                    </div>
                    <div class="tags">
                        <a class="popular-tag" href="#tag-name" data-id="1">Beliy</a>
                        <a class="popular-tag" href="#tag-name" data-id="1">Illa</a>
                        <a class="popular-tag" href="#tag-name" data-id="1">Crewtw</a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>