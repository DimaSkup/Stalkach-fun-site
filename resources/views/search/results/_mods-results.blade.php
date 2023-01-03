<div class="">
    <ul class="">
        @foreach ($content['mods'] as $modification)
            <div>
                {{-- a link to the page with this modification --}}
                <a href="{{ route('mods.show', $modification->slug) }}">

                    {{-- the modification image --}}
                    <img src="{{ $modification->main_image }}" width="720" height="480" alt="post_image">

                    <div class="">
                        {{-- an authors name --}}
                        <div class="">
                            <span>{{ $modification->author->name }}</span>
                        </div>

                        <div class="">{{ $modification->name }}</div>
                        <div class=""> {{ $modification->views }} {{__('views')}} &bull; {{ $modification->created_at }}</div>
                    </div>
                </a>
                <hr>
            </div>
        @endforeach
    </ul>
</div>