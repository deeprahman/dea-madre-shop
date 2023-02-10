import jQuery from 'jquery';

/**
 * Process the form
 * @param {jQUery} $ Jquery Function
 * @param {jQUeryObject} fo form object
 */
export function CartPageFormHandler($, fo){
    this.fd = null;
    this.current = null; // current form data object
    this.formObject = null;
    

    this.init = function(formData, countries){

        this.formObject = fo[0];
        this.fd = formData;
        this.countryObj = countries;
        return this;
    };

    this.processFormData = function(self = this){
  
        for(self.current in self.fd){
            console.log('name: ',self.current, 'data object: ', self.fd[self.current]);
            if( self.fd[self.current].type ){

            }else{

            }
        }
    };

    this.setTheInputElement = function(name, data,self = this){
        // TODO: create input item creator
    }
}

