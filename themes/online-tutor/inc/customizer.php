<?php
/**
 * Online Tutor Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Online Tutor
 */

if ( ! defined( 'ONLINE_TUTOR_URL' ) ) {
    define( 'ONLINE_TUTOR_URL', esc_url( 'https://www.themagnifico.net/themes/online-tutor-wordpress-theme/', 'online-tutor') );
}
if ( ! defined( 'ONLINE_TUTOR_TEXT' ) ) {
    define( 'ONLINE_TUTOR_TEXT', __( 'Online Tutor Pro','online-tutor' ));
}

use WPTRT\Customize\Section\Online_Tutor_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Online_Tutor_Button::class );

    $manager->add_section(
        new Online_Tutor_Button( $manager, 'online_tutor_pro', [
            'title'       => esc_html( ONLINE_TUTOR_TEXT, 'online-tutor' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'online-tutor' ),
            'button_url'  => esc_url( ONLINE_TUTOR_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'online-tutor-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'online-tutor-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function online_tutor_customize_register($wp_customize){
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // General Settings
     $wp_customize->add_section('online_tutor_general_settings',array(
        'title' => esc_html__('General Settings','online-tutor'),
        'description' => esc_html__('General settings of our theme.','online-tutor'),
        'priority'   => 1,
    ));

    $wp_customize->add_setting('online_tutor_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'online_tutor_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'online_tutor_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'online-tutor' ),
        'section'        => 'online_tutor_general_settings',
        'settings'       => 'online_tutor_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'online_tutor_preloader_bg_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_tutor_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','online-tutor'),
        'section' => 'online_tutor_general_settings',
        'settings' => 'online_tutor_preloader_bg_color' 
    )));
    
    $wp_customize->add_setting( 'online_tutor_preloader_dot_1_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_tutor_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','online-tutor'),
        'section' => 'online_tutor_general_settings',
        'settings' => 'online_tutor_preloader_dot_1_color' 
    )));

    $wp_customize->add_setting( 'online_tutor_preloader_dot_2_color', array(
        'default' => '#ffa155',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_tutor_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','online-tutor'),
        'section' => 'online_tutor_general_settings',
        'settings' => 'online_tutor_preloader_dot_2_color' 
    )));

    // Theme Color
    $wp_customize->add_section('online_tutor_color_option',array(
        'title' => esc_html__('Theme Color','online-tutor'),
        'description' => esc_html__('Change theme color on one click.','online-tutor'),
        'priority' => 2,
    ));

    $wp_customize->add_setting( 'online_tutor_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_tutor_theme_color', array(
        'label' => esc_html__('First Color Option','online-tutor'),
        'section' => 'online_tutor_color_option',
        'settings' => 'online_tutor_theme_color' 
    )));

    $wp_customize->add_setting( 'online_tutor_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'online_tutor_theme_color_2', array(
        'label' => esc_html__('Second Color Option','online-tutor'),
        'section' => 'online_tutor_color_option',
        'settings' => 'online_tutor_theme_color_2' 
    )));
    
    // Top Header
    $wp_customize->add_section('online_tutor_top_header',array(
        'title' => esc_html__('Top Header','online-tutor'),
    ));
    
    $wp_customize->add_setting('online_tutor_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_facebook_url',array(
        'label' => esc_html__('Facebook Link','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_twitter_url',array(
        'label' => esc_html__('Twitter Link','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_intagram_url',array(
        'label' => esc_html__('Intagram Link','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_pintrest_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_ticket_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('online_tutor_ticket_text',array(
        'label' => esc_html__('Ticket Text','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_ticket_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('online_tutor_ticket_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_ticket_url',array(
        'label' => esc_html__('Ticket URL','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_ticket_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_phone_number',array(
        'default' => '',
        'sanitize_callback' => 'online_tutor_sanitize_phone_number'
    )); 
    $wp_customize->add_control('online_tutor_phone_number',array(
        'label' => esc_html__('Phone Number','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_phone_number',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('online_tutor_email',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('online_tutor_email',array(
        'label' => esc_html__('Email Address','online-tutor'),
        'section' => 'online_tutor_top_header',
        'setting' => 'online_tutor_email',
        'type'  => 'text'
    ));

    // Header
    $wp_customize->add_section('online_tutor_header',array(
        'title' => esc_html__('Header','online-tutor')
    ));

    $wp_customize->add_setting('online_tutor_search_on_off',array(
        'default' => 0,
        'sanitize_callback' => 'online_tutor_sanitize_checkbox'
    )); 
    $wp_customize->add_control('online_tutor_search_on_off',array(
        'label' => esc_html__('On / Off Homepage Search','online-tutor'),
        'section' => 'online_tutor_header',
        'setting' => 'online_tutor_search_on_off',
        'type'  => 'checkbox'
    ));

    $wp_customize->add_setting('online_tutor_consultation_button1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('online_tutor_consultation_button1',array(
        'label' => esc_html__('Button 1 Text','online-tutor'),
        'section' => 'online_tutor_header',
        'setting' => 'online_tutor_consultation_button1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('online_tutor_button1_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_button1_url',array(
        'label' => esc_html__('Button 1 Link','online-tutor'),
        'section' => 'online_tutor_header',
        'setting' => 'online_tutor_button1_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_consultation_button2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('online_tutor_consultation_button2',array(
        'label' => esc_html__('Button 2 Text','online-tutor'),
        'section' => 'online_tutor_header',
        'setting' => 'online_tutor_consultation_button2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('online_tutor_button2_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('online_tutor_button2_url',array(
        'label' => esc_html__('Button 2 Link','online-tutor'),
        'section' => 'online_tutor_header',
        'setting' => 'online_tutor_button2_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('online_tutor_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'online_tutor_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'online_tutor_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'online-tutor' ),
        'section'        => 'online_tutor_header',
        'settings'       => 'online_tutor_sticky_header',
        'type'           => 'checkbox',
    )));

    //Slider
    $wp_customize->add_section('online_tutor_top_slider',array(
        'title' => esc_html__('Slider Option','online-tutor')
    ));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'online_tutor_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'online_tutor_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'online_tutor_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'online-tutor' ),
            'section'  => 'online_tutor_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    // Project Section
    $wp_customize->add_section('online_tutor_latest_project',array(
        'title' => esc_html__('Latest Online Lessons','online-tutor')
    ));

    $wp_customize->add_setting('online_tutor_projects_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('online_tutor_projects_title',array(
        'label' => esc_html__('Section Title','online-tutor'),
        'section' => 'online_tutor_latest_project',
        'setting' => 'online_tutor_projects_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('online_tutor_project_loop',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    )); 
    $wp_customize->add_control('online_tutor_project_loop',array(
        'label' => esc_html__('No of online lesson','online-tutor'),
        'section'   => 'online_tutor_latest_project',
        'type'      => 'number',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 0,
            'max'              => 9,
        ),
    ));

    $project_loop = get_theme_mod('online_tutor_project_loop');

    $args = array('numberposts' => -1);
    $post_list = get_posts($args);
    $i = 1;
    $pst_sls[]= __('Select','online-tutor');
    foreach ($post_list as $key => $p_post) {
        $pst_sls[$p_post->ID]=$p_post->post_title;
    }
    for ( $i = 1; $i <= $project_loop; $i++ ) {
        $wp_customize->add_setting('online_tutor_other_project_section'.$i,array(
            'sanitize_callback' => 'online_tutor_sanitize_choices',
        ));
        $wp_customize->add_control('online_tutor_other_project_section'.$i,array(
            'type'    => 'select',
            'choices' => $pst_sls,
            'label' => __('Select Post','online-tutor'),
            'section' => 'online_tutor_latest_project',
        ));

        $wp_customize->add_setting('online_tutor_projects_price'.$i, array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('online_tutor_projects_price'.$i, array(
            'label' => __('Lessons Price', 'online-tutor'),
            'section' => 'online_tutor_latest_project',
            'type' => 'text',
        ));

    }
    wp_reset_postdata();
    
    // Footer
    $wp_customize->add_section('online_tutor_site_footer_section', array(
        'title' => esc_html__('Footer', 'online-tutor'),
    ));

    $wp_customize->add_setting('online_tutor_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('online_tutor_footer_text_setting', array(
        'label' => __('Replace the footer text', 'online-tutor'),
        'section' => 'online_tutor_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));
}
add_action('customize_register', 'online_tutor_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function online_tutor_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function online_tutor_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function online_tutor_customize_preview_js(){
    wp_enqueue_script('online-tutor-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'online_tutor_customize_preview_js');