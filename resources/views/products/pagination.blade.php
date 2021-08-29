{{--<div class="pagination-box">      --}}
{{--  <ul class="pagination justify-content-end">--}}
{{--    @if($page>1)--}}
{{--    <li class="page-item"><a class="page-link" href="{{route('ajaxPagination', ['page'=>1] )}}" tabindex="-1">&laquo;</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$page-1] )}}" tabindex="-1">&lsaquo;</a></li>--}}
{{--    @else--}}
{{--    <li class="page-item disabled"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$page] )}}" tabindex="-1">&laquo;</a></li>--}}
{{--    <li class="page-item disabled"><a class="page-link" href="javascript:;" tabindex="-1">&lsaquo;</a></li>--}}
{{--    @endif--}}

{{--    @php--}}
{{--      $start =1;--}}
{{--      $end = $page_count;--}}
{{--      if($page>3 && $page_count>5){--}}
{{--        $start = $page-2;--}}
{{--      }--}}
{{--      --}}
{{--      if(($page+2) <$end){--}}
{{--        $end= $page+2;--}}
{{--      }else{--}}
{{--        if($page_count > 5){--}}
{{--          $start = $end-4;--}}
{{--        }        --}}
{{--      }--}}

{{--      if($page<3){--}}
{{--        if($page_count > 5){--}}
{{--          $end = 5;--}}
{{--        }else{--}}
{{--          $end = $page_count;--}}
{{--        }          --}}
{{--      }--}}
{{--      --}}
{{--    @endphp--}}

{{--    @if($start>1)--}}
{{--      <li class="page-item disabled"><a class="page-link" href="javascript:;" tabindex="-1">...</a></li>--}}
{{--    @endif--}}

{{--    @for($i=$start; $i<=$end; $i++)--}}
{{--      @if($i == $page)--}}
{{--        <li class="page-item active"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$i] )}}">{{$i}}</a></li>--}}
{{--      @else--}}
{{--        <li class="page-item"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$i] )}}">{{$i}}</a></li>--}}
{{--      @endif--}}
{{--    @endfor --}}

{{--    @if($end<$page_count)--}}
{{--      <li class="page-item disabled"><a class="page-link" href="javascript:;" tabindex="-1">...</a></li>--}}
{{--    @endif--}}

{{--    @if($page>=$page_count)--}}
{{--    <li class="page-item disabled"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$page+1] )}}">&rsaquo;</a></li>--}}
{{--    <li class="page-item disabled"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$page_count])}}">&raquo;</a></li>--}}
{{--    @else--}}
{{--    <li class="page-item"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$page+1] )}}">&rsaquo;</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="{{route('ajaxPagination', ['page'=>$page_count])}}">&raquo;</a></li>--}}
{{--    @endif--}}
{{--  </ul>    --}}
{{--</div>--}}

{{--<script type="text/javascript">--}}
{{--  $(".pagination a").click(function(e) {--}}
{{--    e.preventDefault();--}}

{{--    $.ajax({--}}
{{--        url: $(this).attr('href'),--}}
{{--        type: 'POST',--}}
{{--        data:{--}}
{{--            startDate:$('#startDate').val(),--}}
{{--            endDate:$('#endDate').val(),--}}
{{--            availableCheck: $("#availableCheck").is(":checked"),--}}
{{--            countryList: $("#countryList").val(),--}}
{{--            regionList: $("#regionList").val()--}}
{{--        },--}}
{{--        headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        },--}}
{{--        success: function(data){--}}
{{--            $('#result').html(data[0]);--}}
{{--            $('#searchResult').html(data[1]);--}}
{{--        }--}}
{{--    });--}}

{{--    return false;    --}}
{{--  });--}}
{{--</script>--}}
