<?php
if (function_exists("register_field_group")) {
  register_field_group(array(
    'id' => 'acf_coming-soom-settings',
    'title' => esc_html__('Coming Soom Settings', 'plaxer'),
    'fields' => array(
      array(
        'key' => 'field_59bfb14f288cf',
        'label' => esc_html__('Date', 'plaxer'),
        'name' => 'date',
        'type' => 'date_picker',
        'date_format' => 'yy/mm/dd',
        'display_format' => 'dd/mm/yy',
        'first_day' => 1,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'page-coming-soon.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array(
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array(
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array(
    'id' => 'acf_page-settings',
    'title' => esc_html__('Page Settings', 'plaxer'),
    'fields' => array(
      array(
        'key' => 'field_58a43bba66153',
        'label' => esc_html__('Header Color Mode', 'plaxer'),
        'name' => 'header_color_mode',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'light' => esc_html__('Light', 'plaxer'),
          'dark' => esc_html__('Dark', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
        'instructions' => wp_kses(__('<b>Light</b> - White text color & Dark background color<br><b>Dark</b> - Black text color & Light background color', 'plaxer'), 'post'),
      ),
      array(
        'key' => 'field_58a43a8166152',
        'label' => esc_html__('Header Style', 'plaxer'),
        'name' => 'header_style',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'logo-left' => esc_html__('Logo on Left', 'plaxer'),
          'logo-center' => esc_html__('Logo on Center', 'plaxer'),
          'logo-right' => esc_html__('Logo on Right', 'plaxer'),
          'side' => esc_html__('Side', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_58a59207966df7e',
        'label' => esc_html__('Navigation Type', 'plaxer'),
        'name' => 'navigation_type',
        'type' => 'select',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
          ),
          'allorany' => 'all',
        ),
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'disabled' => esc_html__('Disabled', 'plaxer'),
          'hidden_menu' => esc_html__('Hidden', 'plaxer'),
          'visible_menu' => esc_html__('Visible', 'plaxer'),
          'fullscreen' => esc_html__('Fullscreen', 'plaxer'),
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_58a592079667e',
        'label' => esc_html__('Navigation hover style', 'plaxer'),
        'name' => 'navigation_item_hover_style',
        'type' => 'select',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
          ),
          'allorany' => 'all',
        ),
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'style1' => esc_html__('Style 1', 'plaxer'),
          'style2' => esc_html__('Style 2', 'plaxer'),
          'style3' => esc_html__('Style 3', 'plaxer'),
          'style4' => esc_html__('Style 4', 'plaxer'),
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_58a58ef19684e',
        'label' => esc_html__('Header Container', 'plaxer'),
        'name' => 'header_container',
        'type' => 'select',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side-type2',
            ),
          ),
          'allorany' => 'all',
        ),
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'container' => esc_html__('Center container', 'plaxer'),
          'container-fluid' => esc_html__('Full witdh', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_74884d42cdf6',
        'label' => esc_html__('Cart', 'plaxer'),
        'name' => 'header_cart',
        'type' => 'select',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side-type2',
            ),
          ),
          'allorany' => 'all',
        ),
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'true' => esc_html__('Show', 'plaxer'),
          'false' => esc_html__('Hide', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_513fb3c9c826',
        'label' => esc_html__('Search', 'plaxer'),
        'name' => 'header_search',
        'type' => 'select',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side-type2',
            ),
          ),
          'allorany' => 'all',
        ),
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'true' => esc_html__('Show', 'plaxer'),
          'false' => esc_html__('Hide', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_58a43c2266154',
        'label' => esc_html__('Header Space', 'plaxer'),
        'name' => 'header_space',
        'type' => 'radio',
        'choices' => array(
          'true' => esc_html__('Yes', 'plaxer'),
          'false' => esc_html__('No', 'plaxer'),
        ),
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side-type2',
            ),
          ),
          'allorany' => 'all',
        ),
        'other_choice' => 0,
        'save_other_choice' => 0,
        'default_value' => 'true',
        'layout' => 'horizontal',
      ),
      array(
        'key' => 'field_58a45add62c81',
        'label' => esc_html__('Footer', 'plaxer'),
        'name' => 'footer',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'true' => esc_html__('Show', 'plaxer'),
          'false' => esc_html__('Hide', 'plaxer'),
          'minified' => esc_html__('Minified', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_2daefa50b0d2',
        'label' => esc_html__('Sidebar Button', 'plaxer'),
        'name' => 'sidebar_button',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'disable' => esc_html__('Disable', 'plaxer'),
          'side' => esc_html__('On Side', 'plaxer'),
        ),
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side',
            ),
            array(
              'field' => 'field_58a43a8166152',
              'operator' => '!=',
              'value' => 'side-type2',
            ),
          ),
          'allorany' => 'all',
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'template-landing.php',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array(
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array(
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array(
    'id' => 'acf_project-bottom-settings',
    'title' => esc_html__('Project Settings', 'plaxer'),
    'fields' => array(
      array(
        'key' => 'field_423ds2345qw',
        'label' => esc_html__('Short Description', 'plaxer'),
        'name' => 'project_short_desc',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'fw-portfolio',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array(
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array(
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array(
    'id' => 'acf_project-settings',
    'title' => esc_html__('Additional Settings', 'plaxer'),
    'fields' => array(
      array(
        'key' => 'field_59c3a84023b44',
        'label' => esc_html__('Featured Image', 'plaxer'),
        'name' => 'project_image',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'cover' => esc_html__('Cover', 'plaxer'),
          'original' => esc_html__('Original', 'plaxer'),
          'disabled' => esc_html__('Disabled', 'plaxer'),
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_44701ae980b8',
        'label' => esc_html__('Game', 'plaxer'),
        'name' => 'project_game',
        'type' => 'select',
        'choices' => array(
          "" => esc_html__("Select", "plaxer"),
          "Battlefield" => esc_html__("Battlefield", "plaxer"),
          "Battlefield 1" => esc_html__("Battlefield 1", "plaxer"),
          "CS GO" => esc_html__("CS GO", "plaxer"),
          "Dota 2" => esc_html__("Dota 2", "plaxer"),
          "FIFA" => esc_html__("FIFA", "plaxer"),
          "Fortnite" => esc_html__("Fortnite", "plaxer"),
          "Halo" => esc_html__("Halo", "plaxer"),
          "Hearthstone" => esc_html__("Hearthstone", "plaxer"),
          "Mortal Kombat" => esc_html__("Mortal Kombat", "plaxer"),
          "Overwatch" => esc_html__("Overwatch", "plaxer"),
          "Pubg" => esc_html__("Pubg", "plaxer"),
          "Rainbow 6 Siege" => esc_html__("Rainbow 6 Siege", "plaxer"),
          "The Division" => esc_html__("The Division", "plaxer"),
          "World Of Tanks" => esc_html__("World Of Tanks", "plaxer"),
          "World Of Warcraft" => esc_html__("World Of Warcraft", "plaxer"),
          "World Of Warships" => esc_html__("World Of Warships", "plaxer"),
          "other" => esc_html__("Other", "plaxer"),
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_4f135a34ba84',
        'label' => esc_html__('Game Name', 'plaxer'),
        'name' => 'project_game_name',
        'type' => 'text',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_44701ae980b8',
              'operator' => '==',
              'value' => 'other',
            ),
          ),
          'allorany' => 'any',
        ),
      ),
      array(
        'key' => 'field_4f135a34ba84',
        'label' => esc_html__('Game Logo', 'plaxer'),
        'name' => 'project_game_logo',
        'type' => 'image',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_44701ae980b8',
              'operator' => '==',
              'value' => 'other',
            ),
          ),
          'allorany' => 'any',
        ),
      ),
      array(
        'key' => 'field_645dsf53532',
        'label' => esc_html__('Video Sourse', 'plaxer'),
        'name' => 'project_video_sourse',
        'type' => 'select',
        'choices' => array(
          'none' => esc_html__('None', 'plaxer'),
          'external-url' => esc_html__('YouTube, Vimeo or MP4 Url', 'plaxer'),
          'media' => esc_html__('Media Library', 'plaxer'),
        ),
        'default_value' => 'none',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_585653976745',
        'label' => esc_html__('Video url', 'plaxer'),
        'name' => 'project_video_url',
        'type' => 'text',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_645dsf53532',
              'operator' => '==',
              'value' => 'external-url',
            ),
          ),
          'allorany' => 'any',
        ),
      ),
      array(
        'key' => 'field_678455763547',
        'label' => esc_html__('Video', 'plaxer'),
        'name' => 'project_video_media',
        'type' => 'file',
        'mime_types' => 'mp4',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_645dsf53532',
              'operator' => '==',
              'value' => 'media',
            ),
          ),
          'allorany' => 'any',
        ),
      ),
      array(
        'key' => 'field_59c0c83cdb361',
        'label' => esc_html__('Style', 'plaxer'),
        'name' => 'project_style',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'grid' => esc_html__('Grid', 'plaxer'),
          'masonry' => esc_html__('Masonry', 'plaxer'),
          'packery' => esc_html__('Packery', 'plaxer'),
          'slider' => esc_html__('Slider', 'plaxer'),
        ),
        'default_value' => 'default',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_59c0c83nlg94',
        'label' => esc_html__('Cols count', 'plaxer'),
        'name' => 'project_count_cols',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          '1' => esc_html__('1', 'plaxer'),
          '2' => esc_html__('2', 'plaxer'),
          '3' => esc_html__('3', 'plaxer'),
          '4' => esc_html__('4', 'plaxer'),
        ),
        'default_value' => 'default',
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_59c0c83cdb361',
              'operator' => '==',
              'value' => 'grid',
            ),
            array(
              'field' => 'field_59c0c83cdb361',
              'operator' => '==',
              'value' => 'masonry',
            ),
            array(
              'field' => 'field_59c0c83cdb361',
              'operator' => '==',
              'value' => 'packery',
            ),
          ),
          'allorany' => 'any',
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'fw-portfolio',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array(
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array(
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array(
    'id' => 'acf_post-settings',
    'title' => esc_html__('Post Settings', 'plaxer'),
    'fields' => array(
      array(
        'key' => 'field_5a267b326916ab',
        'label' => esc_html__('Short Description', 'plaxer'),
        'name' => 'short_desc',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array(
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array(
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array(
    'id' => 'acf_post-settings2',
    'title' => esc_html__('Additional Post Settings', 'plaxer'),
    'fields' => array(
      array(
        'key' => 'field_458fa8237587',
        'label' => esc_html__('Featured image on top', 'plaxer'),
        'name' => 'featured_image_on_top',
        'type' => 'image',
      ),
      array(
        'key' => 'field_fbc9b69b7bab',
        'label' => esc_html__('Image position', 'plaxer'),
        'name' => 'featured_image_on_top_position',
        'type' => 'select',
        'choices' => array(
          "default" => esc_html__("Default", "plaxer"),
          "50% 0%" => esc_html__("Top", "plaxer"),
          "50% 50%" => esc_html__("Center", "plaxer"),
          "50% 100%" => esc_html__("Bottom", "plaxer"),
        ),
        'conditional_logic' => array(
          'status' => 1,
          'rules' => array(
            array(
              'field' => 'field_458fa8237587',
              'operator' => '!=empty',
            ),
          ),
          'allorany' => 'all',
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array(
        'key' => 'field_8976230934',
        'label' => esc_html__('Show Featured Image On Single Page', 'plaxer'),
        'name' => 'post_featured_image',
        'type' => 'select',
        'choices' => array(
          'default' => esc_html__('Default', 'plaxer'),
          'true' => esc_html__('Yes', 'plaxer'),
          'false' => esc_html__('No', 'plaxer'),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array(
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array(
      ),
    ),
    'menu_order' => 0,
  ));
}