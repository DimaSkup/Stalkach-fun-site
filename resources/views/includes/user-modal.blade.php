<div class="dropdown">
    <button class="user-block {{ (isset($isMin) && $isMin) ? 'min' : '' }} dropdown-toggle"
            type="button"
            id="userInfoDropdown-{{ $user->id }}"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
    >
        <div class="avatar">
            <img src="https://steamuserimages-a.akamaihd.net/ugc/1286290882126965835/26B84DE8DD029438842A6165AF2FD7C9B5D370F1/?imw=88&imh=88&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true">
        </div>
        <div class="name">{{ $user->name }}</div>
    </button>
    <ul class="dropdown-menu" aria-labelledby="userInfoDropdown-{{ $user->id }}">
        <li><a class="dropdown-item" href="#">Go to Account</a></li>
        <li><a class="dropdown-item" href="#">Subscribe</a></li>
    </ul>
</div>