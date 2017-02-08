;(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery);
jQuery(document).ready(function($) {

	// Slicknav Menu
	$('#menu-responsive-menu').slicknav();

	// Placeholder AloEasy Mail
	$('#opt_name').attr('placeholder','Your Name');
	$('#opt_email').attr('placeholder','Your Email');

	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();
	$('.only-onecheck').on('click', function() {
	// in the handler, 'this' refers to the box clicked on
	var $box = $(this);
	if ($box.is(":checked")) {
		var group = "input:checkbox[name='" + $box.attr("name") + "']";
		// the checked state of the group/box on the other hand will change
		// and the current value is retrieved using .prop() method
		$(group).prop("checked", false);
		$box.prop("checked", true);
	} else {
		$box.prop("checked", false);
	}
	});
	$('.product-cat-list').on('click',function(e){
		e.preventDefault();
		var slug = $(this).attr('data-slug');
		$('#input-categories').attr('value',slug);
		$('#advanced-search').submit();
	});
	$('ul.product-categories>li.cat-parent>a').on('click', function(e) {
		$elem = $(this).closest('li.cat-parent');
		e.preventDefault();

		if( ! $($elem).hasClass('show') ) {
			$($elem).addClass('show');
		}
		else{
			$($elem).removeClass('show');
		}
	});

	$('ul.product-categories>li.cat-parent>ul.children>li.cat-parent').on('click', function(e) {
		if( e.target.nodeName.toLowerCase() == 'a' ) {
			return;
		}

		$elem = this;

		if( ! $($elem).hasClass('show') ) {
			$($elem).addClass('show');
		}
		else{
			$($elem).removeClass('show');
		}
	});
	$('ul.product-categories li.current-cat-parent').addClass('show');
	$('.toggle .title').on('click',function(){
		father = $(this).parent('.toggle');
		icon = $(this).find('.icon-open-close');
		if(father.attr('data-open') == 'false' || !father.attr('data-open')){
			father.addClass('open');
			father.attr('data-open','true');
			icon.html('-');
		}
		else if(father.attr('data-open') == 'true'){
			father.removeClass('open');
			father.attr('data-open','false');
			icon.html('+');
		}
	});
	$('.clear-form').on('click',function(){
		$('form').trigger('reset')
	})
	$('ul#price-selector li').on('click',function(){
		$('ul#price-selector li.active').removeClass('active');
		$('#price-input').attr('value',$(this).attr('data-slug'));
		$(this).addClass('active');
	});
	var config1 = {
		"id": $('#twitter-fetcher').attr('data-widget-id'),
		"domId": 'twitter-fetcher',
		"maxTweets": $('#twitter-fetcher').attr('data-widget-max'),
		"enableLinks": true,
		"showTime": false,
		"showRetweet": false,
		"showInteraction": false
	};
	console.log( twitterFetcher.fetch(config1) );

	$('#selector_qty').on('change',function(e){
		$('input.qty').val($(this).val());
	});
	if($('body').hasClass('single-product')){
		$('.type-product form.cart input[name=add-to-cart]').val(product_info.id);
	}

	$('#odin-add-to-cart').on('click',function(e){
		e.preventDefault();
		if ( $('.variations_form').length > 0 ) {
			if ( $( '#input-variation' ).val() != '' ) {
				$('.type-product form').submit();
			}
			else {
				$( '.variations_form .variable-options' ).html( $( '.variations_form .variable-options' ).attr('data-on-send') );
				$( '.variations_form' ).addClass( 'warn-animate' );
				$('html,body').animate( {
					scrollTop: $( 'div.type-product' ).offset().top
				},400);

				setTimeout( function(){
					$( '.variations_form' ).removeClass( 'warn-animate' );
				}, 4000);
			}
		}
		else {
			$('.type-product form').submit();
		}
	});

	$('#slider-cat').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1
	});
	$('#slider-produtos-home').slick({
		lazyLoad: 'progressive',
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
	    {
	      breakpoint: 800,
	      settings: {
	        slidesToShow: 2,
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});
	$('.movescroll').each(function(){
		elem = $(this).attr('href');
		if($(elem).visible() == true){
			$(this).hide();
		}
	});
	$(window).scroll(function(){
		$('.movescroll').each(function(){
			elem = $(this).attr('href');
			if($(elem).visible() == true){
				$(this).fadeOut('slow');
			}
			else{
				$(this).fadeIn('slow');
			}
		});
	});
	$('.movescroll').on('click',function(e){
		e.preventDefault();
		elem = $(this).attr('href');
		$('html,body').animate({scrollTop:$(elem).offset().top},1000);
	});

	//ask a question form
	if (typeof form_info !== 'undefined') {
		console.log(form_info)
		$('input[name=product-url]').val(form_info.url);
		if (typeof form_info.title !== 'undefined') {
			$('input[name=product-name]').val(form_info.title);
			$('[name=your-message]').val(form_info.msg);
		}
		if($('body').hasClass('logged-in')){
			$('input[name=your-name]').val(form_info.user_name);
			$('input[name=your-email]').val(form_info.user_email);
		}
    }

    // chat link support
    if (typeof tidioChatApi !== 'undefined') {
    	$('.open-tidio-chat').on('click', function(){
    		if( $(this).attr('data-clicked') != 'true' ){
    			tidioChatApi.method('popUpOpen');
    			$(this).attr('data-clicked','true');
    		}
    		else{
    			tidioChatApi.method('popUpHide');
    			$(this).attr('data-clicked','false');
		    }
		});
	}

	//news/blog filters
	$('.pagination-control select').on('change',function(e){
		var _href = $(this).attr('value');
		if(_href && _href !== ''){
			window.location.href = _href;
		}
	});

	/* WOOF toggle */
	$('.widget .woof_container .woof_container_inner>h4').on('click',function(e) {
		$elem = $(this).closest('.woof_container_inner');
		e.preventDefault();

		if( ! $($elem).hasClass('show') ) {
			$($elem).addClass('show');
		}
		else{
			$($elem).removeClass('show');
		}
	});

	//* upsells products slider */
	$('.upsells-slider').slick({
	  dots: true,
	  infinite: true,
	  speed: 900,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});
});
(function($) {

/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function render_map( $el ) {

	// var
	var $markers = $el.find('.marker');

	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};

	// create map
	var map = new google.maps.Map( $el[0], args);

	// add a markers reference
	map.markers = [];

	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});

	// center map
	center_map( map );

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/

$(document).ready(function(){

	$('.acf-map').each(function(){

		render_map( $(this) );

	});

});

})(jQuery);
