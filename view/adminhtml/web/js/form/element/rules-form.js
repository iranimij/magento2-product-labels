define([
    'jquery',
    'Magento_Rule/rules',
    'prototype'
], function (jQuery, Rules) {
    'use strict';

    /**
     * @param {string} formId
     * @param {string} childUrl
     */
    function VarienRulesForm(formId, childUrl) {
        this.formId = formId;
        this.childUrl = childUrl;
        this.newChildUrl = this.getNewChildUrl();
    }

    /**
     * @return {string}
     */
    VarienRulesForm.prototype.getNewChildUrl = function () {
        return this.childUrl + '?form=' + this.formId;
    };

    /**
     * @param {string} newUrl
     */
    VarienRulesForm.prototype.setNewChildUrl = function (newUrl) {
        this.childUrl = newUrl;
        this.newChildUrl = this.getNewChildUrl();
    };

    VarienRulesForm.prototype = Class.create(Rules, {
        /**
         * @param {Function} $super
         * @param {Element} container
         * @param {Event} event
         * @return {void}
         */
        removeRuleEntry: function ($super, container, event) {
            $super(container, event);
            this.getCurrentForm().trigger('change');
        },

        /**
         * @param {Function} $super
         * @param {Element} container
         * @param {Event} event
         * @return {void}
         */
        showParamInputField: function ($super, container, event) {
            var result = $super(container, event);

            if (result !== false) {
                this.getCurrentForm().trigger('change');
            }
        },

        /**
         * @param {Function} $super
         * @param {Element} chooser
         * @return {void}
         */
        showChooserElement: function ($super, chooser) {
            $super(chooser);

            jQuery(chooser).on('click', () => {
                this.getCurrentForm().trigger('change');
            });
        },

        /**
         * @return {jQuery}
         */
        getCurrentForm: function () {
            return jQuery(this.parent);
        }
    });

    return VarienRulesForm;
}); 