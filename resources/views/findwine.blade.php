@extends('layouts.appmain')

@section('content')


<div class="container mb-3">
    <div class = "page-list font-weight-bold text-default">
        <a class="text-default" href="{{route('home')}}">{{__('wine.Home')}}</a>&nbsp>&nbsp{{__('wine.'.Route::current()->getName())}}
    </div>
    <div class="d-flex justify-content-between">
        <div class = "row result-title">
            <div class ="col-md-6">
                <span class="h4 pr-3">{{__('wine.total count')}} : {{$result['total_count']}}{{__('wine.item')}}</span>
            </div>
            <div class = "col-md-6">
                <span class="h4"> {{__('wine.search count')}} : <span id = 'searchResult' class = "h4">{{$result['total_count']}}</span>{{__('wine.item')}}</span>
            </div>
        </div>
        <div class = "d-flex">

            <a class="home-addtocart" href="{{ route('rangeSearch') }}"><div class="but1 mr-2 p-2" >{{__('wine.search')}}</div></a>
            <a class="home-addtocart" href="{{ route('advancedSearch') }}"><div class="but1 p-2">{{__('wine.Advanced wine search')}}</div></a>

        </div>

    </div>
</div>
<div class="container">
    <div class="card-type col-md-12 mb-5 row ml-0 pb-3">




