{{-- MOD REVIEW COMMON DESCRIPTION --}}


<div class="drop-down-list">
    <h3 class="title">Загальний опис:</h3>

    <div class="drop-down-list-content hide">
        <br>
        Користувач може написати власний огляд-відгук, який
        буде містити коментар на модифікацію
        (review, на скріні виділено червоним)
        та задати для даної модифікації оцінку (mod rating, на скріні виділено зеленим).
        <br>
        Такий огляд, в сутності, являє собою коментар до модифікації.
        <br><br>
        <img src="{{ asset($pathToImages . "mod_review.png") }}" width="320" alt="mod_review">

        <p>
            Має відношення з:
        <ul>
            <li>
                <a href="{{ route('documentation.show', ['path' => "models.mod"]) }}">
                    модифікацією
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "models.mod-rating"]) }}">
                    оцінкою модифікації
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "models.user"]) }}">
                    автором модифікації
                </a>
            </li>
        </ul>

        <br><br><hr>
    </div> {{-- menu content --}}
</div> {{-- menu --}}