<div>
    <p>Сторінка користувача: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
</div>
<div>
    <img src="{{ $user->avatar }}" width="320" height="320" alt="user_avatar">

    @auth
        <button>
            <a href="{{ route('user.edit', ['user' => $user->id]) }}">
                Edit user
            </a>
        </button>
    @endauth
</div>