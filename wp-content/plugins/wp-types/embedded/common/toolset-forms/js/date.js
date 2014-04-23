
var wptDate = (function($) {
    var _tempConditions, _tempField;
    function init(parent) {
        if ($.isFunction($.fn.datepicker)) {
            $('.js-wpt-date', $(parent)).each(function(index) {
                if (!$(this).is(':disabled') && !$(this).hasClass('hasDatepicker')) {
                    $(this).datepicker({
                        showOn: "button",
                        buttonImage: wptDateData.buttonImage,
                        buttonImageOnly: true,
                        buttonText: wptDateData.buttonText,
                        dateFormat: wptDateData.dateFormat,
                        altFormat: wptDateData.dateFormat,
                        changeMonth: true,
                        changeYear: true,
                        yearRange: wptDateData.yearMin+':'+wptDateData.yearMax,
                        onSelect: function(dateText, inst) {
                            $(this).trigger('wptDateSelect');
                        }
                    });
                    $(this).next().after('<span style="margin-left:10px"><i>' + wptDateData.dateFormatNote + '</i></span>');
                    // Wrap in CSS Scope
                    $("#ui-datepicker-div", $(parent)).each(function() {
                        if (!$(this).hasClass('wpt-jquery-ui-wrapped')) {
                            $(this).wrap('<div class="wpt-jquery-ui" />')
                                    .addClass('wpt-jquery-ui-wrapped');
                        }
                    });
                }
            });
        }
    }
    function ajaxConditional(formID, conditions, field) {
        _tempConditions = conditions;
        _tempField = field;
        wptCallbacks.conditionalCheck.add(wptDate.ajaxCheck);
    }
    function ajaxCheck(formID) {
        wptCallbacks.conditionalCheck.remove(wptDate.ajaxCheck);
        wptCond.ajaxCheck(formID, _tempField, _tempConditions);
    }
    function ignoreConditional(val) {
        return '__ignore';
    }
    function bindConditionalChange($trigger, func, formID) {
        $trigger.on('wptDateSelect', func);
        var lazy = _.debounce(func, 1000);
        $trigger.on('keyup', lazy);
        return false;
    }
    function triggerAjax(func){
        if ($(this).val().length >= wptDateData.dateFormatPhp.length) func();
    }
    return {
        init: init,
        ajaxConditional: ajaxConditional,
        ajaxCheck: ajaxCheck,
        ignoreConditional: ignoreConditional,
        bindConditionalChange: bindConditionalChange,
        triggerAjax: triggerAjax
    };
})(jQuery);

jQuery(document).ready(function() {
    wptDate.init('body');
    
    //fixing unknown Srdjan error
    jQuery('.ui-datepicker-inline').hide();
});

wptCallbacks.reset.add(function(parent) {
    wptDate.init(parent);
});
wptCallbacks.addRepetitive.add(wptDate.init);
add_action('conditional_check_date', wptDate.ajaxConditional, 10, 3);
add_filter('conditional_value_date', wptDate.ignoreConditional, 10, 1);
add_action('conditional_trigger_bind_date', wptDate.bindConditionalChange, 10, 3);