{{--
    A SINGLE MODIFICATION PAGE
    (main template)
--}}

@extends('layouts.theme')

@section('js')
    <script src="{{ asset('js/mod-page.js') }}"></script>
@endsection

@section('content')
    <section class="mod">
        @include ('mods.show.includes._show_mod_header', ['mod' => $mod])
        @include ('mods.show.includes._show_mod_mini_header')
        @include ('mods.show.includes._show_mod_menu_navigation')


        <div class="splide mod-section">
            <div class="splide__track">
                <ul class="splide__list">
{{--                    <li class="mod-section-slide splide__slide" data-slide-id="feed">--}}
{{--                        --}}
{{--                    </li>--}}
                    <li class="mod-section-slide splide__slide" data-slide-id="description">
                        <p>But I must explain to you how all this <mark>mistaken</mark> idea of denouncing <del>pleasure</del> and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
                        <h2>Mecha-Dragon Improvements</h2>
                        <p>But I must explain to you how all <a href="#">this mistaken idea of denouncing pleasure and praising</a> pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
                        <p>But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
                        <blockquote cite="https://www.huxley.net/bnw/four.html">
                            Words can be like X-rays, if you use them properly—they’ll go through anything. You read and you’re pierced.
                            <cite>Brave New World</cite>
                        </blockquote>
                        <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? </p>
                        <img src="https://cdn1.epicgames.com/salesEvent/salesEvent/EGS_STALKER2HeartofChernobyl_GSCGameWorld_S1_2560x1440-34cdfe8a4a37b5c2dc4bf3fe1d943c95" alt="image">
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer</p>
                        <hr>
                        <p>I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who </p>
                        <div class="ratio ratio-16x9">
                            <iframe
                                    src="https://www.youtube-nocookie.com/embed/2aGXNuyUEtk"
                                    title="YouTube video"
                                    allowfullscreen
                            ></iframe>
                        </div>
                        <p>I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who </p>
                        <p>I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who </p>
                        <h2>I will give you a complete account of the system</h2>
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer</p>
                        <h3>Nor again is there anyone who loves or pursues or desires to obtain pain of itself</h3>
                        <p>I will give you a complete account of the system, and expound the actual teachings of the great explorer. But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer</p>
                        <table>
                            <tr>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Country</th>
                            </tr>
                            <tr>
                                <td>Alfreds Futterkiste</td>
                                <td>Maria Anders</td>
                                <td>Germany</td>
                            </tr>
                            <tr>
                                <td>Centro comercial Moctezuma</td>
                                <td>Francisco Chang</td>
                                <td>Mexico</td>
                            </tr>
                        </table>
                        <h3>Nor again is there anyone who loves or pursues or desires to obtain pain of itself</h3>
                        <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
                    </li>
                    <li class="mod-section-slide splide__slide" data-slide-id="reviews">
                        <div class="reviews-wrapper">
                            <div class="reviews-list">
                                <div class="review-block">
                                    <div class="author">
                                        <div class="avatar">
                                            <img src="https://steamuserimages-a.akamaihd.net/ugc/1286290882126965835/26B84DE8DD029438842A6165AF2FD7C9B5D370F1/?imw=88&imh=88&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true">
                                        </div>
                                        <div class="title">x-oscarr</div>
                                    </div>
                                    <div class="content">
                                        Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer
                                    </div>
                                </div>

                                <div class="review-block">
                                    <div class="author">
                                        <div class="avatar">
                                            <img src="https://steamuserimages-a.akamaihd.net/ugc/1286290882126965835/26B84DE8DD029438842A6165AF2FD7C9B5D370F1/?imw=88&imh=88&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true">
                                        </div>
                                        <div class="title">x-oscarr</div>
                                    </div>
                                    <div class="content">
                                        Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer
                                        Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer<br><br>
                                        Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer
                                    </div>
                                </div>
                            </div>
                            <div class="reviews-sidebar">
                                <div class="rating-section">
                                    <div class="rating-category">
                                        <div class="title">Story</div>
                                        <div class="score">7.4/10</div>
                                    </div>
                                    <div class="rating-category">
                                        <div class="title">Graphic</div>
                                        <div class="score">7/10</div>
                                    </div>
                                    <div class="rating-category">
                                        <div class="title">Difficulty</div>
                                        <div class="score">5.4/10</div>
                                    </div>
                                    <div class="rating-category">
                                        <div class="title">Optimisation</div>
                                        <div class="score">8.4/10</div>
                                    </div>
                                    <div class="rating-category">
                                        <div class="title">Atmosphere</div>
                                        <div class="score">9.1/10</div>
                                    </div>
                                    <div class="rating-category">
                                        <div class="title">Summary</div>
                                        <div class="score">6.4/10</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mod-section-slide splide__slide" data-slide-id="faq">
                        <div>
                            <div class="question-section">
                                <button
                                        class="btn question"
                                        type="button"
                                        data-mdb-toggle="collapse"
                                        data-mdb-target="#question1"
                                        aria-expanded="false"
                                        aria-controls="question1"
                                >
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid?
                                </button>

                                <!-- Collapsed content -->
                                <div class="collapse answer" id="question1">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Donec viverra ultricies lectus vitae maximus. Fusce nisi augue, congue id interdum quis, faucibus non justo. Maecenas egestas eu ex eget congue. Phasellus aliquet id nisi in rhoncus. Nam eget tortor nec arcu finibus euismod. Integer non nisl sit amet metus tempus finibus. Mauris eget mauris non risus suscipit volutpat. Quisque leo odio, facilisis eu mauris sed, accumsan hendrerit libero. In euismod nibh tellus, quis imperdiet orci suscipit a. Vivamus porttitor augue vitae sapien bibendum mattis. Suspendisse potenti. Donec nec ligula eu dui laoreet tempor at in leo.
                                </div>
                            </div>
                            <div class="question-section">
                                <button
                                        class="btn question"
                                        type="button"
                                        data-mdb-toggle="collapse"
                                        data-mdb-target="#question2"
                                        aria-expanded="false"
                                        aria-controls="question2"
                                >
                                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident?
                                </button>

                                <!-- Collapsed content -->
                                <div class="collapse answer" id="question2">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. Donec viverra ultricies lectus vitae maximus. Fusce nisi augue, congue id interdum quis, faucibus non justo. Maecenas egestas eu ex eget congue. Phasellus aliquet id nisi in rhoncus. Nam eget tortor nec arcu finibus euismod. Integer non nisl sit amet metus tempus finibus. Mauris eget mauris non risus suscipit volutpat. Quisque leo odio, facilisis eu mauris sed, accumsan hendrerit libero. In euismod nibh tellus, quis imperdiet orci suscipit a. Vivamus porttitor augue vitae sapien bibendum mattis. Suspendisse potenti. Donec nec ligula eu dui laoreet tempor at in leo. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident.
                                </div>
                            </div>
                            <div class="question-section">
                                <button
                                        class="btn question"
                                        type="button"
                                        data-mdb-toggle="collapse"
                                        data-mdb-target="#question3"
                                        aria-expanded="false"
                                        aria-controls="question3"
                                >
                                    Anim pariatur cliche reprehenderit?
                                </button>

                                <!-- Collapsed content -->
                                <div class="collapse answer" id="question3">
                                    Donec viverra ultricies lectus vitae maximus. Fusce nisi augue, congue id interdum quis, faucibus non justo. Maecenas egestas eu ex eget congue. Phasellus aliquet id nisi in rhoncus. Nam eget tortor nec arcu finibus euismod. Integer non nisl sit amet metus tempus finibus. Mauris eget mauris non risus suscipit volutpat. Quisque leo odio, facilisis eu mauris sed, accumsan hendrerit libero. In euismod nibh tellus, quis imperdiet orci suscipit a. Vivamus porttitor augue vitae sapien bibendum mattis. Suspendisse potenti. Donec nec ligula eu dui laoreet tempor at in leo. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident.
                                </div>
                            </div>
                            <div class="question-section">
                                <button
                                        class="btn question"
                                        type="button"
                                        data-mdb-toggle="collapse"
                                        data-mdb-target="#question4"
                                        aria-expanded="false"
                                        aria-controls="question4"
                                >
                                    Maecenas id dui volutpat, interdum risus nec, dictum quam?
                                </button>

                                <!-- Collapsed content -->
                                <div class="collapse answer" id="question4">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid.Donec viverra ultricies lectus vitae maximus. Fusce nisi augue, congue id interdum quis, faucibus non justo. Maecenas egestas eu ex eget congue. Phasellus aliquet id nisi in rhoncus. Nam eget tortor nec arcu finibus euismod. Integer non nisl sit amet metus tempus finibus. Mauris eget mauris non risus suscipit volutpat. Quisque leo odio, facilisis eu mauris sed, accumsan hendrerit libero. In euismod nibh tellus, quis imperdiet orci suscipit a. Vivamus porttitor augue vitae sapien bibendum mattis. Suspendisse potenti. Donec nec ligula eu dui laoreet tempor at in leo.  Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident.
                                </div>
                            </div>
                            <div class="question-section">
                                <button
                                        class="btn question"
                                        type="button"
                                        data-mdb-toggle="collapse"
                                        data-mdb-target="#question5"
                                        aria-expanded="false"
                                        aria-controls="question5"
                                >
                                    Enim eiusmod high life accusamus terry richardson ad
                                    squid?
                                </button>

                                <!-- Collapsed content -->
                                <div class="collapse answer" id="question5">
                                    Donec viverra ultricies lectus vitae maximus. Fusce nisi augue, congue id interdum quis, faucibus non justo. Maecenas egestas eu ex eget congue. Phasellus aliquet id nisi in rhoncus. Nam eget tortor nec arcu finibus euismod. Integer non nisl sit amet metus tempus finibus. Mauris eget mauris non risus suscipit volutpat. Quisque leo odio, facilisis eu mauris sed, accumsan hendrerit libero. In euismod nibh tellus, quis imperdiet orci suscipit a. Vivamus porttitor augue vitae sapien bibendum mattis. Suspendisse potenti. Donec nec ligula eu dui laoreet tempor at in leo. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident.
                                </div>
                            </div>
                            <div class="question-section">
                                <button
                                        class="btn question"
                                        type="button"
                                        data-mdb-toggle="collapse"
                                        data-mdb-target="#question6"
                                        aria-expanded="false"
                                        aria-controls="question6"
                                >
                                    Cras ultrices turpis id ex pretium blandit. Donec pretium vel nibh eget consectetur.
                                </button>

                                <!-- Collapsed content -->
                                <div class="collapse answer" id="question6">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident.
                                </div>
                            </div>
                        </div>
                        <form class="create-question" action="POST">
                            <div class="s-group">
                                <label class="s-control" for="text">Have a problem? Create a question</label>
                                <textarea class="s-control" name="text" id="text"></textarea>
                            </div>
                            <div class="btn-wrapper">
                                <button class="btn">Send</button>
                            </div>
                        </form>
                    </li>
                    <li class="mod-section-slide splide__slide changelog-wrapper" data-slide-id="changelog">
                        <ul class="timeline">
                            <li class="event" data-date="2 days ago">
                                <h3>Dinosaurs Roamed the Earth</h3>
                                <p>Did you know that all of our pixels are hand-forged from  🐢🦂</p>
                            </li>
                            <li class="event" data-date="23 January 2022">
                                <h3>Creative Component Launched</h3>
                                <p>"We can be all things to all people!" 📣</p>
                            </li>
                            <li class="event" id="date" data-date="12 October 2021">
                                <h3>Squareflair was Born</h3>
                                <p>"We can be all things to Squarespace users!" 📣</p>
                            </li>

                            <li class="event" data-date="23 July 2020">
                                <h3>Squareflair Today</h3>
                                <p>"We design and build from scratch!" 📣<p/> <p>When we say <em><strong>100% custom</strong></em> we mean it— and we build all sites on the Squarespace Developer platform.<p/>
                                <p>Did you know that all of our pixels are hand-forged from the rarest of subpixels grown and harvested in the <em>Nerd Forest</em>? <br>🤜💥🤛</p>
                                <p><strong>Our success can be measured by lives and brands enhanced by 9+ years of 100% Squarespace-focused service!</strong></p>
                                <p><a href="https://www.squareflair.com">squareflair.com</a></p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection