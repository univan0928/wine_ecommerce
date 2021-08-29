@extends('layouts.appmain')

@section('additional_css')
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container mb-3">
        <div class="d-flex justify-content-between">
            <h2 class="m-0 font-weight-bold"><a class="text-black" href="{{route('home')}}">{{__('wine.Home')}}</a>&nbsp>&nbsp{{__('wine.Wine Raking')}}</h2>
            <div>
                <a class="home-addtocart pr-2" href="{{ route('findWine') }}"><div class="but1 p-2">{{__('wine.findWine')}}</div></a>
                <a class="home-addtocart" href="{{ route('advancedSearch') }}"><div class="but1 p-2">{{__('wine.Advanced wine search')}}</div></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card-type mb-5 row mr-0 ml-0 p-2 pt-4">
            <div class="col-md-2 col-xl-2">
                <select class = "select-control"  name="country" id="countryList">
                    <option value=""></option>
                    @foreach ($result['all_countries'] as $row)
                        <option value={{$row->country_en_name}}>{{$row->country_jp_name}}</option>
                    @endforeach
                </select>
                <label for="">{{__('wine.country list')}}</label>
            </div>
            <div class="col-md-2 col-xl-2">
                <select class = "select-control"  name="maker" id="makerList">
                    <option value=""></option>
                    <!-- @foreach ($result['all_makers'] as $row)
                        <option value="{{$row->foreign_maker_id}}">{{$row->jp_name}}</option>
                    @endforeach -->
                </select>
                <label for="">{{__('wine.wine maker')}}</label>
            </div>
            <div class="col-md-2 col-xl-2">
                <select class = "select-control"  name="year" id="yearList">
                    <option value=""></option>
                    @for($i=1900; $i<= date('Y'); $i++)
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                </select>
                <label for="">{{__('wine.year')}}</label>
            </div>
            <div class="col-md-2 col-xl-2">
                <select class = "select-control"  name="taste" id="tasteList">
                    <option value=""></option>
                    @foreach ($result['all_taste'] as $row)
                        <option value="{{$row->id}}">{{$row->type_name}}</option>
                    @endforeach
                </select>
                <label for="">{{__('wine.Taste')}}</label>
            </div>
            <div class="col-md-2 col-xl-2">
                <select class = "select-control"  name="type" id="typeList">
                    <option value=""></option>
                    @foreach ($result['all_type'] as $key => $row)
                        <option value={{$key}}>{{$row}}</option>
                    @endforeach
                </select>
                <label for="">{{__('wine.Type')}}</label>
            </div>

            <div class="col-md-2 col-xl-2">
                <select class = "select-control"  name="color" id="colorList">
                    <option value=""></option>
                    <option value="1">{{__('wine.Red')}}</option>
                    <option value="2">{{__('wine.White')}}</option>
                    <option value="3">{{__('wine.Rose')}}</option>
                    <option value="4">{{__('wine.Sparkling wine')}}</option>
                </select>
                <label for="">{{__('wine.Color')}}</label>
            </div>
        </div>
        <div class = "card-type">
            <div class="card-body">
                <!--Table-->
                <table class="table table-hover" id="product_list">
                    <!--Table head-->
                    <thead class="mdb-color darken-3">
                    <tr class="text-black">
                        <th></th>
                        <th>{{__('wine.Color')}}/{{__('wine.Type')}}</th>
                        <th >{{__('wine.product name')}}</th>
                        <th>{{__('wine.year')}}</th>
                        <th>{{__('wine.maker name')}}</th>
                        <th>{{__('wine.Taste')}}</th>
                        <th>{{__('wine.Evalution')}}</th>
                        <th>{{__('wine.Sales by bottle')}}</th>
                        <th>{{__('wine.Price')}}</th>
                    </tr>
                    </thead>
                    <!--Table head-->
                    <!--Table body-->
                    <tbody>

                    </tbody>
                    <!--Table body-->
                </table>
                <!--Table-->
            </div>
        </div>


    </div>

    <script>

    </script>
@endsection

