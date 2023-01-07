"use strict";



export class ShopProducts {
    constructor(css_class, data) {
        this.productContainer = document.getElementsByClassName(css_class)[0];
        this.productData = data;
        this.rowOpen = `<div class="row row-cols-4 my-3 g-3">`;
        this.rowClose = `</div>`;
    }

    init(forLarge = 1) {
        if (forLarge) {
            let data = this.makeProductHtmlLargeDevices(this.productData);
            this.writeProductData(data);
        } else {

            let data = this.makeProductHtmlSmallDevices(this.productData);
            this.writeProductData(data);
        }
    }

    getProductTemplate(data) {
        return `
        <div class="col">
                    <div class="product-container d-flex flex-column align-items-center">
                        <div class="product-img">
                            <a href="${data.productLink}">
                                <picture>
                                    <img class="img-fluid" src="${data.imgSrc}" alt="${data.productName}">
                                </picture>
                            </a>
                        </div>
                        <div class="product-name text-center">
                            <span class="fs-5 fw-bold text-wrap">${data.productName}</span>
                        </div>
                        <div class="product-price my-1">
                            <span>${data.price}</span>
                            <span>${data.currency}</span>
                            <span class="currency-sign">&euro;</span>
                        </div>
                        <div class="product-button my-1">
                            <a href="${data.productLink}" class="btn btn-outline-secondary btn-lg rounded-pill px-5 fw-bold">Buy Now</a>
                        </div>
                    </div>
                </div>
        `;
    }



    writeProductData(data) {
        this.productContainer.getElementsByClassName('container-fluid')[0].innerHTML = data;
    }



    /**
     * Creates Product HTML
     * @param {Object[]} productData 
     * @return string Product Html
     */

    makeProductHtmlLargeDevices(productData) {
        let isClosed = false;
        let indicator = 1;
        let isFirstRow = true;
        let openRowTag;
        let data = productData.reduce((accumulator, currentValue, index) => {

            if (indicator > 4) {
                indicator = 1;
            }

            let productHTML = this.getProductTemplate(currentValue);
            if (indicator == 1) {
                let openRowTag = (isFirstRow) ? this.rowOpen : `<div class="row row-cols-4 my-3 g-3 d-none">`;
                isFirstRow = false;
                productHTML = openRowTag + productHTML;
            }


            if (indicator == 4) {
                productHTML += this.rowClose;
            }

            indicator++;

            return accumulator + productHTML;
        }, '');

        if (!isClosed) {
            data += this.rowClose;
        }
        return data;
    }

    /**
 * Creates Product HTML
 * @param {Object[]} productData 
 * @return string Product Html
 */

    makeProductHtmlSmallDevices(productData) {
        let isClosed = false;
        let indicator = 1;
        let isFirstRow = true;
        let openRowTag;
        let data = productData.reduce((accumulator, currentValue, index) => {

            if (indicator > 1) {
                indicator = 1;
            }

            let productHTML = this.getProductTemplate(currentValue);
            if (indicator == 1) {
                let openRowTag = (isFirstRow) ? `<div class="row row-cols-1 my-3 g-3 ">` : `<div class="row row-cols-1 my-3 g-3 d-none">`;
                isFirstRow = false;
                productHTML = openRowTag + productHTML;
            }


            if (indicator == 1) {
                productHTML += this.rowClose;
            }

            indicator++;

            return accumulator + productHTML;
        }, '');

        if (!isClosed) {
            data += this.rowClose;
        }
        return data;
    }
}

