BillingSystem.AccountScreen = {
    init: function(){
        //UTIL.fire('AccountScreen','index');
    },
    accountIndex: function(){
        //alert('acocunt index');
        UTIL.fire('common','iCheck');
        UTIL.fire('common','table',config.AJAX_LOAD_ACCOUNT_PER_PAGE_URL);
    },
    actionCreateEdit: function(){

        $('input[type="password"]').on('focus',function(){
            $(this).val('');
        });
    },
    accountCreate: function(){
        //alert('acocunt create');
        UTIL.fire('AccountScreen','actionCreateEdit');
    },
    accountInfo: function(){
        //alert('acocunt info');
        UTIL.fire('AccountScreen','actionCreateEdit');

        UTIL.fire('common','iCheck');
    }
}