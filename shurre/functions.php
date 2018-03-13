<?php
/**
 * ShUrRe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ShUrRe
 */

if ( ! function_exists( 'shurre_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shurre_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ShUrRe, use a find and replace
		 * to change 'shurre' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shurre', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'shurre' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shurre_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'shurre_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shurre_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'shurre_content_width', 640 );
}
add_action( 'after_setup_theme', 'shurre_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shurre_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shurre' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shurre' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shurre_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shurre_scripts() {
	wp_enqueue_style( 'shurre-style', get_stylesheet_uri() );

	wp_enqueue_script( 'shurre-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'shurre-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shurre_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
function crear_taxonomia_jerarquica() {

    // Definimos un array para las traducciones de la taxonomía
    $etiquetas = array(
        'name' => __( 'Géneros' ),
        'singular_name' => __( 'Género' ),
        'search_items' =>  __( 'Buscar géneros' ),
        'all_items' => __( 'Todos los géneros' ),
        'parent_item' => __( 'Género padre' ),
        'parent_item_colon' => __( 'Género padre:' ),
        'edit_item' => __( 'Editar género' ), 
        'update_item' => __( 'Actualizar género' ),
        'add_new_item' => __( 'Agregar un nuevo género' ),
        'menu_name' => __( 'Géneros' ),
    ); 	


    // Función WordPress para registrar la taxonomía
    register_taxonomy(
        'generos',
        array('post'), // Tipos de Post a los que asociaremos la taxonomía
        array(
            'hierarchical' => true, // True para taxonomías del tipo "Categoría" y false para el tipo "Etiquetas"
            'labels' => $etiquetas, // La variable con las traducciones de las etiquetas
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'genero' ),
        )
    );

}

add_action( 'init', 'crear_taxonomia_jerarquica', 0 );
*/


/*
/////////////////////////////////////////////////////////////////////////////////////////////

*/
// Añade el metabox para los artículos en el lateral de la pantalla
function add_recetas_metaboxes()
{
   // ID metabox, título metabox, función que muestra los atributos, tipo de post, zona metabox, prioridad
   add_meta_box('receta', 'Atributos de la receta', 'receta', 'receta', 'side', 'default');
}

// Acción que llama a la función que añade el metabox para los artículos
add_action( 'add_meta_boxes', 'add_recetas_metaboxes' );

// Función que muestra los atributos del artículo
function receta()
{
   global $post;

   // Noncename necesario para verificar de dónde vienen los datos
   echo '<input type="hidden" name="recetameta_noncename" id="recetaometa_noncename" value="' .
   wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

   // Obtenemos los atributos del artículo si estuvieran guardados, con get_post_meta y el nombre del atributo
   $descripcion_corta=get_post_meta($post->ID, '_descripcion_corta', true);

   /*$marca = get_post_meta($post->ID, '_marca', true);
   $precio = get_post_meta($post->ID, '_precio', true);
   $talla = get_post_meta($post->ID, '_talla', true);
	*/
   // Mostramos los campos de texto donde introduciremos los atributos
   echo '<p>Descripcion Corta</p>';
   //echo '<input type="text" name="_descripcion_corta" value="' . $marca . '" class="widefat descripcionCorta" maxlength="200" />';
   echo '<textarea name="_descripcion_corta" cols="40" rows="5"  class="widefat">'.$descripcion_corta.'</textarea>';
  /* echo '<p>Precio</p>';
   echo '<input type="text" name="_precio" value="' . $precio . '" class="widefat" />';
   echo '<p>Talla</p>';
   echo '<input type="text" name="_talla" value="' . $talla . '" class="widefat" />';
   */
}

// Guarda los campos personalizados
function save_recetas_meta($post_id, $post)
{
   // Comprobación de seguridad para que no se acceda desde otros sitios
   if ( !wp_verify_nonce( $_POST['recetameta_noncename'], plugin_basename(__FILE__) )) {
      return $post->ID;
   }

   // Comprobación de que el usuario actual puede editar
   if ( !current_user_can( 'edit_post', $post->ID ))
      return $post->ID;

   // Obtenemos los atributos guardados en POST cuando guardamos nuestra página de artículo
   $articulos_meta['_descripcion_corta'] = $_POST['_descripcion_corta'];
   /*$articulos_meta['_precio'] = $_POST['_precio'];
   $articulos_meta['_talla'] = $_POST['_talla'];
   */

   // Guardamos los valores de los atributos como campos personalizados
   foreach ($articulos_meta as $key => $value)
   {
      if( $post->post_type == 'revision' ) return; // No guardamos si el post es una revisión
      if(get_post_meta($post->ID, $key, FALSE))
      {
         // Si el atributo ya existía, lo actualizamos
         update_post_meta($post->ID, $key, $value);
      }
      else
      {
         // Si no existía, lo añadimos nuevo
         add_post_meta($post->ID, $key, $value);
      }

      // Si el valor está en blanco, eliminamos el atributo
      if(!$value) delete_post_meta($post->ID, $key);
   }
}

// Llamamos a guardar los atributos cuando guardemos el artículo
add_action('save_post', 'save_recetas_meta', 1, 2);
