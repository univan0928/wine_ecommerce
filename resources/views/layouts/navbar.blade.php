<div>
    <div class="container mb-3">
        <nav class="navbar navbar-light d-flex card-type font-weight-bold">
            <a class="@if(isset($result['navbar'])&& $result['navbar']=='home') active @endif nav-link" href="{{route('home')}}">{{__('wine.Home')}}</a>
            <a class="@if(isset($result['navbar'])&&$result['navbar']=='findWine') active @endif nav-link" href="{{ route('findWine') }}">{{__('wine.Fnd Wine')}}</a>
{{--            <a class="@if(isset($result['navbar'])&&$result['navbar']=='aboutWine') active @endif nav-link" href="#">{{__('wine.About Wine')}}</a>--}}
            <a class="@if(isset($result['navbar'])&&$result['navbar']=='wineRanking') active @endif nav-link" href="{{route('productRanking')}}">{{__('wine.Wine Raking')}}</a>
            <a class="@if(isset($result['navbar'])&&$result['navbar']=='makerRanking') active @endif nav-link" href="{{route('makerRanking')}}">{{__('wine.Producer Raking')}}</a>
        </nav>
    </div>
</div>
