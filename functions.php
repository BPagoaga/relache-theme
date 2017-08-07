<?php
/**
 * Relache functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Relache
 */

include('./parameters.php');
$bdd_parameters = new Bdd();

if ( ! function_exists( 'relache_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function relache_setup() {

	/*
	Custome editor styles, allows to match backoffice and front-end styles
	*/
	$stylesheet = 'inc/editor-style.css';
	$font_src = 'css/fonts.css';
	add_editor_style( $stylesheet, $font_src );
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Relache, use a find and replace
	 * to change 'relache' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'relache', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

    // Allow WordPress to customize the header image
    $args = array(
        'default-image' => get_template_directory_uri() . '/img/header/logo_relache_2015.svg',
    );
    add_theme_support( 'custom-header', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large-thumb', 1060, 650, true );
	add_image_size( 'index-thumb', 780, 9999, true );// 9999 allow WP to crop the width of the image but not its height


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'relache' ),
		'social' => esc_html__( 'Social Menu', 'relache' )
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside'//,
		//'image',
		//'video',
		//'quote',
		//'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'relache_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // relache_setup
add_action( 'after_setup_theme', 'relache_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function relache_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'relache_content_width', 600 );
}
add_action( 'after_setup_theme', 'relache_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function relache_widgets_init() {

	//sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'relache' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//footer sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget', 'relache' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__('Footer widget area appears in the footer of the site', 'relache'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'relache_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function relache_scripts() {

	wp_enqueue_style( 'relache-style', get_stylesheet_uri() );

	wp_enqueue_style( 'relache-fonts-local', get_template_directory_uri().'/css/fonts.css' );

	wp_enqueue_style( 'relache-fonts', 'https://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700,700italic');

	wp_enqueue_style( 'relache-font-awesome-local', get_template_directory_uri().'/css/font-awesome.min.css' );

	wp_enqueue_style( 'relache-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'flexbox', get_template_directory_uri().'/css/flexboxgrid.min.css' );

    wp_enqueue_script('relache-normalizr', get_template_directory_uri() . '/js/modernizr-2.7.2.min.js', array(), '20151024', false );

	wp_enqueue_script('relache-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20151006', true );

	wp_enqueue_script( 'relache-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'relache-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'relache-masonry', get_template_directory_uri().'/js/masonry.min.js', array('jquery'), '20151006', true );

	wp_enqueue_script( 'instafeed', get_template_directory_uri().'/js/instafeed.min.js', array(), '20151022', true );

	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'), '20151022', true );

    wp_enqueue_script( 'relache-main-js', get_template_directory_uri().'/js/main.js', array('jquery'), '20151024', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'relache_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';





 	/*======================
     * CONNECTION A LA BDD *
     ======================*/

    function connection(){

        $dsn = $bdd_parameters->getDsn();//serveur et base de données
        $user = $bdd_parameters->getUser(); //login
        $password = $bdd_parameters->getPassword(); // mot de passe

        try{

            $bdd = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        }catch( Exception $e ){
            die('Erreur : '.$e->getMessage());
        }

        return $bdd;

    }





    /*=======================
     * AJOUT EMAIL DANS BDD *
     =======================*/

    function add_email($data){

        $bdd = connection();    //rappel de la connection à chaque page
        $email = htmlentities($data['email']);  //on élimine les caractères spéciaux

        $bdd -> exec('
            INSERT INTO emails (
                id,
                email
                )
            VALUES(
                "",
                "'.$email.'"
                )
            ');
    }





    /*=========================================
     * ON VÉRIFIE QU'IL N'Y A PAS DE DOUBLONS *
     =========================================*/

    function email_exist($data) {

        $bdd = connection();
        $email = htmlentities($data['email']);  //on élimine les caractères spéciaux

        $emails = $bdd -> query(
            'SELECT COUNT(email) AS compteur
            FROM emails
            WHERE email = \''.$email.'\''
        );

        $donnees = $emails->fetch();
        $emails->closeCursor();

        if( $donnees['compteur'] === '0' ){
            return true;
        }
    }





    /*=====================
     * DESINSCRIPTION BDD *
     =====================*/

    function delete_email() {

        $bdd = connection();

        $delete = $bdd -> exec('
            DELETE FROM emails
            WHERE email="'.$_GET['email'].'"
        ');

        $resultat = $delete -> query($bdd);
        if( $resultat )
            echo '<p>Votre email '.$_GET['email'].' a bien été supprimé de notre base de données</p>';
        else
            echo '<p>Cet email ne figure pas dans notre base de données</p>';

    }





    /*=========================================
     *      RECUPERER LA PROG DANS LA BDD     *
     =========================================*/

    function get_prog($i, $j) {     //récupération des évènements pour un mois $i et un jour $j donnés

        $bdd = connection();

        if ($j < 10) {      //les jours sont en "01", etc, mais le compteur j part de 1 => il faut donc ajouter le "0" à la main

            $prog = $bdd->query(
                'SELECT artiste, mois, jour, heure, lieu, image, Type_Art, Pays_Art, Type
                FROM prog
                WHERE mois="0'.$i.'" AND jour="0'.$j.'"
                ORDER BY jour ASC
            ');

        }else{      //quand $j est >=10, plus besoin de rajouter le "0"

            $prog = $bdd->query(
                'SELECT artiste, mois, jour, heure, lieu, image, Type_Art, Pays_Art, Type
                FROM prog
                WHERE mois="0'.$i.'" AND jour="'.$j.'"
                ORDER BY jour ASC
            ');

        }

        while ($programmation = $prog->fetch()){    //récupération des valeurs dans un tableau
            $return[] = $programmation;
        }

        $prog->closeCursor();

        if (!empty($return)) {
            return $return;     //la fonction retourne le tableau s'il n'est pas vide
        }

    }

    function get_prog_lieu($lieu) {     //récupération des évènements à un lieu donné

        $bdd = connection();

        $prog = $bdd->query(
            'SELECT artiste, mois, jour, heure, lieu
            FROM prog
            WHERE lieu="'.$lieu.'"'
        );

        while( $programmation = $prog->fetch() ){
            $return[] = $programmation;
        }

        $prog->closeCursor();

        if (!empty($return)) {
            return $return;
        }else{
            return "Aucun évènement n'est prévu à cet endroit pour le moment";
        }

    }





    /*=========================================
     *   RECUPERER LES ARTISTES DANS LA BDD   *
     =========================================*/

    function get_artiste_infos(){     //récupération de toutes les infos d'un artiste lorsqu'on arrive sur la page artiste via la prog

        $bdd = connection();    //rappel de la connection à chaque page

        $artistes = $bdd->query(
            'SELECT post_id, meta_key, meta_value
            FROM wor1107_postmeta
            WHERE

                meta_key = "artiste" OR
                meta_key = "Type_Art" OR
                meta_key = "Pays_Art" OR
                meta_key = "Desc_Art" OR
                meta_key = "image" OR
                meta_key = "Video" OR
                meta_key = "Site" OR
                meta_key = "Facebook" OR
                meta_key = "Instagram" OR
                meta_key = "Tweeter" OR
                meta_key = "Soundcloud" OR
                meta_key = "Youtube"
        ');


        while ($req = $artistes->fetch() ){
            $artiste[] = $req;

        }

        $artistes->closeCursor();

        //print_r($artiste);




        return $return;

        // $artistes = get_posts(array(
        //     'numberposts' => -1,
        //     'post_type' => 'artistes',
        // ));

        // $post_id = $artistes[0]['ID'];
        // print_r($artistes);
        // echo $post_id;

        // if($artistes)

        // {
        //     foreach($artistes as $artiste)
        //     {
        //         $artiste_info = get_fields($post_id);

        //         if( $artiste_info ) {

        //             //print_r($artiste_info);

        //         }

        //     }

        // }

        //return $artiste;
    }

    function get_events($type) {

        $bdd = connection();    //rappel de la connection à chaque page

        $events = $bdd->query(
            'SELECT Type, mois, jour, lieu, image, Desc_Art, evenement
            FROM prog
            WHERE Type="'.$type.'"
        ');

        while ($event = $events->fetch()){
            $return[] = $event;
        }

        $events->closeCursor();

        return $return;

    }





    /*=========================================
     *    RECUPERER LES LIEUX DANS LA BDD     *
     =========================================*/

    function get_lieu($lieu){   //récupération d'un lieu précis

        $bdd = connection();    //rappel de la connection à chaque page

        $lieu = $bdd->query(
            'SELECT lieu, description
            FROM lieux
            WHERE lieu="'.$lieu.'"'
        );

        $return = $lieu->fetch();
        $lieu->closeCursor();

        return $return;
    }

    function get_lieux(){   //récupération de tous les lieux, le tableau obtenu à la fin sera retourné et éclaté dans un foreach pour créer dynamiquement tous les boutons de filtre par lieu
        $bdd = connection();    //rappel de la connection à chaque page

        $lieu = $bdd->query(
            'SELECT lieu, description
            FROM lieux'
        );

        while ($lieux = $lieu->fetch()){
            $return[] = $lieux;
        }

        $lieu->closeCursor();

        return $return;
    }





    /*=========================================
     *    RECUPERER LES ARTICLES DANS WP      *
     =========================================*/

    function get_articles(){    //récupération des articles du blog pour les afficher sur la page d'accueil
        $bdd = connection();

        $articles = $bdd->query(
            'SELECT ID, post_title, post_author, guid, post_date, post_content, post_status, post_excerpt
            FROM wor1107_posts
            WHERE post_status= "publish" AND post_name REGEXP "^[^acf_]"
            ORDER BY post_date DESC
            LIMIT 3'

        );

        while ($article = $articles->fetch()) {
            $return[] = $article;
        }

        $articles->closeCursor();

        return $return;
    }

    function get_thumbnail($ID){    //récupération du thumbnail, the_thumbnail n'est pas utilisable car index.php n'est pas dans le wordpress
    //$ID correspond à l'id du post + 1, soit la ligne contenant le lien vers l'image

        $bdd = connection();

        $thumbnails = $bdd->query(
            'SELECT guid
            FROM wor1107_posts
            WHERE post_parent= "'.$ID.'" AND post_type= "attachment"
        ');

        $return = $thumbnails->fetch();
        $thumbnails->closeCursor();

        return $return;

    }

    function get_author($ID) {      //récupération de l'auteur : "nicename" de la table users, où ID = post_author de la table posts

        $bdd = connection();

        $authors = $bdd->query(
            'SELECT display_name
            FROM wor1107_users
            WHERE ID= "'.$ID.'"
        ');

        $return = $authors->fetch();
        $authors->closeCursor();

        return $return;

    }





    /*=========================================
     *     RECUPERER LE DERNIER MOT STR       *
     =========================================*/

    function recup_dernier_mot($str) {  //fonction pour découper une chaîne et récupérer le dernier mot

        $str = htmlentities($str);

        $apostrophe = strrpos($str, "'");

        if ($apostrophe) {  //test de la présence d'un apostrophe

            $tab = explode("'", $str); //on explose ce nom dans un tableau à chaque apostrophe

        }else{  //si pas d'apostrophe

            $tab = explode(" ", $str); //on explose ce nom dans un tableau à chaque espace

        }

        $dernier_mot = $tab[count($tab)-1];
        return $dernier_mot;
    }

    function recup_premier_mot($str) {  //fonction pour découper une chaîne et récupérer le premier mot

        $str = htmlentities($str);
        $tab = explode(" ", $str); //on explose ce nom dans un tableau à chaque espace

        if  (count($tab > 0)) {

            $premier_mot = $tab[0];

            if ($premier_mot === "Concert") {
                return $premier_mot;
            }else{
                return $str;
            }
        }
    }





    /*=========================================
     *         RECUPERER LA GALERIE           *
     =========================================*/

    function get_galerie() {    //récupération de la galerie (no shit sherlock !)

        $bdd = connection();

        $galerie = $bdd->query(
            'SELECT Type, Titre, Legende, Auteur, Copyright, Lien
            FROM galerie
        ');

        while ($photo = $galerie->fetch()) {
            $return[] = $photo;
        }

        $galerie->closeCursor();

        if (!empty($return)) {

            return $return;

        }else{
            return "La galerie est vide";
        }
    }





    /*=========================================
     *    PARTENAIRES ORDERED BY TYPE         *
     =========================================*/

    function get_partenaires($type) {

        $bdd = connection();

        $partenaires = $bdd -> query (
            'SELECT lien, Logo, Type
            FROM partenaires
            WHERE Type = "'.$type.'"
            ');

        while ($partenaire = $partenaires -> fetch()){
            $return[] = $partenaire;
        }

        $partenaires -> closeCursor();

        if (!empty($return)) {

            echo '<h3>'.$type.'</h3>';

            return $return;

        }else{
            return "Nous n'avons pas de partenaires pour le moment";
        }
    }






    /* Functions related to advanced custom fields */

    function get_partners($type) {

        $posts = get_posts(array(
            'numberposts' => -1,
            'post_type' => 'partenaires',
            'meta_key' => 'Type', // name of custom field
            'meta_value' => $type
        ));

        if ($posts){ ?>

            <h3 class="col-xs-12"><?php echo $type; ?></h3>

            <?php foreach ($posts as $post) {

                setup_postdata( $post );
                $post_id = $post->ID;
                $fields = get_fields($post_id);

                $logo_partenaire = get_field('logo', $post_id);
                $url_partenaire = get_field('lien', $post_id);

            ?>

            <div class="zone-img col-xs-3">

                <a href="<?php echo $url_partenaire; ?>">
                    <img src="<?php echo $logo_partenaire; ?>" alt="Partenaires Relache">
                </a>

            </div>

            <?php
            } // end foreach

            wp_reset_postdata();

        } // end if
    }

?>