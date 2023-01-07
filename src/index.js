"use strict";
import page from './js/get-page-name.js';
import { generateProductData, productWine, productsBeverage } from "./js/dummy-data.js";
// Test import of a JavaScript module
import { bootstrap } from 'bootstrap';
import './js/multilevel-nav.js';
import oc from './js/our-client.js';
import pat from './js/pattern.js';
import prodCat from './js/shop-prod-cat.js';
import { ShopProducts as sp } from "./js/product-data.js";




if (page.pageName === 'home') {
    oc.init();
    pat.init();
} else if (page.pageName === 'shop') {

    pat.init();// Initialize pattern

    prodCat.init(); // Initialize the product category

    const wineData = generateProductData(productWine);
    const sp1 = new sp('products-wine-on-small-devices', wineData);
    sp1.init(false);

    const beverageData = generateProductData(productsBeverage);
    const sp2 = new sp('products-beverage-on-large-devices', beverageData);
    sp2.init();

}












