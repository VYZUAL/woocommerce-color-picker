<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WCCP_Admin {

    public static function init() {
        add_action( 'pa_kleur_add_form_fields', [ __CLASS__, 'add_color_picker_field' ] );
        add_action( 'pa_kleur_edit_form_fields', [ __CLASS__, 'edit_color_picker_field' ] );
        add_action( 'created_pa_kleur', [ __CLASS__, 'save_color_picker_field' ] );
        add_action( 'edited_pa_kleur', [ __CLASS__, 'save_color_picker_field' ] );
    }

    public static function add_color_picker_field() { ?>
        <div class="form-field">
            <label for="term_color"><?php esc_html_e( 'Color', 'woocommerce-color-picker' ); ?></label>
            <input type="color" name="term_color" id="term_color" value="#ffffff">
            <p><?php esc_html_e( 'Select a color for this attribute.', 'woocommerce-color-picker' ); ?></p>
        </div>
    <?php }

    public static function edit_color_picker_field( $term ) {
        $color = get_term_meta( $term->term_id, 'term_color', true ); ?>
        <tr class="form-field">
            <th><label for="term_color"><?php esc_html_e( 'Color', 'woocommerce-color-picker' ); ?></label></th>
            <td>
                <input type="color" name="term_color" id="term_color" value="<?php echo esc_attr( $color ?: '#ffffff' ); ?>">
            </td>
        </tr>
    <?php }

    public static function save_color_picker_field( $term_id ) {
        if ( isset( $_POST['term_color'] ) ) {
            update_term_meta( $term_id, 'term_color', sanitize_hex_color( $_POST['term_color'] ) );
        }
    }
}
