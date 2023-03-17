jQuery( window ).on('elementor/frontend/init', () => {
    if (elementorFrontend.isEditMode()) {
        elementorFrontend.hooks.addAction('frontend/element_ready/ohio_dynamic_text.default', ( $element ) => {
            jQuery(window).trigger('ohio:handle_ohio_dynamic_text');
        });
    }
});