'use strict';

const productsBeverage = {
    imgSrc: 'https://wp.localhost/wp-content/uploads/2023/01/3092808152.jpg',
    productLink: '#',
    productName: 'Gin Genesi 42° cl.70',
    price: '29,99',
    currency: '&euro;'
};

const productWine = {
    imgSrc: 'https://wp.localhost/wp-content/uploads/2023/01/3059089658.jpg',
    productLink: '#',
    productName: "Cabernet Sauvignon Doc Venezia Ca' di Rajo l.0,75",
    price: '9,90',
    currency: '&euro;'
};

let generateProductData = function (initialData) {
    let data = [];
    for (let i = 0; i <= 19; i++) {
        data.push(initialData);
    }
    return data;
};

export { generateProductData, productWine, productsBeverage };