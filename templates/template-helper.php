<?php



//add_filter( 'template_include', 'ancms_template_include', 99 );

function ancms_template_include( $template ) {

    $pt = sh_get_post_type();
    echo '<pre>' . $template . '</pre>';
    switch ($pt) {
        case "sh_new_car_":
           // $new_template = locate_template( array( "ancms/test-template.php", "ancms/test-template-new-car.php" ) );
           // if( !$new_template )
           // {
           //     $new_template = ANCMS_TEMPLATE_PATH . "test-template.php";
           // }
           // break;
        case "blue":
            echo "Your favorite color is blue!";
            break;
        case "green":
            echo "Your favorite color is green!";
            break;
        default:
            echo "Your favorite color is neither red, blue, nor green!";
    }

	if ( is_page( 'portfolio' )  ) {
		$new_template = locate_template( array( 'portfolio-page-template.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}
    echo '<pre>' . $new_template . '</pre>';

    if ( !$new_template ) {
        return $template;
    } else {
        return $new_template;
    }
	
}

function ancms_get_template_part( $slug, $name = null, $load = true ) {
	// Execute code for this part
	do_action( 'get_template_part_' . $slug, $slug, $name ); //get_template_part_template-parts/content


	// Setup possible parts
	$templates = array();
	if ( isset( $name ) )
		$templates[] = $slug . '-' . $name . '.php';
	$templates[] = $slug . '.php';

	// Allow template parts to be filtered
	$templates = apply_filters( 'ancms_get_template_part', $templates, $slug, $name );

    //echo '<pre>Haitch Test ';
    //echo print_r($templates);
    //echo '</pre>';

	// Return the part that is found
	//return ancms_locate_template( $templates, $load, false );
	return ancms_locate_template( $templates, $load, false );
}


function ancms_locate_template( $template_names, $load = false, $require_once = true ) {
	/**
	 * Order of checking theme templates (intems in {} are sent over in slug normally)
	 * Check Child ancms/{template-parts}
	 * check Parent ancms/{template-parts}
	 * check Plugin templates/{template-parts}
	 * check Child {template-parts}
	 * check Parent {template-parts}

	 * @var boolean
	 */
	$located = false;
	// Try to find a template file.
	// 
	
	//echo '<pre>Haitch Test 2 ';
    //echo print_r($template_names);
    //echo '</pre>';


	foreach ( (array) $template_names as $template_name ) {

		//echo '<pre>If Varibles: <br>';
	   // echo trailingslashit( get_stylesheet_directory() ) . 'ancms/' . $template_name . '<br>';
		//echo trailingslashit( get_template_directory() ) . 'ancms/' . $template_name . '<br>';
		//echo trailingslashit( get_stylesheet_directory() ) . $template_name . '<br>';
		//echo trailingslashit( get_template_directory() )  . $template_name . '<br>';
		//echo trailingslashit( ANCMS_TEMPLATE_PATH ) . $template_name . '<br>';
	    //echo '</pre>';

		// Continue if template is empty.
		if ( empty( $template_name ) )
			continue;
		// Trim off any slashes from the template name.
		$template_name = ltrim( $template_name, '/' );

		// Check child theme first.
		if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'ancms/' . $template_name ) ) {
			$located = trailingslashit( get_stylesheet_directory() ) . 'ancms/' . $template_name;
			break;
		// Check parent theme next.
		} elseif ( file_exists( trailingslashit( get_template_directory() ) . 'ancms/' . $template_name ) ) {
			$located = trailingslashit( get_template_directory() ) . 'ancms/' . $template_name;
			break;
		} elseif ( file_exists( trailingslashit( ANCMS_TEMPLATE_PATH ) . $template_name ) ) {
			$located = trailingslashit( ANCMS_TEMPLATE_PATH ) . $template_name;
			break;
		// Check theme compatibility last.
		} elseif ( file_exists( trailingslashit( get_stylesheet_directory() ) . $template_name ) ) {
			$located = trailingslashit( get_stylesheet_directory() ) . $template_name;
			break;
		// Check parent theme next.
		} elseif ( file_exists( trailingslashit( get_template_directory() ) . $template_name ) ) {
			$located = trailingslashit( get_template_directory() ) . $template_name;
			break;
		} 
		// Check child theme first
	}
	//echo '<pre>Haitch Test <br>';
   // echo print_r($located);
    //echo '</pre>';

	if ( ( true === $load ) && ! empty( $located ) )
		load_template( $located, $require_once );
	return $located;
}