{{--        <div class="col-md-2 col-xl-2 mt-3 mb-3 text-left">--}}
{{--            {{__('wine.Filter By Date')}}--}}
{{--        </div>--}}


        <div class = "col-md-3 col-xl-3 mt-2 mb-2" >
            <div class = "col-md-12 row">
                <div class = "col-12 p-0 m-0">
                    <label class = "p-0 m-0" for="cars mr-2 ml">     {{__('wine.vintage')}}</label>
                </div>

                <div class = " mr-1" style="position:relative;width:80px;height:25px;border:0;padding:0;margin:0;">
                    <select class = "form-control" style="position:absolute;top:0px;left:0px;width:80px; height:25px;line-height:20px;margin:1px 0 0 0;padding:0;"
                            onchange="document.getElementById('vintageDate').value=this.options[this.selectedIndex].text;loadDataStart()">
                        <option value=""></option>
                        @for($i = 1950;$i<= date('Y');$i++)
                            <option value={{$i}}>{{$i}}</option>
                        @endfor
                    </select>
                    <input class = "input-search-type-orignal" type="number" name="vintageDate" id="vintageDate"
                           onfocus="this.select()"
                           onchange="loadDataStart()"
                           style="position:absolute;top:0px;left:0px;width:60px;height:23px;margin:2px 1px 1px 1px;border:0px"  >

                </div>

            </div>
        </div>

        <div class = "col-md-7 col-xl-7 mb-2 mt-2">
            <label for="product_name" class="p-0 m-0">{{__('wine.maker name')}}</label><br>
            <input type="text" style = "height:25px" class="input-search-type-orignal maker-w" oninput="loadDataStart()" id="maker_name" name="maker_name">
        </div>
        <div class = "col-md-4 col-xl-3">
            <div class = "row vintage-padding">

                {{--                <div class="input-wrap">--}}


                {{--                </div>--}}
                <div class = "col-md-6 row mr-2">
                    <div class = " mr-1" style="position:relative;width:80px;height:25px;border:0;padding:0;margin:0;">
                        <select class = "form-control" style="position:absolute;top:0px;left:0px;width:80px; height:25px;line-height:20px;margin:1px 0 0 0;padding:0;"
                                onchange="document.getElementById('startDate').value=this.options[this.selectedIndex].text;loadDataStart()">
                            <option value=""></option>
                            @for($i = 1950;$i<= date('Y');$i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
                        </select>
                        <input class = "input-search-type-orignal" type="number" name="startDate" id="startDate"
                               onfocus="this.select()"
                               onchange="loadDataStart()"
                               style="position:absolute;top:0px;left:0px;width:60px;height:23px;margin:2px 1px 1px 1px;border:0px"  >

                    </div>
                    <label for="cars mr-2 ml">     {{__('wine.From')}}</label>
                </div>



                <div class = "col-md-6 row">
                    <div class = "mr-1" style="position:relative;width:80px;height:25px;border:0;padding:0;margin:0;">
                        <select class = "form-control" style="position:absolute;top:0px;left:0px;width:80px; height:25px;line-height:20px;margin:1px 0 0 0;padding:0;"
                                onchange="document.getElementById('endDate').value=this.options[this.selectedIndex].text;loadDataStart()">
                            <option value=""></option>
                            @for($i = 1950;$i<= date('Y');$i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
                        </select>
                        <input class = "input-search-type-orignal" type="number" name="endDate" id="endDate"
                               onfocus="this.select()"
                               onchange="loadDataStart()"
                               style="position:absolute;top:0px;left:0px;width:60px;height:23px;margin:2px 1px 1px 1px;border:0px">
                    </div>
                    <div>
                        <label for="cars mr-2 pr-3">{{__('wine.To')}}</label>
                    </div>

                </div>


                {{--                <div class="col-md-5 text-left">--}}
                {{--                    <input list="startDateInput" class="input-search-type-orignal" type="text" id="startDate" name="startDate" onchange="loadDataStart()">--}}
                {{--                    <datalist id = "startDateInput">--}}
                {{--                        @for($i = 1950;$i<= date('Y');$i++)--}}
                {{--                            <option value={{$i}}>{{$i}}</option>--}}
                {{--                        @endfor--}}
                {{--                    </datalist>--}}

                {{--                </div>--}}
                {{--                <div class="col-md-6 text-left">--}}
                {{--                    <input list="endDateInput" class="input-search-type-orignal" type="text" id="endDate" name="endDate" onchange="loadDataStart()">--}}
                {{--                    <datalist id = "endDateInput">--}}
                {{--                        @for($i = 1950;$i<= date('Y');$i++)--}}
                {{--                            <option value={{$i}}>{{$i}}</option>--}}
                {{--                        @endfor--}}
                {{--                    </datalist>--}}

                {{--                    <select name="cars" id="endDate" onchange = "loadDataStart()">--}}
                {{--                        <option value=""></option>--}}
                {{--                        @for($i = 1950;$i<= date('Y');$i++){--}}
                {{--                        @if($i == date('Y'))--}}
                {{--                            <option value={{$i}}>{{$i}}</option>--}}
                {{--                        @else <option value={{$i}}>{{$i}}</option>--}}
                {{--                        @endif--}}
                {{--                        }--}}
                {{--                        @endfor--}}
                {{--                    </select>--}}
                {{--                    <label for="cars mr-2">{{__('wine.To')}}</label>--}}
                {{--                </div>--}}
            </div>
        </div>


        <div class="col-md-4 col-xl-3">
            <select class = "select-control"  name="cars" id="countryList" onchange = "loadDataCountry()">
                <option value=""></option>
                @foreach ($result['all_countries'] as $row)
                <option value={{$row->country_en_name}}>{{$row->country_jp_name}}</option>
                @endforeach
            </select>
            <label for="exampleCheck2">{{__('wine.country list')}}</label>
        </div>
        <div class="col-md-4 col-xl-3" id = "region">
            <select class = "select-control" name="cars" id="regionList" onchange = "loadDataStart()">
{{--                @foreach ($result['all_regions'] as $row)--}}
{{--                    <option value={{$row->region_jp_name}}>{{$row->region_jp_name}}</option>--}}
{{--                @endforeach--}}
            </select>
            <label class = "" for="exampleCheck2">{{__('wine.local name search')}}</label>
        </div>



        <div class="col-md-7 col-xl-3">
            <div class="form-check pl-0">
                <input type="checkbox" id="availableCheck" onclick = "loadDataStart()">
                <label class="form-check-label" for="availableCheck">{{__('wine.Available stock')}}</label>
            </div>
        </div>

    </div>
    <div id ='result'>
        @include('products.modal');
{{--        @foreach($result['all_products'] as $row)--}}
{{--        <div class="col mb-4">--}}
{{--            <div class="card card-product p-2">--}}
{{--                @if($row->naccs)--}}
{{--                <img src="/images/flags/{{$row->naccs}}@3x.png" width="26">--}}
{{--                @else--}}
{{--                <img src="/images/default_flag.png" width="26">--}}
{{--                @endif--}}
{{--                <span style="font-size: 12px;">{{$row->vintage_year?$row->vintage_year:''}}</span>--}}
{{--                @if($row->color == 1) <span class="text-danger">--}}
{{--                @elseif($row->color == 2) <span class="text-white-product">--}}
{{--                @elseif($row->color == 3) <span class="text-rose">--}}
{{--                @elseif($row->color == 0) <span class ="text-sparkling">--}}
{{--                @endif--}}
{{--                    <i class="fa fa-circle ml-1"></i>--}}
{{--                </span>--}}
{{--                <div class="d-flex justify-content-center">--}}
{{--                    <a href="/productdetail/{{$row->product_code}}">--}}
{{--                    @if($row->image_name)--}}
{{--                    <img src="/images/products/{{$row->image_name}}" class="card-img-top" alt="...">--}}
{{--                    @else--}}
{{--                            @if($row->color == 1) <img src="/images/default_red.png" class="card-img-top" alt="...">--}}
{{--                            @elseif($row->color == 2) <img src="/images/default_white.png" class="card-img-top" alt="...">--}}
{{--                            @elseif($row->color == 3) <img src="/images/default_rose.png" class="card-img-top" alt="...">--}}
{{--                            @elseif($row->color == 0) <img src="/images/default_sparkling.png" class="card-img-top" alt="...">--}}
{{--                            @endif--}}
{{--                    @endif--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <span class=""></span>--}}
{{--                <div class="card-body card-position">--}}
{{--                    <div class="card-top">--}}
{{--                        <div class="card-title-name">--}}
{{--                            <div class="card-title mb-1">{{$row->maker_name}}</div>--}}
{{--                            <div class="card-title mb-0"><b><a class="text-black no-underline" href="/productdetail/{{$row->product_code}}">{{$row->full_product_name}}</b></a></div>--}}
{{--                        </div>--}}
{{--                        <div class = "card-title-amount">--}}
{{--                            <p class="card-text">{{$row->amount * 1000}}ml<br>--}}
{{--                            <span class="text-bold">{{number_format(intval($row->shop_price))}}円</span></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-bottom">--}}
{{--                        @if($row->current_stock > 0) <a href="{{url('addToCart/'.$row->product_code)}}" class="ajax_cart home-addtocart"><div class="but1 text-center">{{__('wine.add to cart')}}</div></a>--}}
{{--                        @if($row->current_stock > 0) <div class="but1 text-center ajax_cart" data-id = {{$row->product_code}}>{{__('wine.add to cart')}}</div>--}}
{{--                        @elseif($row->is_reserve == 1) <div class="but text-center">{{__('wine.reservation')}}</div>--}}
{{--                        @else <div class="but2 text-center">{{__('wine.coming soon')}}</div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--        {{ $result['all_products']->links() }}--}}
    </div>

</div>

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
        function loadDataStart(){

            $.ajax({
                url:"/product/ajaxsearch",
                type: 'POST',
                data:{
                    startDate:$('#startDate').val(),
                    endDate:$('#endDate').val(),
                    availableCheck: $("#availableCheck").is(":checked"),
                    countryList: $("#countryList").val(),
                    regionList: $("#regionList").val(),
                    maker_name: $('#maker_name').val(),
                    vintageDate: $('#vintageDate').val(),
                    count:$('#count').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    $('#result').html(data[0]);
                    $('#searchResult').html(data[1]);
                }
            });
        }

        function loadDataCountry(page){

            $.ajax({
                url:"/product/ajaxsearch",
                type: 'POST',
                data:{
                    startDate:$('#startDate').val(),
                    endDate:$('#endDate').val(),
                    availableCheck: $("#availableCheck").is(":checked"),
                    countryList: $("#countryList").val(),
                    regionList: "",
                    maker_name: $('#maker_name').val(),
                    vintageDate: $('#vintageDate').val(),
                    count:$('#count').val(),
                    page:page
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    $('#result').html(data[0]);
                    $('#searchResult').html(data[1]);
                    $('#regionList').html(data[2]);
                }
            });
        }

        $( document ).ready(function() {
            $(document).on('click', '.page-link', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadDataCountry(page);
            });
            cartRefresh();
            // loadDataCountry();
            // loadRegions();
            advancedRegions();
            whiteVarietySearch();
            redVarietySearch();
            rangeAjax();
        });
    </script>
@endsection
