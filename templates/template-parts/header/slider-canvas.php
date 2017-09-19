<?php

$slider_var_1 = array(
	'style' => '', 	// slider-parallax - Enables Parallax Functionality for the Slider Element.
					// boxed-slider - Makes the Slider Boxed within the Container.
					// full-screen - Makes the Slider Full Screen.
					// with-header - Makes the Slider Full Screen with Header Height included. .full-screen class should also be included.
	'slides' => array(
		array(
			'img' => ANCMS_IMAGES_URL . 'slider/swiper/1.jpg',
			'h2' => 'Welcome to Canvas',
			'p' => 'Create just what you need for your Perfect Website. Choose from a wide range of Elements &amp; simply put them on your own Canvas.',
			'classes' => 'dark',
			'caption_bg' => '', // slider-caption-bg (use with dark) | slider-caption-bg slider-caption-bg-light (dont use with dark)
			'caption_padding' => '',
			'position' => 'slider-caption-center', // slider-caption-[ right | center | top-left | top-right | bottom-right ]
		),
		array(
			'img' => '',
			'h2' => 'Beautifully Flexible',
			'p' => 'Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.',
			'classes' => 'dark',
			'caption_bg' => '', // slider-caption-bg (use with dark) | slider-caption-bg slider-caption-bg-light (dont use with dark)
			'caption_padding' => '',
			'position' => 'slider-caption-left', // slider-caption-[ right | center | top-left | top-right | bottom-right 
			'video' => array(
				'poster' => ANCMS_IMAGES_URL . 'videos/explore.jpg',
				'webm' => ANCMS_IMAGES_URL . 'videos/explore.webm',
				'mp4' => ANCMS_IMAGES_URL . 'videos/explore.mp4',
				'background_col' => 'rgba(0,0,0,0.55)',
				),
		),
		array(
			'img' => ANCMS_IMAGES_URL . 'slider/swiper/3.jpg',
			'h2' => 'Great Performance',
			'p' => 'You\'ll be surprised to see the Final Results of your Creation &amp; would crave for more.',
			'classes' => '',
			'caption_bg' => '', // slider-caption-bg (use with dark) | slider-caption-bg slider-caption-bg-light (dont use with dark)
			'caption_padding' => '',
			'position' => 'slider-caption-right', // slider-caption-[ right | center | top-left | top-right | bottom-right ]
		),
	),
	
);

$slider_var_2 = array(
	'style' => '', 	// slider-parallax - Enables Parallax Functionality for the Slider Element.
					// boxed-slider - Makes the Slider Boxed within the Container.
					// full-screen - Makes the Slider Full Screen.
					// with-header - Makes the Slider Full Screen with Header Height included. .full-screen class should also be included.
	'slides' => array(
		array(
			'img' => ANCMS_IMAGES_URL . 'slider/swiper/1.jpg',
			'h2' => 'Welcome to Canvas',
			'p' => 'Create just what you need for your Perfect Website. Choose from a wide range of Elements &amp; simply put them on your own Canvas.',
			'classes' => 'dark',
			'caption_bg' => '', // slider-caption-bg (use with dark) | slider-caption-bg slider-caption-bg-light (dont use with dark)
			'caption_padding' => '',
			'position' => 'slider-caption-center', // slider-caption-[ right | center | top-left | top-right | bottom-right ]
		),
		array(
			'img' => '',
			'h2' => 'Beautifully Flexible',
			'p' => 'Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.',
			'classes' => 'dark',
			'caption_bg' => '', // slider-caption-bg (use with dark) | slider-caption-bg slider-caption-bg-light (dont use with dark)
			'caption_padding' => '',
			'position' => 'slider-caption-left', // slider-caption-[ right | center | top-left | top-right | bottom-right 
			'video' => array(
				'poster' => ANCMS_IMAGES_URL . 'videos/explore.jpg',
				'webm' => ANCMS_IMAGES_URL . 'videos/explore.webm',
				'mp4' => ANCMS_IMAGES_URL . 'videos/explore.mp4',
				'background_col' => 'rgba(0,0,0,0.55)',
				),
		),
		array(
			'img' => ANCMS_IMAGES_URL . 'slider/swiper/3.jpg',
			'h2' => 'Great Performance',
			'p' => 'You\'ll be surprised to see the Final Results of your Creation &amp; would crave for more.',
			'classes' => '',
			'caption_bg' => '', // slider-caption-bg (use with dark) | slider-caption-bg slider-caption-bg-light (dont use with dark)
			'caption_padding' => '',
			'position' => 'slider-caption-right', // slider-caption-[ right | center | top-left | top-right | bottom-right ]
		),
	),
	
);

$slider_var = $slider_var_1;

?>

<!-- <section id="slider" class="slider-parallax swiper_wrapper full-screen with-header clearfix"> -->
<!-- <section id="slider" class="slider-parallax swiper_wrapper clearfix"> -->
<section id="slider" class="slider-parallax swiper_wrapper full-screen with-header clearfix">
	<div class="slider-parallax-inner">

		<div class="swiper-container swiper-parent">
			<div class="swiper-wrapper">
				
				<?php foreach($slider_var['slides'] as $slider ) { ?>

					<div class="swiper-slide <?php echo $slider['classes']; ?>" <?php echo ( $slider['img'] != '' ? 'style="background-image: url(\'' . $slider['img'] . '\')"' : '' ); ?> >

						<div class="container clearfix">
							<div class="slider-caption <?php echo $slider['position']; ?>">
								<h2 data-caption-animate="fadeInUp"><?php echo $slider['h2']; ?></h2>
								<p data-caption-animate="fadeInUp" data-caption-delay="200"><?php echo $slider['p']; ?></p>
							</div>
						</div>
						
						<?php if (isset($slider['video']) && $slider['video'] != '' ) { ?>
							<div class="video-wrap">
								<video id="slide-video" poster="<?php echo $slider['video']['poster']; ?>" preload="auto" loop autoplay muted>
									<?php echo ( $slider['video']['webm'] != '' ? '<source src="' . $slider['video']['webm'] . '" type="video/webm" />' : '' ); ?>
									<?php echo ( $slider['video']['mp4'] != '' ? '<source src="' . $slider['video']['mp4'] . '" type="video/mp4" />' : '' ); ?>
								</video>
								<div class="video-overlay" <?php echo ( $slider['video']['mp4'] != '' ? 'style="background-color: ' . $slider['video']['background_col'] . ';"' : '' ); ?> ></div>
							</div>
						<?php } ?>
					</div>	

				<?php } ?>
			</div>
			<div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
			<div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
		</div>

		<a href="#" data-scrollto="#content" data-offset="100" class="dark one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a>

	</div>
</section>