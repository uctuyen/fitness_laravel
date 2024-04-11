(function($){
    "user strict";
    var Uc = {};

    Uc.getLocation = () => {
       $(document).on('change','.location',
       function(){

                let _this = $(this)
                let option = {
                    'data' :{
                        'location_id': _this.val()
                    },
                    'target' : _this.attr('data-target') 
                }
                Uc.sendDataLocation(option)
            }
       )
    }
    Uc.sendDataLocation = (option) => {
        $.ajax(
            {
                url:'/ajax/location/getLocation', // --> đường dan T http://127.0.0.1:8000/employee/ajax/location/getLocation?data%5Blocation_id%5D=01&target=districts no ghep them namspace của controller
                type: 'GET',
                data: option,
                dataType: 'json',
                success: function(res){
                    $('.'+option.target).html(res.html)
                    if(district_id != '' && option.target == 'districts'){

                        $('.districts').val(district_id).trigger('change')
                    }
                    if(ward_id != '' && option.target == 'wards'){
                        console.log(123);

                        $('.wards').val(ward_id)
                    }
                    console.log(option.target);

                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Lỗi' + textStatus + ' ' + errorThrown);
                }
            }
        )
    }
    Uc.loadCity = () => {
        if (province_id != ''){
            $(".province").val(province_id).trigger('change');
        }
    }
    $(document).ready(function(){
        Uc.getLocation();
        Uc.loadCity();
    })
})(jQuery);