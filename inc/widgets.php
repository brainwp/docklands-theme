<?php
/* Widget Produtos */
class Produtos_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'Produtos_Widget',
			'description' => 'WooCommerce Product List'
		);
		//$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('Produtos_Widget','Widget de Produtos', $widget_ops);
	}

	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_produtos_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$qtd_produtos = apply_filters( 'widget_produtos_qtd_produtos', empty( $instance['qtd_produtos'] ) ? '' : $instance['qtd_produtos'], $instance );
		$cat_produtos = apply_filters( 'widget_produtos_cat_produtos', empty( $instance['cat_produtos'] ) ? '' : $instance['cat_produtos'], $instance );

		echo '<div class="col-md-12 Produtos_Widget produtos-widget">';
		echo '<h3 class="item">' . $title . '</h3>';
		echo '<ul>';

		global $post;

		/* Guarda a variável $post em $temp_post */
		$temp_posts = $post;

		$produtos_posts = get_posts( array(
			'post_type' => 'product',
			'posts_per_page' => $qtd_produtos,
			'_is_wc_query'	=> true,
			'tax_query' => array(
    			array(
      				'taxonomy' => 'product_cat',
      				'field' => 'id',
      				'terms' => $cat_produtos,
      				'include_children' => false
    			)
  			)
		));

		// Start the Loop.
		if( $produtos_posts ) :
			foreach( $produtos_posts as $post ) : setup_postdata( $post );
			$product = wc_get_product( $post->ID );
			echo "<li>";
			echo "<a href=" . get_the_permalink() . ">";
			echo "<div class='thumb col-xs-4 pull-left'>";
				the_post_thumbnail( array( '120', '120' ) );
			echo "</div>";
			echo "<div class='desc col-xs-8 pull-left'>";
			echo "<span class='title'>";
				the_title();
			echo "</span><!-- title -->";
			if( $product->get_sale_price() ){
				echo '<div class="wrap-preco">';
				echo '<span class="moeda-preco">'. get_woocommerce_currency_symbol() . ' </span><span class="price">';
				echo wc_price( $product->get_sale_price(), array( 'currency' => '__false' ) );
				echo "</span><!-- price -->";
				echo "<span class='old-price'>";
				echo wc_price( $product->get_regular_price(), array( 'currency' => '__false' ) );
				echo "</span><!-- old-price -->";
				echo '</div><!-- .wrap-preco -->';
			} elseif ( $product->is_type( 'variable' ) && $product->get_variation_sale_price() && $product->get_variation_sale_price() != $product->get_variation_regular_price() ) {
				echo '<div class="wrap-preco">';
				echo '<span class="moeda-preco">'. get_woocommerce_currency_symbol() . ' </span><span class="price">';
				echo wc_price( $product->get_variation_sale_price(), array( 'currency' => '__false' ) );
				echo "</span><!-- price -->";
				echo "<span class='old-price'>";
				echo get_woocommerce_currency_symbol() . ' ' . wc_price( $product->get_variation_regular_price(), array( 'currency' => '__false' ) );
				echo "</span><!-- old-price -->";
				echo '</div><!-- .wrap-preco -->';
			} else{
				echo '<div class="wrap-preco">';
				echo '<span class="moeda-preco">'. get_woocommerce_currency_symbol() . ' </span><span class="price">';
				echo wc_price( $product->get_sale_price(), array( 'currency' => '__false' ) );
				echo "</span><!-- price -->";
				echo '</div><!-- .wrap-preco -->';
			}
			echo "</div>";
			echo "</a>";
			echo "</li>";

			endforeach;
			wp_reset_postdata();

		endif;
		echo '</ul><!-- list_produtos --></div>';

		/* Retorna o valor da variável $post como era antes do loop de produtos */
		$post = $temp_posts;
}

	public function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['qtd_produtos'] = $new_instance['qtd_produtos'];
		$instance['cat_produtos'] = $new_instance['cat_produtos'];
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'qtd_produtos' => '5', 'cat_produtos' => '') );
		$title = strip_tags( $instance['title'] );
		$qtd_produtos = strip_tags( $instance['qtd_produtos'] );
		$cat_produtos = strip_tags( $instance['cat_produtos'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php echo 'Titulo do Widget'; ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('qtd_produtos'); ?>">
				<?php echo 'Quantidade de Produtos'; ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('qtd_produtos'); ?>" name="<?php echo $this->get_field_name('qtd_produtos'); ?>" type="text" value="<?php echo esc_attr($qtd_produtos); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat_produtos'); ?>">
				<?php echo 'Categoria de Produtos'; ?>
			</label>
			<select id="<?php echo $this->get_field_id('cat_produtos'); ?>" name="<?php echo $this->get_field_name('cat_produtos'); ?>" class="widefat" style="width:100%;">
	            <?php foreach(get_terms('product_cat','parent=0&hide_empty=0') as $term) { ?>
	            <option <?php selected( $instance['cat_produtos'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
	            <?php } ?>
	        </select>
		</p>
	<?php
	}
}




/* Widget Produtos */
class Specials_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'Specials_Widget',
			'description' => 'Widget para os posts Specials'
		);
		//$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct( 'Specials_Widget', 'Widget of the Specials', $widget_ops );
	}

	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_specials_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$qtd_produtos = apply_filters( 'widget_produtos_qtd_produtos', empty( $instance['qtd_produtos'] ) ? '' : $instance['qtd_produtos'], $instance );

		echo '<div class="col-md-12 Specials_Widget special-widget nopadding">';
		echo '<h3 class="item">' . $title . '</h3>';
		echo '<ul>';

		global $post;

		/* Guarda a variável $post em $temp_post */
		$temp_posts = $post;

		/* Pega o ID do term Specials */
		$get_term = get_term_by( 'slug', 'specials', 'product_cat', OBJECT );
		$term_id = $get_term->term_id;

		$produtos_posts = get_posts( array(
			'post_type' => 'product',
			'posts_per_page' => $qtd_produtos,
			'tax_query' => array(
    			array(
      				'taxonomy' => 'product_cat',
      				'field' => 'id',
      				'terms' => $term_id,
      				'include_children' => false
    			)
  			)
		));

		// Start the Loop.
		if( $produtos_posts ) :
			foreach( $produtos_posts as $post ) : setup_postdata( $post );
			$product = wc_get_product( $post->ID );
			echo "<li>";
			echo "<a href=" . get_the_permalink() . ">";
			echo "<div class='thumb col-xs-4 pull-left'>";
				the_post_thumbnail( array( '120', '120' ) );
			echo "</div>";
			echo "<div class='desc col-xs-8 pull-left'>";
			echo "<span class='title'>";
				the_title();
			echo "</span><!-- title -->";
			if( $product->get_sale_price() ){
				echo '<div class="wrap-preco">';
				echo '<span class="moeda-preco">'. get_woocommerce_currency_symbol() . ' </span><span class="price">';
				echo $product->get_sale_price();
				echo "</span><!-- price -->";
				echo "<span class='old-price'>";
				echo get_woocommerce_currency_symbol() . ' ' . $product->get_regular_price();
				echo "</span><!-- old-price -->";
				echo '</div><!-- .wrap-preco -->';
			} elseif ( $product->is_type( 'variable' ) && $product->get_variation_sale_price() ) {
				echo '<div class="wrap-preco">';
				echo '<span class="moeda-preco">'. get_woocommerce_currency_symbol() . ' </span><span class="price">';
				echo $product->get_variation_sale_price();
				echo "</span><!-- price -->";
				echo "<span class='old-price'>";
				echo get_woocommerce_currency_symbol() . ' ' . $product->get_variation_regular_price();
				echo "</span><!-- old-price -->";
				echo '</div><!-- .wrap-preco -->';
			} else{
				echo '<div class="wrap-preco">';
				echo '<span class="moeda-preco">'. get_woocommerce_currency_symbol() . ' </span><span class="price">';
				echo $product->get_price();
				echo "</span><!-- price -->";
				echo '</div><!-- .wrap-preco -->';
			}
			echo "</div>";
			echo "</a>";
			echo "</li>";

			endforeach;
			wp_reset_postdata();

		endif;
		echo '</ul><!-- list_produtos --></div>';

		/* Retorna o valor da variável $post como era antes do loop de produtos */
		$post = $temp_posts;
}

	public function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['qtd_produtos'] = $new_instance['qtd_produtos'];
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'qtd_produtos' => '5' ) );
		$title = strip_tags( $instance['title'] );
		$qtd_produtos = strip_tags( $instance['qtd_produtos'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php echo 'Titulo do Widget'; ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('qtd_produtos'); ?>">
				<?php echo 'Quantidade de Produtos'; ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('qtd_produtos'); ?>" name="<?php echo $this->get_field_name('qtd_produtos'); ?>" type="text" value="<?php echo esc_attr($qtd_produtos); ?>" />
		</p>
	<?php
	}
}




function theme_register_widgets() {
	register_widget( 'Produtos_Widget' );
	//register_widget( 'Specials_Widget' );
}

add_action( 'widgets_init', 'theme_register_widgets' );
