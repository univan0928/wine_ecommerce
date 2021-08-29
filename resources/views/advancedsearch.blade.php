@extends('layouts.appmain')

@section('content')


    <div class="container mb-3">
        <div class = "page-list font-weight-bold text-default">
            <a class="text-default" href="{{route('home')}}">{{__('wine.Home')}}</a>&nbsp>&nbsp<a class="text-default" href="{{route('findWine')}}">{{__('wine.findWine')}}</a>&nbsp>&nbsp {{__('wine.Advanced wine search')}}
        </div>
        <div class="d-flex justify-content-between">
            <span class="h3">{{__('wine.Advanced wine search result')}} </span>
            <a class="home-addtocart" href="{{ route('rangeSearch') }}"><div class="but1 mr-2 p-2" >{{__('wine.search')}}</div></a>
        </div>
    </div>
    <form method="POST" action="{{ route('advancedResult') }}">
        @csrf

        <div class="form-group">
            <div class="container mb-3">
                <div class="search-type">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fname" class="text-left">{{__('wine.Producer name')}}</label><br>
                            <input type="text" class="input-search-type-orignal" id="product_name" name="product_name">
                        </div>
                        <div class="col-md-6">
                            <label for="fname" class="text-left">{{__('wine.Year name')}}</label><br>
                            <div class="input-wrap">
                                <div class = " mr-1" style="position:relative;width:80px;height:25px;border:0;padding:0;margin:0;">
                                    <select class = "form-control" style="position:absolute;top:0px;left:0px;width:80px; height:25px;line-height:20px;margin:1px 0 0 0;padding:0;"
                                            onchange="document.getElementById('start_year').value=this.options[this.selectedIndex].text;">
                                        <option value=""></option>
                                        @for($i = 1950;$i<= date('Y');$i++)
                                            <option value={{$i}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <input class = "input-search-type-orignal" type="number" name="start_year" id="start_year"
                                           onfocus="this.select()"
                                           style="position:absolute;top:0px;left:0px;width:60px;height:23px;margin:2px 1px 1px 1px;border:0px"  >

                                </div>
{{--                                <input class="input-search-type-orignal mr-2" type="number" id="start_year" name="start_year">--}}
                                <span>{{__('wine.year')}}~</span>
                                <div class = "mr-1" style="position:relative;width:80px;height:25px;border:0;padding:0;margin:0;">
                                    <select class = "form-control" style="position:absolute;top:0px;left:0px;width:80px; height:25px;line-height:20px;margin:1px 0 0 0;padding:0;"
                                            onchange="document.getElementById('end_year').value=this.options[this.selectedIndex].text;">
                                        <option value=""></option>
                                        @for($i = 1950;$i<= date('Y');$i++)
                                            <option value={{$i}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <input class = "input-search-type-orignal" type="number" name="end_year" id="end_year"
                                           onfocus="this.select()"
                                           style="position:absolute;top:0px;left:0px;width:60px;height:23px;margin:2px 1px 1px 1px;border:0px">
                                </div>
{{--                                <input class="input-search-type-orignal ml-2 mr-2" type="number" id="end_year" name="end_year">--}}
                                <span>{{__('wine.year')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">{{__('wine.Origine Country')}}</label>

                                <select class="form-control" name="product_country" id="product_country" onchange="loadRegions()">
                                    <option value=""></option>
{{--                                    <option>{{__('wine.Not specified')}}</option>--}}
                                    @foreach ($result['all_countries'] as $row)
                                        <option value={{$row->country_en_name}}>{{$row->country_jp_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">{{__('wine.local name search')}}</label>
                                <select class="form-control" name="product_region" id="product_region">
{{--                                    <option>{{__('wine.Not specified')}}</option>--}}
                                    <option value=""></option>
{{--                                    @foreach ($result['all_regions'] as $row)--}}
{{--                                        <option value={{$row->region_jp_name}}>{{$row->region_jp_name}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleFormControlSelect1">{{__('wine.Area name')}}</label>--}}
{{--                                <select class="form-control" id="exampleFormControlSelect3" placeholder="Not specified">--}}
{{--                                    <option>{{__('wine.Not specified')}}</option>--}}
{{--                                    <option>2</option>--}}
{{--                                    <option>3</option>--}}
{{--                                    <option>4</option>--}}
{{--                                    <option>5</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="col-md-4 row">
                        <div class="col-sm-6">
                            <div for="exampleFormControlSelect1" class="text-center-style-1">{{__('wine.Quality category')}}</div>

                            <div class="text-center-style-1"><a href="" class="a-tag-type-1" data-toggle="modal" data-target="#myModal">{{__('wine.choice')}}</a></div>
                        </div>
                        <div class="col-sm-6">
                            <div for="exampleFormControlSelect2" class="text-center-style-1">{{__('wine.Rating')}}</div>
                            <!-- <div class="text-center-style-1"><a href="#" class="a-tag-type-1">選択</div> -->
                            <div class="text-center-style-1"><a href="" class="a-tag-type-1" data-toggle = "modal" data-target="#certification">{{__('wine.choice')}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="container mb-3">
                <a href="#" class="a-tag-type-1">{{__('wine.To add')}}</a>
                <div class="search-type">
                    <div class="row">
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3 border-bottom">
                                <label for="fname" class="text-left">{{__('wine.Color')}}</label>
                            </div>
                            <div class="col-md-9 row border-bottom ml-1">
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value="red" id="red" name = "red">
                                    <label class="form-check-label" for="red">
                                    {{__('wine.Red')}}
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value="white" id="white" name="white">
                                    <label class="form-check-label" for="white">
                                        {{__('wine.White')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value="rose" id="rose" name = "rose">
                                    <label class="form-check-label" for="rose">
                                        {{__('wine.Rose')}}
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3 border-bottom">
                                <label for="fname" class="text-left">{{__('wine.Type')}}</label>
                            </div>
                            <div class="col-md-9 row border-bottom ml-1">
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value='still' name="still">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Still wine')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value='sparkling' name="sparkling">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Sparkling wine')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3 border-bottom">
                                <label for="fname" class="text-left">{{__('wine.Taste')}}</label>
                            </div>
                            <div class="col-md-9 row border-bottom ml-1">
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value='1' name="super_dry">
                                    <label class="form-check-label" for="Still">
                                    {{__('wine.Super dry')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=2 name="spicy">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.spicy')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=3 name="medium_dry">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Medium dry')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=4 name="medium_sweet">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Medium sweet')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=5 name="sweet">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Sweet')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=6 name="very_sweet">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Very sweet')}}
                                    </label>

                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=7 name="heavy_mouth">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Heavy mouth')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=8 name="medium_weight">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Medium weight')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=9 name="light_mouth">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Light mouth')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=10 name="trocken">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Trocken')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=11 name="easy_to_eat">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Easy to eat')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=12 name="middle">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Middle')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=13 name="individual">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.Individual')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=14 name="fresh">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.fresh')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=15 name="cream">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.cream')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=16 name="dessert">
                                    <label class="form-check-label" for="Still">
                                        {{__('wine.dessert')}}
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=17 name="full_body">
                                    <label class="form-check-label" for="Still">
                                        フルボディ
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=18 name="medium_body">
                                    <label class="form-check-label" for="Still">
                                        ミディアムボディ
                                    </label>
                                </div>
                                <div class="form-check w-25">
                                    <input class="form-check-input" type="checkbox" value=19 name="light_body">
                                    <label class="form-check-label" for="Still">
                                        ライトボディ
                                    </label>
                                </div>
                            </div>

                        </div>
{{--                        <div class="col-md-12 row mb-2">--}}
{{--                            <div class="col-md-3 border-bottom">--}}
{{--                                <label for="fname" class="text-left">{{__('wine.Taste')}}</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-9 row border-bottom pb-2">--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Full">--}}
{{--                                    <label class="form-check-label" for="Full">--}}
{{--                                        {{__('wine.Full body')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Medium">--}}
{{--                                    <label class="form-check-label" for="Medium">--}}
{{--                                        {{__('wine.Medium body')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Light">--}}
{{--                                    <label class="form-check-label" for="Light">--}}
{{--                                        {{__('wine.Light body')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Spicy">--}}
{{--                                    <label class="form-check-label" for="Spicy">--}}
{{--                                    {{__('wine.Spicy')}}--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Slight">--}}
{{--                                    <label class="form-check-label" for="Slight">--}}
{{--                                        {{__('wine.Slightly dry')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Sweet">--}}
{{--                                    <label class="form-check-label" for="Sweet">--}}
{{--                                        {{__('wine.Sweet')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Very">--}}
{{--                                    <label class="form-check-label" for="Very">--}}
{{--                                        {{__('wine.Very sweet')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3">
                                <label for="fname" class="text-left mt-3">{{__('wine.Variety raw material')}}</label><br><label for="fname" class="text-left">{{__('wine.*multiple selection possible')}}</label>
                            </div>
                            <div class="col-md-9 row border-bottom pb-2 ml-1">
                                <div class="w-100 mt-3 mb-2"><b>{{__('wine.Red wine varies')}}</b>
                                    <input class="ml-3 input-search-type-orignal w-25" placeholder={{__('wine.search')}} type="search" id="red_variety" name="red_variety" oninput="redVarietySearch()">
                                </div>
                                    <div id = "red_variety_result" class = "w-100 row ml-1">

                                    </div>
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Cabernet">--}}
{{--                                    <label class="form-check-label" for="Cabernet">--}}
{{--                                        {{__('wine.Cabernet Franch')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Merlot">--}}
{{--                                    <label class="form-check-label" for="Merlot">--}}
{{--                                        {{__('wine.Merlot')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Franc">--}}
{{--                                    <label class="form-check-label" for="Franc">--}}
{{--                                        {{__('wine.Cabernet Franc')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Pinot">--}}
{{--                                    <label class="form-check-label" for="Pinot">--}}
{{--                                        {{__('wine.Pinot Noir')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Gamay">--}}
{{--                                    <label class="form-check-label" for="Gamay">--}}
{{--                                        {{__('wine.Gamay')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Syrah">--}}
{{--                                    <label class="form-check-label" for="Syrah">--}}
{{--                                        {{__('wine.Syrah')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Grenache">--}}
{{--                                    <label class="form-check-label" for="Grenache">--}}
{{--                                        {{__('wine.Grenache')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Sangiovese">--}}
{{--                                    <label class="form-check-label" for="Sangiovese">--}}
{{--                                        {{__('wine.Sangiovese')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Tempranillo">--}}
{{--                                    <label class="form-check-label" for="Tempranillo">--}}
{{--                                        {{__('wine.Tempranillo')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 row border-bottom pb-2 ml-1">
                                <div class="w-100 mt-3 mb-2"><b>{{__('wine.White wine varies')}}</b>
                                    <input class="ml-3 input-search-type-orignal w-25" placeholder={{__('wine.search')}} type="search" id="white_variety" name="white_variety" oninput="whiteVarietySearch()">
                                </div>
                            <div id = "white_variety_result" class = "w-100 row ml-1">

                            </div>
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Chardonnay">--}}
{{--                                    <label class="form-check-label" for="Chardonnay">--}}
{{--                                    {{__('wine.Chardonnay')}}--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Sauvignon">--}}
{{--                                    <label class="form-check-label" for="Sauvignon">--}}
{{--                                        {{__('wine.Sauvignon')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Semillon">--}}
{{--                                    <label class="form-check-label" for="Semillon">--}}

{{--                                        {{__('wine.Semillon')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Riesling">--}}
{{--                                    <label class="form-check-label" for="Riesling">--}}

{{--                                        {{__('wine.Riesling')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Gewürztraminer">--}}
{{--                                    <label class="form-check-label" for="Gewürztraminer">--}}

{{--                                        {{__('wine.Gewürztram')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Gris">--}}
{{--                                    <label class="form-check-label" for="Gris">--}}

{{--                                        {{__('wine.Pinot Gris')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Viognier">--}}
{{--                                    <label class="form-check-label" for="Viognier">--}}

{{--                                        {{__('wine.Viognier')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check w-25">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="Moscato">--}}
{{--                                    <label class="form-check-label" for="Moscato">--}}

{{--                                        {{__('wine.Moscato')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 pl-0 ml-3">
                                <div class="w-100 mt-3 mb-2">{{__('wine.If you want to narrow down by other than the above check boxes, please enter below.')}}</div>
                                <input type="text" class="input-search-type-orignal w-100" id="producername" name="pname">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="container mb-3">
                <div class="search-type">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="fname" class="text-left">{{__('wine.Annual production')}}</label><br>
                            <input type="text" class="input-search-type-orignal w-100" id="annual_amount" name="annual_amount">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="fname" class="text-left">{{__('wine.Brewing and aging')}}</label><br>
                            <input type="text" class="input-search-type-orignal w-100" id="aging" name="aging">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="fname" class="text-left">{{__('wine.soil')}}</label><br>
                            <input type="text" class="input-search-type-orignal w-100" id="soil" name="soil">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="fname" class="text-left">{{__('wine.Tree age')}}</label><br>
                            <input type="text" class="input-search-type-orignal w-100" id="tree_age" name="tree_age">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><label for="fname" class="text-left">{{__('wine.suggested retail price')}}</label></div>
                        <div class="col-md-6 mb-2">
                            <input type="text" class="input-search-type-orignal w-100" id="start_price" name="start_price">
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="text" class="input-search-type-orignal w-100" id="end_price" name="end_price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a class="buttop-style-2 mr-4" href = "{{route('advancedSearch')}}">{{__('wine.Reset')}}</a>
                        <button class="buttop-style-3" type="submit">{{__('wine.Search by this condition')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content modal-box">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">品質を選択</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body w-100 row ml-1 quality-modal">
                        @foreach ($result['quality_origin'] as $row)
                            <div class="form-check w-25 ">
                                <input class="form-check-input" type="checkbox" value={{$row->id}} name={{$row->id}} onclick="quality()">
                                <label class="form-check-label" for="Cabernet">
                                    {{$row->quality_name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="buttop-style-2" onclick="qualityReset()">リセットする</button>
                        <button type="button" class="buttop-style-3" data-dismiss="modal">選択する</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="certification">
            <div class="modal-dialog">
                <div class="modal-content modal-box">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">品質を選択</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body w-100 row ml-1 quality-modal">
                        @foreach ($result['certification'] as $row)
                            @php
                                $id = "certification".$row->id
                            @endphp
                            <div class="form-check w-25 ">
                                <input class="form-check-input" type="checkbox" value={{$id}} name={{$id}} onclick="">
                                <label class="form-check-label" for="Cabernet">
                                    {{$row->certification_name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="buttop-style-2" onclick="certificationReset()">リセットする</button>
                        <button type="button" class="buttop-style-3" data-dismiss="modal">選択する</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Button to Open the Modal -->


    <!-- The Modal -->


<script>
    function quality(){

    }


    function qualityReset(){
        @foreach ($result['quality_origin'] as $row)

         if ($("input[name='{{$row->quality_name}}']").is(":checked"))
         {
            $("input[name='{{$row->quality_name}}']").prop('checked', false);
         }
        @endforeach
    }
    function certificationReset(){
        @foreach ($result['certification'] as $row)
        @php
            $id = 'certification'.$row->id;
        @endphp
        if ($("input[name='{{$id}}']").is(":checked"))
        {
            $("input[name='{{$id}}']").prop('checked', false);
        }
        @endforeach
    }
    $( document ).ready(function() {
        loadRegions();
        advancedRegions();
        whiteVarietySearch();
        redVarietySearch();
        rangeAjax();
    });
</script>

@endsection
