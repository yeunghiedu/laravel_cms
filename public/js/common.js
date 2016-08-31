/**
 * Created by huytt on 8/8/2016.
 */
BillingSystem.common = {
    init     : function(){
        // smartresize
        UTIL.fire('common','smartResize');

        // sideBar
        UTIL.fire('common','sideBar');

        // panelToolbox
        UTIL.fire('common','panelToolbox');

        // tooltip
        UTIL.fire('common','tooltip');

        // processBar
        UTIL.fire('common','processBar');

        // switchChery
        UTIL.fire('common','switchChery');

        // iCheck
        //UTIL.fire('common','iCheck');

        // table
        //UTIL.fire('common','table');

        // accordion
        UTIL.fire('common','accordion');

        // NProcess
        UTIL.fire('common','NProcess');

        // waiting dialog plugin
        UTIL.fire('common','waitingDialogPlugin');

        UTIL.fire('common','applyHTBSChange');
    },
    accordion: function(){
        $(document).ready(function() {
            $(".expand").on("click", function () {
                $(this).next().slideToggle(200);
                $expand = $(this).find(">:first-child");

                if ($expand.text() == "+") {
                    $expand.text("-");
                } else {
                    $expand.text("+");
                }
            });
        });
    },
    sideBar:function(){
        $(document).ready(function() {
            // TODO: This is some kind of easy fix, maybe we can improve this
            $SIDEBAR_MENU.find('a').on('click', function(ev) {
                var $li = $(this).parent();

                if ($li.is('.active')) {
                    $li.removeClass('active active-sm');
                    $('ul:first', $li).slideUp(function() {
                        setContentHeight();
                    });
                } else {
                    // prevent closing menu if we are on child menu
                    if (!$li.parent().is('.child_menu')) {
                        $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                        $SIDEBAR_MENU.find('li ul').slideUp();
                    }

                    $li.addClass('active');

                    $('ul:first', $li).slideDown(function() {
                        setContentHeight();
                    });
                }
            });

            // toggle small or large menu
            $MENU_TOGGLE.on('click', function() {
                if ($BODY.hasClass('nav-md')) {
                    $SIDEBAR_MENU.find('li.active ul').hide();
                    $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
                } else {
                    $SIDEBAR_MENU.find('li.active-sm ul').show();
                    $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
                }

                $BODY.toggleClass('nav-md nav-sm');

                setContentHeight();
            });

            // check active menu
            $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

            $SIDEBAR_MENU.find('a').filter(function () {
                return this.href == CURRENT_URL;
            }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
                setContentHeight();
            }).parent().addClass('active');

            // recompute content when resizing
            $(window).smartresize(function(){
                setContentHeight();
            });

            setContentHeight();

            // fixed sidebar
            if ($.fn.mCustomScrollbar) {
                $('.menu_fixed').mCustomScrollbar({
                    autoHideScrollbar: true,
                    theme: 'minimal',
                    mouseWheel:{ preventDefault: true }
                });
            }
        });
    },
    smartResize:function(){
        /**
         * Resize function without multiple trigger
         *
         * Usage:
         * $(window).smartresize(function(){
         *     // code here
         * });
         */
        (function($,sr){
            // debouncing function from John Hann
            // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
            var debounce = function (func, threshold, execAsap) {
                var timeout;

                return function debounced () {
                    var obj = this, args = arguments;
                    function delayed () {
                        if (!execAsap)
                            func.apply(obj, args);
                        timeout = null;
                    }

                    if (timeout)
                        clearTimeout(timeout);
                    else if (execAsap)
                        func.apply(obj, args);

                    timeout = setTimeout(delayed, threshold || 100);
                };
            };

            // smartresize
            jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

        })(jQuery,'smartresize');
    },
    NProcess: function(){
        if (typeof NProgress != 'undefined') {
            $(document).ready(function () {
                NProgress.start();
            });

            $(window).load(function () {
                NProgress.done();
            });
        }
    },
    switchChery:function(){
        $(document).ready(function() {
            if ($(".js-switch")[0]) {
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function (html) {
                    var switchery = new Switchery(html, {
                        color: '#26B99A'
                    });
                });
            }
        });

    },
    processBar: function(){
        if ($(".progress .progress-bar")[0]) {
            $('.progress .progress-bar').progressbar();
        }
    },
    iCheck : function(){
        $(document).ready(function() {
            if ($("input.flat")[0]) {
                $(document).ready(function () {
                    $('input.flat').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });
                });
            }
        });
    },
    table_event: function(){

    },
    table: function(ajaxURL){
        var arrCheck = [];
        $('table input').on('ifChecked', function () {
            checkState = '';
            $(this).parent().parent().parent().addClass('selected');
            countChecked();
            getValChecked(this);

            $('#btn-delete').show();
            $('#btn-create').hide();
        });
        $('table input').on('ifUnchecked', function () {
            checkState = '';
            $(this).parent().parent().parent().removeClass('selected');
            var checkCount = countChecked();
            getValChecked(this);

            if(checkCount == 0){
                $('#btn-delete').hide();
                $('#btn-create').show();
            }
        });

        var checkState = '';

        $('.bulk_action input').on('ifChecked', function () {
            checkState = '';
            $(this).parent().parent().parent().addClass('selected');
            countChecked();
        });
        $('.bulk_action input').on('ifUnchecked', function () {
            checkState = '';
            $(this).parent().parent().parent().removeClass('selected');
            countChecked();
        });
        $('.bulk_action input#check-all').on('ifChecked', function () {
            checkState = 'all';
            countChecked();
        });
        $('.bulk_action input#check-all').on('ifUnchecked', function () {
            checkState = 'none';
            countChecked();
        });

        function countChecked() {
            if (checkState === 'all') {
                $(".bulk_action input[name='table_records']").iCheck('check');
            }
            if (checkState === 'none') {
                $(".bulk_action input[name='table_records']").iCheck('uncheck');
            }

            var checkCount = $(".bulk_action input[name='table_records']:checked").length;

            if (checkCount) {
                $('.column-title').hide();
                $('.bulk-actions').show();
                $('.action-cnt').html(checkCount + ' Records Selected');
            } else {
                $('.column-title').show();
                $('.bulk-actions').hide();
            }

            return checkCount;
        }

        //[HTBS-678] kienbt: add function to get value of checked rows
        function getValChecked(el){
            if(arrCheck.indexOf($(el).val()) > -1){
                arrCheck = $.grep(arrCheck,function(v){
                    return v != $(el).val();
                });
            }else{
                if($(el).val() != 'on') arrCheck.push($(el).val());
            }
        }

        // init event of table
        var tableContentId = '#table-content';
        if(ajaxURL.tableName != undefined && ajaxURL.tableName != ''){
            tableContentId += '-' + ajaxURL.tableName;
        }
        $('#calllogFilter').off('click').on('click',function(e){
            e.preventDefault();
            UTIL.fire('common','checkFilterForm');
            if($BOL === false) return false;
            ajaxURL.params.perPage = $(tableContentId + ' .select_per_page option:selected').val();;
            ajaxURL.params.dataFilter = $('#filter_form').serialize();
            loadTableByPerpage(ajaxURL.url,ajaxURL.params, tableContentId);
        });

        $(tableContentId + ' .select_per_page').on('change',function(){
            //[HTBS-524] huytt: refactor to pass more params when use ajax
            ajaxURL.params.perPage = $(tableContentId + ' .select_per_page option:selected').val();
            ajaxURL.params.page = 1;

            loadTableByPerpage(ajaxURL.url,ajaxURL.params, tableContentId);
        });

        $('#btn-delete').on('click',function(e){
            e.preventDefault();
            if(confirm("Are you sure make delete?")){
                ajaxURL.params.perPage = $(tableContentId + ' .select_per_page option:selected').val();;
                deleteSelectedRows($(this).attr('href'),arrCheck,ajaxURL);
            }
        });

        $(tableContentId + ' .pagination li a').on('click', function(e){
            e.preventDefault();
            //[HTBS-524] huytt: refactor to pass more params when use ajax
            //ajaxURL.params.perPage = $(this).attr('href').split('perPage=')[1];
            ajaxURL.params.perPage = $(tableContentId + ' .select_per_page option:selected').val();
            ajaxURL.params.page = $(this).attr('href').split('page=')[1];

            //console.log(data);
            loadTableByPerpage(ajaxURL.url,ajaxURL.params, tableContentId);
        });

        $(tableContentId + ' .even.pointer').on('click',function(e){
            if($(this).attr('data-toggle') === 'modal')
            {
                //alert($(this).attr('data-href'));
                //loadModalContent($(this).attr('data-href'));
                return;
            }
            location.href  = $(this).attr('data-href');
        });

        $('[role="accountIndex"] .column-title').on('click',function(e){
            e.preventDefault();
            $(this).siblings('.column-title').find('i').remove();
            $(this).siblings('.column-title').removeAttr('aria-sort').append('<i class="fa fa-sort"></i>');
            ajaxURL.params.orderBy = $(this).attr('aria-name');
            if($(this).attr('aria-sort') == 'asc'){
                $(this).attr('aria-sort','desc');
                $(this).find('.fa').removeClass('fa-sort-up').addClass('fa-sort-down');
            }else if($(this).attr('aria-sort') == 'desc'){
                $(this).removeAttr('aria-sort');
                ajaxURL.params.orderBy = '';
                $(this).find('.fa').removeClass('fa-sort-down').addClass('fa-sort');
            }else{
                $(this).attr('aria-sort','asc');
                $(this).find('.fa').removeClass('fa-sort').addClass('fa-sort-up');
            }
            ajaxURL.params.sortedBy = $(this).attr('aria-sort');
            ajaxURL.params.perPage = $(tableContentId + ' .select_per_page option:selected').val();
            ajaxURL.params.column = $('#sel_filter').val();
            loadTableByPerpage(ajaxURL.url,ajaxURL.params, tableContentId);
        });

        $('#datatable-responsive_filter button').on('click',function(e){
            e.preventDefault();
            var p = $('#search_field').val();
            ajaxURL.params.search = p;
            ajaxURL.params.perPage = $(tableContentId + ' .select_per_page option:selected').val();
            loadTableByPerpage(ajaxURL.url,ajaxURL.params, tableContentId);
        });

        $('#actionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            loadModalContent(button.data('href'));

            var title = button.data('modal-title');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-title').text(title);
            modal.find('.modal-body').html('<div style="text-align: center;"><img src="http://i.stack.imgur.com/FhHRx.gif" alt="enter image description here"></div>');

        });

        var deleteSelectedRows = function(url,ids,ajaxURL){
            $.ajax({
                url: url,
                type: "POST",
                data: {'_token':$('#token').val(),'id':ids},
                dataType: "json",
                beforeSend: function(){
                    $('#btn-delete').addClass('disabled');
                }
            }).done(function(data){
                if(data.success){
                    alert(data.html);
                    loadTableByPerpage(ajaxURL.url,ajaxURL.params, tableContentId);
                } else {
                    alert(data.html);
                }
            }).error(function(data){
                alert('Error: '+data.statusText);
                console.log(data);
            });
        }

        var loadModalContent = function(url){
            $.ajax({
                url: url,
                dataType:'json'
            }).done(function(data){
                if(data.success){
                    //console.log(data.html);

                    var modal = $('#actionModal');
                    modal.find('.modal-body').html(data.html);

                } else {
                    alert("loadModalContent has error");
                }
            });
        }

        var loadTableByPerpage = function(url, data, tableContentId){

            $.ajax({
                url: url,
                data: data,
                dataType:'json',
                tableContentId: tableContentId
            }).done(function(data){
                //console.log(data);
                if(data.success){
                    //console.log(data.html);

                    $(tableContentId).html(data.html);
                    $(tableContentId).prepend(data.filterHTML);
                    $('#search_field').val(data.search);

                    if(data.orderby){
                        var sel = $('[aria-name='+data.orderby+']');
                        if(data.sortby == 'asc'){
                            sel.find('.fa').removeClass('fa-sort').addClass('fa-sort-up');
                            sel.attr('aria-sort','asc');
                        }else if(data.sortby == 'desc'){
                            sel.find('.fa').removeClass('fa-sort').addClass('fa-sort-down');
                            sel.attr('aria-sort','desc');
                        }
                    }

                    $('body').animate({ scrollTop: 0 }, 'slow');

                    // recompute content when resizing
                    $(window).smartresize(function(){
                        setContentHeight();
                    });

                    setContentHeight();

                    // reinitialize events.
                    UTIL.fire('common','iCheck');
                    UTIL.fire('common','table', ajaxURL);
                } else {
                    alert("loadTableByPerpage has error");
                }
            });
        }
    },
    panelToolbox: function(){
        $(document).ready(function() {
            $('.collapse-link').on('click', function() {
                var $BOX_PANEL = $(this).closest('.x_panel'),
                    $ICON = $(this).find('i'),
                    $BOX_CONTENT = $BOX_PANEL.find('.x_content');

                // fix for some div with hardcoded fix class
                if ($BOX_PANEL.attr('style')) {
                    $BOX_CONTENT.slideToggle(200, function(){
                        $BOX_PANEL.removeAttr('style');
                    });
                } else {
                    $BOX_CONTENT.slideToggle(200);
                    $BOX_PANEL.css('height', 'auto');
                }

                $ICON.toggleClass('fa-chevron-up fa-chevron-down');
            });

            $('.close-link').click(function () {
                var $BOX_PANEL = $(this).closest('.x_panel');

                $BOX_PANEL.remove();
            });
        });
    },
    tooltip : function(){
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        });
    },
    applyHTBSChange: function(){
        var waitingDialog = $(window).waitingDialog();

        $('#applyHTBSChange li a').on('click',function(e){
            waitingDialog.show('Reloading');
            //alert($(this).attr('data-href'));
            $.ajax({
                url: $(this).attr('data-href'),
                dataType:'json'
            }).done(function(data){
                //console.log(data);
                waitingDialog.hide();
                if(data.success){
                    alert(data.html)
                } else {
                    alert("loadRateSelect has error");
                }
            });
        });
    },
    waitingDialogPlugin: function(){
        (function ($) {
            $.fn.extend({
                waitingDialog: function(){
                    // Creating modal dialog's DOM
                    var $dialog = $(
                        '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
                        '<div class="modal-dialog modal-m">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                        '<div class="modal-body">' +
                        '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                        '</div>' +
                        '</div></div></div>');

                    return {
                        /**
                         * Opens our dialog
                         * @param message Custom message
                         * @param options Custom options:
                         *                options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
                         *                options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
                         */
                        show: function (message, options) {
                            // Assigning defaults
                            if (typeof options === 'undefined') {
                                options = {};
                            }
                            if (typeof message === 'undefined') {
                                message = 'Loading';
                            }
                            var settings = $.extend({
                                dialogSize: 'm',
                                progressType: '',
                                onHide: null // This callback runs after the dialog was hidden
                            }, options);

                            // Configuring dialog
                            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                            $dialog.find('.progress-bar').attr('class', 'progress-bar');
                            if (settings.progressType) {
                                $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                            }
                            $dialog.find('h3').text(message);
                            // Adding callbacks
                            if (typeof settings.onHide === 'function') {
                                $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                                    settings.onHide.call($dialog);
                                });
                            }
                            // Opening dialog
                            $dialog.modal();
                        },
                        /**
                         * Closes dialog
                         */
                        hide: function () {
                            $dialog.modal('hide');
                        }
                    };
                }
            });

        })(jQuery);
    },
    finalize : function(){
        //alert('Common finalize');
    },
    tagsinput : function(){
        $('#sel_filter').tagsinput({
            typeahead: {
                source: ['Account','Name','Email','DailNumber','Balance','PaymentType','AccountType','Discount','Status','Tel'],
                items:50,
                minLength : 0
            },
            freeInput : false
        });
    },
    'export' : function(ajaxURL){
        $('#Export').on('click',function(){
            UTIL.fire('common','checkFilterForm');
            if($BOL === false) return false;
            ajaxURL.params.dataFilter = $('#filter_form').serialize();
            var params = $.param(ajaxURL.params);
            var url = ajaxURL.url +'?'+ params;
            window.location.href = url;
        });
    },
    filter : function(){
        var operatorLabels = {"=":"is","!":"is not","\u003e=":"\u003e=","\u003c=":"\u003c=","\u003e\u003c":"between","t":"today","ld":"yesterday","w":"this week","lw":"last week","l2w":"last 2 weeks","m":"this month","lm":"last month","y":"this year"};
        var operatorByType = {"list":["=","!"],"date":["=","\u003e=","\u003c=","\u003e\u003c","t","ld","w","lw","l2w","m","lm","y"]};

        $('#add_filter_select').change(function() {
            addFilter($(this).val(), '', []);
        });
        $('#filters-table td.field input').each(function() {
            toggleFilter($(this).val());
        });
        $('#filters-table').on('ifChanged','input:checkbox', function(e) {
            toggleFilter($(this).val());
        });
        $('#filters-table').on('click', '.toggle-multiselect', function() {
            toggleMultiSelect($(this).siblings('select'));
        });
        function addFilter(field, operator, values) {
            var fieldId = field.replace('.', '_');
            var tr = $('#tr_'+fieldId);
            if (tr.length > 0) {
                tr.show();
            } else {
                buildFilterRow(field, operator, values);
            }
            $('#cb_'+fieldId).iCheck({checkboxClass: 'icheckbox_flat-green',checkedClass: 'checked'});
            toggleFilter(field);
            $('#add_filter_select').val('').find('option').each(function() {
                if ($(this).attr('value') == field) {
                    $(this).attr('disabled', true);
                }
            });

        }
        function buildFilterRow(field, operator, values) {
            var fieldId = field.replace('.', '_');
            var filterTable = $("#filters-table");
            var filterOptions = availableFilters[field];
            if (!filterOptions) return;
            var operators = operatorByType[filterOptions['type']];
            var filterValues = filterOptions['values'];
            var i, select;

            var tr = $('<tr class="filter">').attr('id', 'tr_'+fieldId).html(
                '<td class="field"><input checked="checked" id="cb_'+fieldId+'" name="f[]" value="'+field+'" type="checkbox" class="flat"><label for="cb_'+fieldId+'"> '+filterOptions['name']+'</label></td>' +
                '<td class="operator"><select id="operators_'+fieldId+'" name="op['+field+']"></td>' +
                '<td class="values"></td>'
            );
            filterTable.append(tr);

            select = tr.find('td.operator select');
            for (i = 0; i < operators.length; i++) {
                var option = $('<option>').val(operators[i]).text(operatorLabels[operators[i]]);
                if (operators[i] == operator) { option.attr('selected', true); }
                select.append(option);
            }
            select.change(function(){ toggleOperator(field); });

            switch (filterOptions['type']) {
                case "list":
                    tr.find('td.values').append(
                        '<span style="display:inline;"><select class="value" id="values_'+fieldId+'_1" name="v['+field+'][]"></select>' +
                        ' <span class="toggle-multiselect"><i class="fa fa-plus"></i></span></span>'
                    );
                    select = tr.find('td.values select');
                    if (values.length > 1) { select.attr('multiple', true); }
                    for (i = 0; i < filterValues.length; i++) {
                        var filterValue = filterValues[i];
                        var option = $('<option>');
                        if ($.isArray(filterValue)) {
                            option.val(filterValue[1]).text(filterValue[0]);
                            if ($.inArray(filterValue[1], values) > -1) {option.attr('selected', true);}
                        } else {
                            option.val(filterValue).text(filterValue);
                            if ($.inArray(filterValue, values) > -1) {option.attr('selected', true);}
                        }
                        select.append(option);
                    }
                    break;
                case "date":
                    tr.find('td.values').append(
                        '<span class="input-group input-group-sm" style="display:none;"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" name="v['+field+'][]" id="values_'+fieldId+'_1" size="10" class="value form-control" /></span>' +
                        '<span class="input-group input-group-sm" style="display:none;"><span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" name="v['+field+'][]" id="values_'+fieldId+'_2" size="10" class="value form-control" /></span>'
                    );
                    $('#values_'+fieldId+'_1').daterangepicker({
                        singleDatePicker: true,
                        calender_style: "picker_2"
                    });
                    $('#values_'+fieldId+'_2').daterangepicker({
                        singleDatePicker: false,
                        calender_style: "picker_2",
                        opens: 'left'
                    });
                    break;
            }
        }

        function toggleFilter(field) {
            var fieldId = field.replace('.', '_');
            if ($('#cb_' + fieldId).is(':checked')) {
                $("#operators_" + fieldId).show().removeAttr('disabled');
                toggleOperator(field);
            } else {
                $("#operators_" + fieldId).hide().attr('disabled', true);
                enableValues(field, []);
            }
        }

        function enableValues(field, indexes) {
            var fieldId = field.replace('.', '_');
            $('#tr_'+fieldId+' td.values .value').each(function(index) {
                if ($.inArray(index, indexes) >= 0) {
                    $(this).removeAttr('disabled');
                    $(this).parents('span').first().show();
                } else {
                    $(this).val('');
                    $(this).attr('disabled', true);
                    $(this).parents('span').first().hide();
                }

                if ($(this).hasClass('group')) {
                    $(this).addClass('open');
                } else {
                    $(this).show();
                }
            });
        }

        function toggleOperator(field) {
            var fieldId = field.replace('.', '_');
            var operator = $("#operators_" + fieldId);
            switch (operator.val()) {
                case "!*":
                case "*":
                case "t":
                case "ld":
                case "w":
                case "lw":
                case "l2w":
                case "m":
                case "lm":
                case "y":
                case "o":
                case "c":
                case "*o":
                case "!o":
                    enableValues(field, []);
                    break;
                case "><":
                    enableValues(field, [1]);
                    break;
                case "<t+":
                case ">t+":
                case "><t+":
                case "t+":
                case ">t-":
                case "<t-":
                case "><t-":
                case "t-":
                    enableValues(field, [2]);
                    break;
                case "=p":
                case "=!p":
                case "!p":
                    enableValues(field, [1]);
                    break;
                default:
                    enableValues(field, [0]);
                    break;
            }
        }

        function toggleMultiSelect(el) {
            if (el.attr('multiple')) {
                el.removeAttr('multiple');
                el.attr('size', 1);
            } else {
                el.attr('multiple', true);
                if (el.children().length > 10)
                    el.attr('size', 10);
                else
                    el.attr('size', 4);
            }
        }
    },
    checkFilterForm : function(){
        //Simple validate to get correct result.
        $BOL = true;
        $('#filter_form .value').each(function(){
            if($(this).is(':visible')){
                if($(this).val() == '' || $(this).val() == null){
                    var text = $(this).parents('td').siblings('.field').find('label').text();
                    alert(text + ' cannot be blank');
                    $BOL = false;
                }
            }
        });
    }
}