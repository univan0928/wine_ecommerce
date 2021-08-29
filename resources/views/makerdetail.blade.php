@extends('layouts.appmain')

@section('content')
    @php
        $maker = $result['maker'];
    @endphp

    @if($maker)
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class = "page-list font-weight-bold text-default">
                    <a class="text-default" href="{{route('home')}}">{{__('wine.Home')}}</a>&nbsp>&nbsp@php echo mb_convert_kana($maker->jp_name,'KVC')@endphp
                </div>
                <a class="home-addtocart" href="{{ route('advancedSearch') }}"><div class="but1 p-2">{{__('wine.Advanced wine search')}}</div></a>
            </div>
        </div>

        <div class="">
            <div class = "pt-2">
                <div class = "">

                        @if(isset($maker->pdf_maker_place) && $maker->pdf_maker_place!='')
                            <img src="{{asset("images/bigplaces/".$maker->pdf_maker_place)}}" class = "makerdetail-banner w-100"/>
                        @else
                            <img src="{{asset("images/bigplaces/default_large.png")}}" class = "makerdetail-banner w-100"/>
                        @endif
                        <div style = "margin-top:-150px; width:100%">
                            <svg class="swoop" width="100%"  style = "" xmlns="http://www.w3.org/2000/svg">
                                <filter id="dropShadow" >
                                    <feGaussianBlur in="SourceAlpha" stdDeviation="6"></feGaussianBlur>
                                    <feOffset dx="2" dy="4"></feOffset>
                                    <feMerge>
                                        <feMergeNode></feMergeNode>
                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                    </feMerge>
                                </filter>
                                <ellipse cx="33%" cy="250%" fill="#fff" filter="url(#dropShadow)" rx="100%" ry="300"></ellipse>
                            </svg>
                        </div>


                </div>
                <div class = "container">
                    <div class ="row">
                        <div class = "pl-5" style = "margin-top:-100px; width:100%">
                            <h1 class = "mt-5 font-weight-bold">{{$maker->en_name}}</h1>
                            <h1 class = "font-weight-bold"> @php echo mb_convert_kana($maker->jp_name,'KVC')@endphp</h1>
                            <h4 class = "m-4 text-grey">{{$maker->foreign_maker_id}}</h4>
                        </div>
                    </div>
                    <div class ="row m-3">
                        <div class = "col-md-8">
                            <h4 class = "font-weight-bold">{{__('wine.comment')}}</h4>
                            <p class = "detail-toptext">{{$maker->maker_description}}</p>
                        </div>
                        <div class = "col-md-4 align-items-center d-flex">
                            <img class="w-100 mb-2" src="../../images/logo_black.png">
                        </div>
                    </div>

                    <div class="default-slider">
                        <div class = "makerdetail-slider-img">
                            @if(isset($maker->maker_name)&&$maker->maker_name!='')
                                <img src="{{asset("images/detailmaker/".$maker->maker_name)}}" class = "w-100"/>
                            @else
                                <img src="{{asset("images/detailmaker/default.png")}}" class = "w-100"/>
                            @endif
                        </div>
                        <div class = "makerdetail-slider-img">
                            @if(isset($maker->maker_place)&&$maker->maker_place!='')
                                <img src="{{asset("images/places/".$maker->maker_place)}}" class = 'w-100'>
                            @else
                                <img src="{{asset("images/places/place.png")}}" class = "w-100"/>
                            @endif
                        </div>
                        <div class = "makerdetail-slider-img">
                            @if(isset($maker->maker_place_2)&&$maker->maker_place_2!='')
                                <img src="{{asset("images/places_2/".$maker->maker_place_2)}}" class = 'w-100'>
                            @else
                                <img src="{{asset("images/places_2/place.png")}}" class = "w-100"/>
                            @endif
                        </div>
                        <div class = "makerdetail-slider-img">
                            @if(isset($maker->maker_place_3)&&$maker->maker_place_3!='')
                                <img src="{{asset("images/places_3/".$maker->maker_place_3)}}" class = 'w-100'>
                            @else
                                <img src="{{asset("images/places_3/place.png")}}" class = "w-100"/>
                            @endif
                        </div>


                    </div>
                    <div class = "maker-card row mt-3">
                        <div class = "col-md-6 p-3">
                            <p class = "detail-toptext font-weight-bold">
                                {{__('wine.E-Mail Address')}}: {{$maker->maker_address}}
                            </p>
                            <p class = "detail-toptext font-weight-bold">

                                {{__('wine.country list')}}:
                                @if($maker->naccs)
                                    <img src="/images/flags/{{$maker->naccs}}@3x.png" width="26">
                                @else
                                    <img src="/images/default_flag.png" width="26">
                                @endif
                                {{$maker->country_jp_name}}

                            </p>
                            <p class = "detail-toptext font-weight-bold">
                                {{__('wine.Area name')}}:
                            </p>
                        </div>
                        <div class = "col-md-6 p-3">
                            <p class = "detail-toptext font-weight-bold">
                                Website: {{$maker->maker_url}}
                            </p>
                            <p class = "detail-toptext font-weight-bold">
                                {{__('wine.tel')}}: {{$maker->maker_phone}}
                            </p>
                            {{--                            <p class = "detail-toptext font-weight-bold">--}}
                            {{--                                Stats etc:--}}
                            {{--                            </p>--}}
                            <p class = "detail-toptext font-weight-bold">
                                {{__('wine.Rating')}}:
                            </p>
                        </div>
                        <div class = "col-md-12 p-5">
                            <div class = "m-auto" id="map" style = "width:80%; height:400px"></div>
                        </div>
                    </div>
                    <div class = "row mb-4">
                        <div class = "col-md-6 p-3">

                        </div>
                        <div class = "col-md-6 p-3"></div>
                    </div>
                    <div class = "row">
                        <h3 class = "font-weight-bold">{{__('wine.Product')}}</h3>
                        @include('products.makermodal');
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="container mb-3 mh-50">
            <div class = "card-type p-3">
                <div class = "row">
                    <div class = "col-xs-12 p-3">
                        {{__('wine.no_product')}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCU-KS2NjGzKtUumiURBnQ-q3VLcRYGogM&callback=initMap&libraries=&v=weekly"
        async
    ></script>
    <script type="text/javascript">

        function initMap() {
            // The location of Uluru
            const uluru = { lat: -25.344, lng: 131.036 };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }

         $('.default-slider').slick({
             slidesToShow: 3,
             slidesToScroll: 1,
             infinite: true,

             responsive: [
                 {
                     breakpoint: 1640,
                     settings: {
                         slidesToShow: 3,
                         slidesToScroll: 1,
                     }
                 },
                 {
                     breakpoint: 1200,
                     settings: {
                         slidesToShow: 3,
                         slidesToScroll: 1,
                     },
                 },
                 {
                     breakpoint: 768,
                     settings: {
                         slidesToShow: 1,
                         slidesToScroll: 1
                     },
                 },
                 {
                     breakpoint: 558,
                     settings: {
                         slidesToShow: 1,
                         slidesToScroll: 1
                     },
                 }
             ]
         });
        $(window).on('load', function () {
            $('#loading').hide();
        });

    </script>
@endsection
