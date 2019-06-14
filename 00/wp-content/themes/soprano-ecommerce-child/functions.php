<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */

// here comes your code ...
function theme_styles() {

	wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome_css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );


	wp_enqueue_style( 'masonry_css', get_stylesheet_directory_uri() . '/css/masonry.css' );
	wp_enqueue_style( 'mega-menu_css', get_stylesheet_directory_uri() . '/css/mega-menu.css' );

	wp_enqueue_style( 'footer-riojawine', get_stylesheet_directory_uri() . '/css/footer-riojawine.css' );
	wp_enqueue_style( 'ficha-bodega', get_stylesheet_directory_uri() . '/css/ficha-bodega.css' );
	wp_enqueue_style( 'masonry_css', get_stylesheet_directory_uri() . '/css/masonry.css' );
	wp_enqueue_style( 'magnific-popup', get_stylesheet_directory_uri() . '/css/magnific-popup.css' );
	wp_enqueue_style( 'mega-menu_css', get_stylesheet_directory_uri() . '/css/mega-menu.css' );
	wp_enqueue_style( 'accordion_menu_css', get_stylesheet_directory_uri() . '/css/accordion_menu.css' );
	wp_enqueue_style( 'buscador-bodegas', get_stylesheet_directory_uri() . '/css/buscador-bodegas.css' );
	wp_enqueue_style( 'mapa_interactivo_css', get_stylesheet_directory_uri() . '/css/mapa_interactivo.css' );
	wp_enqueue_style( 'menus_variedades_css', get_stylesheet_directory_uri() . '/css/menus_variedades.css' );
	wp_enqueue_style( 'ficha_vino_css', get_stylesheet_directory_uri() . '/css/ficha-vino.css' );
	wp_enqueue_style( 'ficha-municipio', get_stylesheet_directory_uri() . '/css/ficha-municipio.css' );
	wp_enqueue_style( 'buttons_css', get_stylesheet_directory_uri() . '/css/buttons.css' );
	wp_enqueue_style( 'contact-riojawine_css', get_stylesheet_directory_uri() . '/css/contact-riojawine.css' );

	if ( is_single() || is_archive() || is_search()) {
		wp_enqueue_style( 'post_page_css', get_stylesheet_directory_uri() . '/css/post-page.css' );
		wp_enqueue_style( 'post_page_carousel_css', get_stylesheet_directory_uri() . '/css/post-page-carousel.css' );
		wp_enqueue_style( 'imagen_rioja_css', get_stylesheet_directory_uri() . '/css/imagen_rioja.css' );
		wp_enqueue_style( 'essential_rioja_css', get_stylesheet_directory_uri() . '/css/essential_rioja.css' );
		wp_enqueue_style( 'visita_rioja_css', get_stylesheet_directory_uri() . '/css/visita_rioja.css' );
		wp_enqueue_style( 'buttons_css', get_stylesheet_directory_uri() . '/css/buttons.css' );
		wp_enqueue_style( 'unite-gallery_css', get_stylesheet_directory_uri() . '/css/unite-gallery.css' );
    }

	if (is_page( 'newsletter' ) ){
		wp_enqueue_style( 'hide-newsletter_css', get_stylesheet_directory_uri() . '/css/hide-newsletter.css' );
	}
	
	wp_enqueue_style( 'print-riojawine', get_stylesheet_directory_uri() . '/css/print.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_styles');










