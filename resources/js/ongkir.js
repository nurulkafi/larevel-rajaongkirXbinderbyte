$(document).ready(function () {
    $('#province_origin').on('change', function(){
        let provinceId = $(this).val();
        if(provinceId) {
            $.ajax({
                url: '/api/province/'+provinceId+'/cities',
                type: 'get',
                dataType: 'json',
                success:function(data) {
                    $('#city_origin').empty();
                    $.each(data, function(key, value){
                        $('#city_origin').append(`<option value="${key}"> ${value} </option>`);
                    });
                },
            });
        } else {
            $('#city_origin').empty();
        }
    });
    $('#province_destionation').on('change', function(){
        let provinceId = $(this).val();
        if(provinceId) {
            $.ajax({
                url: '/api/province/'+provinceId+'/cities',
                type: 'get',
                dataType: 'json',
                success:function(data) {
                    $('#city_destination').empty();
                    $.each(data, function(key, value){
                        $('#city_destination').append(`<option value="${key}"> ${value} </option>`);
                    });
                },
            });
        } else {
            $('#city_destination').empty();
        }
    });
    // $('#province_origin').on('change', function(){
    //     console.log("OK");
    // });
    // $('#submit').on('click', function () {
    //     console.log("OK");
    // });
    // function myFunction() {
    //     alert("Page is loaded");
    // }
});
