import jQuery from 'jquery';
import { HandleWooMessage as HM } from "./woo-notice-handler.js"
import { AlertDisplay as AD } from './alert-display';
import { CartPageFormHandler as FH }  from "./cart-page-form-handler.js";


if ('undefined' === typeof $) {
  var $ = jQuery;
}
let sentData = Object.create(null);
const cartPage = Object.create(null);

cartPage.newNonce = cartObject.nonce;

cartPage.accountPart = $('#cart-confirm-account-part');
cartPage.shipmentAddressPart = $('#cart-confirm-shipment-address-part');
cartPage.billingAddressPart = $('#cart-confirm-billing-address-part');
cartPage.shipmentRatePart = $('#cart-confirm-shipment-rate-part');

cartPage.formHandler = null;


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
      console.log(res);
      setNewNonce(res);
      processSuccess(res);
    },
    error: function (error) {
      console.warn(error);
    }
  });
}

function setNewNonce(obj){
  cartPage.newNonce = obj.data.newNonce || (console.log('No New Nonce returned'));
}

function getNewNonce(){
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
    console.log('Account validated');
    cartPage.accountPart.hide();
    showShipmentAddress(messageObj.data);
    return;
  }
  let h = new HM();
  h.process(messageObj);
}

function showShipmentAddress(data) {
  cartPage.FH = new FH($,cartPage.shipmentAddressPart.find('form'));

  fetchShipmentFormData(data);
  cartPage.shipmentAddressPart.show();
}

function fetchShipmentFormData(data) {
  sentData = null;
  sentData = {
    action: 'dm_cart_confirmation',
    nonce: data.newNonce,
    cart_action: 'shipping-form'
  };

  $.ajax({
    url: dmObject.siteUrl + '/wp-admin/admin-ajax.php',
    type: 'GET',
    data: sentData,
    success: function (res) {
      setNewNonce(res);
      console.log(res );

      cartPage.FH.init(res.data.address_data.address_form, res.data.allowed_countries).processFormData();
      cartPage.shipmentAddressPart.show();
    },
    error: function (error) {
      console.warn(error);
    }
  });
}

function changeInCountryHandler(e) {
  let country = $(this).children('option:selected').val();
  console.log('The selected country: ' + country);
  fetchStatesForACountry(country,(res)=>{
    console.log("State Updated", res);
  });
}



function fetchStatesForACountry(country_code, handler) {
  sentData = null;
  sentData = {
    action: 'dm_cart_confirmation',
    nonce: getNewNonce(),
    cart_action: 'states-for-country',
    countryCode: country_code
  };
  $.ajax(
    {
       url: dmObject.siteUrl + '/wp-admin/admin-ajax.php',
       type: 'GET',
       data: sentData,
       success: function(res){
        setNewNonce(res);
        console.log(res);
        handler(res);
       },
       error:function(error){
        console.warn(error.responseText);
       }
    }
  );
}

//========================================================
cartPage.init = function () {

  console.log('This is the cart page');
  cartPage.accountPart = $('#cart-confirm-account-part').show(); // TODO: change to how
  cartPage.shipmentAddressPart.hide(); // TODO: change to hide 
  cartPage.billingAddressPart.hide();
  cartPage.shipmentRatePart.hide();
};
export default cartPage;