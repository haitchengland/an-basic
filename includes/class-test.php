<?php



class ANCMS_Start {
	protected static $_instance = null;
	public $structured_data = null; //Structured data instance.
	public $haitch_data = null; 

	public function __construct() {
		echo '<br>=== IN ANCMS_Start __construct() ===';
		$this->init_hooks();

		//$this->haitch_data = 'Helen England';

		do_action( 'ancms_loaded' );
	}

	public function init_hooks() {
		echo '<br>=== IN ANCMS_Start init_hooks() ===';
		$this->haitch_data = 'Helen England 2';
		echo '<pre>init_hooks() : ';
		echo $this->get_haitch_data();
		print_r($this->get_structured_data());
		echo '</pre>';

		
		add_action( 'init', array( $this, 'init' ), 0 );
		//$this->structured_data = new ANCMS_Data(); // Structured Data class, generates and handles structured data
		
	}

	public function get_haitch_data() {
		return $this->haitch_data;
	}

	public function get_structured_data() {
		return $this->structured_data;
	}

	public function init() {
		echo '<br>=== IN ANCMS_Start init() ===';
		$this->structured_data = new ANCMS_Data(); // Structured Data class, generates and handles structured data
		echo '<pre>init : ';
		echo $this->get_haitch_data();
		print_r($this->get_structured_data());
		echo '</pre>';
		}
	public static function instance() {
		echo '<br>=== IN ANCMS_Start instance() ===';
		if ( is_null( self::$_instance ) ) {
			echo '<br>=== IN ANCMS_Start instance() New Instance ===';
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}

function WC() {
	return ANCMS_Start::instance();
}
// Global for backwards compatibility.
$GLOBALS['ancms'] = WC();


class ANCMS_Breadcrumb {
	private $crumbs = array();

	public function add_crumb ( $name, $link = '') {
		$this->crumbs[] = array(
			strip_tags( $name ),
			$link,
		);
	}

	public function get_breadcrumb() {
		echo '<br>=== IN ANCMS_Breadcrumb get_breadcrumb() ===';
		return apply_filters( 'ancms_get_breadcrumb', $this->crumbs, $this );
	}

	public function generate() {
		echo '<br>=== IN ANCMS_Breadcrumb generate() ===';
		$this->add_crumb( 'test 1', 'http://dev.autonerd.co.uk/test1');
		$this->add_crumb( 'test 2', 'http://dev.autonerd.co.uk/test2');
		$this->add_crumb( 'test 3', 'http://dev.autonerd.co.uk/test3');
		$this->add_crumb( 'test 4', 'http://dev.autonerd.co.uk/test4');
		$this->add_crumb( 'test 5', 'http://dev.autonerd.co.uk/test5');

		return $this->get_breadcrumb();
	}
}


class ANCMS_Data {
	private $_data = array();

	public function __construct() {	
		echo '<br>=== IN ANCMS_Data __construct() ===';
		add_action( 'ancms_breadcrumb_1', array( $this, 'generate_breadcrumblist_data' ), 10 );
	}

	public function get_data() {
		return $this->_data;
	}

	public function set_data( $data, $reset = false ) {
		if ( ! isset( $data['@type'] ) || ! preg_match( '|^[a-zA-Z]{1,20}$|', $data['@type'] ) ) {
			return false;
		}

		if ( $reset && isset( $this->_data ) ) {
			unset( $this->_data );
		}

		$this->_data[] = $data;

		return true;
	}

	public function output_structured_data() {
		$types = $this->get_data_type_for_page();

		if ( $data = wc_clean( $this->get_structured_data( $types ) ) ) {
			echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>';
		}
	}

	protected function get_data_type_for_page() {
		$types   = array();
		$types[] = is_shop() || is_product_category() || is_product() ? 'product' : '';
		$types[] = is_shop() && is_front_page() ? 'website' : '';
		$types[] = is_product() ? 'review' : '';
		$types[] = ! is_shop() ? 'breadcrumblist' : '';
		$types[] = 'order';

		return array_filter( apply_filters( 'woocommerce_structured_data_type_for_page', $types ) );
	}

	public function generate_breadcrumblist_data( $breadcrumbs, $args ) {
		echo '<br>=== IN ANCMS_Data generate_breadcrumblist_data() ===';
		$crumbs = $breadcrumbs->get_breadcrumb();

		if ( empty( $crumbs ) || ! is_array( $crumbs ) ) {
			//return;
		}

		$markup                    = array();
		$markup['@type']           = 'BreadcrumbList';
		$markup['itemListElement'] = array();

		foreach ( $crumbs as $key => $crumb ) {
			$markup['itemListElement'][ $key ] = array(
				'@type'    => 'ListItem',
				'position' => $key + 1,
				'item'     => array(
					'name' => $crumb[0],
				),
			);

			if ( ! empty( $crumb[1] ) && sizeof( $crumbs ) !== $key + 1 ) {
				$markup['itemListElement'][ $key ]['item'] += array( '@id' => $crumb[1] );
			}
		}

		$this->set_data( apply_filters( 'ancms_structured_data_breadcrumblist', $markup, $breadcrumbs ) );
		
	}
}
?>
