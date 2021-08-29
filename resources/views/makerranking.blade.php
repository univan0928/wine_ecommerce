@extends('layouts.appmain')

@section('additional_css')
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <style>

    </style>
@endsection

@section('content')

    <div class="container mb-3">
        <div class="d-flex justify-content-between">
            <h2 class="m-0 font-weight-bold"><a class="text-black" href="{{route('home')}}">{{__('wine.Home')}}</a>&nbsp>&nbsp{{__('wine.Producer Raking')}}</h2>
            <div>
                <a class="home-addtocart pr-2" href="{{ route('findWine') }}"><div class="but1 p-2">{{__('wine.findWine')}}</div></a>
                <a class="home-addtocart" href="{{ route('advancedSearch') }}"><div class="but1 p-2">{{__('wine.Advanced wine search')}}</div></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card-type mb-5 row mr-0 ml-0 p-2 pt-4">
            <div class="col-md-3 col-xl-3">
                <select class = "select-control"  name="cars" id="typeList">
                    <option value=""></option>
                    @foreach ($result['types'] as $row)
                        <option value={{$row->data}}>{{$row->data}}</option>
                    @endforeach
                </select>
                <label for="exampleCheck2">{{__('wine.Type')}}</label>
            </div>
            <div class="col-md-3 col-xl-3">
                <select class = "select-control"  name="cars" id="countryList">
                    <option value=""></option>
                    @foreach ($result['all_countries'] as $row)
                        <option value={{$row->id}}>{{$row->country_jp_name}}</option>
                    @endforeach
                </select>
                <label for="exampleCheck2">{{__('wine.country list')}}</label>
            </div>
            <div class="col-md-3 ol-xl-3" id = "region">
                <select class = "select-control" name="cars" id="regionList">
                    <!-- @foreach ($result['all_regions'] as $row)
                        <option value={{$row->region_jp_name}}>{{$row->region_jp_name}}</option>
                    @endforeach -->
                </select>
                <label class = "" for="exampleCheck2">{{__('wine.local name search')}}</label>
            </div>
            <div class="col-md-3 col-xl-3">
                <select class = "select-control"  name="cars" id="qualityList">
                    <option value=""></option>
                    @foreach ($result['qualities'] as $row)
                        <option value={{$row->data}}>{{$row->data}}</option>
                    @endforeach
                </select>
                <label for="exampleCheck2">{{__('wine.Quality category')}}</label>
            </div>
        </div>
        <div class = "card-type">
            <div class="card-body">
                <!--Table-->
                <table class="table table-hover" id="maker_list">
                    <!--Table head-->
                    <thead class="mdb-color darken-3">
                        <tr class="text-black">
                            <th></th>
                            <th>{{__('wine.wine maker')}}</th>
                            <th>{{__('wine.Origine Country')}}</th>
                            <th>{{__('wine.local name search')}}</th>
                            <th>{{__('wine.Evalution')}}</th>
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
@endsection

@section('additional_script')

    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script  type="text/javascript">
        $(document).ready(function() {
            var settings = {
                ajax: {
                   'url':"{{ route('ajaxMakerList') }}",
                   'type':'post',
                   'data': function(data){
                     data._token = $("meta[name='csrf-token']").attr("content");
                     data.searchtype= $("#typeList").val();
                     data.searchcountry= $("#countryList").val();
                     data.searchregion= $("#regionList").val();
                     data.searchquality= $("#qualityList").val();

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
                  [ 1, "desc" ]
                ],
                columns: [
                  { "data": "maker_avatar" },
                  { "data": "jp_name" },
                  { "data": "country_jp_name" },
                  { "data": "region_jp_name" },
                  { "data": "foreign_maker_id" }
                ],
                columnDefs: [
                  {
                    targets: 0,
                    orderable: false,
                    render: function(data, type, full, meta){
                        if(data){

                            return "<img class='maker_avatar' src='/images/detailmaker/"+data+"'>";
                        }else{
                            return "<img class='maker_avatar' src='/images/maker/default.jpg'>";
                        }
                    }
                  },
                  {
                    targets: 1,
                    render: function(data, type, full, meta){
                        if(full.jp_name){
                            return full.jp_name;
                        }else{
                            return full.en_name;
                        }
                    }
                  },

                    {
                        targets: 2,
                        render: function(data, type, full, meta){
                            if(full.country_jp_name){
                                return full.country_jp_name;
                            }else{
                                return "";
                            }
                        }
                    },
                  {
                    targets: -1,
                    render: function(data, type, full, meta){
                        return "";
                    }
                  },
                ]
              };
            var tbl_main = $('#maker_list').DataTable( settings );

            $("#countryList").change(function(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('getRegionByCountry') }}",
                    data: { country_id: $(this).val(), _token:$("meta[name='csrf-token']").attr("content") },
                    success: function(res){
                        var str = "";
                        str += `<option value = ""></option>`;
                        $.each(res, function(key, value){
                            str += "<option value='"+value.id+"'>"+ value.region_jp_name + "</option>";
                        });

                        $("#regionList").html(str);
                    }
                });
                tbl_main.ajax.reload();
            });

            $('#typeList, #regionList, #qualityList').change( function() {
                tbl_main.ajax.reload();
            });
        });

    </script>
@endsection
