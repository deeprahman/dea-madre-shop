import jQuery from 'jquery';

/**
 * Process the form
 * @param {jQUery} $ Jquery Function
 * @param {jQUeryObject} fo form object
 */
export function CartPageFormHandler($, fo) {
    this.fd = null;
    this.current = null; // current form data object
    this.formObject = null;


    this.init = function (formData, countries) {

        this.formObject = fo[0];
        this.fd = formData;
        this.countryObj = countries;
        return this;
    };

    this.setStates = function(data){
        this.states = data;
        return this;
    };

    this.getStates = function(){ return this.states; };

    this.processFormData = function (self = this) {
  
        for (self.current in self.fd) {
            console.log('name: ', self.current, 'data object: ', self.fd[self.current]);
            if (self.fd[self.current].type) {

            } else {
                this.setTheInputElement(self.current, self.fd[self.current]);
            }
        }
    };

    this.setTheInputElement = function (name, data, self = this) {
        
        $(this.formObject.querySelectorAll('[name="' + name + '"]')).val(data.value);
        $(this.formObject.querySelectorAll('[for="cart-page__'+name+'"]')).text(data.label);;
    }

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
        $(this.formObject.querySelectorAll('#' + id_value)).html(option_element);
    };

    this.createDatalist = function(id, data){
        let data_list = '<datalist id="'+id+'">';
        for(let code in data){
            data_list += '<option value='+data.code+'>';
        }
    };
     
    /**
     * Interface for creating datalist element 
     * @param {*} name 
     * @param {*} input_element_data 
     * @param {*} states 
     * @param {*} self 
     */
     this.createInputDatalistElement = function(name, input_element_data, states, self= this){
        self.setTheInputElement(name,input_element_data);
        let el = $(this.formObject.querySelectorAll('[name="' + name + '"]'));
        let id_value = el.attr('list');
        let data_list = createDatalist(id_value,states);
        el.next(data_list);
     }
}

