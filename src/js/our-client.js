import client_ca from "../images/clients/ca-640w.webp";
import client_daroma from "../images/clients/daroma-640w.webp";
import client_ariosa from "../images/clients/l-ariosa-640w.webp";
import client_lucolbu from "../images/clients/lucolbu-640w.webp";
import client_marduk from "../images/clients/marduk-640w.webp";
import client_mogoro from "../images/clients/mogoro-640w.webp";
import client_palombini from "../images/clients/palombini-640w.webp";
import client_puggioni from "../images/clients/puggioni-640w.webp";
import client_rau from "../images/clients/rau-640w.webp";

console.log(client_ca);

const oc = Object.create(null);

oc.imgPaths = [
    client_ca, client_daroma, client_ariosa, client_lucolbu, client_marduk, client_mogoro, client_palombini, client_puggioni, client_rau
];
oc.section = document.querySelector("#our-clients");

oc.imageEls = oc.section.querySelectorAll('img');

oc.setImgSrcAttr = function (els) {
    console.log(els);
   this.imgPaths.forEach((val,key)=>{
     els[key].setAttribute("src", val);
   });
    
};


oc.init = function () {
    this.setImgSrcAttr(this.imageEls);
};

export default oc;

