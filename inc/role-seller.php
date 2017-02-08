<?php
/**
 * WooCommerce role seller
 *
 * @author Brasa
 */
class Woo_Seller_Role{
	public function __construct() {
		$this->add_role();
		add_action( 'admin_enqueue_scripts', array($this,'scripts') );
		add_action( 'wp_ajax_woo_stock', array($this,'ajax_woo_stock') );
		add_action( 'admin_init', array($this,'admin_init'), 9999);
		add_action( 'admin_footer', array($this,'add_modal') );
		add_action( 'current_screen', array($this,'redirect') );
		add_action( 'woocommerce_prevent_admin_access', array($this,'remove_woocommerce_redirect'), 99999999 );
		//add_filter( 'role_has_cap', array( $this, 'check_user_cap' ), 99999999999 );
		add_action( 'add_meta_boxes', array($this,'remove_meta_boxes'), 9999999999999 );
	}
	public function remove_meta_boxes( $post_type = null, $post = null ) {
		global $wp_meta_boxes;
		if( $this->get_user_role() == 'woo_seller' ) {
			foreach ( (array) $wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ] as $metabox  => $value ) {
				if ( $value['id'] != 'woocommerce-product-data' ) {
					unset( $wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ][ $metabox ] );
				}
			}
			//echo json_encode( $wp_meta_boxes[ 'product' ], true );
			foreach ( (array) $wp_meta_boxes[ 'product' ][ 'normal' ][ 'high' ] as $metabox  => $value ) {
				if ( $value['id'] != 'woocommerce-product-data' ) {
					unset( $wp_meta_boxes[ 'product' ][ 'normal' ][ 'high' ][ $metabox ] );
				}
			}
			$wp_meta_boxes[ 'product' ][ 'normal' ][ 'low' ] = array();
			$wp_meta_boxes[ 'product' ][ 'normal' ][ 'default' ] = array();
			$wp_meta_boxes[ 'product' ][ 'advanced' ][ 'high' ] = array();
			$wp_meta_boxes[ 'product' ][ 'side' ][ 'low' ] = array();

			//die();

			//echo json_encode( $wp_meta_boxes[ 'product' ][ 'normal' ][ 'core' ] );
		}
	}

	private function get_user_role() {
		global $current_user;

		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);

		return $user_role;
	}
	public function ajax_woo_stock(){
		if(is_user_logged_in() && $this->get_user_role() == 'woo_seller'){
			$id = $_POST['id'];
			$value = $_POST['value'];
			update_post_meta( $id, '_stock', $value);
			echo 'true';
		}
        die();
	}
	public function redirect(){
		if($this->get_user_role() != 'woo_seller')
			return;

		$current_screen = get_current_screen();
		if($current_screen->base != 'edit' || $_GET['post_type'] != 'product'){
			//wp_redirect(admin_url('edit.php?post_type=product' ));
			//die();
		}
	}
	public function scripts(){
		$template_url = get_template_directory_uri();
		//wp_enqueue_script( 'woo-role-js', $template_url . '/assets/js/role.js', array(), null, true );
	}
	private function add_role(){
		add_role(
			'woo_seller',
			__( 'Seller', 'odin' ),
			array(
                'read'              => true,
                'product'           => true,
                'edit_product'      => true,
                'edit_others_products'=> true,
                'edit_products' => true,
                'edit_post' => true,
                'edit' => true,
                'level_9' => true,
                'assign_product_terms' => false,
            )
		);
	}
	public function admin_init(){
		global $wp_taxonomies;
	    // gets the author role
		$role = get_role( 'woo_seller' );
		$role->add_cap( 'edit_others_products' );
		$role->add_cap( 'edit_products' );
		$role->add_cap( 'edit_product' );
		$role->add_cap( 'edit_other_product' );
		$role->add_cap( 'edit_other_products' );
		$role->add_cap( 'edit_others_products' );
		$role->add_cap( 'edit_published_products' );
		$role->add_cap( 'edit' );

		// remove taxonomies
		if ( $this->get_user_role() == 'woo_seller' ) {
			foreach ( (array) $wp_taxonomies as $tax => $tax_obj ) {
				$wp_taxonomies[ $tax ]->show_ui = false;
			}
		}
	}
	public function add_modal(){
		add_thickbox();
	}
	public function remove_woocommerce_redirect( $value ) {
		if ( is_user_logged_in() ) {
			if ( $this->get_user_role() == 'woo_seller' ) {
				return false;
			}
		}
		return $value;
	}

}
new Woo_Seller_Role();
?>
