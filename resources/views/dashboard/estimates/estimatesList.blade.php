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
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ trans('wine.estimates')}} </div>
                        <div class="card-body">
                            <br>
                            <table id="estimates" class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{{ trans('No')}} </th>
                                    <th>{{ trans('担当者')}} </th>
                                    <th>{{ trans('wine.date')}} </th>
                                    <th>{{ trans('wine.customer')}} </th>
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

@endsection


@section('javascript')
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var settings = {
                ajax: {
                   'url':'estimates/list',
                   'type':'post',
                   'data': function(data){
                     data._token = $("meta[name='csrf-token']").attr("content");
                   }
                },
                processing: true,
                serverSide: true,
                responsive: true,
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
                  [ 1, "asc" ]
                ],
                columns: [
                  { "data": "estimate_number" },
                  { "data": "user_name" },
                  { "data": "created_at" },
                  { "data": "customer_name" },
                    {"data": "estimate_number"},
                  { "data": "id" }
                ],
                createdRow: function (row, data, dataIndex) {
                  $(row).attr('data-id', data[data.length-1]);
              },
                columnDefs: [
              {
                targets: 0,
                render: function(data, type, full, meta){
                    return data+"<a target='_blank' class='estimate_link' href='/admin/estimate/pdf_"+data+"'>&nbsp&nbsp<i style = \"font-size:25px; color:red;font-weight:bold\" class=\"fa fa-file-pdf-o\" aria-hidden=\"true\"></i></a>";
                }
              },
                {
                    targets: 4,
                    orderable:false,
                    render: function(data, type, full, meta){
                         return "<a  class='btn btn-block btn-primary' href='/admin/estimate/"+data+"'>{{__('wine.show')}}</a>";
                    }
                },
                  {
                    targets: -1,
                    visible: false,
                  }
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

