<?php
/**
 * Plugin description
 *
 * @package   ANCMS
 * @author    Helen England
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 * @copyright 2016 Helen England
 */

/**
 * The core plugin class
 *
 * @package 	ANCMS
 * @author 		Helen England
 */
class Autonerd {
	/**
	 * [$instance description]
	 *
	 * @var [type]
	 */
	private static $instance; // used for singleto patton.

	/**
	 * [$twitter_handle description]
	 *
	 * @var [type]
	 */
	private $twitter_handle;

	/**
	 * [__construct description]
	 */
	public function __construct() {

		$this->twitter_handle = 'tommcfarlin';
		add_filter( 'the_content', array( $this, 'display_twitter_follower_count' ) );
	}

	/**
	 * [get_instance description]
	 *
	 * @return [type] [description]
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * [get_twitter_follower_count description]
	 *
	 * @return [type] [description]
	 */
	private function get_twitter_follower_count() {

		$follower_count = -1;
		// Reguest the HTML from Twitter.
		$response = file_get_contents( 'https://twitter.com/' . $this->twitter_handle . '/' );

		// Parse the markup to find followers.
		preg_match_all( '#<span class="ProfileNav-value" data-is-compact=".+?"\>(.+?)\<\/span\>#', $response, $matches );

		$follower_count = $matches[1][2];

		// Return the follower count, or -1 if isnt found.
		return $follower_count;
	}

	/**
	 * [display_twitter_follower_count description]
	 *
	 * @param  [type] $content [description].
	 * @return [type]          [description]
	 */
	public function display_twitter_follower_count( $content ) {

		if ( ! is_single() ) {;
		} {
			return $content;
		}

		$follower_count = '';
		$follower_count = $this->get_twitter_follower_count();

		if ( '' !== $follower_count && -1 !== $follower_count ) {
			$html = '<div class="twitter-followers">';
				$html .= '<span class="twitter-handle">' . $this->twitter_handle . '</span>';
				$html .= ' has ' . $follower_count . ' followers on Twitter.';
			$html .= '</div>';

			$content .= $html;
		}

		return $content;
	}
}

