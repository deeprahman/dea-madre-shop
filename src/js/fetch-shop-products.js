import jQuery from 'jquery';
import { ShopProducts as sp } from "./product-data.js";
import page from './get-page-name.js';
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



        instantiateClassAccordingToDeviceWith(
            'products-wine-on-large-devices',
            'products-wine-on-small-devices',
            wineData,
            "btn-wine"
        );

        instantiateClassAccordingToDeviceWith(
            'products-beverage-on-large-devices',
            'products-beverage-on-small-devices',
            beverageData,
            "btn-beverage"
        );


    }

    function instantiateClassAccordingToDeviceWith(css_class_lg, css_class_sm, data, btn_id) {
        if (window.matchMedia("(max-width: 1200px)").matches) {
            // No large devices
            (new sp(css_class_sm, data)).init(false);
            showMoreButton(css_class_sm, btn_id);

        } else {
            // Large devices
            (new sp(css_class_lg, data)).init();
            showMoreButton(css_class_lg, btn_id);
        }
    }

    function showMoreButton(css_class_name, btn_id) {

        $("#" + btn_id).on('click', function (e) {
            e.preventDefault();
            $("." + this.class_name + " ." + 'd-none').each(function(){
                $(this).removeClass("d-none");
                $(this).addClass("d-block");
            });
        }.bind({ class_name: css_class_name }));
    }

    if (typeof shopObject === 'object' && page.pageName === 'Shop') {
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
