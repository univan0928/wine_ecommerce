@extends('layouts.appmainbackground')

@section('content')
    <div id="loading" class="align-items-center">
        <div class = "loader m-auto"></div>
    </div>
    <div style = "" id = "slider-page">
        <div class = "header-layout" >
            @include('layouts.navbar')
            @php
                $cnt = 0;
            @endphp
            {{--    <div class="container mb-3">--}}
            {{--        <div class="d-flex justify-content-between">--}}
            {{--            <span class="h3">{{__('wine.search count')}} : 352 {{__('wine.item')}}</span>--}}
            {{--            <a class="nav-link advanced-search" href="#">{{__('wine.Advanced wine search')}}</a>--}}
            {{--        </div>--}}
            {{--    </div>--}}
            <div class="container mb-3">
                <div class="d-flex justify-content-center text-white text-center mb-2 mt-4">
                    <img class="banner-img" src="../../images/Ellipse 1 copy 4.png">

                    <span class="banner-img-text pl-3">{{__('wine.wine advisor')}}</span>
                </div>

                <div class="container mt-5 pt-4">

                    <form action="{{route('totalFind')}}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-center mt-3 mb-5">
                            <input type="search" name="content" id="content" class="form-control w-50" />
                            <button class="topBtn btn pt-0 pb-0" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="slider-1 " >

                    <div class="slick-slider">
                        @foreach($result['available_products'] as $row)
                            @php
                                $cnt++;
                            @endphp
                            {{--                    @if($cnt == 7) @break;--}}
                            {{--                    @endif--}}
                            <div class="p-2">
                                @if($row->naccs)
                                <img class="flag-img" src="/images/flags/{{$row->naccs}}@3x.png" width="26">
                                @else
                                <img class="flag-img" src="/images/default_flag.png" width="26">
                                @endif
                                <div class="text-left">
                                    <span class="year">{{$row->vintage_year?$row->vintage_year:'NV'}}</span>
                                </div>
                                <div class="text-left color-wine">
                                    @if($row->color == 1) <span class="text-danger">
                                        @elseif($row->color == 2) <span class="text-white-product">
                                        @elseif($row->color == 3) <span class="text-rose">
                                        @elseif($row->color == 0) <span class ="text-sparkling">
                                        @endif
                                        <i class="fa fa-circle ml-1"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center img">
                                    <a href="/productdetail/{{$row->product_code}}">
                                    @if($row->image_name)
                                    <img src="/images/products/{{$row->image_name}}" class="card-img-top-slider" alt="...">
                                    @else
                                            @if($row->color == 1 && $row->wine_type =='スパークリング') <img src="/images/default_red.png" class="card-img-top-slider" alt="...">
                                            @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img src="/images/default_sparkling.png" class="card-img-top-slider" alt="...">
                                            @elseif($row->color == 1) <img src="/images/default_red.png" class="card-img-top-slider" alt="...">
                                            @elseif($row->color == 2) <img src="/images/default_white.png" class="card-img-top-slider" alt="...">
                                            @elseif($row->color == 3) <img src="/images/default_rose.png" class="card-img-top-slider" alt="...">
                                            @elseif($row->color == 0) <img src="/images/default_sparkling.png" class="card-img-top-slider" alt="...">
                                            @endif
                                    @endif
                                    </a>
                                </div>
                                <span class=""></span>
                                <div class="card-body mt-2">
                                    <div class="card-top mb-2">
                                        <div class = "card-title-name">
                                            <div class="card-title mb-0">{{$row->maker_name}}</div>
                                            <div class="card-title mb-0"><b><a class="text-black no-underline" href="/productdetail/{{$row->product_code}}">{{$row->full_product_name}}</a></b></div>
                                        </div>
                                        <div class="card-title-amount">
                                            <p class="card-text m-0">{{$row->amount * 1000}}ml<br>
                                            <span class="text-bold">{{number_format(intval($row->shop_price))}}円</span>  ({{__('wine.Retail Price')}})</p>
                                        </div>
                                        <span class="badge badge-pill badge-dark">RP {{$row->rate}}</span>
                                    </div>
                                    {{--                        <div class="d-flex justify-content-center mb-2">--}}
                                    {{--                            <span class="fa fa-star checked"></span>--}}
                                    {{--                            <span class="fa fa-star checked"></span>--}}
                                    {{--                            <span class="fa fa-star checked"></span>--}}
                                    {{--                            <span class="fa fa-star"></span>--}}
                                    {{--                            <span class="fa fa-star"></span>--}}
                                    {{--                        </div>--}}

                                    <div class="but1 text-center ajax_cart" data-id = {{$row->product_code}}>{{__('wine.add to cart')}}</div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>



        <div>
            <div class="container mb-3 pb-3">
                <div class="card-type">
                    <div class="card-body">
                        <!--Table-->
                        <table class="table table-hover">
                            <!--Table head-->
                            <thead class="mdb-color darken-3">
                            <tr class="text-black">
                                <th></th>
                                <th>{{__('wine.Origine Country')}}</th>
                                <th>{{__('wine.Producer name')}}</th>
                                {{--                            <th>{{__('wine.Scheduled Arrive')}}</th>--}}
                                <th>{{__('wine.Evalution')}}</th>
                                <th>{{__('wine.Capacity')}}</th>
                                <th>{{__('wine.Suggested Price')}}</th>
                                <th>{{__('wine.add to cart')}}</th>
                            </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                            @foreach($result['available_products'] as $row)
                                <tr>
                                    <td>
                                        <div class="wine_img">
                                            <a class="text-black no-underline" href="/productdetail/{{$row->product_code}}">
                                            @if($row->image_name)
                                            <img style = "padding-left:10px" src="/images/products/{{$row->image_name}}" alt="...">
                                            @else
                                                    @if($row->color == 1 && $row->wine_type =='スパークリング') <img src="/images/default_red.png" alt="...">
                                                    @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img src="/images/default_sparkling.png" alt="...">
                                                    @elseif($row->color == 1) <img src="/images/default_red.png" alt="...">
                                                    @elseif($row->color == 2) <img src="/images/default_white.png" alt="...">
                                                    @elseif($row->color == 3) <img src="/images/default_rose.png" alt="...">
                                                    @elseif($row->color == 0) <img src="/images/default_sparkling.png" alt="...">
                                                    @endif
                                            @endif
                                            </a>
                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div>
                                            @if($row->naccs)
                                                <img src="/images/flags/{{$row->naccs}}@3x.png" width="26"></div>
                                            @else
                                                <img src="/images/default_flag.png" width="26"></div>
                                            @endif
                                        <div class="no-wrap">{{$row->country_jp_name}}</div>
                                        <div><span class="year">{{$row->vintage_year?$row->vintage_year:'NV'}}</span></div>
                                        @if($row->color == 1) <span class="text-danger">
                                        @elseif($row->color == 2) <span class="text-white-product">
                                        @elseif($row->color == 3) <span class="text-rose">
                                        @elseif($row->color == 0) <span class ="text-sparkling">
                                        @endif
                                            <i class="fa fa-circle ml-1"></i>

                                        </span>
                                    </td>
                                    {{--                            <td><div class="card-title1 mb-0">ｼｬﾄｰ元詰</div><div class="card-title1 mb-0"><b>ｼｬﾄｰ･ﾗﾌｨｯﾄ</b></div><div class="d-flex justify-content-center"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div></td>--}}
                                    <td>
                                        <div class="card-title1 mb-0">{{$row->maker_name}}</div>
                                        <div class="card-title1 mb-0"><b><a class="text-black no-underline" href="/productdetail/{{$row->product_code}}">{{$row->full_product_name}}</a></b></div>
                                        {{--                                <div class="d-flex justify-content-center"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>--}}
                                    </td>
                                    <td><span class="badge badge-pill badge-dark">RP {{$row->rate}}</span></td>
                                    <td><div>{{$row->amount * 1000}}ml</div></td>
                                    <td>{{number_format((int)$row->shop_price)}}円</td>
                                    <td><div class="but1 text-center ajax_cart" data-id = {{$row->product_code}}>{{__('wine.add to cart')}}</div></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.slick-slider').slick({
            centerMode: true,
            slidesToShow: 5,
            dots: true,
            arrows: false,
            swipe: true,
            swipeToSlide: true,
            adaptiveHeight: true,
            infinite: false,
            autoplay: true,
            autoplaySpeed: 2000,
            pauseOnFocus: false,
            pauseOnHover: true,
            pauseOnDotsHover: false,
            initialSlide: 2,
            // slidesToScroll: 5,

            responsive: [
                {
                    breakpoint: 1640,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
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
        $(".ajax_cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('addToCart') }}',
                method: "POST",
                data: {id: ele.attr("data-id")},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // console.log(response);
                    // window.location.reload();
                    $('#cart_dropdown_refresh').html(response);
                }
            });
        });
    </script>
@endsection
