<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>TOKUOKA - ワインアドバイザー</title>

    <!-- Scripts -->
    <script src="{{ public_path('js/app.js') }}" defer></script>
    <script src="{{ public_path('js/main.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css?v=1a040064279b" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Styles -->
    <link href="{{ public_path('css/app.css?v='.time()) }}" rel="stylesheet" type="text/css" media = "all">
    <link href="{{ public_path('css/main.css?v='.time()) }}" rel="stylesheet" type="text/css" media = "all">
    <link href="{{ public_path('css/style.css?v='.time()) }}" rel="stylesheet" type="text/css" media = "all">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <link href="{{ asset('css/app.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/main.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v='.time()) }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css?v=1a040064279b" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css?v=1a040064279b" rel="stylesheet">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
    <style>
        @font-face {
            font-family: 'ipamg';
            src: url('{{ public_path('fonts/ipamp.ttf?v='.time())}}') format("truetype");
        /*    font-weight: normal; // use the matching font-weight here ( 100, 200, 300, 400, etc).*/
        /*font-style: normal; // use the matching font-style here*/
        }
        @font-face{
            font-family:'ipag';
            src: url('{{public_path('fonts/ipag.ttf?v='.time())}}') format("truetype");
        }
        * { font-family: ipamg; }
        @page {
            margin: 0 !important;
            padding: 0 !important;
        }
        .page_break { page-break-before: always; }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #cabebe;
            text-align: center  ;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

</head>
<body>

