@extends('documentation.base')

@section('content')
    <h1>FACTORY</h1>

    <p>
        Розташування: <span class="variable-name">proj_root/database/factories/</span>
    </p>

    <div>
        <h3>Перелік:</h3>
        <ul>
            {{----------------------------- MOD FACTORIES -----------------------------}}
            <li>
               <a href="{{ route('documentation.show', ['path' => 'factory.mod-factory']) }}">
                   <span class="file-name">ModFactory</span>
               </a>
            </li>
            <li>
                <a href="{{ route('documentation.show', ['path' => 'factory.mod-rating-factory']) }}">
                    <span class="file-name">ModRatingFactory</span>
                </a>
            </li>
            <li>
                <a href="{{ route('documentation.show', ['path' => 'factory.mod-review-factory']) }}">
                    <span class="file-name">ModReviewFactory</span>
                </a>
            </li>



            {{----------------------------- POST FACTORIES -----------------------------}}
            <li>
                <a href="{{ route('documentation.show', ['path' => 'factory.post-category-factory']) }}">
                    <span class="file-name">PostCategoryFactory</span>
                </a>
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => 'factory.post-factory']) }}">
                    <span class="file-name">PostFactory</span>
                </a>
            </li>



            {{----------------------------- USER FACTORY ------------------------------}}
            <li>
                <a href="{{ route('documentation.show', ['path' => 'factory.user-factory']) }}">
                    <span class="file-name">UserFactory</span>
                </a>
            </li>
        </ul>
    </div>
@endsection