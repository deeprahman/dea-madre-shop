import jQuery from 'jquery';
import { HandleWooMessage as HM } from "./woo-notice-handler.js"
import { AlertDisplay as AD } from './alert-display';
import { CartPageFormHandler as FH } from "./cart-page-form-handler.js";


if ('undefined' === typeof $) {
  var $ = jQuery;
}
let sentData = Object.create(null);
const cartPage = Object.create(null);


cartPage.accountPart = $('#cart-confirm-account-part');
cartPage.shipmentAddressPart = $('#cart-confirm-shipment-address-part');
cartPage.billingAddressPart = $('#cart-confirm-billing-address-part');
cartPage.shipmentRatePart = $('#cart-confirm-shipment-rate-part');

cartPage.btnNext = $('.go-to-next');
cartPage.btnPrevious = $('.go-to-previous');
cartPage.btnSubmit = $('.submit');

cartPage.formHandler = null;

cartPage.checkoutFormSections = $('.cart-confirmation-group');
console.log(cartPage.checkoutFormSections);

cartPage.checkBtn = $('#checkout-btn').on('click', function (e) {
  e.preventDefault();
  let saleChkBox = $('#acceptSellsTerms')[0];
  if (saleChkBox.checked) {
    proceedToCheckout();
  } else {
    let alert = new AD();
    alert.showAlert('Warning', "Sales terms and condition is not checked");
  }
});

cartPage.currentNonce = '';

function proceedToCheckout() {
  $.ajax({
    url: dmObject.siteUrl + '/wp-admin/admin-ajax.php',
    type: 'POST',
    data: prepareSentData(),
    success: function (res) {

      setNewNonce(res);
      processSuccess(res);
    },
    error: function (error) {
      console.warn(error);
    }
  });
}

function setNewNonce(obj) {
  cartPage.newNonce = obj.data.newNonce || (console.log('No New Nonce returned'));
}

function getNewNonce() {
  return cartPage.newNonce;
}


function getCustomerEmail() {
  let email = $('#dm-customer-email').val();
  if (email) {
    sentData['email'] = email;
  } else {
    let alert = new AD();
    alert.showAlert('Warning', "Email is not set");
    throw new Error();
  }
}

function prepareSentData() {
  sentData = {
    action: 'dm_cart_confirmation',
    cart_action: 'account-check',
    nonce: cartPage.newNonce
  };
  getCustomerEmail();
  return sentData;
}

function processSuccess(messageObj) {

  if (messageObj.data === 'undefined') {
    return;
  } else if ((messageObj.data.did === 'account-checking') && (messageObj.data.notice.length === 0)) {

    cartPage.accountPart.hide();
    showShipmentAddress(messageObj.data);
    return;
  }
  let h = new HM();
  h.process(messageObj);
}

function showShipmentAddress(data) {

  cartPage.FH = new FH($, cartPage.shipmentAddressPart.find('fieldset'));

  fetchShipmentFormData(data);
  cartPage.shipmentAddressPart.show();
}

function fetchShipmentFormData(data) {
  sentData = null;
  sentData = {
    action: 'dm_cart_confirmation',
    nonce: data.newNonce,
    cart_action: 'shipping-form',
    
  };

  $.ajax({
    url: dmObject.siteUrl + '/wp-admin/admin-ajax.php',
    type: 'GET',
    data: sentData,
    success: function (res) {
      setNewNonce(res);


      cartPage.FH.init(res.data.address_data.address_form, res.data.address_data.allowed_countries).processFormData(fetchStatesForACountry);
      let cc = res.data.address_data.address_form.shipping_country.value;


    },
    error: function (error) {
      console.warn(error);
    }
  });
}

function changeInCountryHandler(e) {
  let country = $(this).children('option:selected').val();

  fetchStatesForACountry(country, (res) => {

  });
}




function fetchStatesForACountry(country_code) {

  sentData = null;
  sentData = {
    action: 'dm_cart_confirmation',
    nonce: getNewNonce(),
    cart_action: 'states-for-country',
    countryCode: country_code
  };
  return new Promise((resolve, reject) => {
    $.ajax(
      {
        url: dmObject.siteUrl + '/wp-admin/admin-ajax.php',
        type: 'GET',
        data: sentData,
        success: resolve,
        error: reject
      }
    );
  });
}

cartPage.formClickEventListener = function () {
  $(document).on('click', '#cart-confirm-shipment-address-part, #cart-confirm-billing-address-part, #cart-confirm-shipment-rate-part', function (e) {
    let $btn = $(e.target);

    if ($btn.hasClass('go-to-next')) {
      cartPage.handleNextBtnClick(this, e);
    } else if ($btn.hasClass('go-to-prev')) {
      cartPage.handlePrevClick(this, e);
    } else if ($btn.hasClass('go-to-submit')) {
      cartPage.formSubmitClick(this, e);
    }
  });

};

cartPage.handleNextBtnClick = function (el, e) {
  let $this = $(el);
  let id = $this.next().attr('id');
  let ind_selector = 'li[for="' + id + '"]';
  let $ind = $(ind_selector);
  // hide current section
  $ind.hide();
  $this.hide();
  // show next section
  $this.next().show();
};

cartPage.handlePrevClick = function (el, e) {
  debugger;
  let $this = $(el);
  let id = $this.prev().attr('id');
  let ind_selector = 'li[for="' + id + '"]';
  let $ind = $(ind_selector);
  // hide current section
  $ind.hide();
  $this.hide();
  // show previous section
  $this.prev().show();

};

cartPage.formSubmitClick = function () {
  // submit the cart confirmation form
};



//========================================================
cartPage.init = function () {
  cartPage.formClickEventListener();
  cartPage.newNonce = cartObject.nonce;
  console.log('This is the cart page');
  cartPage.accountPart = $('#cart-confirm-account-part').show(); // TODO: change to how
  cartPage.shipmentAddressPart.hide(); // TODO: change to hide 
  cartPage.billingAddressPart.hide();
  cartPage.shipmentRatePart.hide();
};
export default cartPage;