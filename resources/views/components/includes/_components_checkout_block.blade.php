{{--
    COMPONENTS:

    ckecout block with grid
--}}

<div class="row-demo">
    <div class="col-demo">
        <b>Checkout block</b>
        <div class="s-card-grid">
            @foreach ($imgLinks as $key => $imageLink)
                <label class="s-card">
                    <input class="s-card__input" type="checkbox"  @if ($loop->last) disabled="disabled" @endif >
                    <div class="s-card__body">
                        <div class="s-card__body-cover">
                            <img class="s-card__body-cover-image" src="{{ $imageLink }}">
                            <span class="s-card__body-cover-checkbox">
                                <svg viewBox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div class="s-card__body-header">
                            <b class="s-card__body-header-title">Заголовок_{{ $key + 1 }}</b>
                            <p class="s-card__body-header-subtitle">Підзаголовок_{{ $key + 1 }}</p>
                        </div>
                    </div>
                </label>

            @endforeach
        </div>
    </div>
</div>

