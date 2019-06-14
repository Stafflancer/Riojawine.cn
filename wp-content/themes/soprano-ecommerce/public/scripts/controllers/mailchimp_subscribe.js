/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * Mailchimp subscription ajax form
 ***********************************************/
(function($) {
    'use strict';

    $.ajaxChimp.translations.soprano = {
			'submit': 'Loading, please wait...',
			0: 'We have sent you a confirmation email. Please check your inbox.',
			1: 'The field is empty. Please enter your email.',
			2: 'An email address must contain a single "@" character.',
			3: 'This email seems to be invalid. Please enter a correct one.',
			4: 'This email seems to be invalid. Please enter a correct one.',
			5: 'This email address looks fake or invalid. Please enter a real email address.',
            6: 'is already subscribed to list'
		
    };
	
	$.ajaxChimp.translations.es = {
			'submit': 'Enviando datos, por favor espere...',
			0: 'Te hemos enviado un correo electrónico de confirmación. Por favor revisa tu email.',
			1: 'El campo está vacío. Por favor introduzca su correo electrónico.',
			2: 'Una dirección de correo electrónico debe contener un único carácter "@".',
			3: 'Este correo electrónico parece no ser válido. Por favor, ingrese uno correcto.',
			4: 'Este correo electrónico parece no ser válido. Por favor, ingrese uno correcto.',
			5: 'Esta dirección de correo electrónico parece falsa o no válida. Por favor ingrese una dirección de correo real.',
            6: 'ya está suscrito a la lista'
		
    };
	
	$.ajaxChimp.translations.en = {
			'submit': 'Loading, please wait...',
			0: 'We have sent you a confirmation email. Please check your inbox.',
			1: 'The field is empty. Please enter your email.',
			2: 'An email address must contain a single "@" character.',
			3: 'This email seems to be invalid. Please enter a correct one.',
			4: 'This email seems to be invalid. Please enter a correct one.',
			5: 'This email address looks fake or invalid. Please enter a real email address.',
            6: 'is already subscribed to list'
		
    };

    $('.sp-subscribe-form').each(function () {
        var $form = $(this).closest('form');

        $form.on('submit', function () {
            $form.addClass('mc-loading');
        });

        $form.ajaxChimp({
            language: navigator.language.split('-')[0],
            label   : $form.find('> .form-output'),
            callback: function (resp) {
                $form.removeClass('mc-loading');
                $form.toggleClass('mc-valid', (resp.result === 'success'));
                $form.toggleClass('mc-invalid', (resp.result === 'error'));

                if (resp.result === 'success') {
                    $form.find('input[type="email"]').val('');
                }

                setTimeout(function () {
                    $form.removeClass('mc-valid mc-invalid');
                    $form.find('input[type="email"]').focus();
                }, 4500);
            }
        });
    });

})(jQuery);