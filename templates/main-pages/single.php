<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

//log_back(array('page' => 'plugin single.php'));

get_header();
 ?>



<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
			
					echo '<pre>';
						echo '<h3>Get Terms for Post</h3>';
						$terms = get_the_terms( get_the_ID(), 'vehical_makes_and_models');
						//print_r($terms);

						foreach ($terms as $term) {
							echo 'Name: ' . $term->name . '<br>';
							echo 'Desc: ' . $term->description . '<br>';
							echo 'Discontined: ' . get_field('ancms_discontined', $term ) . '<br>';
							echo 'Text Field: ' . get_field('testteste', $term ) . '<br>';
							//print_r($term);
							//print_r(get_queried_object());
							//print_r(get_field('ancms_discontinued', $term ));
							//print_r(get_fields( $term ));
							echo '<br><br>';
						}

						echo '<h3>Get disccontined for Test Model</h3>';
						//print_r(get_term_by( 'name', 'Test Model', 'vehical_makes_and_models' ));
						//print_r(get_term_by( 'slug', 'test-tax-model', 'vehical_makes_and_models' ));
						//print_r(get_term_by( 'id', 7, 'vehical_makes_and_models' ));
						echo 'Discontined: ' . get_field('ancms_discontined', get_term_by( 'slug', 'test-tax-model', 'vehical_makes_and_models' ) ) . '<br>';
					echo '</pre>';


					if( have_rows('ancms_page_builder') ):
						echo '<pre>Haitch Test 2 ';
					    echo print_r(get_field('ancms_page_builder'));
					    echo '</pre>';
					     // loop through the rows of data
					    while ( have_rows('ancms_page_builder') ) : the_row();


							$test1 = get_sub_field('test_3');
					        $test2 = get_sub_field('test_33');
					      
					      // echo get_row_layout();

							ancms_get_template_part( 'template-parts/fc', get_row_layout()); 

							//if you want vaibles included use the following
							include( ancms_get_template_part( 'template-parts/fc', get_row_layout(), false ) );

							//this will get fc-templatename.php, if no template just fc.php

					        if( get_row_layout() == 'test_3' ):

					        	the_sub_field('test_3');
					        	the_sub_field('test_33');

					        elseif( get_row_layout() == 'download' ): 

					        	$file = get_sub_field('file');

					        endif;

					    endwhile;

					else :

					    // no layouts found

					endif;




					get_template_part( 'template-parts/post/content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					the_post_navigation( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
					) );

				endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
