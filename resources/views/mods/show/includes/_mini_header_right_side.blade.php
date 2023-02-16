{{--
    A SINGLE MODIFICATION PAGE
    (mini header)

    mod stats: rating, subscribers, and views
--}}

<div class="right-side">
    <div class="stat-block">
        <span><b>{{ $mod->averageGrade }}</b>/10</span>
        <small>Rating</small>
    </div>
    <div class="stat-block">
        <span>{{ $mod->subscribersCount }}</span>
        <small>Subscribers</small>
    </div>
    <div class="stat-block">
        <span>{{ $mod->views }}</span>
        <small>Views</small>
    </div>
</div>