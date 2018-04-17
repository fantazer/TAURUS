$(document).ready(function() {
    $('#submit-callback-form').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        var modalWindow = $('#callback-form');

        if (!modalWindow.hasClass('loading')) {
            modalWindow.addClass('loading');
            modalWindow.find('input').attr('disabled', 'disabled');
			
            $.post({
                url: $('#callback-url').val(),
                data: {
                    _csrf: $('meta[name="csrf-token"]').attr("content"),
                    "ContactForm[name]": $('#callback-name').val(),
                    "ContactForm[contactString]": $('#callback-phone').val(),
					"ContactForm[message]": $('#callback-message').val()
                },
                success: function(data) {
                    var form = $('#callback-form');
                    modalWindow.removeClass('loading')

                    if (data.error === true) {
                        $('#callback-form').find('.error-message').text(data.message);
                        modalWindow.find('input').removeAttr('disabled');
                    } else {
                        form.find('.error-message').remove();
                        form.find('input').remove();
						form.find('textarea').remove();
                        form.find('.success-message').text(data.message);
                        modalWindow.addClass('success-send');
                    }

                }
            });
        }
    })
});
