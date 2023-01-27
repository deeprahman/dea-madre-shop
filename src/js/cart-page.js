import jQuery from 'jquery';

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
      console.log(res);
    },
    error: function (error) {
      console.log(error);
    }
  });
}

export default cartPage;