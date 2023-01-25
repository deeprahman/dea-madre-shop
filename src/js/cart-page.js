import jQuery from 'jquery';

if ( 'undefined' === typeof $){
  var  $ = jQuery;
}

const cartPage = Object.create(null);

cartPage.init = function(){
    console.log('This is the cart page');
};

cartPage.checkBtn = $('#checkout-btn');
cartPage.saleCondChkBox = $('#acceptSellsTerms');

export default cartPage;