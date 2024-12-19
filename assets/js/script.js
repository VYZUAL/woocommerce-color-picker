jQuery(document).ready(function ($) {
    const circles = $('.color-circle');
    const selectInput = $('select[name="attribute_pa_kleur"]');
    const label = $('<div id="selected-color-label"></div>');

    if (selectInput.length) {
        selectInput.hide().after(label);
    }

    circles.on('click', function () {
        const value = $(this).data('value');
        selectInput.val(value).trigger('change');
        label.text('Selected color: ' + value);
        circles.removeClass('selected');
        $(this).addClass('selected');
    });
});
