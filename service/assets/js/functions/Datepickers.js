import {Datepicker} from "vanillajs-datepicker";

class Datetricker extends Datepicker {
    constructor(element, options = {}) {
        const originalType = element.type;
        const dateInput = element.cloneNode(true);
        dateInput.removeAttribute('name');

        if (element.value) {
            dateInput.value = Datepicker.formatDate(
                new Date(`${element.value}T00:00:00`), // not to be parsed as UTC date, add time w/o 'Z'
                options.format || 'mm/dd/yyyy'
            );
        }
        element.type = 'hidden';
        element.after(dateInput);
        super(dateInput, options);
        this.originalElement = element;
        this.originalElementType = originalType;

        dateInput.addEventListener('changeDate', () => {
            element.value = this.getDate('yyyy-mm-dd') || '';
        });
    }

    destroy() {
        super.destroy();
        this.element.remove();
        this.originalElement.type = this.originalElementType;
        return this;
    }
}

export class Datepickers {
    constructor(element) {
        let targets = [...element.querySelectorAll('[data-behaviour="datepicker"]')];
        let settings = {
            autohide: true,
            buttonClass: 'btn',
            format: 'dd/mm/yyyy'
        }
        targets.forEach((datepickerElem) => {
            let customSettings = {...settings, ...JSON.parse(datepickerElem.dataset?.options ?? '{}')}
            new Datetricker(datepickerElem, customSettings);
        });
    }
}
