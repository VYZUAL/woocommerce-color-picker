<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WCCP_Frontend {

    /**
     * Initialize the frontend functionality.
     */
    public static function init() {
        add_action( 'woocommerce_before_add_to_cart_form', [ __CLASS__, 'display_color_circles' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_assets' ] );

        // Verberg de "Wissen"-optie via een WooCommerce filter
        add_filter( 'woocommerce_reset_variations_link', '__return_empty_string' );
    }

    /**
     * Display the color circles on the product page.
     */
    public static function display_color_circles() {
        global $product;

        if ( $product->is_type( 'variable' ) ) {
            $attributes = $product->get_variation_attributes();

            if ( isset( $attributes['pa_kleur'] ) ) {
                $terms = get_terms( [ 'taxonomy' => 'pa_kleur', 'hide_empty' => false ] );
                echo '<div id="color-picker" class="product-colors">';
                foreach ( $terms as $term ) {
                    $color = get_term_meta( $term->term_id, 'term_color', true );
                    if ( $color ) {
                        echo '<div class="color-circle" data-value="' . esc_attr( $term->slug ) . '" 
                              style="background-color:' . esc_attr( $color ) . ';"></div>';
                    }
                }
                echo '</div>';
            }
        }
    }

    /**
     * Enqueue the required assets for the frontend.
     */
    public static function enqueue_assets() {
        if ( is_product() ) {
            wp_enqueue_style( 'wccp-styles' );
            wp_enqueue_script( 'wccp-scripts' );
        }
    }
}
