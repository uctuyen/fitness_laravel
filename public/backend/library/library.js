// (function($){
//     "user strict";
//     var Uc = {};
//     var document = $(document)

//     Uc.switchery = () =>{
//         $('.js-switch').each(function(){
//             var switchery = new Switchery(this, { color: '#1AB394' });
//         })
//     }

//     Uc.checkAll = () =>{
//         if($('#checkAll').length){
//             $(document).on('click','#checkAll', function(e){
//                 let checkAll = $(this).prop('checked')
//                 $('.checkBoxItem').prop('checked', checkAll)

//                 e.preventDefault()
//             }
//         )
//     }
//     Uc.select2 = () =>{
//         $('.setupSelect2').select2();
//     }
//     document.ready(function(){
//         Uc.switchery();
//         Uc.checkAll();
//         Uc.select2();
//     })
// }
// })(jQuery);
(function($){
    "use strict";
    var Uc = {};

    Uc.switchery = () =>{
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394' });
        });
    }

    Uc.checkAll = () =>{
        if($('#checkAll').length){
            $(document).on('click','#checkAll', function(){
                let iChecked = $(this).prop('checked');
                $('.checkBoxItem').prop('checked', iChecked);
                $('.checkBoxItem').each(function(){
                    let _this = $(this);
                    if(_this.prop('checked')){
                        _this.closest('tr').addClass('active-bg');
                    }else{
                        _this.closest('tr').removeClass('active-bg');
                    }
                })
            });
        }
    }

    Uc.checkBoxItem = () =>{
        if($('.checkBoxItem').length){
            $(document).on('click','.checkBoxItem', function(){
                let _this = $(this);
                let isChecked = _this.prop('checked');
                let uncheckedCheckBoxExist = $('.input-check:not(:checked)').length > 0;
                $('#checkAll').prop('checked', !uncheckedCheckBoxExist);
                if(isChecked){
                    _this.closest('tr').addClass('active-bg');
                }else{
                    _this.closest('tr').removeClass('active-bg');
                }
            });
        }
    }

    Uc.select2 = () =>{
        $('.setupSelect2').select2();
    }

    $(document).ready(function(){
        Uc.switchery();
        Uc.checkAll();
        Uc.checkBoxItem();
        Uc.select2();
    });
})(jQuery);