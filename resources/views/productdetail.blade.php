@extends('layouts.appmain')

@section('content')
    @php
        $row = $result['product'];
    @endphp

    @if($row)
    <div class="container mb-3">
        <div class="d-flex justify-content-between">
            <div class = "page-list font-weight-bold text-default">
                <a class="text-default" href="{{route('home')}}">{{__('wine.Home')}}</a>&nbsp>&nbsp<a class="text-default" href="{{route('findWine')}}">{{__('wine.findWine')}}</a>&nbsp>&nbsp@php echo mb_convert_kana($row->full_product_name,'KVC') @endphp
            </div>
            <a class="home-addtocart" href="{{ route('advancedSearch') }}"><div class="but1 p-2">{{__('wine.Advanced wine search')}}</div></a>
        </div>
    </div>
    <div class="container">
        <div class = "card-type p-3">
            <div class = "row">
                <div class = "col-md-4">
                    <div class = "detail-img-background row">
                            <div class = "col-4 col-md-12 ">
                            @if($row->big_image_name)
                                <img src="/images/bigproducts/{{$row->image_name}}" class="detail-img-active" alt="...">
                            @else
                                @if($row->color == 1 && $row->wine_type =='スパークリング') <img src="/images/default_red_large.png" class="detail-img" alt="...">
                                @elseif($row->color!=1 && $row->wine_type =='スパークリング') <img src="/images/default_sparkling_large.png" class="detail-img" alt="...">
                                @elseif($row->color == 1) <img src="/images/default_red_large.png" class="detail-img" alt="...">
                                @elseif($row->color == 2) <img src="/images/default_white_large.png" class="detail-img" alt="...">
                                @elseif($row->color == 3) <img src="/images/default_rose_large.png" class="detail-img" alt="...">
                                @elseif($row->color == 0) <img src="/images/default_sparkling_large.png" class="detail-img" alt="...">
                                @endif
                            @endif
                        </div>

                    </div>
                    <div class = "m-2">
                        @if($row->current_stock > 0) <div class="w-75 but1 p-2 m-auto text-center ajax_cart" data-id = {{$row->product_code}}>{{__('wine.add to cart')}}</div>
                        @elseif($row->is_reserve == 1) <div class="w-75 m-auto but text-center">{{__('wine.reservation')}}</div>
                        @else <div class="w-75 m-auto but2 text-center">{{__('wine.coming soon')}}</div>
                        @endif
                    </div>
                    <div class = "m-2">
                        @if($row->current_stock > 0) <div class="w-75 but5 p-2 m-auto text-center ajax_case_cart" data-price = {{$row->case_price}} data-case ={{$row->bottles_per_case}} data-id = {{$row->product_code}}>{{__('wine.add case to cart')}}</div>
                        @elseif($row->is_reserve == 1) <div class="w-75 m-auto but text-center">{{__('wine.reservation')}}</div>
                        @else <div class="w-75 m-auto but2 text-center">{{__('wine.coming soon')}}</div>
                        @endif
                    </div>
                </div>
                <div class = "col-md-8 p-4">
                    <div class = "detail-toptext">
                            @if($row->color == 1) <span class="text-danger">
                        @elseif($row->color == 2) <span class="text-white-product">
                        @elseif($row->color == 3) <span class="text-rose">
                        @elseif($row->color == 0) <span class ="text-sparkling">
                        @endif
                            <i class="fa fa-circle ml-1"></i>
                        </span>
                        <span>{{$row->full_english_name}}</span>
                    </div>
                    <h2 class="font-weight-bold mt-3 mb-3">
                        @php echo mb_convert_kana($row->full_product_name,'KVC') @endphp
                    </h2>
                    <p class = "detail-toptext">
                        {{$row->description}}
                    </p>
                    <div class = "underline mt-4 mb-4"></div>
                    <div class = "row maker-desc justify-content-center">
                        <div class="col-md-4 ">
                            <p class="detail-toptext"><strong>{{__('wine.maker name')}}:</strong>&nbsp;&nbsp;&nbsp;

                            </p>
                            <p class = "detail-toptext">
                                <a href = "/makerdetail/{{$row->foreign_maker_code}}">
                                    @php echo mb_convert_kana($row->maker_name,'KVC') @endphp
                                </a>
                            </p>
                            <p class="detail-toptext">
                                <a href = "/makerdetail/{{$row->foreign_maker_code}}">
                                {{$row->maker_en_name}}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-4 mr-5 ml-5 m-md-0 pr-5 pb-1 pl-5 p-md-2">
                            @if(isset($row->foreign_maker_code) && file_exists( public_path() . '/images/detailmaker/'. $row->foreign_maker_code .'.png'))
                                <img class = "maker-desc1" src = "{{ asset('images/detailmaker/'.$row->foreign_maker_code.'.png' )}}" />
                            @else
                                <img class = "maker-desc1" src = "{{ asset('images/maker/default.png') }}" />
                            @endif
                        </div>
                        <div class="col-md-4 mr-5 ml-5 m-md-0 pr-5 pb-1 pl-5 p-md-2">
                            @if(isset($row->foreign_maker_code) && file_exists( public_path() . '/images/places/'. $row->foreign_maker_code .'.png'))
                            <img class = "maker-desc2" src = "{{ asset('images/places/'.$row->foreign_maker_code.'.png') }}" />
                            @else
                            <img class = "maker-desc2" src = "{{ asset('images/places/place.png') }}" />
                            @endif
                        </div>

                    </div>
                    <div class = "underline mt-4 mb-4"></div>
                    <div class = "row">
                        <div class = "col-md-12 mb-3">
                            <h4 class="font-weight-bold">{{__('wine.product information')}}</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="detail-toptext"><strong>{{__('wine.country list')}}:</strong>&nbsp;&nbsp;&nbsp;
                                @if($row->naccs)
                                <img src="/images/flags/{{$row->naccs}}@3x.png" width="26">
                                @else
                                <img src="/images/default_flag.png" width="26">
                                @endif
                                {{$row->country_jp_name}}
                            </p>
                            <p class="detail-toptext"><strong>{{__('wine.Area name')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->region}}</p>
                            <p class="detail-toptext"><strong>{{__('wine.Local name')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->local_area}}</p>
                        </div>
                        <div class="col-md-6">

                            <p class="detail-toptext"><strong>{{__('wine.village name')}}:</strong>&nbsp;&nbsp;&nbsp;-</p>
                            <p class="detail-toptext"><strong>{{__('wine.Rating')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->certification}}</p>
                        </div>
                    </div>
                    <div class = "underline mt-4 mb-4"></div>
                    <div class = "row">
                        <div class="col-md-6">
                            <p class="detail-toptext"><strong>{{__('wine.Color')}}:</strong>&nbsp;&nbsp;&nbsp;
                                @if($row->color == 1) 赤
                                @elseif($row->color == 2) 白
                                @elseif($row->color == 3) ﾛｾﾞ
{{--                                @elseif($row->color == 0) スパークリング--}}
                                @endif
                            </p>
                            <p class="detail-toptext"><strong>{{__('wine.Type')}}:</strong>
                                &nbsp;&nbsp;&nbsp;{{$row->wine_type}}
{{--                                @if($row->color == 0) {{__('wine.Sparkling wine')}}--}}
{{--                                @else {{__('wine.Still wine')}}--}}
{{--                                @endif--}}
                            </p>
                            <p class="detail-toptext"><strong>{{__('wine.vintage')}}:</strong>&nbsp;&nbsp;&nbsp;
                                @php
                                    echo $row->vintage_year?$row->vintage_year.__('wine.year') :'<small class="text-grey">NV</small>'
                                @endphp
                            </p>
                            <p class="detail-toptext"><strong>{{__('wine.drinking temperature')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->drinking_temperature}}度</p>
                            <p class="detail-toptext"><strong>{{__('wine.Suggested Price')}}:</strong>&nbsp;&nbsp;&nbsp;{{number_format((int)$row->shop_price)}}円</p>
                        </div>
                        <div class="col-md-6">
                            <p class="detail-toptext"><strong>{{__('wine.Taste')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->type_name}}</p>
                            <p class="detail-toptext"><strong>{{__('wine.Capacity')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->amount * 1000}}ml</p>
                            <p class="detail-toptext"><strong>{{__('wine.variety')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->variety}}</p>
                            <p class="detail-toptext"><strong>入数:</strong>&nbsp;&nbsp;&nbsp;{{$row->bottles_per_case}}</p>
                            <p class="detail-toptext"><strong>{{__('wine.case')}}:</strong>&nbsp;&nbsp;&nbsp;{{number_format((int)$row->case_price)}}円</p>
                        </div>
                    </div>
                    <div class = "underline mt-4 mb-4"></div>
                    <div class = "row">
                        <div class = "col-md-12 mb-3">
                            <h4 class="font-weight-bold">{{__('wine.production information')}}</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="detail-toptext"><strong>{{__('wine.Annual production')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->annual_amount}}本</p>
                            <p class="detail-toptext"><strong>{{__('wine.Cultivated area')}}:</strong>&nbsp;&nbsp;&nbsp;1000ha</p>
                            <p class="detail-toptext"><strong>{{__('wine.Average yield')}}:</strong>&nbsp;&nbsp;&nbsp;-</p>

                        </div>
                        <div class="col-md-6">

                            <p class="detail-toptext"><strong>{{__('wine.Tree age')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->tree_age}}</p>
                            <p class="detail-toptext"><strong>{{__('wine.soil')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->soil}}-</p>
                        </div>
                    </div>
                    <div class = "underline mt-4 mb-4"></div>
                    <div class = "row">

                        <div class="col-md-6">
                            <p class="detail-toptext"><strong>{{__('wine.jancode')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->jan_code}}</p>
                            <p class="detail-toptext"><strong>{{__('wine.product code')}}:</strong>&nbsp;&nbsp;&nbsp;{{$row->product_code}}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="detail-toptext"><strong>{{__('wine.cap specification')}}:</strong>&nbsp;{{$row->cap}}</p>
                            <p class="detail-toptext"><strong>{{__('wine.stock')}}:</strong>&nbsp;{{$row->current_stock}}</p>
                        </div>
                    </div>
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

    <script>
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
        $(".ajax_case_cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('addCaseToCart') }}',
                method: "POST",
                data: {id: ele.attr("data-id"), case:ele.attr("data-case"),case_price:ele.attr("data-price")},
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
