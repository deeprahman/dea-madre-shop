import jQuery from 'jquery';
import {AlertDisplay as AD } from './alert-display';

if ('undefined' === typeof $) {
  var $ = jQuery;
}

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
    console.log('Shop button is not checked');
  }
});

function proceedToCheckout() {
  $.ajax({
    url: dmObject.siteUrl + '/wp-admin/admin-ajax.php',
    type: 'GET',
    data: {
      action: 'dm_cart_confirmation',
      nonce: cartObject.nonce
    },
    success: function (res) {
      processSuccess(res);
    },
    error: function (error) {
      console.log(error);
    }
  });
}


function processSuccess(messageObj){
  if(messageObj.data === 'undefined'){
    return;
  }
  let alert = new AD();
    if(! messageObj.data.cartShipmentOk){
      alert.showAlert('Warning', "Shipment details is not configured");
    }
    if(! messageObj.data.isLoggedIn){
      alert.showAlert('Warning', "User is not logged in");
    }
}

export default cartPage;