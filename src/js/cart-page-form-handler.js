import jQuery from 'jquery';

/**
 * Process the form
 * @param {jQUery} $ Jquery Function
 * @param {jQUeryObject} fo form object
 */
export function CartPageFormHandler($, fo) {
    this.fd = null;
    this.stateObj = null;
    this.current = null; // current form data object
    this.formObject = null;
    this.stateAddressObj = null;
    this.countryAddressObj = null;
    this.countryObj = null; // Contains list of countries


    this.init = function (formData, countries) {
        this.formObject = fo[0];
        this.fd = formData;
        this.countryObj = countries;
        return this;
    };

    this.setStates = function(data){
        this.stateObj = data;
        return this;
    };

    this.getStates = function(){ return this.stateObj; };

    /**
     * 
     * @param {callback} stateAsync  Handler for country and sate input field
     * @param {*} self 
     */
    this.processFormData = function (stateAsync,self = this) {
        const state = new RegExp(/^.+(_state)/);
        const country = new RegExp(/^.+_(country)/);
        for (self.current in self.fd) {
            
            if (self.fd[self.current].type) {
                if(state.test(self.current)){
                    this.stateAddressObj = self.fd[self.current];
                    this.stateAddressObj.name = self.current; 
                }else if(country.test(self.current)){
                    this.countryAddressObj = self.fd[self.current];
                    this.countryAddressObj.name = self.current;
                }    
            } else {
                this.setTheInputElement(self.current, self.fd[self.current]);
            }
        }
        const resFnc = this.setCountryAndStateInputField.bind(this)
        stateAsync(this.countryAddressObj.value).then(
           resFnc
            ).catch(
            err => {console.warn(err);}
        );
    };

    this.setTheInputElement = function (name, data, self = this) {
        
        $(this.formObject.querySelectorAll('[name="' + name + '"]')).val(data.value);
        $(this.formObject.querySelectorAll('[for="cart-page__'+name+'"]')).text(data.label);;
    }

    this.setCountryAndStateInputField = function(dataObj){
    
        this.setStates(dataObj.data.states || {});
        const country_options = this.createOptionElement(this.countryObj, this.countryAddressObj.value);
    
        this.createSelectElement(this.countryAddressObj.name, country_options);
        let modified_state_address = this.stateAddressObj;
        debugger;
        modified_state_address.value = this.getStates()[modified_state_address.value];
        this.setTheInputElement(modified_state_address.name,modified_state_address);
        let el = $(this.formObject).find('[name="' + this.stateAddressObj.name + '"]');
        let id_value = el.attr('list');
        let data_list = this.createDatalist(id_value,this.getStates(),this.stateAddressObj.value);
        el.parent().append(data_list);
    };

    this.createOptionElement = function(data, selected){
        let options = '';
        for(let code in data){
            if(code === selected){
                options += '<option value="' + code +'" selected>' + data[code] + '</option>';
                continue;
            }
            options += '<option value="' + code +'">' + data[code] + '</option>';
        }
        return options;
    };

    /**
     * This puts <option> in the select element 
     * @param {string} id_value     id of the select element
     * @param {string} option_element   the <option> elements
     */
    this.createSelectElement = function(id_value, option_element){
        let id = 'cart-page__' + id_value;
        // const el = $(this.formObject).find('#'+'cart-page__shipping-country');
        const el = $(this.formObject).find('#'+id);
        $(el).html(option_element);
    };

    this.createDatalist = function(id, data, selected){
        let data_list = '<datalist id="'+id+'">';
        for(let code in data){
            if(code === selected){

                data_list += '<option data-state_code="'+code+ '" value="'+data[code]+'" selected>';
                continue
            }
            data_list += '<option data-state_code="'+code+ '" value="'+data[code]+'">';
        }
        return data_list += '</datalist>';

    };
     
    /**
     * Interface for creating datalist element 
     * @param {string} name value of the name attribute of the address field 
     * @param {object} input_element_data   Data object of the address field 
     * @param {object} states   the state object 
     * @param {*} self 
     */
     this.createInputDatalistElement = function(name, input_element_data, states, self= this){
      console.log(self);
        
        
     }
}

