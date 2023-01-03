{{--- PREPARE BREADCURMBS ---}}
@for($i = 1; $i <= count(Request::segments()); $i++)
    @php
        if ($i > 1) // if we farther than the first page of the documentation
        {
            if (\Illuminate\Support\Facades\Session::has("breadcrumbs"))
            {
            	$breadcrumbsArray = \Illuminate\Support\Facades\Session::get("breadcrumbs");
            	$breadcrumbsLinks = $breadcrumbsArray['links'];
            	$breadcrumbsNames = $breadcrumbsArray['names'];
            }
        }
    @endphp
@endfor

{{--- MAKE BREADCURMBS LINKS CHAIN ---}}
<a href="/">Хата</a> >
<a href="{{route('documentation')}}">Документація</a>

@isset ($breadcrumbsLinks)
    @for ($i = 0; $i < count($breadcrumbsLinks) - 1; $i++)
        >   {{-- an arrow --}}


        <a href="{{ route('documentation.show', ['path' => $breadcrumbsLinks[$i]]) }}">
            {{$breadcrumbsNames[$i]}}
        </a>
    @endfor

    {{-- the last element won't be a link --}}
    <span>
        >
        {{last($breadcrumbsNames)}}
    </span>
@endif