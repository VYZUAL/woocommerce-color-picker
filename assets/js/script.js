jQuery(document).ready(function ($) {
    // Selecteer relevante elementen
    const circles = $('.color-circle');
    const selectInput = $('select[name="attribute_pa_kleur"]');
    const resetButton = $('.elementor-widget-woocommerce-product-add-to-cart .reset_variations');
    const label = $('<div id="selected-color-label"></div>');

    if (selectInput.length) {
        // Verberg dropdown en voeg tekstlabel toe
        selectInput.hide().after(label);
    }

    // Verberg standaard WooCommerce-labels en "Wissen"-knop
    $('label[for="attribute_pa_kleur"]').hide();
    resetButton.hide();

    // Kleurselectie via bolletjes
    circles.on('click', function () {
        const value = $(this).data('value'); // Haal de waarde (slug) van het bolletje op
        selectInput.val(value).trigger('change'); // Stel de waarde in voor WooCommerce

        // Zoek de naam van de geselecteerde optie in de dropdown
        const optionText = selectInput.find(`option[value="${value}"]`).text();
        label.text(optionText); // Toon de termnaam als label

        // Highlight het geselecteerde bolletje
        circles.removeClass('selected');
        $(this).addClass('selected');

        // Toon de "Wissen"-knop
        resetButton.show();
    });

    // Verberg "Wissen"-knop bij reset
    resetButton.on('click', function () {
        label.text(''); // Reset het label
        circles.removeClass('selected');
        selectInput.val('').trigger('change'); // Reset de waarde
        resetButton.hide();
    });
});
