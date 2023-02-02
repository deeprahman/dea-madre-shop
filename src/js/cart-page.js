import jQuery from 'jquery';
import { HandleWooMessage as HM } from "./woo-notice-handler.js"
import { AlertDisplay as AD } from './alert-display';

if ('undefined' === typeof $) {
  var $ = jQuery;
}
let sentData = Object.create(null);
const cartPage = Object.create(null);

cartPage.init = function () {
  console.log('This is the cart page');
};
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
  }
  let h = new HM();
  h.process(messageObj);
}

export default cartPage;