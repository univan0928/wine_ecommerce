@php
    if(isset($result->regions) && $result->regions!='') $result = json_decode($result->regions);
    else $result = array();
@endphp

<select name="cars" id="regionList" onchange = "loadDataStart()">
    <option value=""></option>
        @for($i=0;$i<count($result);$i++)
        <option value={{$result[$i]}}>{{$result[$i]}}</option>
        @endfor
</select>
<label for="exampleCheck2">{{__('wine.Future Area')}}</label>
