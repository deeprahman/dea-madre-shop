"use strict";
import { bootstrap } from 'bootstrap';
import page from './js/get-page-name.js';
import "./js/fetch-shop-products.js";
// Test import of a JavaScript module
import './js/multilevel-nav.js';
import oc from './js/our-client.js';
import pat from './js/pattern.js';
import prodCat from './js/shop-prod-cat.js';
import { ShopProducts as sp } from "./js/product-data.js";
import  cartPage  from './js/cart-page.js';






switch (dmObject.pageName) {
    case 'shop':
        pat.init();// Initialize pattern image
        prodCat.init(); // Initialize the product category
        break;
    case 'cart':
        cartPage.init();
        break;
    default:
        oc.init();
        pat.init();
}












