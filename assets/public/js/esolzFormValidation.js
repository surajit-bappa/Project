(function($){
    $.fn.extend({
        
        preOption:{
            errorTextColor: 'red',
            errorFieldColor: 'red'
        },
        ErrerAdd: function(selecter,errorShow,message){
            selecter.next('.ErrorMag').remove();
            selecter.css('border-color','');
            if (message == '') {
                selecter.css('border-color',this.preOption.errorFieldColor);
            }
            else{
                selecter.css('border-color',this.preOption.errorFieldColor);
                if (errorShow == '') {
                    selecter.after('<div class="ErrorMag" style="color:'+this.preOption.errorTextColor+';">'+message+'</div>');
                }
                else{
                    $(errorShow).html('<div class="ErrorMag" style="color:'+this.preOption.errorTextColor+';">'+message+'</div>');
                }
            }
        },
        ErrerFree: function(selecter,errorShow){
            selecter.next('.ErrorMag').remove();
            $(errorShow).html('');
            selecter.css('border-color','');
        },
        commonCheck: function(options){

            var defaults = {
                errorArea: '',
                errorMessage1: 'This field is required'
            };
            
            options_v = $.extend(defaults,options);
            
            msg = options_v.errorMessage1;
            if((typeof options == "undefined") || (typeof options == "")){
                msg = options_v.errorMessage1;
            }
            else if ((typeof options == "string")) {
                msg = options;
            }
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this),options_v.errorArea,msg);
                    return false;
                }
                else{
                   this.ErrerFree($(this),options_v.errorArea);
                   return true;
                }
            }
            else{
                return false;
            }
        },
        validateEmail: function(options){
        
            var defaults = {
                errorArea: '',
                errorMessage1: 'Email is required',
                errorMessage2: 'Please enter a valid e-mail address'
            };
            
            options_v = $.extend(defaults,options);

            msg1 = options_v.errorMessage1;

            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this),options_v.errorArea,msg1);
                    return false;
                }
                else if (!pattern.test(ThisValue)) {
                    
                    msg2 = options_v.errorMessage2;
                    if((typeof options == "undefined") || (typeof options == "")){
                        msg2 = options_v.errorMessage2;
                    }
                    else if ((typeof options == "string")) {
                        msg2 = options;
                    }
                    
                    this.ErrerAdd($(this),options_v.errorArea,msg2);
                    return false;
                }
                else{
                   this.ErrerFree($(this),options_v.errorArea);
                   return true;
                }
                
            }
            else{
                return false;
            }
        },
        CkConfirmPassword: function(options){
            if ($(this).length == 1) {
                $(this).css('border-color','');
                var defaults = {
                    passwordField: '',
                    errorArea: '',
                    errorMessage1: 'This field is required',
                    errorMessage2: 'Password and confirm password not match'
                };
                options_v = $.extend(defaults,options);
               
                ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this),options_v.errorArea,options_v.errorMessage1);
                    return false;
                }
                else if ((options_v.passwordField == '')) {
                    this.ErrerAdd($(this),options_v.errorArea,'<b>Please provide the password field</b>');
                    return false;
                }
                else if ($(options_v.passwordField).length == 0) {
                    this.ErrerAdd($(this),options_v.errorArea,'<b>Please provide the password field</b>');
                    return false;
                }
                else if (ThisValue != $.trim($(options_v.passwordField).val())) {
                    this.ErrerAdd($(this),options_v.errorArea,options_v.errorMessage2);
                    return false;
                }
                else{
                   this.ErrerFree($(this),options_v.errorArea);
                   return true;
                }
            }
            else{
                return false;
            }
        },
        checkFileType: function(options){
            
            if ($(this).length == 1) {
                var defaults = {
                    blankCk: true,
                    allowedExtensions: [], //like ['jpg', 'jpeg']
                    errorArea: '',
                    errorMessage1: 'This field is required',
                    errorMessage2: 'Wrong file type'
                };
                options_v = $.extend(defaults,options);
                ThisValue = $.trim($(this).val());

                if ((ThisValue == '') & (options_v.blankCk)) {
                    this.ErrerAdd($(this),options_v.errorArea,options_v.errorMessage1);
                    return false;
                }
                else{
                    if ((options_v.allowedExtensions.length > 0) & (ThisValue != '')) {
                        ThisValueLower = ThisValue.toLowerCase();
                        extension = ThisValueLower.substring(ThisValueLower.lastIndexOf('.') + 1);
                        if ($.inArray(extension, options_v.allowedExtensions) == -1) {
                            this.ErrerAdd($(this),options_v.errorArea,options_v.errorMessage2);
                            return false;
                        }
                        else{
                            this.ErrerFree($(this),options_v.errorArea);
                            return true;
                        }
                    }
                    else{
                        this.ErrerFree($(this),options_v.errorArea);
                        return true;
                    }
                }
            }
            else{
                return false;
            }
        },
        checkRadioOrCheck: function(options){
            
            //Demo $("input[name=s]:checked").checkRadioOrCheck();
            //  if  name is not array (input[name=s]) 
            //  if name is an array (input[name^=s]) 
            var msg = '';
            var defaults = {
                errorArea : '',
                errorMessage1: 'This field is required'
            };
            options_v = $.extend(defaults,options);
            
            $(options_v.errorArea).html('');
            
            if ((options === undefined) || (options == '')) {
                msg = '';
            }
            else if (typeof options == 'string') {
                msg = options;
            }
            else if (typeof options == 'object') {
                msg = options_v.errorMessage1;
            }
            
            selectorName = $(this).selector;

            if ($(selectorName+':checked').length <= 0) {
                    if (options_v.errorArea !='') {
                        $(options_v.errorArea).html('<span style="color:'+this.preOption.errorTextColor+'">'+options_v.errorMessage1+'</span>');
                    }
                    else{
                        this.ErrerAdd($(this),msg);
                    }
                    return false;
            }
            else{
                   this.ErrerFree($(this));
                   return true;
            }
            
        }
        
    })
})(jQuery);
    