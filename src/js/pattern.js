"user strict";
/**
 * Sets background image to the elements with the pattern class;
 */
import pattern from '../images/patterns/BG_DEA_MADRE-1920w.png';

const pat = Object.create(null);

pat.els = document.querySelectorAll('.pattern');

pat.setBackgroundImageStyle = function(els){

    for(const el of els){
        el.style.backgroundImage = `url("${pattern}")`;
    }
};

pat.init = function(){
    this.setBackgroundImageStyle(this.els);

};

export default pat;