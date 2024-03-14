<?php

function alpha_bootstraping(){

load_theme_textdomain("alpha");

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'title-tag' );

$alpha_custom_header_details = array(
    'header-text' => true,
    'default-text-color' => '#222',
);
add_theme_support( 'custom-header', $alpha_custom_header_details);

add_theme_support( 'post-thumbnails' );

register_nav_menus(
    array(
        'menu-1' => esc_html__( 'Primary', 'alpha' ),
    ),
);

register_nav_menus(
    array(
        'menu-2' => esc_html__( 'Footer', 'alpha' ),
    ),
);

add_theme_support(
    'html5',
    array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    )
);

add_theme_support(
    'custom-background',
    apply_filters(
        'alpha_custom_background_args',
        array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )
    )
);

add_theme_support( 'customize-selective-refresh-widgets' );


add_theme_support(
    'custom-logo',
    array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    )
);





}
add_action('after_setup_theme','alpha_bootstraping');



function alpha_assets(){
    wp_enqueue_style("alpha",get_stylesheet_uri());
    wp_enqueue_style("bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
    wp_enqueue_style("featherlight-css", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css");

    wp_enqueue_script("featherlight-js", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" ,array("jquery"), '0.0.1', true);

    wp_enqueue_script("alpha-js", get_template_directory_uri()."/assets/js/main.js", array("jquery","featherlight-js"), '0.0.1', true);
}
add_action("wp_enqueue_scripts","alpha_assets");



// widget register

function alpha_sidebar(){
    register_sidebar(
		array(
			'name'          => esc_html__( 'Single Post Sidebar', 'alpha' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Right Sidebar', 'alpha' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);


    register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Left', 'alpha' ),
			'id'            => 'footer-left',
			'description'   => esc_html__( 'Footer Left Sidevar', 'alpha' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);


    register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Right', 'alpha' ),
			'id'            => 'footer-right',
			'description'   => esc_html__( 'Footer Right Sidevar', 'alpha' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}
add_action("widgets_init","alpha_sidebar");




// function alpha_the_excerpt(){
//     if(!post_passsword_required()){
//         return $excerpt;
//     }else{
//         echo get_the_password_form();
//     }
// }

// add_filter("the_excerpt","alpha_the_excerpt");

function alpha_protected_title_change(){
    return "%s";
}
add_filter("protected_title_format","alpha_protected_title_change");



// nav menu css class 
function alpha_menu_item_class($classes, $item){
    $classes[] = 'list-inline-item';

    return $classes;
}
add_filter('nav_menu_css_class', 'alpha_menu_item_class', 10, 2);




function alpha_about_page_template_banner(){
    if(is_page()){
        $alpha_feat_image = get_the_post_thumbnail_url(null,"large");
        ?>
        <style>
            .page-header{
                background-image: url(<?php echo $alpha_feat_image;?>);
            }


            .header h1.heading a, h3.tagline{
                color: #<?php echo get_header_text_color();?>
            }

        </style>

        <?php
    }


}


add_action("wp_head","alpha_about_page_template_banner");