function theme_js() {

	global $wp_scripts;


	wp_enqueue_script('magnific-popup',  get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.js');
	wp_enqueue_script('my-magnific',  get_stylesheet_directory_uri() . '/js/my-magnific.js');
	wp_enqueue_script('masonry',  get_stylesheet_directory_uri() . '/js/masonry.pkgd.js');
	wp_enqueue_script('my-masonry',  get_stylesheet_directory_uri() . '/js/my-masonry.js');
	wp_enqueue_script('map_places',  get_stylesheet_directory_uri() . '/js/map_places.js');
	wp_enqueue_script('accordion_menu_js',  get_stylesheet_directory_uri() . '/js/accordion_menu.js');
	wp_enqueue_script('footer_js',  get_stylesheet_directory_uri() . '/js/footer.js');
	wp_enqueue_script('mega_menu_js',  get_stylesheet_directory_uri() . '/js/mega_menu.js');
	wp_enqueue_script('mapa_interactivo_js',  get_stylesheet_directory_uri() . '/js/mapa_interactivo.js');
	wp_enqueue_script('jquery.morelines_js',  get_stylesheet_directory_uri() . '/js/jquery.morelines.js');
	wp_enqueue_script('bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js' );
	// wp_enqueue_script('pzt_helpers', get_stylesheet_directory_uri() . '/js/pzt_helpers.js');


	if ( is_page_template('page_without_image.php') ) {
        wp_enqueue_script('header_without_image', get_stylesheet_directory_uri() . '/js/header_without_image.js');
    }

	if ( is_page_template('blogroll-template.php') ) {
        wp_enqueue_script('header_without_image', get_stylesheet_directory_uri() . '/js/header_without_image.js');
    }

	if ( is_single() || is_archive() || is_search()) {
        wp_enqueue_script('header_without_image', get_stylesheet_directory_uri() . '/js/header_without_image.js');
		wp_enqueue_script('owl-carousel-js', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js');
		wp_enqueue_script('post-page-js', get_stylesheet_directory_uri() . '/js/post-page.js');
		wp_enqueue_script('unitegallery-js', get_stylesheet_directory_uri() . '/js/unitegallery.min.js');
		wp_enqueue_script('ug-theme-grid-js', get_stylesheet_directory_uri() . '/js/ug-theme-grid.js');
    }

	// if ( is_page_template('bodegas.php') ) {
        // wp_enqueue_script('header_without_image', get_stylesheet_directory_uri() . '/js/header_without_image.js');
    // }

	wp_localize_script( 'map_places', 'MyAjax', array(
	    // URL to wp-admin/admin-ajax.php to process the request
	    'ajaxurl' => admin_url( 'admin-ajax.php' ),
	    // generate a nonce with a unique ID "myajax-post-comment-nonce"
	    // so that you can check it later when an AJAX request is sent
	    'security' => wp_create_nonce( 'my-special-string' )
	));

}

add_action( 'wp_enqueue_scripts', 'theme_js');



//--------------------------Mueve la carga de javascript al final de la página--------------------------------

function move_scripts_from_head_to_footer() {
    // remove_action( 'wp_head', 'wp_print_scripts' );
    // remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
    remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );

    // add_action( 'wp_footer', 'wp_print_scripts', 5);
    // add_action( 'wp_footer', 'wp_print_head_scripts', 5);
    add_action( 'wp_footer', 'wp_enqueue_scripts', 5);
}
add_action('wp_enqueue_scripts', 'move_scripts_from_head_to_footer');
//------------------------------------------------------------------------------------------------------


//------------------------ REDIRECCION POR IDIOMA --------------------------
add_action( 'init', 'redirect_by_language' );
function redirect_by_language(){
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);

	if( strpos($lang, 'en') !== false ){
			// if( is_home() ){
		$url = "http://uk.riojawine.com";
	    wp_redirect( $url , 301 ); exit;
	        // }
	}else if( strpos($lang, "es-mx") !== false ){
			// if( is_home() ){
		$url = "http://mx.riojawine.com";
	    wp_redirect( $url , 301 ); exit;
	        // }
	}else if( strpos($lang, "zh") !== false ){
			// if( is_home() ){
		$url = "http://www.riojawine.cn";
		wp_redirect( $url , 301 ); exit;
	        // }
	}else if( strpos($lang, "ru") !== false ){
			// if( is_home() ){
		$url = "http://ru.riojawine.com";
	    wp_redirect( $url , 301 ); exit;
	        // }
	}else if( strpos($lang, "de") !== false ){
			// if( is_home() ){
		$url = "http://de.riojawine.com";
	    wp_redirect( $url , 301 ); exit;
	        // }
	}
}
//------------------------------------------------------------------------

//Sidebar para página de buscador general
function buscador_general_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Buscador General', 'soprano-theme-child' ),
            'id' => 'buscador-general-sidebar',
            'description' => __( 'Buscador General Sidebar', 'soprano-theme-child' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'buscador_general_sidebar' );

//Sidebar para páginas de menú Consejo Regulador
function consejo_regulador_es_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Consejo Regulador Menú ES', 'soprano-theme-child' ),
            'id' => 'consejo-menu-es-side-bar',
            'description' => __( 'Consejo Regulador ES Sidebar', 'soprano-theme-child' ),
            'before_widget' => '<div class="widget-content accordion_menu_lateral">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'consejo_regulador_es_sidebar' );


//Sidebar para páginas de menú Consejo Regulador
function consejo_regulador_en_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Consejo Regulador Menú EN', 'soprano-theme-child' ),
            'id' => 'consejo-menu-en-side-bar',
            'description' => __( 'Consejo Regulador EN Sidebar', 'soprano-theme-child' ),
            'before_widget' => '<div class="widget-content accordion_menu_lateral">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'consejo_regulador_en_sidebar' );

function SearchFilter($query) {
	if (is_admin() || ! $query->is_main_query()){
		return;
	} else {
		$date_post = $_GET['date'];

		if(!empty($date_post)){
			$array_date = explode('_',$date_post);

			$monthnum = $array_date[0];
			$year = $array_date[1];
			if(!empty($year)){
				$query->set('year', $year);
			}
			if(!empty($monthnum)){
				$query->set('monthnum', $monthnum);
			}
		}
		if ($query->is_search) {
			$query->set('post_type', 'post');
			$query->set('post_status', 'publish');

		}
		return $query;
	}
}
add_filter('pre_get_posts','SearchFilter');

