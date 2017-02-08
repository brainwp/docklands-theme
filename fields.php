<?php if(function_exists("register_field_group")){
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_contact-us',
		'title' => 'Contact Us',
		'fields' => array (
			array (
				'key' => 'field_54d29fd4c4970',
				'label' => 'E-mail',
				'name' => 'contact-email',
				'type' => 'email',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_54d2a2ba90fa1',
				'label' => 'Office Phone',
				'name' => 'contact-tel-office',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a3935f258',
				'label' => '24hr Hot Line',
				'name' => 'contact-tel-hot-line',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a47681e57',
				'label' => 'Hours Monday',
				'name' => 'contact-hr-monday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a4d8d7b19',
				'label' => 'Hours Tuesday',
				'name' => 'contact-hr-tuesday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a68dd7ba0',
				'label' => 'Hours Wednesday',
				'name' => 'contact-hr-wednesday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a5a08408d',
				'label' => 'Hours Thursday',
				'name' => 'contact-hr-thursday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a794a7d34',
				'label' => 'Hours Friday',
				'name' => 'contact-hr-friday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a794aewweieiw994944',
				'label' => 'Hours Saturday',
				'name' => 'contact-hr-saturday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a799a7d35',
				'label' => 'Hours Sunday',
				'name' => 'contact-hr-sunday',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54d2a7f0bba2f',
				'label' => ' Map',
				'name' => 'contact-map',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_criobba2l0f',
				'label' => 'Link to Google Maps',
				'name' => 'contact-map-link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_color',
		'title' => 'Color',
		'fields' => array (
			array (
				'key' => 'field_558c1f73971f1',
				'label' => 'Image',
				'name' => 'color_img',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'color',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
//add woocommerce fields
function brasa_woocommerce_product_options_shipping(){
	woocommerce_wp_textarea_input(array(
		'id' => 'woo_shipping_content',
		'label' => __('Shipping description', 'odin')
		)
	);
}
add_action('woocommerce_product_options_shipping','brasa_woocommerce_product_options_shipping');
function brasa_save_woocommerce($id){
	if(empty($_POST['woo_shipping_content']))
		return;
	update_post_meta( $id, 'woo_shipping_content', $_POST['woo_shipping_content'], null );
}
add_action('save_post_product','brasa_save_woocommerce');
