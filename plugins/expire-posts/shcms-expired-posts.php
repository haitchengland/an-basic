<?php
/**
 * Inisiation php file for expire posts
 *
 * This is a work in progress and is not used currently
 *
 * @package AutoNerdFramework
 * @subpackage AutoNerdTemplate
 * 
 * File Version 0.0.1
 *
 * Useful pages
 * https://gist.github.com/franz-josef-kaiser/2930190 
 * http://jamescollings.co.uk/blog/wordpress-create-custom-post-status/
 * http://wordpress.stackexchange.com/questions/89351/new-post-status-for-custom-post-type
 * https://paulund.co.uk/register-new-post-status
 */

$expired_posts_plugin_active = false;

if ( $expired_posts_plugin_active ) {


	/**
	 * Add expired to post status
	 * This does not show up on the post page drop down, see function sh_append_post_status_list for this functionality
	 * https://codex.wordpress.org/Function_Reference/register_post_status
	 */
	function sh_expired_post_status() {
	  register_post_status( 'expired', array(
	    'label'                     => _x( 'Expired', 'sh_news' ), //not sure if you will need to add one for each post type???
	    'public' 					=> false,
	    'exclude_from_search' 		=> true,
	    'show_in_admin_all_list' 	=> true,
	    'show_in_admin_status_list' => true
	    'label_count'               => _n_noop( 'Expired Post <span class="count">(%s)</span>', 'Expired <span class="count">(%s)</span>' ), 
	  ) );

	}
	add_action( 'init', 'sh_expired_post_status' );

	/**
	 * This displays the value in the post edit dropdown. This need editing as I dont think its quite upto date
	 * http://jamescollings.co.uk/blog/wordpress-create-custom-post-status/
	 * http://wordpress.stackexchange.com/questions/89351/new-post-status-for-custom-post-type
	 * https://paulund.co.uk/register-new-post-status
	 */
	add_action('admin_footer-post.php', 'sh_append_post_status_list'); //Fires on the post edit page
	function sh_append_post_status_list(){
	 global $post;
	 $complete = '';
	 $label = '';
	 if($post->post_type == 'sh_news'){ //again needed for each post type
	      if($post->post_status == 'expired'){
	           $complete = ' selected=\"selected\"';
	           $label = '<span id=\"post-status-display\"> Aggregated</span>';
	      }
	      echo '
	      <script>
	      jQuery(document).ready(function($){
	           $("select#post_status").append("<option value=\"aggregated\" '.$complete.'>Aggregated</option>");
	           $(".misc-pub-section label").append("'.$label.'");
	      });
	      </script>
	      ';
	  }
	}


	/**
	 * Schedule daily cronjob
	 * https://codex.wordpress.org/Function_Reference/wp_schedule_event
	 * https://generatewp.com/schedule_event/
	 */

	// Custom Cron Recurrences
	function custom_cron_job_recurrence( $schedules ) {
	  $schedules['5 minute'] = array(
	    'display' => __( '5 minute', 'textdomain' ),
	    'interval' => 300,
	  );
	  return $schedules;
	}
	//add_filter( 'cron_schedules', 'custom_cron_job_recurrence' );

	// Schedule Cron Job Event
	function sh_expire_posts_cron_job() {
	  if ( ! wp_next_scheduled( 'sh_expire_posts' ) ) {
	    wp_schedule_event( time(), '5 minute', 'sh_expire_posts' );
	  }
	}
	//add_action( 'wp', 'sh_expire_posts_cron_job' );


	/**
	 * Update post with new post status if date is older than expiry
	 * @return [type] [description]
	 */
	function sh_expire_posts( ) {
	  	$today = date('Ymd');
 		$args = array(
            'post_type' => 'sh_news', // this obviously needs all the posttypes pressent
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                   'key' => 'shcms_post_expires',
                   'value' => (int)$today, // have to cast it to int for the query to pick up any posts
                   'compare' => '<',
                   'type' => 'numeric',
                )
            )
        );

		$query = new WP_Query( $args );

		if ( $query -> have_posts() ) { 
			while ( $query -> have_posts() ) {
				$query -> the_post(); 

				wp_update_post( array(
			    	'id'    => $post->ID, 
			    	'post_status' => 'expired'
			  	));
			}	
		}

	}


}

/*
	Testing code used in a page that I can see the output of the query

    <?php echo 'date: ' . date('Ymd'); 

    global $wp_query;
    
    echo '<pre>';
    //print_r($wp_query);
    echo '</pre>';

    $today = date('Ymd');

      $args = array(
            'post_type' => 'sh_news',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                   'key' => 'shcms_post_expires',
                   'value' => (int)$today,
                   'compare' => '<',
                   'type' => 'numeric',
                )
            )
        );

      $query = new WP_Query( $args );

      echo '<pre>';

    print_r($query);
    echo '</pre>';

     // if ( $query -> have_posts() ) { 
     //   while ( $query -> have_posts() ) {
     //       $query -> the_post(); 
            
     //       wp_update_post( array(
     //           'id'    => $post->ID, 
     //           'post_status' => 'expired'
     //         ));
      //    }
     // }
 */
?>