function language_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Conmutador de idioma', 'soprano-theme-child' ),
            'id' => 'conmutador-idioma-bar',
            'description' => __( 'Conmutador de idioma', 'soprano-theme-child' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'language_sidebar' );


function wpb_add_google_fonts() {

    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i', false );
    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Titillium+Web:300,300i,400,400i,600,600i,700,700i', false );
}

add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

//------------------------------------------------------------
//---------------------- INICIO WIDGETS-----------------------
//------------------------------------------------------------


// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
    register_widget( 'wpb_one_news_post_selector' );
	register_widget( 'wpb_one_rtv_post_selector' );

}

add_action( 'widgets_init', 'wpb_load_widget' );

function ctUp_wdScript(){
	wp_enqueue_media();
	wp_enqueue_script('adsScript',  get_stylesheet_directory_uri() . '/js/custom_menu_widget.js');
}

add_action('admin_enqueue_scripts', 'ctUp_wdScript');


// // here comes your code ...
// function wpb_one_post_selector_styles() {
// 	wp_enqueue_style( 'bootstrap-multiselect_css', get_stylesheet_directory_uri() . '/css/boostrap-multiselect.css' );
// }
//
// add_action( 'admin_enqueue_scripts', 'wpb_one_post_selector_styles');
//
// function wpb_one_post_selector_scripts(){
// 	wp_enqueue_media();
// 	wp_enqueue_script('bootstrap-multiselectScript',  get_stylesheet_directory_uri() . '/js/bootstrap-multiselect.js');
// 	wp_enqueue_script('wpb_one_post_selectorScript',  get_stylesheet_directory_uri() . '/js/wpb_one_post_selector.js', array( 'jquery' ));
// }
//
// add_action('admin_enqueue_scripts', 'wpb_one_post_selector_scripts');




// Creating the widget
class wpb_widget extends WP_Widget {

	function __construct() {
		parent::__construct(

			// Base ID of your widget
			'wpb_widget',

			// Widget name will appear in UI
			__('Menu Item Riojawine', 'wpb_widget_domain'),

			// Widget description
			array( 'description' => __( 'Widget para añadir submenús con enlace, texto e imagen personalizados', 'wpb_widget_domain' ), )
		);




	}

	// Creating widget front-end

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$description = apply_filters( 'widget_description', $instance['description'] );
		$url_image = esc_url($instance['image_uri']);
		$link = apply_filters( 'widget_link', $instance['link'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		?>

		<div class="container-widget-menu">
			<a class="wg_link" href="<?php echo $link; ?>">
			<div class="container-title-text-wg-menu">
				<?php
				if ( ! empty( $title ) ){
				?>
					<div class="title_widget">
						<h4 class="text_overlay">
						<?php echo $args['before_title'] . $title . $args['after_title'];?>
						</h4>
					</div>
				<?php
				}
				?>
				<div class="text_widget">
					<p class="text_widget">
					<?php
						if ( ! empty( $description ) )
							echo $args['before_description'] . $description . $args['after_description'];
					?>
					</p>
				</div>
			</div>
			<div class="image_widget">
				<img class="image-item-menu" alt="custom-image" width="100%" src="<?php echo $url_image; ?>" />
				<div class="velo-magenta-noticias-rioja show-overlay" width="100%"></div>
				<div class="overlay" width="100%"></div>
			</div>
			</a>
		</div>
		<?php

		// This is where you run the code and display the output
		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else {
			$title = '';//__( 'New title', 'wpb_widget_domain' );
		}

		if ( isset( $instance[ 'description' ] ) ) {
			$description = $instance[ 'description' ];
		}else {
			$description = '';//__( 'New description', 'wpb_widget_domain' );
		}

		if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		}else {
			$link = '';//__( 'New link', 'wpb_widget_domain' );
		}

		// Widget admin form
		?>
			<p>
				<label style="font-weight: 600;margin-bottom:5px;" for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> <br />
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label style="font-weight: 600;margin-bottom:5px;" for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label> <br />
				<textarea class="widefat" style="text-align:left;" maxlength="100" id="<?php echo $this->get_field_id( 'description' ); ?>"
						name="<?php echo $this->get_field_name( 'description' ); ?>"
						rows="5"><?php echo esc_attr( $description ); ?></textarea>
			</p>


			<p>
				<label style="font-weight: 600;margin-bottom:5px;" for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e( 'Selecciona una página:' ); ?></label> <br />
				<select name="page-dropdown" class="widget_menu_select">
					<option value="">
					<?php echo esc_attr( __( 'Select page' ) ); ?></option>
					<?php
						$pages = get_pages();
						foreach ( $pages as $page ) {
							$link_page = get_page_link( $page->ID );
							if(strcmp($link, $link_page) == 0){
								$option = '<option value="' . $link_page . '" selected>';
							} else {
								$option = '<option value="' . $link_page . '">';
							}
							$option .= $page->post_title;
							$option .= '</option>';
							echo $option;
						}
					?>
				</select>
			</p>

			<p>
				<label style="font-weight: 600;margin-bottom:5px;" for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'O introduce un link:' ); ?></label> <br />
				<input class="widefat widget_link" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
			</p>