@section('additional_script')
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script  type="text/javascript">
        $(document).ready(function() {
            var settings = {

                ajax: {
                   'url':"{{ route('ajaxProductList') }}",
                   'type':'post',
                   'data': function(data){
                     data._token = $("meta[name='csrf-token']").attr("content");
                     data.searchtype= $("#typeList").val();
                     data.searchcountry= $("#countryList").val();
                     data.searchmaker= $("#makerList").val();
                     data.searchcolor= $("#colorList").val();

                   data.searchyear= $("#yearList").val();
                     data.searchtaste= $("#tasteList").val();

                   }
                },
                processing: true,
                serverSide: true,
                responsive: true,
                lengthMenu: [5, 10, 15, 25, 50, 100],
                pageLength: 10,
                searching: false,
                lengthChange: false,
                info: false,
                pagingType: 'full_numbers',
                language: {
                    paginate: {
                        "previous" : "&lsaquo;",
                        "next" : "&rsaquo;",
                        "last":"&raquo;",
                        "first" :"&laquo;"
                    },
                    zeroRecords: "該当する記録は見つかりません。" ,
                    emptyTable: "テーブル内のデータなし。",
                    processing: '読み込んでいます...',
                },
                order: [
                  [ 6, "desc" ]
                ],
                columns: [
                    { "data": "image_name"},
                    { "data": "color" },
                    { "data": "full_product_name" },
                    { "data": "vintage_year" },
                    { "data": "maker_jp_name" },
                    { "data": "type_name" },
                    { "data": "rate" },
                    { "data": "bottles_per_case" },
                    { "data": "shop_price" }
                ],
                columnDefs: [
                 {
                    targets: 0,
                    orderable: false,
                    render: function(data, type, full, meta){
                        var str;

                        if(data){
                            return "<img class='product_img' src='/images/products/"+data+"'>";
                        }else{
                            if(full.color == 1){
                                return "<img class='product_img' src='/images/default_red.png'>";
                            }else if(full.color == 2){
                                return "<img class='product_img' src='/images/default_white.png'>";
                            }
                            else if(full.color == 3){
                                return "<img class='product_img' src='/images/default_rose.png'>";
                            }
                            else if(full.color == 0) {
                                return "<img class='product_img' src='/images/default_sparkling.png'>";
                            }
                        }
                    }
                  },
                  {
                    targets: 1,
                    render: function(data, type, full, meta){
                        var str ="";
                        if(full.color == 1){
                            str = '<span class="text-danger">';
                        }else if(full.color == 2){
                            str = '<span class="text-white-product">' ;
                        }
                        else if(full.color == 3){
                            str = '<span class="text-rose">';
                        }
                        else if(full.color == 0){
                            str ='<span class ="text-sparkling">';
                        }else{
                            str = '<span>';
                        }

                        str +='<i class="fa fa-circle ml-1"></i></span>';

                        if(full.color == 0){
                            str += "<p>{{__('wine.Sparkling wine')}}</p>";
                        }else{
                            str +="<p>{{__('wine.Still wine')}}</p>";
                        }
                        return str;
                    }
                  },{
                        targets: 3,
                        render: function (data,type,full,meta){
                            if(data == 0) return 'NV';
                            else return data;
                        }
                    }
                    ,

                  {
                    targets: -1,
                    render: function(data, type, full, meta){
                        return number_format(data) + "円";
                    }
                  },
                ]
              };
            var tbl_main = $('#product_list').DataTable( settings );

            $("#countryList").change(function(){

                $.ajax({
                    type: "POST",
                    url: "{{ route('getRegionByCountry') }}",
                    data: { country_id: $(this).val(), _token:$("meta[name='csrf-token']").attr("content") },
                    success: function(res){
                        var str = "";
                        $.each(res, function(key, value){
                            str += "<option value='"+value.id+"'>"+ value.region_jp_name + "</option>";
                        });

                        $("#regionList").html(str);
                    }
                });
                tbl_main.ajax.reload();
            });

            $('#typeList, #colorList, #makerList, #yearList, #tasteList').change( function() {
                tbl_main.ajax.reload();
            });
        });

    </script>
@endsection
