import jQuery from 'jquery';
import { HandleWooMessage as HM } from "./woo-notice-handler.js"
import { AlertDisplay as AD } from './alert-display';

if ('undefined' === typeof $) {
  var $ = jQuery;
}
let sentData = Object.create(null);
const cartPage = Object.create(null);



cartPage.accountPart = $('#cart-confirm-account-part');
cartPage.shipmentAddressPart = $('#cart-confirm-shipment-address-part');
cartPage.billingAddressPart = $('#cart-confirm-billing-address-part');
cartPage.shipmentRatePart = $('#cart-confirm-shipment-rate-part');



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
      processSuccess(res);
    },
    error: function (error) {
      console.log(error);
    }
  });
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
    nonce: cartObject.nonce
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
  cartPage.shipmentAddressPart.show();
  fetchShipmentFormData(data);
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
      console.log(res);
    },
    error: function (error) {
      console.warning(error);
    }
  });
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