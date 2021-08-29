function passwordShow() {
    var x = document.getElementById("password");
    var y = document.getElementById("slash");
    if (x.type === "password") {
        x.type = "text";
        y.classList.remove("fa-eye-slash");
        y.classList.add("fa-eye");
    } else {
        x.type = "password";
        y.classList.remove("fa-eye");
        y.classList.add("fa-eye-slash");
    }
}

$(document).ready(function (){
    cartRefresh();
});

const emailField = $("#email");

emailField.keyup(function (event) {
    const emailVal = emailField.val();
    isValidEmail = checkValidity(emailVal);
    if(isValidEmail) {
        $("#check-circle").attr("style","display:inline");
    }
    else {
        $("#check-circle").attr("style","display:none");
        // if(emailVal.length>0) $("#passwordLabel").attr("style","top:-12px,font-size: 12px;");
    }
});
// if(emailField.val().length>0) $("#passwordLabel").attr("style","top:-12px,font-size: 12px;");
const flag = checkValidity(emailField.val());
if(flag) $("#check-circle").attr("style","display:inline");
else $("#check-circle").attr("style","display:none");


function checkValidity(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function cartRefresh(){
    $.ajax({
        url: '/addToCart',
        method: "POST",
        data: {id: ""},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            // console.log(response);
            // window.location.reload();
            $('#cart_dropdown_refresh').html(response);
        }
    });
}


function advancedRegions(){

    $.ajax({
        url:"/product/ajaxsearch",
        type: 'POST',
        data:{
            startDate:$('#startDate').val(),
            endDate:$('#endDate').val(),
            availableCheck: $("#availableCheck").is(":checked"),
            countryList: $("#countryList").val(),
            regionList: "",
            maker_name: $('#maker_name').val(),
            vintageDate: $('#vintageDate').val()
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#regionList').html(data[2]);
        }
    });
}

function loadRegions(){
    $.ajax({
        url:"product/ajaxregions",
        type:'POST',
        data:{
            countryList:$('#product_country').val()
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#product_region').html(data);
        }
    })
}

function whiteVarietySearch(){

    var cnt = 0;
    var tmp = 0;
    var check = [];
    var uncheck =[]
    for(let i = 0;i < $("#white_variety_result").children().length;i++){
        var str = "#white_variety"+i;
        if($(str).is(":checked") == true) {
            check[cnt++] = $(str).val();
        }else uncheck[tmp++] = $(str).val();
    }


    $.ajax({
        url:"product/ajaxwhitevariety",
        type:'POST',
        data:{
            whiteVariety:$('#white_variety').val(),
            check:check,
            uncheck:uncheck,
            cnt:cnt,
            tmp:tmp,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){

            $('#white_variety_result').html(data);
        }
    })
}



function redVarietySearch(){
    var cnt = 0;
    var tmp = 0;
    var check = [];
    var uncheck =[]
    for(let i = 0;i < $("#red_variety_result").children().length;i++){
        var str = "#red_variety"+i;
        if($(str).is(":checked") == true) {
            check[cnt++] = $(str).val();
        }else uncheck[tmp++] = $(str).val();
    }

    $.ajax({
        url:"product/ajaxredvariety",
        type:'POST',
        data:{
            check:check,
            uncheck:uncheck,
            cnt:cnt,
            tmp:tmp,
            redVariety:$('#red_variety').val()
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){

            $('#red_variety_result').html(data);
        }
    })

}



function rangeAjax(){
      $.ajax({
        url:"range/refreshajax",
        type:'POST',
        data:{
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#range_price').html(data);
        }
    })

}


function number_format (number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    const n = !isFinite(+number) ? 0 : +number
    const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    const dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    let s = ''
    const toFixedFix = function (n, prec) {
    if (('' + n).indexOf('e') === -1) {
      return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
    } else {
      const arr = ('' + n).split('e')
      let sig = ''
      if (+arr[1] + prec > 0) {
        sig = '+'
      }
      return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
    }
    }
    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
    s[1] = s[1] || ''
    s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}

