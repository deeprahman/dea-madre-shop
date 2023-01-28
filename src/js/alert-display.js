import jQuery from 'jquery';


if ('undefined' === typeof $) {
    var $ = jQuery;
}

export class AlertDisplay {

 

   

    setTemplate(alert_type, message) {
        this.alertTemplate = `
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <strong>${alert_type}</strong>:<span>${message}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;
        return this;
    }

    getTemplate(){
        return this.alertTemplate;
    }

    showAlert(alert_type, message){
        let alertHtml = this.setTemplate(alert_type, message).getTemplate();
        $('body').prepend(alertHtml);
    }


}




