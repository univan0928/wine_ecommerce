@php
    $cnt = 0;
@endphp
<input type ="hidden" value = {{$result['cnt']}} name="white_count">

@for($i = 0;$i<$result['cnt'];$i++)
    @php
        $id = 'white_variety'.$i;
        $cnt++;
    @endphp
    <div class="form-check w-25">
        <input class="form-check-input" type="checkbox" value={{$result['check'][$i]}} name={{$id}} id={{$id}} onclick="whiteVarietySearch()" checked>
        <label class="form-check-label" for="Cabernet">
            {{$result['check'][$i]}}
        </label>
    </div>
    @if($cnt == 10) @break;
    @endif
@endfor

@foreach($result['search'] as $row)
    @php
        $id = 'white_variety'.$cnt;

        $flag = 0;
        for($i = 0;$i<$result['cnt'];$i++){
            if($row->variety == $result['check'][$i]) {
                $flag=1; break;
            }
        }

    @endphp
    @if($flag == 1) @continue
    @endif
    <div class="form-check w-25">
        <input class="form-check-input" type="checkbox" value={{$row->variety}} name={{$id}} id={{$id}} onclick="whiteVarietySearch()">
        <label class="form-check-label" for="Cabernet">
            {{$row->variety}}
        </label>
    </div>
    @if(($cnt++) == 9) @break;
    @endif
@endforeach

