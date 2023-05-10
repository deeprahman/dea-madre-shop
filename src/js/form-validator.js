import jQuery from 'jquery';

export default validator = {
    

    isInputFieldValid: function(controlEl, className){
        if(controlEl.validity,valid){
            $(controlEl).css({
                "border": "1px groove green"
            });
            return true;
        }else{
              $(controlEl).css({
                "border": "1px groove red"
            });
            return false;
        }
    }
};