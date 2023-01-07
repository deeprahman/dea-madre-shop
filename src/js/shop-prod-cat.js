import beverage_img from "../images/hero-carosel/birre_GettyImages-566272557-1920w.jpg";

import wines_img from "../images/hero-carosel/vini_GettyImages-534940776-1920w.jpg";

import cafeteria_img from "../images/hero-carosel/caffee_GettyImages-580676691-1920w.jpg";
/**
 * Sets background image to the elements with the pattern class;
 */
const prodCat = Object.create(null);

prodCat.imgBev = document.querySelectorAll(".procudt-cats__beverage img");
prodCat.imgWines = document.querySelectorAll(".procudt-cats__wines img");
console.log("Product cat js file");
prodCat.imgCafe = document.querySelectorAll(".procudt-cats__cafeteria img");
if(prodCat.imgBev !== null && prodCat.imgWines !== null &&prodCat.imgWines !== null){

    prodCat.setImages = function(els, img_src){
        for(const el of els){
            el.setAttribute('src',img_src);
        }
    };
    
    prodCat.init = function(){
        this.setImages(this.imgBev, beverage_img);
        this.setImages(this.imgWines, wines_img);
        this.setImages(this.imgCafe, cafeteria_img);
    };
}
export default prodCat;