			<p>
				<label style="font-weight: 600;margin-bottom:5px;" for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
				<img class="custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin-bottom:5px;padding:0;max-width:100px;float:left;display:inline-block" />
				<input type="text" style="display: none; font-style: italic;margin-bottom:5px;"  class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
				<input type="button" value="<?php _e( 'Seleccionar imagen', 'themename' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
			</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

		return $instance;
	}

} // Class wpb_widget ends here



// Creating the widget
class wpb_one_news_post_selector extends WP_Widget {

	function __construct() {
		parent::__construct(

			// Base ID of your widget
			'wpb_one_news_post_selector',

			// Widget name will appear in UI
			__('News Post Selector Riojawine', 'wpb_widget_domain'),

			// Widget description
			array( 'description' => __( 'Widget para añadir un post de Noticias', 'wpb_widget_domain' ), )
		);




	}

	// Creating widget front-end

	public function widget( $args, $instance ) {
		$selected_id = apply_filters( 'widget_post_id', $instance['post_id'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
        $post = get_post($selected_id);
		?>

		<!-- <div class="wpmmpro-posts-list"> -->
        <div class="wponepost-list">
            <a class="wg_link" href="<?php echo get_permalink($post->ID); ?>">
                <div class="wponepost_img">
    				<?php echo get_the_post_thumbnail( $post->ID , 'thumbnail'); ?>

					<div class="velo-magenta-noticias-rioja show-overlay" width="100%"></div>
    				<div class="overlay" width="100%"></div>
    			</div>

				<div class="wponepost-list-content">
					<div class="wponepost-date">
						<?php echo $args['before_title'] . get_the_date( 'd F Y', $post->ID ) . $args['after_title'];?>
					</div>

	                <div class="wponepost-category">
						<?php $post_category = get_the_category( $post->ID ) ;
	                        echo $post_category[0]->name; ?>
					</div>

					<span class="wponepost-title text_overlay">
						<?php
							echo $args['before_title'] . get_the_title( $post->ID ) . $args['after_title'];
						?>
					</span>
				</div>

            </a>
		</div>
		<?php

		// This is where you run the code and display the output
		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {

        $posts = get_posts( array(
			'numberposts' => 50,
			'category' => 76,
			'offset' => 0
		) );

        $selected_post = ! empty( $instance['post_id'] ) ? $instance['post_id'] : array();

		// if ( isset( $instance[ 'post_id' ] ) ) {
		// 	$title = $instance[ 'title' ];
		// }else {
		// 	$title = '';//__( 'New title', 'wpb_widget_domain' );
		// }

		// if ( isset( $instance[ 'description' ] ) ) {
		// 	$description = $instance[ 'description' ];
		// }else {
		// 	$description = '';//__( 'New description', 'wpb_widget_domain' );
		// }
        //
		// if ( isset( $instance[ 'link' ] ) ) {
		// 	$link = $instance[ 'link' ];
		// }else {
		// 	$link = '';//__( 'New link', 'wpb_widget_domain' );
		// }

		// Widget admin form
		?>

        <select class="wpb_one_news_post_selector_post" name="<?php echo esc_attr( $this->get_field_name( 'post_id' ) ); ?>">
            <option value="">
            <?php echo esc_attr( __( 'Select post' ) ); ?></option>
        <?php foreach ( $posts as $post ) { ?>
            <option value="<?php echo $post->ID; ?>"
                <?php echo ( $post->ID == $selected_post ) ? 'selected': ''; ?>
                ><?php echo substr(get_the_title( $post->ID ), 0, 40); ?></option>
        <?php } ?>
        </select >
        <?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['post_id'] = strip_tags( $new_instance['post_id'] );

		return $instance;
	}

} // Class wpb_widget ends here


// Creating the widget
class wpb_one_rtv_post_selector extends WP_Widget {

	function __construct() {
		parent::__construct(

			// Base ID of your widget
			'wpb_one_rtv_post_selector',

			// Widget name will appear in UI
			__('Riojawine TV Post Selector Riojawine', 'wpb_widget_domain'),

			// Widget description
			array( 'description' => __( 'Widget para añadir un post de Riojawine TV', 'wpb_widget_domain' ), )
		);




	}

	// Creating widget front-end

	public function widget( $args, $instance ) {
		$selected_id = apply_filters( 'widget_post_id', $instance['post_id'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
        $post = get_post($selected_id);
		?>

		<!-- <div class="wpmmpro-posts-list"> -->
        <div class="wponepost-list">
            <a class="wg_link" href="<?php echo get_permalink($post->ID); ?>">

				<div class="wponepost_img">
    				<?php echo get_the_post_thumbnail( $post->ID , 'thumbnail'); ?>

					<div class="velo-magenta-noticias-rioja show-overlay" width="100%"></div>
    				<div class="overlay" width="100%"></div>
    			</div>

				<div class="wponepost-list-content">

					<!-- <div class="wponepost-date">
						<?php //echo $args['before_title'] . get_the_date( 'd F Y', $post->ID ) . $args['after_title'];?>
					</div> -->

	                <div class="wponepost-category">
						<?php $post_category = get_the_category( $post->ID ) ;
	                        echo $post_category[0]->name; ?>
					</div>

					<span class="wponepost-title text_overlay">
						<?php
							echo $args['before_title'] . get_the_title( $post->ID ) . $args['after_title'];
						?>
					</span>
				</div>
            </a>
		</div>
		<?php

		// This is where you run the code and display the output
		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {

        $posts = get_posts( array(
			'numberposts' => 50,
			'category' => 89,
			'offset' => 0
		) );

        $selected_post = ! empty( $instance['post_id'] ) ? $instance['post_id'] : array();

		// if ( isset( $instance[ 'post_id' ] ) ) {
		// 	$title = $instance[ 'title' ];
		// }else {
		// 	$title = '';//__( 'New title', 'wpb_widget_domain' );
		// }

		// if ( isset( $instance[ 'description' ] ) ) {
		// 	$description = $instance[ 'description' ];
		// }else {
		// 	$description = '';//__( 'New description', 'wpb_widget_domain' );
		// }
        //
		// if ( isset( $instance[ 'link' ] ) ) {
		// 	$link = $instance[ 'link' ];
		// }else {
		// 	$link = '';//__( 'New link', 'wpb_widget_domain' );
		// }

		// Widget admin form
		?>

        <select class="wpb_one_post_selector_post" name="<?php echo esc_attr( $this->get_field_name( 'post_id' ) ); ?>">
            <option value="">
            <?php echo esc_attr( __( 'Select post' ) ); ?></option>
        <?php foreach ( $posts as $post ) { ?>
            <option value="<?php echo $post->ID; ?>"
                <?php echo ( $post->ID == $selected_post ) ? 'selected': ''; ?>
                ><?php echo substr(get_the_title( $post->ID ), 0, 40); ?></option>
        <?php } ?>
        </select >
        <?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['post_id'] = strip_tags( $new_instance['post_id'] );

		return $instance;
	}

} // Class wpb_widget ends here

//------------------------------------------------------------
//----------------------- FIN WIDGETS ------------------------
//------------------------------------------------------------

// function custom_rewrite_basic_1() {
//
//
// }
// add_action('init', 'custom_rewrite_basic_1');

function custom_rewrite_basic() {
	add_rewrite_tag( '%winery_url%', '([^&]+)' );
	add_rewrite_tag( '%wine_url%', '([^&]+)' );
	add_rewrite_tag( '%company_url%', '([^&]+)' );
	add_rewrite_tag( '%city_url%', '([^&]+)' );
	add_rewrite_tag( '%wineries_types%', '([^&]+)' );


	add_rewrite_rule('^([A-Za-z0-9-]+)/bodegas-rioja/page/([0-9]{1,})/wineries_types/([0-9]{1,})/?', 'index.php?page_id=103&paged=$matches[2]&wineries_types=$matches[3]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/bodegas-rioja/page/([0-9]{1,})/?', 'index.php?page_id=103&paged=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/bodegas-rioja/([^/]*)/([^/]*)$', 'index.php?page_id=1241&winery_url=$matches[2]&wine_url=$matches[3]', 'top');
  	add_rewrite_rule('^([A-Za-z0-9-]+)/bodegas-rioja/([^/]*)$', 'index.php?page_id=93&winery_url=$matches[2]', 'top');

	add_rewrite_rule('^([A-Za-z0-9-]+)/wineries/page/([0-9]{1,})/?', 'index.php?page_id=103&paged=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/wineries/([^/]*)/([^/]*)$', 'index.php?page_id=10221&winery_url=$matches[2]&wine_url=$matches[3]', 'top');
  	add_rewrite_rule('^([A-Za-z0-9-]+)/wineries/([^/]*)$', 'index.php?page_id=96&winery_url=$matches[2]', 'top');

	add_rewrite_rule('^([A-Za-z0-9-]+)/espacios-culturales/page/([0-9]{1,})/?', 'index.php?page_id=482&paged=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/espacios-culturales/([^/]*)$', 'index.php?page_id=980&company_url=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/rutas-del-vino/page/([0-9]{1,})/?', 'index.php?page_id=491&paged=$matches[2]', 'top');

	add_rewrite_rule('^([A-Za-z0-9-]+)/cultural-spaces/page/([0-9]{1,})/?', 'index.php?page_id=482&paged=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/cultural-spaces/([^/]*)$', 'index.php?page_id=10228&company_url=$matches[2]', 'top');
	
	add_rewrite_rule('^([A-Za-z0-9-]+)/municipios/page/([0-9]{1,})/?', 'index.php?page_id=2142&paged=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/municipios/([^/]*)$', 'index.php?page_id=2149&city_url=$matches[2]', 'top');
	// add_rewrite_rule('^([A-Za-z0-9-]+)/municipios/([^/]*)$', 'index.php?page_id=2149&city_url=$matches[2]', 'top');
	
	add_rewrite_rule('^([A-Za-z0-9-]+)/cities/page/([0-9]{1,})/?', 'index.php?page_id=2142&paged=$matches[2]', 'top');
	add_rewrite_rule('^([A-Za-z0-9-]+)/cities/([^/]*)$', 'index.php?page_id=2152&city_url=$matches[2]', 'top');
}
add_action('init', 'custom_rewrite_basic');

// function remove_category( $string, $type )
// {
        // if ( $type != 'single' && $type == 'category' && ( strpos( $string, 'category' ) !== false ) )
        // {
            // $url_without_category = str_replace( "/category/", "/", $string );
            // return trailingslashit( $url_without_category );
        // }
    // return $string;
// }

// add_filter( 'user_trailingslashit', 'remove_category', 100, 2);

add_filter('wpseo_title', 'filter_product_wpseo_title');
function filter_product_wpseo_title($title) {
	global $winery, $winery_url, $wine_url, $city_url, $company_url;

	if( empty($winery) && empty($winery_url) && empty($wine_url) && empty($city_url) && empty($company_url) ){
		return $title;
	}
	
	// if ( is_feed() )
	// 	return $title;

	if ( get_locale() == 'es_ES'){
		$locale = "Locale: es\r\n";
	}

	$make_request = false;

	// if ( is_page_template( 'ficha-bodega.php' ) ) {
	if ( strpos( get_the_title() , 'Ficha Bodega')  !== false || strpos( get_the_title() , 'Winery detail')  !== false  ) {

		if( isset($winery_url) && count($winery_url) ){

			$make_request = true;
			$url_WS = URL_RIOJAWINE_API. "/wineries/" . $winery_url . '.json';
			$itemName = 'Winery';
			$title_prefix =  (get_locale() == 'es_ES') ? 'Bodegas Rioja - ' : 'Rioja Wineries - ';
			
			
		}
	}else if ( strpos( get_the_title() , 'Ficha Vino') !== false || strpos( get_the_title() , 'Wine detail')  !== false  ) {

		if( isset($wine_url) && count($wine_url) ){

			$make_request = true;
			$url_WS = URL_RIOJAWINE_API. "/wines/" . $wine_url . '.json';
			$itemName = 'Wine';
			$title_prefix =  (get_locale() == 'es_ES') ? 'Vinos Rioja - ' : 'Rioja Wines - ';
		}
	}else if ( strpos( get_the_title() , 'Ficha Municipio') !== false || strpos( get_the_title() , 'City detail')  !== false  ) {

		if( isset($city_url) && count($city_url) ){

			$make_request = true;
			$url_WS = URL_RIOJAWINE_API. "/cities/" . $city_url . '.json';
			$itemName = 'City';
			$title_prefix =  (get_locale() == 'es_ES') ? 'Municipios - ' : 'Cities - ';
		}
	}else if ( strpos( get_the_title() , 'Ficha espacios culturales') !== false || strpos( get_the_title() , 'Cultural space detail')  !== false  ) {

		if( isset($company_url) && count($company_url) ){

			$make_request = true;
			$url_WS = URL_RIOJAWINE_API. "/companies/" . $company_url . '.json';
			$itemName = 'Company';
			$title_prefix =  (get_locale() == 'es_ES') ? 'Espacios Culturales - ' : 'Cultural Space - ';
		}
	}

	if( $make_request ){

		$ch = curl_init( $url_WS );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				  $locale,
			   ));
		$response = curl_exec($ch);
		curl_close($ch);
		if(!$response) { $jsonObject = false;
		}else{ $jsonObject = json_decode($response); }
		$itemData = $jsonObject->data;

		$item = $itemData->$itemName;
		$title =  $title_prefix . $item->name . ' ' . RIOJAWINE_SEO_TITLE;

	}else{

		$title =  RIOJAWINE_SEO_TITLE;
	}

	return $title;
}

function add_theme_caps() {

	if ( !is_admin())
	  return;

	  global $pagenow;

     if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){ // Test if theme is active
         // Theme is active
         // gets the author role

		// gets the editor role
		$role = get_role( 'Editor' );

		if ( !$role->has_cap('edit_theme_options') ) {

			// This only works, because it accesses the class instance.
		    // would allow the author to edit others' posts for current theme only
		    $role->add_cap( 'edit_theme_options' );
		}
	} else {
         // Theme is deactivated
         // Remove the capacity when theme is deactivate
        //  $role->remove_cap( 'edit_theme_options' );
    }
}
add_action( 'load-themes.php', 'add_theme_caps' );


// ****************  AJAX CALLBACKS  ******************
// The function that handles the AJAX request
function search_closeness_companies() {
	check_ajax_referer( 'my-special-string', 'security' );

	$result=array();

	$getdata = http_build_query(
			      array(
			          'closeness' => true,
			          'lat' => $_POST['lat'],
			          'lng' => $_POST['lng'],
			          'hasattributes'=>[66]
			       )
	);

	$ch = curl_init(URL_RIOJAWINE_API. "/companies.json?".$getdata);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			            $locale,
	));
	//obtenemos la respuesta
	$response = curl_exec($ch);
	// Se cierra el recurso CURL y se liberan los recursos del sistema
	curl_close($ch);
	if(!$response) {
		$jsonObject = false;
	}else{
		$jsonObject = json_decode($response) ;
	}
	$companies = $jsonObject->data;

	foreach ($companies as $key => $item) {

		$result[] = ['name' 	=> $item->Company->name,
					 'lat'		=> $item->Company->lat,
					 'lng'		=> $item->Company->lng,
					 'address'	=> $item->Company->address,
					 'city'		=> $item->Company->city,
					 'email'	=> $item->Company->email,
					 'url_logo'	=> $item->Company->url_logo,
					 'type' 	=> 'restaurants'
					];
	}

	$getdata = http_build_query(
					  		array(
					  			'closeness' => true,
					  			'lat' 		=> $_POST['lat'],
					  			'lng'		=> $_POST['lng'],
					  			'hasattributes'=>[65,73,74]
					  		 )
	);

	$ch = curl_init(URL_RIOJAWINE_API. "/companies.json?".$getdata);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					  $locale,
	));
	//obtenemos la respuesta
	$response = curl_exec($ch);
	// Se cierra el recurso CURL y se liberan los recursos del sistema
	curl_close($ch);
	if(!$response) {
		$jsonObject = false;
	}else{
				$jsonObject = json_decode($response) ;
	}
	$companies = $jsonObject->data;

	foreach ($companies as $key => $item) {

		$result[] = ['name' 	 => $item->Company->name,
				   	 'lat'	 	=> $item->Company->lat,
		  			 'lng'	 	=> $item->Company->lng,
		  			 'address' 	=> $item->Company->address,
		  			 'city'	 	=> $item->Company->city,
		  			 'email'	=> $item->Company->email,
		  			 'url_logo'	=> $item->Company->url_logo,
		  			 'type' 	=> 'hotels'
		  			];
	}

	echo json_encode($result);

  	die(); // this is required to return a proper result
}
// Hook para usuarios no logueados
add_action('wp_ajax_nopriv_search_closeness_companies', 'search_closeness_companies');

