<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';
function wpjobContactForm() { 
echo"hi";
exit;
	/* if(mail('sharad.kolhe@wwindia.com', 'My Subject', "test")){ echo "Sent";  }else{ echo "Not sent"; } exit; */

  if ( isset( $_POST['scf_nonce'] ) && wp_verify_nonce( $_POST['scf_nonce'], 'scf_html' ) ) {

	$name = sanitize_text_field($_POST['contactName']);
	$email = sanitize_email($_POST['UsrEmail']);
	$receiverEmail = sanitize_email($_POST['receiverEmail']);
	$message = wp_kses_data($_POST['message']);
	//echo $message;
	$blog_title = get_bloginfo('name');
	$user_mailid=sanitize_text_field($_POST['reciver_email']); echo $user_mailid;
	$fullName=sanitize_text_field($_POST['fullname']);
	$profpic=sanitize_text_field($_POST['profpic']);
	//echo $profpic;
	$emailTo = $user_mailid;
	//echo $emailTo;
	$subject = "Message from ".$blog_title; 
	$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
	
	$main_image   = get_stylesheet_directory_uri()."/images/wc-mailer.png";
	$logo_image =get_stylesheet_directory_uri()."/images/CareerImLogo.png";
	$fb=get_stylesheet_directory_uri()."/images/wc-f.png";
	$tw=get_stylesheet_directory_uri()."/images/wc-t.png";
	$go=get_stylesheet_directory_uri()."/images/wc-g.png";

	$home_url = get_home_url();

	$mail_links = $home_url."/resumes/";
	
    /******** Email Template integration code end  **********/


	$mail_content ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Career-I-am</title>
  <style>
   table {border-collapse:collapse; table-layout:fixed; width:550px;}
   table td {  word-wrap:break-word; }
   </style>
</head>
  
<body style="margin:0; padding:0; ">
  <table width="550" style="margin:0 auto; "  cellspacing="0" cellpadding="0" border="0">
    <tr width="550" style=" background:#404040;margin:0; padding:0; ">
      <td style="margin:0 auto; padding:25px 0; text-align:center;" >
        <img src="'.$logo_image.'" alt="Logo"  />
      </td>
    </tr>
    <tr width="550" style="margin:0; padding:0; ">
      <td style="margin:0 auto; text-align:center;" >
        <img src="'.$main_image.'" alt="Main Image"  />
      </td>
    </tr>
  </table> 
    <table width="550" style="background:#f7f7f7; display:block; margin:0 auto;" cellspacing="0" cellpadding="0" border="0">
      <tr  style="float:left; width:474px; display:block; margin:0;padding:0 38px; ">
        <td style="font-size:51px;color: #28a4c4; float:left; width:474px; font-weight:bold; margin:0 auto; text-align:center; padding:20px 0 2px 0;" >
         MESSAGE
        </td>
      </tr>
      <tr  style="float:left; width:474px; display:block; margin:0;padding:0 38px  ">
        <td style="color:#9a9a9a; font-size:18px; text-align:center;font-weight:bold; width:474px; float:left;"> You have a message from</td>
      </tr>
     
      <tr style="float:left; width:488px; display:block; margin:35px 31px 40px;padding:30px 0; background:url(http://careeriam.phpdevelopment.co.in/wp-content/themes/careeriam/images/wc-bg.jpg)no-repeat; ">
        <td style=" width:130px; float:left; margin:0 0 0 25px;"> 
          <img src="'.$profpic.'" alt="Profile pic" width="113" height="113"/>
        </td>
        <td style=" width:300px; float:right; color:#fff; padding: 0 10px 0 0;"> 
            <h3 style="margin:0;">'.$fullName.'</h3>
            <p style="font-size: 14px;">'.$message.'</p>
            <p style="float:right; width:190px;">
              <a href="'.$mail_links.'" style="display:inline; color:#fff; width:98px; height:34px; line-height:34px; padding:0 12px;">IGNORE</a>
              <a href="'.$mail_links.'" style="display:inline-block; color:#fff; text-decoration:none; width:98px; height:34px; line-height:34px; text-align:center; background: #2ba7ca !important; background: -moz-linear-gradient(-45deg,  #2ba7ca 0%, #3bb9bc 49%, #41bfb0 52%, #46c79c 100%) !important; background: -webkit-linear-gradient(-45deg,  #2ba7ca 0%,#3bb9bc 49%,#41bfb0 52%,#46c79c 100%) !important; background: linear-gradient(135deg,  #2ba7ca 0%,#3bb9bc 49%,#41bfb0 52%,#46c79c 100%) !important;">REPLY</a>
            </p>
        </td>
      </tr>
    </table>
    <table width="550" style="background:#f7f7f7; display:block; margin:0 auto;" cellspacing="0" cellpadding="0" border="0">
        <tr width="550" style="background-color:#43c499;">
            <td style="text-align:center; width:550px;">
               <ul style="margin:0; padding:24px 0 20px 0;">
                  <li style="margin: 0; padding: 0; list-style-type: none; display: inline-block;">
                    <a href="#" style="margin: 0;  list-style-type: none; border-right: 1px solid #fff; text-decoration: none; color:#fff; font-size: 16px; padding: 0 15px 0 15px;">Jobs</a></li>

                  <li style="margin: 0; padding: 0; list-style-type: none; display: inline-block;">
                    <a href="#" style="margin: 0;  list-style-type: none; border-right: 1px solid #fff; text-decoration: none; color:#fff; font-size: 16px; padding: 0 15px 0 15px;">Members</a></li>

                  <li style="margin: 0; padding: 0; list-style-type: none; display: inline-block;">
                    <a href="#" style="margin: 0;  list-style-type: none; border-right: 1px solid #fff; text-decoration: none; color:#fff; font-size: 16px; padding: 0 15px 0 15px;">Companies</a></li>

                  <li style="margin: 0; padding: 0; list-style-type: none; display: inline-block;">
                    <a href="#" style="margin: 0;  list-style-type: none; text-decoration: none; color:#fff; font-size: 16px; padding: 0 15px 0 15px;">Contact Us</a></li>

               </ul> 
          </td>
    </tr>

    <tr width="550" style="background-color:#43c499;">
         <td style="text-align:center; padding:0 0 22px 0; margin:0; width:550px;">
             <a href="#"><img src="'.$fb.'" alt="Facebook"></a>
             <a href="#"><img src="'.$tw.'" alt="Twitter"></a>
             <a href="#"><img src="'.$go.'" alt="Google"></a>
         </td>
    </tr>
    <tr width="550" style="background-color:#2aa6c9;">
        <td style="font-size:12px; color:#fff; text-align:center; padding:15px 0 15px 0; margin:0; width:550px;">
          <a href="#" style="color:#fff; text-decoration:none;">www.careeriam.com</a> - Copyright 2015
        </td>
    </tr>
    </table>

  
</body>
</html>
';
	include($_SERVER['DOCUMENT_ROOT'].'/PHPMailer-master/PHPMailerAutoload.php');

		ini_set('display_errors','1');
		error_reporting(E_ALL);

            echo $emailTo;

			$from =  get_option('admin_email');
			//echo "string",$from;
		$from_name = 'From Careeriam website';
		$subject = $subject;

		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->IsHTML(true);
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'mail.phpdevelopment.co.in';
		$mail->Port = 25;
		$mail->Username = "testing@careeriam.phpdevelopment.co.in";
		$mail->Password = "T2[-+Do_rAyw";
		$mail->SetFrom($from, $from_name);
		$mail->Subject = $subject;
		$mail->Body = $mail_content;
		// $mail->AddAddress($mgmtEmail);
		$mail->AddAddress($emailTo);

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

	
	/********* Email Template integration code end *********/
	
	//$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
	if ($mail->Send()) {
				echo "sent";
				$send = 1;
		  
		 } else {
		
		 		echo "not sent";
				$send = 0;
		 }
	  return $send;
	//wp_mail($emailTo, $subject, $body, $headers);

  } else {

  }
 
  die(); // this is required to return a proper result

}

add_action( 'wp_ajax_wpjobContactForm', 'wpjobContactForm' );
add_action( 'wp_ajax_nopriv_wpjobContactForm', 'wpjobContactForm' );