<div id="app">
    @php
        $cnt = 0;
        $total = 0;
        $product_cnt = 0;
        $condition = [];
    @endphp
    <main>
        <div style = "z-index: 1000; position: absolute; margin-left:50%;top:3%; color:white; font-size:22px">ワイン詳細</div>
        <div style = "z-index: -1">
            <img src = "images/pdfbar.png" style = "width:100%;height:auto">
        </div>

        <div class = "pdf-grey">
            <div style="position:absolute; padding-left:4%; width:18%;">
                @if(isset($topmaker->foreign_maker_id) && file_exists( public_path() . '/images/detailmaker/'. $topmaker->foreign_maker_id .'.png'))
                    <img src = "images/detailmaker/{{$topmaker->foreign_maker_id}}.png" style = "width:100%;">
                @else
                    <img src = "images/maker/default.png" style = "width:100%;">
                @endif
            </div>
            @if(isset($topmaker->foreign_maker_id) && file_exists( public_path() . '/images/places/'. $topmaker->foreign_maker_id .'.png'))
            <img style ="position:relative;width:15%; float:right;padding-right:10%" src = "images/places/{{$topmaker->foreign_maker_id}}.png">
            @else
            <img style ="position:relative;width:15%; float:right;padding-right:10%" src = "images/places/place.png">
            @endif
            <div style="position: relative; margin-left:26%; width:74%">
                <p style = "font-size:20px">
                    {{isset($topmaker->jp_name)?$topmaker->jp_name:"-"}}
                </p>
                <p style = "font-size:20px">
                    {{isset($topmaker->en_name)?$topmaker->en_name:"-"}}
                </p>
                @if(isset($topmaker->maker_description) && $topmaker->maker_description!="")
                <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:3%;margin-right:3%;margin-bottom:1%;">
                    {{isset($topmaker->maker_description)?$topmaker->maker_description:""}}
                </p>
                @else
                    <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:3%;margin-right:3%;margin-bottom:1%;height:130px">
                        {{isset($topmaker->maker_description)?$topmaker->maker_description:""}}
                    </p>
                @endif
            </div>
        </div>
        @foreach($result as $row)
            @php
                $percent = ($product_cnt%4)*25;
                $product_cnt++;
            @endphp
            @php
                if($product_cnt == 9||($product_cnt-9)%12 == 0){
                    echo "<div class=\"page_break\"></div>
                    <div  style = \"height:70px\"></div>";
                }
                if($product_cnt%4 == 1){
                    if($product_cnt>8) echo "<div style = \"display:flex;height:350px; margin-right:3%;\">";
                    else echo "<div style = \"display:flex;height:330px; margin-right:3%;\">";
                }
            @endphp
            <div style="margin-left:{{$percent}}%; width:25%; position: relative;">
                <div style = "position:absolute; width:50%; text-align: center; top:0px;">
                    @if($row->image_name)
                        <div style = "width:100%; padding-top:16px;padding-bottom:6px">
                            <img src = "images/products/{{$row->image_name}}" style="width:44%" alt="...">
                        </div>

                    @else
                        <div style ="width:100%;padding-top:13px">


                        @if($row->color == 1 && $row->wine_type =='スパークリング') <img src="images/default_red.png" style="width:95%" alt="...">
                        @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img src="images/default_sparkling.png" style="width:95%" alt="...">
                        @elseif($row->color == 1) <img src="images/default_red.png" style="width:95%" alt="...">
                        @elseif($row->color == 2) <img src="images/default_white.png" style="width:95%" alt="...">
                        @elseif($row->color == 3) <img src="images/default_rose.png" style="width:95%" alt="...">
                        @elseif($row->color == 0) <img src="images/default_sparkling.png" style="width:95%" alt="...">
                        @endif
                        </div>
                    @endif
                    <p class = "m-0 p-0">{{(isset($row->vintage_year)&&$row->vintage_year!=0)?$row->vintage_year:'NV'}}</p>
                    <p class = "m-0 p-0" style = "font-size:7px">{{$row->product_code}}</p>
                </div>
                <div style = "margin-left:50%; width:50%">
                    <p style = "text-align: center; border:1px solid black;font-size:7px; width:50%">
                        {{$row->product_code}}
                    </p>
                    <p style = "line-height: 100%; margin:0; padding-bottom:5%; word-wrap: break-word; width:100%;font-size:8px; height:24px">
                        {{$row->full_product_name}}
                    </p>
                    <p style = "line-height: 100%; margin:0; padding-bottom:5%; word-wrap: break-word; width:100%;font-size:6px;height:12px">
                        {{$row->full_english_name}}
                    </p>
                    <p style = "line-height: 100%; margin:0; padding-bottom:5%; word-wrap: break-word; width:100%;font-size:8px;height:10px">
                        {{$row->region}}
                    </p>
                    <div style = "width:100%; margin:0">
                        <p style = "position:absolute;line-height: 100%; margin:0; padding-bottom:10%; word-wrap: break-word; width:100%;font-size:6px;">
                            {{$row->quality_origin}}
                        </p>
                        <div style = "position: relative;line-height: 100%;margin-top:0; margin-bottom:0; margin-left:80%; padding:0; word-wrap: break-word; width:20%;font-size:7px">
                            <p style="background: grey;color: white;width: 10px;text-align: center">{{$row->bottles_per_case}}</p>
                        </div>
                    </div>

                    <div style = "width:100%;margin: 0;">
                        @if($row->color == 1) <div class = "pdf-red-product" style = "position: absolute; margin-top:0; height:7px; width:7px; border-radius:3.5px; margin-bottom:0;"></div>
                        @elseif($row->color == 2) <div class = "pdf-white-product" style = "position: absolute; margin-top:0; height:7px; width:7px; border-radius:3.5px; margin-bottom:0;"></div>
                        @elseif($row->color == 3) <div class = "pdf-rose" style = "position: absolute; margin-top:0; height:7px; width:7px; border-radius:3.5px; margin-bottom:0;"></div>
                        @elseif($row->color == 0) <div class = "pdf-sparkling" style = "position: absolute; margin-top:0; height:7px; width:7px; border-radius:3.5px; margin-bottom:0;"></div>
                        @endif

                        <p style = "position: absolute; line-height: 100%;margin-top:0; margin-bottom:0; margin-left:15%; padding:0; word-wrap: break-word; width:50%;font-size:7px">
                            {{$row->type_name}}
                        </p>
                        <p style = "position: relative;line-height: 100%;margin-top:0; margin-bottom:0; margin-left:65%; padding:0; word-wrap: break-word; width:35%;font-size:7px">
                            {{$row->amount * 1000}}ml
                        </p>
                    </div>
                    <hr style ="border-top: dotted 1px #000;border-bottom: none; margin-top:1%; margin-bottom:1%">
                    <p style = "padding:0; line-height: 100%; margin:0;word-wrap: break-word; width:100%;font-size:8px;height:78px">
                        {{$row->description}}
                    </p>
                    <hr style ="border-top: dotted 1px #000;border-bottom:none; margin-bottom:1%; margin-top:1%">
                    <p style = "line-height: 100%; margin:0; padding-bottom:5%; word-wrap: break-word; width:100%;font-size:6px; height:12px">
                        {{$row->variety}}
                    </p>
                    <p class = "m-0 p-0" style = "color:red">¥{{$row->pdf_id==1?number_format(intval($row->case_price)).'(ケース)':number_format(intval($row->shop_price)).'(瓶)'}}</p>
                    <div style = "width:100%">
                        @if($row->naccs)
                        <img style = "position: absolute;width:10%" src ="images/flags/{{$row->naccs}}@3x.png">
                        @else
                        <img style = "position: absolute;width:10%" src ="images/default_flag.png">
                        @endif
                        <p style = "margin-left:20%; width:70%; line-height: 100%; padding-bottom:5%; word-wrap: break-word; width:100%;font-size:8px">
                            {{$row->country_jp_name}}
                        </p>
                    </div>
                </div>
            </div>
            @php
                if($product_cnt%4 == 0) echo "</div>";
            @endphp
        @endforeach
        @php
            if($product_cnt%4 != 0) echo "</div>";
        @endphp
        <div class="page_break"></div>

        <div style = "z-index: 1000; position: absolute; margin-left:50%;top:3%; color:white; font-size:22px">見積書</div>
        <div style = "z-index: -1">
            <img src = "images/pdfbar.png" style = "width:100%;height:auto">
        </div>
        <div style ="text-align: center; padding-top:2%;  padding-bottom:1%">
            <p style = "font-size:22px">見積書</p>
        </div>
        <div style = "width:100%; margin-left:3%; margin-right:3%; margin-bottom: 1%;">
            <div style = "position: absolute; width:58%">
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">{{$customer->postcode}}</p>
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">{{$customer->address}}</p>
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">{{$customer->name}} 御中</p>
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">TEL : {{$customer->tel}} FAX : {{$customer->fax}}</p>
            </div>
            <div style ="margin-left:58%; width:42%;">

                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">発行日 {{date('Y')}}年{{date('m')}}月{{date('d')}}日 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 見積No.{{$estimate}}</p>
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">〒542-0081 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大阪市中央区南船場3丁目5番26号</p>
{{--                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;麻布高橋ビル6F</p>--}}
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">株式会社徳岡</p>
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">TEL : 06-4704-3035 FAX : 06-4704-3070</p>
                <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">担当者 : {{ Auth::user()->name }}</p>
            </div>
        </div>
        <div style = "padding:15px">
            <table style = "">
                <tr style = "width:100%">
                    <th colspan = "4" style = "font-family: 'ipamg' !important; font-weight:400;width:300px ">商品コード / 商品名</th>
                    <th style = "font-family: 'ipamg' !important; font-weight:400; ">数量</th>
                    <th style = "font-family: 'ipamg' !important; font-weight:400; ">単価</th>
                    <th style = "font-family: 'ipamg' !important; font-weight:400; ">金額</th>
                    <th style = "font-family: 'ipamg' !important; font-weight:400; ">備考</th>
                </tr>
                @foreach($result as $row)
                    @php $code = $row->product_code;
                        $cnt++;
                        if($row->pdf_id == 1) $total += (intval($row->case_price)*$row->pdf_quantity);
                        else $total += (intval($row->shop_price)*$row->pdf_quantity);
                    @endphp
                <tr>
                    <td colspan = "4" style = "font-family: 'ipamg' !important; height:70px; font-weight:400; width:100%">
                        <div style = "width:20%; margin-top:25px;position:absolute;">

                            <p class = "m-0" style = "display:flex; align-self:center; font-size:7px;line-height: 150%;">{{$row->product_code}}</p>
                        </div>
                        @if($row->image_name)
                        <img style = "margin-left:17%; max-width:30px; max-height: 60px; position:absolute " src = "images/products/{{$row->image_name}}">
                        @else
                            @if($row->color == 1 && $row->wine_type =='スパークリング') <img style = "margin-left:15%; max-width:30px; max-height: 60px; position:absolute;" src = "images/default_red.png">
                            @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img style = "margin-left:15%; max-width:30px; max-height: 60px; position:absolute;" src = "images/default_sparkling.png">
                            @elseif($row->color == 1) <img style = "margin-left:15%; max-width:30px; max-height: 60px; position:absolute;" src = "images/default_red.png">
                            @elseif($row->color == 2) <img style = "margin-left:15%; max-width:30px; max-height: 60px; position:absolute;" src = "images/default_white.png">
                            @elseif($row->color == 3) <img style = "margin-left:15%; max-width:30px; max-height: 60px; position:absolute;" src = "images/default_rose.png">
                            @elseif($row->color == 0) <img style = "margin-left:15%; max-width:30px; max-height: 60px; position:absolute;" src = "images/default_sparkling.png">
                            @endif
                        @endif
                        <div style = "margin-left:30%; text-align: left !important;">
                            <p class = "m-0 p-0" style = "display: flex; align-self:center; font-size:10px;line-height: 100%">
                                {{ $row->vintage_year?$row->vintage_year :'NV' }}
                            </p>
                            <p class = "m-0" style = "font-size:12px; line-height:100%;padding-bottom:3px;padding-top:3px">{{$row->full_product_name}}</p>

                            <div style="width:100%">
                                @if($row->color == 1) <div class = "pdf-red-product" style = "position: absolute; margin-top:0; height:10px; width:10px; border-radius:5px; margin-bottom:0;"></div>
                @elseif($row->color == 2) <div class = "pdf-white-product" style = "position: absolute; margin-top:0; height:10px; width:10px; border-radius:5px; margin-bottom:0;"></div>
                @elseif($row->color == 3) <div class = "pdf-rose" style = "position: absolute; margin-top:0; height:10px; width:10px; border-radius:5px; margin-bottom:0;"></div>
                @elseif($row->color == 0) <div class = "pdf-sparkling" style = "position: absolute; margin-top:0; height:10px; width:10px; border-radius:5px; margin-bottom:0;"></div>
                @endif
                                <p style = "padding:0;margin-bottom: 0px; margin-left: 5%;font-size:10px;line-height: 100%;font-family: 'ipamg' !important; font-weight:400">{{$row->type_name}}</p>
                            </div>
                        </div>
                    </td>
                    <td style = "font-family: 'ipamg' !important; font-weight:400">{{$row->pdf_id == 1? $row->pdf_quantity.'(ケース)':$row->pdf_quantity.'(瓶)'}}</td>
                    <td style = "font-family: 'ipamg' !important; font-weight:400">{{($row->pdf_id == 1)?number_format(intval($row->case_price)):number_format(intval($row->shop_price))}}円</td>
                    <td style = "font-family: 'ipamg' !important; font-weight:400">{{($row->pdf_id == 1)?number_format(intval($row->case_price)*$row->pdf_quantity):number_format(intval($row->shop_price)*$row->pdf_quantity)}}円</td>
                    <td style = "font-family: 'ipamg' !important; font-weight:400">8%</td>
                </tr>
                @php
                    if($cnt == 10 || ($cnt-10)%14 == 0){
                        echo "</table>
            <div class=\"page_break\"></div>
            <table style = \"padding-top:3%\">
                <tr style = \"width:100%\">
                    <th colspan = \"4\" style = \"font-family: 'ipamg' !important; font-weight:400;width:300px \">商品コード / 商品名<br>Product Code / Name</th>
                    <th style = \"font-family: 'ipamg' !important; font-weight:400; \">数量<br>Quantity</th>
                    <th style = \"font-family: 'ipamg' !important; font-weight:400; \">単価<br>Unit Price</th>
                    <th style = \"font-family: 'ipamg' !important; font-weight:400; \">金額<br>Price</th>
                    <th style = \"font-family: 'ipamg' !important; font-weight:400; \">備 考</th>
                </tr>";
                    }
                @endphp
                @endforeach
                <tr>
                    <td>税抜額</td>
                    <td>{{number_format($total)}}円</td>
                    <td></td>
                    <td></td>
                    <td>消費税額</td>
                    <td>{{number_format(intval($total*8/100))}}円</td>
                    <td >合計</td>
                    <td >{{number_format($total+intval($total*8/100))}}円</td>
                </tr>
            </table>
        </div>

        <div class="page_break"></div>
        @foreach($result as $row)
            @if(isset($condition[$row->product_code])) @continue;
            @else @php $condition[$row->product_code] = 1;@endphp
            @endif

        <div style = "z-index: 1000; position: absolute; margin-left:50%;top:3%; color:white; font-size:22px">ワイン詳細</div>
        <div style = "z-index: -1">
            <img src = "images/pdfbar.png" style = "width:100%;height:auto">
        </div>
        <div class = "pdf-detail">
            <div style="position:absolute;width:100%;">
                @if(isset($topmaker->foreign_maker_id)&&file_exists( public_path() . '/images/bigplaces/'. $topmaker->foreign_maker_id .'.png'))
                <img src = "images/bigplaces/{{$topmaker->foreign_maker_id}}.png" style = "width:100%;z-index: 0;">
                @else
                <img src = "images/bigplaces/default_large.png" style = "width:100%;z-index: 0;">
                @endif
            </div>
            <div style = "position:absolute;top:4%; width:30%;z-index: 10000;padding:0 2%;">
                @if($row->pdf_image_name)
                    <img src = "images/pdfproducts/{{$row->image_name}}" style = "margin-top:3%;width:50%;margin-left:25%">
                @else
                    @if($row->color == 1 && $row->wine_type =='スパークリング') <img src = "images/default_red_large.png" style = "margin-top:3%;width:80%;margin-left:10%">
                    @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img src = "images/default_sparkling_large.png" style = "margin-top:3%;width:80%;margin-left:10%">
                    @elseif($row->color == 1) <img src = "images/default_red_large.png" style = "margin-top:3%;width:80%;margin-left:10%">
                    @elseif($row->color == 2) <img src = "images/default_white_large.png" style = "margin-top:3%;width:80%;margin-left:10%">
                    @elseif($row->color == 3) <img src = "images/default_rose_large.png" style = "margin-top:3%;width:80%;margin-left:10%">
                    @elseif($row->color == 0) <img src = "images/default_sparkling_large.png" style = "margin-top:3%;width:80%;margin-left:10%">
                    @endif
                @endif

                    <p style = "font-size:22px;font-weight: bold; text-align: center" class = "mb-0 p-0">{{(isset($row->vintage_year)&&$row->vintage_year!=0)?$row->vintage_year:'NV'}}</p>
                    <p style = "font-size:12px;text-align: center" class = "mt-0 p-0 mb-2">49415369</p>
                <hr style ="border-top: 1px grey;border-bottom: none; margin-top:1%; margin-bottom:1%"/>
                    <div style = "margin-left:10%;width:35%;position:absolute">
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">生産者名</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">原産国名</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">地区名</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">村名</p>
                    </div>
                    <div style = "margin-left:45%; width:55%;position:absolute">
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->maker_name}}</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->country_jp_name}}</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->region}}</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;-</p>
                    </div>
{{--                    <hr style = "margin-top:8%; position:relative; width:100%"/>--}}
                <hr style ="border-top: 1px grey;border-bottom: none; margin-top:10%; margin-bottom:1%"/>
                    <div style = "margin-left:10%;width:35%;position:absolute">
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">種類</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">内容量</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">品種（原材料)</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px;">飲み頃温度</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">味わい</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">JANコード</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">希望小売価格</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">希望小売価格<br>&nbsp;&nbsp;(ケース)</p>
                    </div>
                    <div style = "margin-left:45%; width:55%;position:absolute">
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;
                            @if($row->color == 0) {{__('wine.Sparkling wine')}}
                                @else {{__('wine.Still wine')}}
                            @endif
                        </p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->amount * 1000}}ml</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->variety}}</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->drinking_temperature}}度</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->type_name}}</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{$row->jan_code}}</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{number_format((int)$row->shop_price)}}円</p>
                        <p style = "line-height: 120%;padding:0; margin:0;font-size:12px">:&nbsp;&nbsp;&nbsp;{{number_format((int)$row->case_price)}}円</p>
                    </div>
{{--                    <hr style="margin-top :10%"/>--}}
                <hr style ="border-top: 1px grey;border-bottom: none; margin-top:15%; margin-bottom:1%"/>
                    <p style = "font-size:22px;font-weight: bold; text-align: center; color:red" class = "mb-0 p-0"></p>
                </div>

            <div style = "position: absolute; width:66%;margin-left:34%; background: #e7e5e2;height:100%;z-index:-1">
                <div style ="margin-top:38%;padding:0 5%">
                    <p style = "font-size:20px;line-height: 80%" class = "p-0 mb-2">
                        {{$row->product_name}}
                    </p>
                    <hr style ="border-top: 1px grey;border-bottom: none; margin-top:2%; margin-bottom:3%"/>
                    <p style = "font-size:20px;line-height: 80%" class = "p-0 mb-2">
                        テイスティングノート
                    </p>
                    <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:1%;margin-right:3%;margin-bottom:1%; line-height:120%">
                        {{$row->description}}
                    </p>

                    <hr style ="border-top: 1px grey;border-bottom: none; margin-top:7%; margin-bottom:3%"/>
                    <p style = "font-size:20px;line-height: 80%" class = "p-0 m-0">
                        {{$row->maker_name}}
                    </p>
                    <p style = "font-size:20px;" class = "p-0 m-0">
                        {{$row->maker_en_name}}
                    </p>
                    <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:1%;margin-right:3%;margin-bottom:1%; line-height:120%">
                        {{$row->maker_description}}
                    </p>
                    @if(file_exists( public_path() . '/images/places/'. $row->foreign_maker_code .'.png'))
                        <img style ="position:relative;width:25%; float:left;margin-top:1%; margin-bottom:1%" src = "images/places/{{$row->foreign_maker_code}}.png">
                    @else
                        <img style ="position:relative;width:25%; float:left;margin-top:1%; margin-bottom:1%" src = "images/places/place.png">
                    @endif
                    <hr style ="border-top: 1px grey;border-bottom: none; margin-top:17%; margin-bottom:3%"/>
{{--                    <p style = "font-size:20px;line-height: 80%" class = "p-0 mb-2">--}}
{{--                        テロワール--}}
{{--                    </p>--}}
{{--                    <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:1%;margin-right:3%;margin-bottom:1%; line-height:120%">--}}
{{--                        土壌：キメリジアン石灰岩の硬い層が粘土の柔らかい層と交互になります。 ブドウの木の平--}}
{{--                        均年齢：20歳。ストレージの可能性3～5年。軽い魚やシーフードの前菜、家禽の牧師、海の白--}}
{{--                        い魚のグリルと一緒に出すことをお勧めします。--}}
{{--                    </p>--}}
                </div>
            </div>
        </div>
        <div class="page_break"></div>
        @endforeach


        <div style = "z-index: 1000; position: absolute; margin-left:50%;top:3%; color:white; font-size:22px">生産者情報</div>
        <div style = "z-index: -1">
            <img src = "images/pdfbar.png" style = "width:100%;height:auto">
        </div>
        @php
            $makercount = 0;
        @endphp
        @foreach ($makers as $row)
            <div class = "pdf-maker">
                <div style="position:absolute; padding-left:4%; width:18%;">
                    @if(isset($row->foreign_maker_id) && file_exists( public_path() . '/images/detailmaker/'. $row->foreign_maker_id .'.png'))
                        <img style ="width:100%" src = "images/detailmaker/{{$row->foreign_maker_id}}.png">
                    @else
                        <img style ="width:100%" src = "images/maker/default.png">
                    @endif
                </div>
                @if(isset($row->foreign_maker_id) && file_exists( public_path() . '/images/places/'. $row->foreign_maker_id .'.png'))
                    <img style ="position:relative;width:15%; float:right;padding-right:10%" src = "images/places/{{$row->foreign_maker_id}}.png">
                @else
                    <img style ="position:relative;width:15%; float:right;padding-right:10%" src = "images/places/place.png">
                @endif
                <div style="position: relative; margin-left:26%; width:74%">
                    <p style = "font-size:20px;height:40px">
                        {{isset($row->jp_name)?$row->jp_name:''}}
                    </p>
                    <p style = "font-size:20px; height:40px">
                        {{isset($row->en_name)?$row->en_name:''}}
                    </p>
                    @if(isset($row->maker_description) && $row->maker_description!="")
                        <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:3%;margin-right:3%;margin-bottom:3%;">
                            {{isset($row->maker_description)?$row->maker_description:""}}
                        </p>
                    @else
                        <p style = "position:relative;word-wrap: break-word; font-size:10px;width:100%; margin-top:3%;margin-right:3%;margin-bottom:3%;height:130px">
                            {{isset($row->maker_description)?$row->maker_description:""}}
                        </p>
                    @endif
                </div>
            </div>
            @if($makercount%3 !=2 )
                <hr style ="border-top: 1px grey;border-bottom: none;"/>
            @endif

            @if($makercount >= 2&& ($makercount-2)%3 ==0 )
                <div class="page_break"></div>
            @endif
            @php
                $makercount++;
            @endphp
        @endforeach

    </main>
</div>
</body>
</html>
