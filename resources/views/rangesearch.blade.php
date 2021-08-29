@extends('layouts.appmain')

@section('content')


    <div class="container mb-3">
        <div class = "page-list font-weight-bold text-default">
            {{__('wine.findWine')}}&nbsp /&nbsp {{__('wine.search')}}
        </div>
        <div class="d-flex justify-content-between">
            <span class="h3">{{__('wine.search')}} </span>
            <a class="home-addtocart" href="{{ route('advancedSearch') }}"><div class="but1 p-2">{{__('wine.Advanced wine search')}}</div></a>
        </div>
    </div>
    <form method="POST" action="{{ route('advancedResult') }}">
        @csrf


        <div class="form-group">
            <div class="container mb-3">
                <div class="search-type">
                    <div class="row pb-2">
                        <div class="col-md-12">
                            <label for="fname" class="text-left">{{__('wine.Producer name')}}</label><br>
                            <input type="text" class="input-search-type-orignal w-100" id="product_name" name="product_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 row mb-2">
                            <div class="col-md-3 border-bottom">
                                <label for="fname" class="text-left">{{__('wine.Origine Country')}}</label>
                            </div>
                            <div class="col-md-9 row border-bottom ml-1">
                                @foreach ($result['all_countries'] as $row)

                                    @if($row->naccs == 'SE')
                                        @break;
                                    @endif
                                <div class="form-check w-25 pb-1">
                                    <input class="form-check-input" type="checkbox" value={{$row->country_en_name}} name={{$row->country_en_name}}>
                                    <img src="/images/flags/{{$row->naccs}}@3x.png" width="26">
                                </div>
                                @endforeach
                            </div>

                        </div>
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
{{--                            <div class="col-md-9 row border-bottom pb-2 ml-1">--}}
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
                        <div class="col-md-12 row mb-2 ml-1">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 pl-0">
                                <div class="w-100 mt-3 mb-2">{{__('wine.If you want to narrow down by other than the above check boxes, please enter below.')}}</div>
                                <input type="text" class="input-search-type-orignal w-100" id="producername" name="pname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 row mb-2 ml-1">
                            <div class="col-md-3">
                            </div>
                            <div class = "col-md-9 row">
                                <label for="fname" class="text-left">{{__('wine.suggested retail price')}}</label>
                                <div class="rt-container" id = "range_price">
                                    <div class="col-rt-12">
                                        <div class="Scriptcontent">
                                            <!-- Range Slider HTML -->
                                            <div slider id="slider-distance">
                                                <div>
                                                    <div inverse-left style="width:0%;"></div>
                                                    <div inverse-right style="width:0%;"></div>
                                                    <div range style="left:0%;right:0%;"></div>
                                                    <span thumb style="left:0%;"></span>
                                                    <span thumb style="left:100%;"></span>
                                                    <div sign style="left:0%;">
                                                        <span id="value">0</span><span>円</span>
                                                    </div>
                                                    <div sign style="left:100%;">
                                                        <span id="value">100000</span><span>円</span>
                                                    </div>
                                                </div>
                                                <input id = "range_price_start" name="range_price_start" type="range" tabindex="0" value="0" max="100" min="0" step="1" oninput="
                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                        var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
                                        var children = this.parentNode.childNodes[1].childNodes;
                                        children[1].style.width=value+'%';
                                        children[5].style.left=value+'%';
                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                        children[11].childNodes[1].innerHTML=this.value*1000;
                                        " />

                                                <input id ="range_price_end" name = "range_price_end" type="range" tabindex="0" value="100" max="100" min="0" step="1" oninput="
                                        this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                        var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
                                        var children = this.parentNode.childNodes[1].childNodes;
                                        children[3].style.width=(100-value)+'%';
                                        children[5].style.right=(100-value)+'%';
                                        children[9].style.left=value+'%';children[13].style.left=value+'%';
                                        children[13].childNodes[1].innerHTML=this.value*1000;

                                        " />
                                            </div>
                                            <!-- End Range Slider HTML -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a class="buttop-style-2 mr-4" href = "{{route('rangeSearch')}}">{{__('wine.Reset')}}</a>
                        <button class="buttop-style-3" type="submit">{{__('wine.Search by this condition')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>

        $( document ).ready(function() {
            loadRegions();
            advancedRegions();
            whiteVarietySearch();
            redVarietySearch();
            rangeAjax();
        });
    </script>
@endsection
