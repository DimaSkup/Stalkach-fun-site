{{--
      A SINGLE MODIFICATION PAGE
      (navigation menu)

      this menu is placed under the header section
--}}

<nav class="mod-menu" id="mod-navigation">

    <a href="#description" class="active">
        <div class="nav-wrapper">
            <span class="material-icons">description</span>
            <span class="title">Description</span>
        </div>
    </a>
    <a href="#reviews">
        <div class="nav-wrapper">
            <span class="material-icons">reviews</span>
            <span class="title">Reviews</span>
        </div>
    </a>
    <a href="#faq">
        <div class="nav-wrapper">
            <span class="material-icons">question_answer</span>
            <span class="title">Q&A</span>
        </div>
    </a>
    <a href="#changelog">
        <div class="nav-wrapper">
            <span class="material-icons">update</span>
            <span class="title">Changelog</span>
        </div>
    </a>
    <a href="{{ $mod->reviewVideoUrl }}" target="_blank">
        <div class="nav-wrapper">
            <span class="material-icons">ondemand_video</span>
            <span class="title">Video Review</span>
        </div>
    </a>
    <a href="#" target="_blank">
        <div class="nav-wrapper">
            <span class="material-icons">route</span>
            <span class="title">Guide</span>
        </div>
    </a>
</nav>