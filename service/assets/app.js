import "./styles/app.scss";
import TomSelect from "tom-select";
require("bootstrap");

console.log("LOADED!!!")

let targets = document.querySelectorAll('[data-behaviour="advanced-select"]');
if(targets.length > 0) {
    targets.forEach((advancedSelectElem) => {
        let settings = {
            plugins: {
                remove_button:{
                    title:'Remove this item',
                }
            },
            persist: false,
            createOnBlur: true,
            create: advancedSelectElem.dataset.allowAdd,
            loadingClass: 'select-loading',
            placeholder: advancedSelectElem.dataset.placeholder ? advancedSelectElem.dataset.placeholder : ''
        }
        if(advancedSelectElem.dataset.maxItems >= 1) {
            settings.maxItems = advancedSelectElem.dataset.maxItems
        }
        new TomSelect(advancedSelectElem, settings);
    });
}
