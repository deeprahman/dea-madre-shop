
import $ from 'jquery';

export class FormCreator {

    /**
     * 
     * @param {object} address_data address data created by WooCommerce to be used in form creation
     * @param {object} countries Object containing country data
     * @param {string} form_type   'billing'  or  'shipping'
     */
    constructor(address_data, countries, form_type) {
        this.addressData = address_data;
        this.countriesData = countries;
        this.formType = form_type;
    }
    init() {

        let form = ``;

        for (let key in this.addressData) {
            let data = this.addressData[key];
            data.name = key;
            if (data.name === 'shipping_country') {

                form += this.getTemplateSelect(data, this.countriesData);
            } else {
                form += this.getInputTemplate(data);
            }
        }

        form += ``;

        this.form = form;
        return this;
    }

    getForm() {
        return this.form;
    }

    triggerForChangesInCountry(handler, el_name){
        let el = $(el_name);
        if(el){
            el.on('change',handler);
            return;
        }
        console.log("the country selection element is not defined");
    }

    getInputTemplate(data) {
        return `
        <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="id-${data.name}" class="col-form-label">${data.label}</label>
        </div>
        <div class="col-auto">
            <input name="${data.name}" type="text" id="id-${data.name}" class="form-control" value="${data.value}" aria-describedby="${data.name}HelpInline" ${data.required ? 'required' : ''}>
        </div>
        <div class="col-auto">
            <span id="${data.name}HelpInline" class="form-text"> <?php exc_html_e('Input', 'deamadre')?>&nbsp;
                ${data.label}
            </span>
        </div>
    </div>
        `;
    }




    getDatalist(data, id) {
        let dataList = '';
        for (let key in data) {
            dataList += `<option value="${key}">${data[key]}</option>`;
        }
        return `<datalist id="${id}">${dataList}</datalist>`
    }

    getTemplateInputOption(data, options) {

        let id = "id-datalist-" + data.name;
        let opt = this.getDatalist(options, id)
        return `
        <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="id-${data.name}" class="col-form-label">${data.label}</label>
        </div>
        <div class="col-auto">
            <input list="${id}" name="${data.name}" value="${data.value}" type="text" id="id-${data.name}" class="form-control" aria-describedby="${data.name}HelpInline" ${data.required ? 'required' : ''}>${opt}
        </div>
        <div class="col-auto">
            <span id="${data.name}HelpInline" class="form-text"> <?php exc_html_e('Input', 'deamadre')?>&nbsp;
                ${data.label}
            </span>
        </div>
    </div>
        `;
    }


    getOptions(data, value) {
        let options = '';
        for (let key in data) {
            if( key === value ){

                options += `<option value="${key}" selected>${data[key]}</option>`;
                continue;
            }
            options += `<option value="${key}">${data[key]}</option>`;
        }
        return options;
    }

    getTemplateSelect(data, options) {

        let opt = this.getOptions(options, data.value)
        return `
        <div class="row g-3 align-items-center my-3">
        <div class="col-auto">
            <label for="id-${data.name}" class="col-form-label">${data.label}</label>
        </div>
        <div class="col-auto">
           <select name="${data.name}" class="form-select" aria-label="Default select example">
                ${opt}
            </select> 
        </div>
        <div class="col-auto">
            <span id="${data.name}HelpInline" class="form-text"> <?php exc_html_e('Input', 'deamadre')?>&nbsp;
                ${data.label}
            </span>
        </div>
    </div>
        `;
    }
}