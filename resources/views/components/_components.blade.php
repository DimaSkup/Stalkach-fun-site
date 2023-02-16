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

@php
    /* prepare some data */
    use Illuminate\Support\Facades\Storage;
    $imgLinks = [];

    for($i = 1; $i < 9; $i++)
    {
        $imgLinks[] = Storage::url("components/" . $i . ".jpg");
    }

@endphp

<body>

    @include ('components.includes._components_headers')

    @include ('components.includes._components_buttons')

    @include ('components.includes._components_form_elements_input_elements')

    @include ('components.includes._components_form_elements_option_elements')

    @include ('components.includes._components_radio_categories')

    @include ('components.includes._components_mix_categories')

    @include ('components.includes._components_checkout_block', ['imgLinks' => $imgLinks])

    @include ('components.includes._components_posts_block', ['imgLinks' => $imgLinks])







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