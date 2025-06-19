define([
    'jquery',
    'mage/translate',
    'jquery/validate'
], function ($) {
    'use strict';

    return function (config) {
        $.validator.addMethod(
            'amlabel-validate-percent-or-number',
            function (value) {
                return /^(?:100|[0-9]{1,2})[%]?$/.test(value);
            },
            $.mage.__('Value can be only integer number or percent.')
        );

        $.validator.addMethod(
            'validate-hex-color',
            function (value) {
                return /^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/i.test(value);
            },
            $.mage.__('Field must have valid hex color code.')
        );

        $.validator.addMethod(
            'validate-css-text-size-directive',
            function (value) {
                return /^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/i.test(value);
            },
            $.mage.__('Field must have valid hex color code.')
        );

        return config;
    };
}); 