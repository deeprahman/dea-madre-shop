
"use strict";

const meta = document.querySelectorAll('meta[page-name]');

const page = Object.create(null);

page.pageEl = document.querySelectorAll('meta[page-name]');
page.pageName = page.pageEl[0].getAttribute('page-name');

export default page;




