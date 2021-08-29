@extends('dashboard.base')

@section('css')
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <i class="fa fa-align-justify"></i>{{ trans('wine.wine maker')}}
                                <a href="{{ route('makers.create') }}" class="btn btn-primary m-2">{{ __('wine.Add maker') }}</a>
                            </div>
                            <div class = "float-right">
                                <a href="{{ route('makerexport') }}" class="btn btn-primary m-2">{{ __('Excel') }}</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <br>
                            <table id="estimates" class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{{ trans('wine.code winery')}} </th>
                                    <th>{{ trans('wine.place')}} </th>
                                    <th>{{ trans('wine.jp winery')}} </th>
                                    <th>{{ trans('wine.en winery')}} </th>
                                        <th>{{trans('wine.E-Mail Address')}}</th>
{{--                                    <th>{{trans('wine.address')}}</th>--}}
{{--                                    <th>{{trans('wine.fax')}}</th>--}}
{{--                                    <th>{{trans('wine.tel')}}</th>--}}
                                    <th>{{"URL"}}</th>
                                    <th>

                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('wine.alert')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    {{__('wine.alert content')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.alert cancel')}}</button>
                    <form action="{{ route('makers.destroy', '1' ) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="user_name" id="user_name" value=""/>
                        <button class="btn btn-block btn-danger">{{__('wine.alert delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script type="text/javascript">
        $(document).on("click", "#customer_dialog", function () {
            var UserName = $(this).data('id');
            $(".modal-footer #user_name").val( UserName );
        });
        $(document).ready(function() {
            var settings = {
                ajax: {
                    'url':'makers/list',
                    'type':'post',
                    'data': function(data){
                        data._token = $("meta[name='csrf-token']").attr("content");
                    }
                },
                processing: true,
                serverSide: true,

                // responsive: true,
                scrollX:true,
                lengthMenu: [5, 10, 15, 25, 50, 100],
                pageLength: 10,
                language:{
                    "lengthMenu": "&nbsp;<span class='pageLength'>表示数:</span>&nbsp; _MENU_",
                    "zeroRecords": "該当する記録が見つかりません。",
                    "info": "",
                    "infoEmpty": "&nbsp;&nbsp;表示するレコードが見つかりませんでした。",
                    "emptyTable": "テーブル内のデータなし。",
                    "infoFiltered": "",
                    "paginate": {
                        "previous": "<",
                        "next": ">",
                        "last": "最終",
                        "first": "最初",
                        "page": "ぺージ:&nbsp;",
                        "pageOf": "&nbsp;"
                    },
                    "search":"検索:"
                },
                order: [
                    [ 0, "asc" ]
                ],
                columns: [
                    { "data": "foreign_maker_id" },
                    { "data": "maker_place" },
                    { "data": "jp_full_name" },
                    { "data": "en_name" },
                    {"data":"maker_email"},
                    // {"data":"maker_address"},
                    // {"data":"maker_fax"},
                    // {"data":"maker_phone"},
                    {"data":"maker_url"},
                    { "data": "foreign_maker_id" },
                    { "data": "foreign_maker_id" },
                    { "data": "foreign_maker_id" }
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-id', data[data.length-1]);
                },
                columnDefs: [
                    {
                        targets: 1,
                        orderable:false,
                        render: function(data, type, full, meta){
                            console.log(data);
                            if(data == null ||data == '')
                                return `<img src="{{asset("images/places/place.png")}}" style="border:6px solid #e6d2d2; cursor:pointer;height:68px;width:105px" />`
                            else return `<img src="{{asset("images/places/`+data+`")}}" style="border:6px solid #e6d2d2; cursor:pointer;height:68px;width:105px" />`
                        }
                    },
                    {
                        targets: 6,
                        orderable:false,
                        render: function(data, type, full, meta){
                            return "<a  class='btn btn-block btn-primary' href='/admin/makers/"+data+"/edit'>{{__('wine.edit')}}</a>";
                        }
                    },
                    {
                        targets: 7,
                        orderable:false,
                        render: function(data, type, full, meta){
                            return  `<button id = "customer_dialog" class="btn btn-block btn-danger" data-id=`+data+` data-toggle="modal" data-target="#exampleModal">
                                {{__('wine.delete')}}
                                </button>`
                        }
                    },
                    {
                        targets: -1,
                        visible: false,
                    },

                ]
            };

            var tbl_main = $('#estimates').DataTable( settings );
            tbl_main.on('click', 'a.estimate_link', function(e){
                e.stopPropagation();
                e.preventDefault();
                var url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'get',
                    data: {file_check:true},
                    dataType: 'json',
                    success:function(res){
                        console.log(res);
                        if(res==false){
                            alert('PDFファイルが存在しません。');
                        }else{
                            window.open(url, '_blank');
                        }
                    }
                });
            });

        });
    </script>

@endsection

