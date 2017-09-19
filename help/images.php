<?php

/**
 * Different ways of loading images
 */
	
	global $registry;
	$header = $registry->get( 'header' );

	

	//wp_get_attachment_image( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false, string|array $attr = '' )
	//wp_get_attachment_image_src( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false )
	//wp_get_attachment_image_srcset( int $attachment_id, array|string $size = 'medium', array $image_meta = null )
	$size2 = array('700','900');
	$size2_output = '700x900';
	$img_atts = array(
 		'src'   => wp_get_attachment_image_url( $entry['slide_image_id'], $img_size_class, false ),
      	'alt'   => trim(strip_tags( get_post_meta( $entry['slide_image_id'], '_wp_attachment_image_alt', true) ) )
      	'class' => 'attachment-' . $size2_output . ' size-' . $size2_output . ' haitch-test',
      	'data-original' => 'haitch-test2',
      	'data-original2' => 'haitch-test3'
	);
	

	//If an 'alt' attribute was not specified, try to create one from attachment post data
	if( empty( $img_atts[ 'alt' ] ) )
	  $img_atts[ 'alt' ] = trim(strip_tags( $attachment->post_excerpt ));
	if( empty( $img_atts[ 'alt' ] ) )
	  $img_atts[ 'alt' ] = trim(strip_tags( $attachment->post_title ));

	$size = 'full';

	echo '<pre>';
	print_r($header['ancms_logos_options']['ancms_standard_logo']);
	print_r($header['ancms_logos_options']['ancms_retina_logo']);

	print_r( wp_get_attachment_image( $header['ancms_logos_options']['ancms_standard_logo'], $size ) );
	//<img width="184" height="100" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/logo.png" class="attachment-full size-full" alt="">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], 'thumbnail' ));
	//<img width="150" height="150" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-150x150.jpg" 
	//class="attachment-thumbnail size-thumbnail" alt="" 
	//srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-150x150.jpg 150w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-100x100.jpg 100w" 
	//sizes="(max-width: 150px) 100vw, 150px">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], 'medium' ));
	//<img width="300" height="225" 
	//src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg" 
	//class="attachment-medium size-medium" alt="" 
	//srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w" 
	//sizes="(max-width: 300px) 100vw, 300px">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], 'large' ));
	//<img width="1024" height="768" 
	//src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg" 
	//class="attachment-large size-large" alt="" 
	//srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w" 
	//sizes="(max-width: 1024px) 100vw, 1024px">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], 'full' ));
	//<img width="1080" height="810" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg" 
	//class="attachment-full size-full" alt="" 
	//srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w,
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w" 
	//sizes="(max-width: 1080px) 100vw, 1080px">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], array('500','440') ));
	//<img width="500" height="375" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg" class="attachment-500x440 size-500x440" alt="" srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w" sizes="(max-width: 500px) 100vw, 500px">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], array('700','900') ));
	//<img width="700" height="525" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg" class="attachment-700x900 size-700x900" alt="" srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w" sizes="(max-width: 700px) 100vw, 700px">

	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], 'full', '', ['class' => 'haitch-test', 'data-original' => 'haitch-test2'] ));
	//<img width="1080" height="810" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg" 
	//class="haitch-test" alt="" 
	//data-original="haitch-test2" 
	//srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w, 
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w" 
	//sizes="(max-width: 1080px) 100vw, 1080px">

	$img_atts = array(
	  //'src'   => wp_get_attachment_image_url( $entry['slide_image_id'], $img_size_class, false ),
	  //'class' => 'attachment-' . $img_size_class . ' size-' . $img_size_class,
	  //'alt'   => trim(strip_tags( get_post_meta( $entry['slide_image_id'], '_wp_attachment_image_alt', true) ) )
	  'class' => 'haitch-test',
	  'data-original' => 'haitch-test2',
	  'data-original2' => 'haitch-test3'
	);
	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], 'full', '', $img_atts ));
	//<img width="1080" height="810" src="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg" class="haitch-test" alt="" data-original="haitch-test2" data-original2="haitch-test3" srcset="http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57.jpg 1080w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-300x225.jpg 300w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-768x576.jpg 768w, http://dev.autonerd.co.uk/wp-content/uploads/2017/09/c81fd5e6-ba63-313c-9007-68a8419dce57-1024x768.jpg 1024w" sizes="(max-width: 1080px) 100vw, 1080px">

	$size2 = array('700','900');
	$size2_output = '700x900';
	$img_atts = array(
	  //'src'   => wp_get_attachment_image_url( $entry['slide_image_id'], $img_size_class, false ),
	  //'class' => 'attachment-' . $img_size_class . ' size-' . $img_size_class,
	  //'alt'   => trim(strip_tags( get_post_meta( $entry['slide_image_id'], '_wp_attachment_image_alt', true) ) )
	  'class' => 'attachment-' . $size2_output . ' size-' . $size2_output . ' haitch-test',
	  'data-original' => 'haitch-test2',
	  'data-original2' => 'haitch-test3'
	);
	print_r(wp_get_attachment_image( $header['ancms_logos_options']['ancms_retina_logo'], $size2, '', $img_atts ));



	print_r(wp_get_attachment_image_src( $header['ancms_logos_options']['ancms_standard_logo'], $size));
		/*Array
		(
		    [0] => http://dev.autonerd.co.uk/wp-content/uploads/2017/09/logo.png
		    [1] => 184
		    [2] => 100
		    [3] => 
		)*/
		
	print_r( wp_get_attachment_image_src( $header['ancms_logos_options']['ancms_standard_logo'], $size)[0] );
	//http://dev.autonerd.co.uk/wp-content/uploads/2017/09/logo.png