add_action( 'wp_ajax_search_closeness_companies', 'search_closeness_companies' );


//******************* CUSTOM FUNCTIONS **********************

function custom_paginate($item_per_page, $current_page, $total_pages, $urlParameters)
{
	$pagination = '';

	$__first = pll__("First");
	$__previous  = pll__("Previous");
	$__page = pll__("Page");
	$__next  = pll__("Next");
	$__last  = pll__("Last");

	if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
		$pagination .= '<ul>';

		$right_links    = $current_page + 3;
		$previous       = $current_page - 3; //previous link
		$next           = $current_page + 1; //next link
		$first_link     = true; //boolean var to decide our first link

		if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
			$pagination .= '<li class="first"><a href="'. get_permalink() . $urlParameters .'" data-page="1" title="'.$__first.'">&laquo;</a></li>'; //first link
			$pagination .= '<li><a href="'. get_permalink() .'page/'.$previous_link . $urlParameters .'" data-page="'.$previous_link.'" title="'.$__previous.'">&lt;</a></li>'; //previous link
				for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
					if($i > 0){
						$pagination .= '<li><a href="'. get_permalink() .'page/'.$i . $urlParameters .'" data-page="'.$i.'" title="'.$__page.' '.$i.'">'.$i.'</a></li>';
					}
				}
			$first_link = false; //set first link to false
		}

		if($first_link){ //if current active page is first link
			$pagination .= '<li><a href="#" class="active">'.$current_page.'</a></li>';
		}elseif($current_page == $total_pages){ //if it's the last active link
			$pagination .= '<li><a href="#" class="active">'.$current_page.'</a></li>';
		}else{ //regular current link
			$pagination .= '<li><a href="#" class="active">'.$current_page.'</a></li>';
		}

		for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
			if($i<=$total_pages){
				$pagination .= '<li><a href="'. get_permalink() .'page/'.$i . $urlParameters .'" data-page="'.$i.'" title="'.$__page.' '.$i.'">'.$i.'</a></li>';
			}
		}
		if($current_page < $total_pages){
				$next_link = ($i > $total_pages)? $total_pages : $i;
				$pagination .= '<li><a href="'. get_permalink() .'page/'.$next_link . $urlParameters .'" data-page="'.$next_link.'" title="'.$__next.'">&gt;</a></li>'; //next link
				$pagination .= '<li class="last"><a href="'. get_permalink() .'page/'.$total_pages . $urlParameters .'" data-page="'.$total_pages.'" title="'.$__last.'">&raquo;</a></li>'; //last link
		}

		$pagination .= '</ul>';
	}
	return $pagination; //return pagination links
}
add_filter('custom_paginate', 'custom_paginate');


