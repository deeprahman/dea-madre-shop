import jQuery from 'jquery';
import { ShopProducts as sp } from "./product-data.js";


//===========================================================================================

jQuery(function ($) {
    "use strict";
    let wineData = [], beverageData = [];
    function theDivider(data) {
        data.forEach((datum) => {

            if (datum.productCatNames.includes('Wine')) {
                wineData.push(productObject(datum));
            } else if (datum.productCatNames.includes('Beverage')) {
                beverageData.push(productObject(datum));
            }
        });
    }

    function productObject(datum) {
        return {
            imgSrc: datum.productImage,
            productLink: datum.productLink,
            productName: datum.productName,
            price: datum.productPrice,
            currency: '&euro;'
        }
    }

    function writeProductData() {
        
        const sp1 = new sp('products-wine-on-large-devices', wineData);
        sp1.init();


        const sp2 = new sp('products-beverage-on-large-devices', beverageData);
        sp2.init();
    }

    if (typeof shopObject === 'object') {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'GET',
            data: {
                action: 'shop_data',
                nonce: shopObject.nonce
            },
            success: function (res) {

                theDivider(res.data);
                writeProductData();
            },
            error: function (error) {
                console.log(error);
            }
        });
    } else {
        console.log('The shop Object is not defined');
    }
});
