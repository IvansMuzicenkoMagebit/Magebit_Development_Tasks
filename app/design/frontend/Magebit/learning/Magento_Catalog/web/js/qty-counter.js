define([
    'ko',
    'uiElement'
], function (ko, Element) {
    return Element.extend({
        defaults: {
            template: 'Magento_Catalog/input-counter'
        },

        /**
         * Observable quantity paramater initialization
         * @return Object
         */
        initObservable: function () {
            this._super().observe('qty');

            return this;
        },

        /**
         * Data validation function
         * @return JSON string
         */
        getDataValidator: function() {
            return JSON.stringify(this.dataValidate);
        },

        /**
         * Quantity decrease function
         * @return void
         */
        decreaseQty: function() {
            let qty;

            this.qty() > 1 ? qty = this.qty() - 1 : qty = 1

            this.qty(qty);
        },

        /**
         * Quantity increase function
         * @return void
         */
        increaseQty: function() {
            let qty = this.qty() + 1;

            this.qty(qty);
        }
    });
});