//**************************CARGAR STYLE DEL THEME CHILD*************************************//
add_action( 'wp_enqueue_scripts', 'func_enqueue_child_styles', 99);

function func_enqueue_child_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css' );
    wp_dequeue_style('soprano-ecommerce-child-style');
    wp_enqueue_style( 'soprano-ecommerce-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}




//******************* CUSTOM SHORTCODES **********************
// Shortcode to output custom PHP in Visual Composer
function get_wineries_shortcode( $atts ) {

	// include( WP_CONTENT_DIR . '/themes/soprano-ecommerce-child/bodegas.php' );
	include( get_template_directory() . '-child/wineries.php');
	return '';
}
add_shortcode( 'vc_get_wineries_shortcode', 'get_wineries_shortcode');

function get_winery_shortcode( $atts ) {

	include( get_template_directory() . '-child/winery_detail.php' );
	return '';
}
add_shortcode( 'vc_get_winery_shortcode', 'get_winery_shortcode');

function get_wineries_search_shortcode( $atts ) {

	include( get_template_directory() . '-child/wineries_search.php' );
	return '';
}
add_shortcode( 'vc_get_wineries_search_shortcode', 'get_wineries_search_shortcode');

function get_wine_shortcode( $atts ) {

	include( get_template_directory() . '-child/wine_detail.php' );
	return '';
}
add_shortcode( 'vc_get_wine_shortcode', 'get_wine_shortcode');

function get_cultural_spaces_shortcode( $atts ) {

	include( get_template_directory() . '-child/cultural_spaces.php' );
	return '';
}
add_shortcode( 'vc_get_cultural_spaces_shortcode', 'get_cultural_spaces_shortcode');

function get_cultural_space_shortcode( $atts ) {

	include( get_template_directory() . '-child/cultural_space_detail.php' );
	return '';
}
add_shortcode( 'vc_get_cultural_space_shortcode', 'get_cultural_space_shortcode');

function get_wine_routes_shortcode( $atts ) {

	include( get_template_directory() . '-child/wine_routes.php' );
	return '';
}
add_shortcode( 'vc_get_wine_routes_shortcode', 'get_wine_routes_shortcode');

function get_cities_shortcode( $atts ) {

	include( get_template_directory() . '-child/cities.php' );
	return '';
}
add_shortcode( 'vc_get_cities_shortcode', 'get_cities_shortcode');

function get_city_shortcode( $atts ) {

	include( get_template_directory() . '-child/city_detail.php' );
	return '';
}
add_shortcode( 'vc_get_city_shortcode', 'get_city_shortcode');


function get_search_shortcode( $atts ) {

	include( get_template_directory() . '-child/search_web.php' );
	return '';
}
add_shortcode( 'vc_get_search_shortcode', 'get_search_shortcode');

function get_wineries_types_shortcode( $atts ) {

	// Crear un flujo
	// $options = array(
	// 	'http'=>array(
	// 	'method'=>"GET",
	// 	'header'=>"Locale: es\r\n"
	// 	)
	// );
	// $context = stream_context_create($options);
	// $jsonObject = json_decode( file_get_contents(URL_RIOJAWINE_API. '/attributes.json?attribute_category_id=6&rol=bodega', false, $context) );
	// $attributesData = $jsonObject->data;

	if ( get_locale() == 'es_ES'){
	    $locale = "Locale: es\r\n";
	}

	// url contra la que atacamos
	$ch = curl_init(URL_RIOJAWINE_API. '/attributes.json?attribute_category_id=6&rol=bodega');
	//a true, obtendremos una respuesta de la url, en otro caso,
	//true si es correcto, false si no lo es
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//establecemos el verbo http que queremos utilizar para la petición
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	//enviamos el array data
	// curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	          $locale,
	       ));
	//obtenemos la respuesta
	$response = curl_exec($ch);
	// Se cierra el recurso CURL y se liberan los recursos del sistema
	curl_close($ch);
	if(!$response) {
	    $jsonObject = false;
	}else{
	    $jsonObject = json_decode($response) ;
	}
 	$attributesData = $jsonObject->data;

	if ( get_locale() == 'es_ES'){
		$__placeholder  = "Todas las Tipologías";
	}else{
		
		$__placeholder  = "All types";
	}

	$content = '<select class="wineries_types" name="wineries_types">
				<option value="">' . $__placeholder . '</option>';

	foreach ($attributesData as $key => $item) {
		$content .= '<option value="'. $item->Attribute->id .'">' . $item->AttributeTranslation[0]->name . '</option>';

	}

	$content .= '</select>';

	return $content;

}
add_shortcode( 'vc_wineries_types_shortcode', 'get_wineries_types_shortcode');

@ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '300' );
