// global varienGlobalEvents
define([
    'Magento_Ui/js/form/element/abstract',
    'jquery',
    'ko',
    'Iranimij_ProductLabels/js/form/element/rules-form',
    'prototype'
], function (Abstract, $, ko, VarienRulesForm) {
    'use strict';

    return Abstract.extend({
        default: {
            formContent: '',
            elementTmpl: 'Iranimij_ProductLabels/form/element/rule-conditions-chooser',
            newFormChildUrl: '',
            conditionsFormId: 'rule_conditions_fieldset'
        },
        /**
         * @return {string}
         */
        getFormContent: function () {
            return this.formContent;
        },

        /**
         * @return {void}
         */
        initForm: function () {
            window[this.conditionsFormId] = new VarienRulesForm(this.conditionsFormId, this.newFormChildUrl);
            varienGlobalEvents && varienGlobalEvents.attachEventHandler('gridRowClick', this.processRuleFormChange.bind(this));
        },

        /**
         * @return {void}
         */
        processRuleFormChange: function () {
            var formValue = $('#' + this.conditionsFormId).serializeArray(),
                parsedFormValue = this.parseFormValue(formValue);

            this.value(parsedFormValue);
        },

        /**
         * Transform jQuery.serializeArray result to tree like object
         *
         * @param {object} formValue
         * @return {object}
         */
        parseFormValue: function (formValue) {
            var result = {};

            formValue.forEach(function (formPart) {
                var flatKey = formPart['name'],
                    partValue = formPart['value'],
                    keyParts = flatKey.split('[').map(function (rawKeyPart) {
                        return rawKeyPart === ']' ? '[]' : rawKeyPart.replace(/]$/g, '');
                    });

                this.setValue(result, keyParts.reverse(), partValue);
            }.bind(this));

            return result;
        },

        /**
         * Inserts a value into an object at the path specified in the first argument.
         *
         * @example
         *   keysPathParts = ['c', 'b', 'a']
         *   result = {a: {b: {c: value}}}
         *
         * @param {object} object
         * @param keysPathParts
         * @param value
         */
        setValue: function (object, keysPathParts, value) {
            var key,
                nextKey,
                newObject;

            if (keysPathParts.length > 0) {
                key = keysPathParts.pop();

                if (keysPathParts.length === 0) {
                    // eslint-disable-next-line max-depth
                    if (object instanceof Array) {
                        object.push(value);
                    } else {
                        object[key] = value;
                    }
                } else {
                    nextKey = keysPathParts.pop();
                    newObject = nextKey === '[]' ? [] : {};

                    newObject = object[key] || newObject;
                    keysPathParts.push(nextKey);
                    object[key] = newObject;
                    this.setValue(newObject, keysPathParts, value);
                }
            }
        }
    });
}); 