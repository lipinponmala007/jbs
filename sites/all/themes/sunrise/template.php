<?php 

/**
 * Implements hook_preprocess_contact_site_form().
 */
function sunrise_preprocess_comment_form__node_jobs(&$variables) {
	drupal_set_title('Application form');
	//$variables['note'] = t("We'd love hear from you. Expect to hear back from us in 1-2 business days.");
	$form=$variables['form'];
	unset($form['author']);
	unset($form['subject']);
	unset($form['comment_body']);
	unset($form['field_resume']);
	$form['actions']['submit']['#value']=t('Apply');

	// Create variables for individual elements.
	$variables['author'] = render($variables['form']['author']);
	$variables['subject'] = render($variables['form']['subject']);
	$variables['comment_body'] = render($variables['form']['comment_body']);
	$variables['field_resume'] = render($variables['form']['field_resume']);
	//$variables['actions'] = render($variables['form']['actions']);


	// Be sure to print the remaining rendered form items.
	$variables['children'] = drupal_render_children($form);
}

function sunrise_preprocess_comment(&$variables) {
	if($variables['elements']['#node']->type=='jobs'){
		unset($variables['content']['links']['comment']['#links']['comment-reply']);
	}
	//$variables['theme_hook_suggestion'][] = 'comment__node_' . $variables['node']->type;
}

function sunrise_comment_post_forbidden($variables) {
	$node = $variables['node'];
	if($node->type=='jobs'){
		global $user;
		
		// Since this is expensive to compute, we cache it so that a page with many
		// comments only has to query the database once for all the links.
		$authenticated_post_comments = &drupal_static(__FUNCTION__, NULL);
		
		if (!$user->uid) {
			if (!isset($authenticated_post_comments)) {
				// We only output a link if we are certain that users will get permission
				// to post comments by logging in.
				$comment_roles = user_roles(TRUE, 'post comments');
				$authenticated_post_comments = isset($comment_roles[DRUPAL_AUTHENTICATED_RID]);
			}
		
			if ($authenticated_post_comments) {
				// We cannot use drupal_get_destination() because these links
				// sometimes appear on /node and taxonomy listing pages.
				if (variable_get('comment_form_location_' . $node->type, COMMENT_FORM_BELOW) == COMMENT_FORM_SEPARATE_PAGE) {
					$destination = array('destination' => "comment/reply/$node->nid#comment-form");
				}
				else {
					$destination = array('destination' => "node/$node->nid#comment-form");
				}
		
				if (variable_get('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL)) {
					// Users can register themselves.
					return t('<a href="@login">Log in</a> or <a href="@register">register</a> to apply', array('@login' => url('user/login', array('query' => $destination)), '@register' => url('user/register', array('query' => $destination))));
				}
				else {
					// Only admins can add new users, no public registration.
					return t('<a href="@login">Log in</a> to spply', array('@login' => url('user/login', array('query' => $destination))));
				}
			}
		}
		
	}

}




/**
 * Page alter.
 */
function sunrise_page_alter($page) {
	$mobileoptimized = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'MobileOptimized',
		'content' =>  'width'
		)
	);
	$handheldfriendly = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'HandheldFriendly',
		'content' =>  'true'
		)
	);
	$viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'viewport',
		'content' =>  'width=device-width, initial-scale=1'
		)
	);
	drupal_add_html_head($mobileoptimized, 'MobileOptimized');
	drupal_add_html_head($handheldfriendly, 'HandheldFriendly');
	drupal_add_html_head($viewport, 'viewport');
}

/**
 * Preprocess variables for html.tpl.php
 */
function sunrise_preprocess_html(&$variables) {
	/**
	 * Add IE8 Support
	 */
	drupal_add_css(path_to_theme() . '/css/ie8.css', array('group' => CSS_THEME, 'browsers' => array('IE' => '(lt IE 9)', '!IE' => FALSE), 'preprocess' => FALSE));
    
	/**
	* Bootstrap CDN
	*/
    if (theme_get_setting('bootstrap_css_cdn', 'sunrise')) {
        $cdn = '//maxcdn.bootstrapcdn.com/bootstrap/' . theme_get_setting('bootstrap_css_cdn', 'sunrise')  . '/css/bootstrap.min.css';
        drupal_add_css($cdn, array('type' => 'external'));
    }
    
    if (theme_get_setting('bootstrap_js_cdn', 'sunrise')) {
        $cdn = '//maxcdn.bootstrapcdn.com/bootstrap/' . theme_get_setting('bootstrap_js_cdn', 'sunrise')  . '/js/bootstrap.min.js';
        drupal_add_js($cdn, array('type' => 'external'));
    }
	
	/**
	* Add Javascript for enable/disable scrollTop action
	*/
	if (theme_get_setting('scrolltop_display', 'sunrise')) {

		drupal_add_js('jQuery(document).ready(function($) { 
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$("#toTop").fadeIn();	
			} else {
				$("#toTop").fadeOut();
			}
		});
		
		$("#toTop").click(function() {
			$("body,html").animate({scrollTop:0},800);
		});	
		
		});',
		array('type' => 'inline', 'scope' => 'header'));
	}
	//EOF:Javascript
}

/**
 * Override or insert variables into the html template.
 */
function sunrise_process_html(&$vars) {
	// Hook into color.module
	if (module_exists('color')) {
	_color_html_alter($vars);
	}
}

/**
 * Preprocess variables for page template.
 */
function sunrise_preprocess_page(&$vars) {

	/**
	 * insert variables into page template.
	 */
	if($vars['page']['sidebar_first'] && $vars['page']['sidebar_second']) { 
		$vars['sidebar_grid_class'] = 'col-md-3';
		$vars['main_grid_class'] = 'col-md-6';
	} elseif ($vars['page']['sidebar_first'] || $vars['page']['sidebar_second']) {
		$vars['sidebar_grid_class'] = 'col-md-4';
		$vars['main_grid_class'] = 'col-md-8';		
	} else {
		$vars['main_grid_class'] = 'col-md-12';			
	}

}

/**
 * Override or insert variables into the page template.
 */
function sunrise_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
}

/**
 * Preprocess variables for block.tpl.php
 */
function sunrise_preprocess_block(&$variables) {
	$variables['classes_array'][]='clearfix';
}

/**
 * Override theme_breadrumb().
 *
 * Print breadcrumbs as a list, with separators.
 */
function sunrise_breadcrumb($variables) {
	$breadcrumb = $variables['breadcrumb'];

	if (!empty($breadcrumb)) {
		$breadcrumb[] = drupal_get_title();
		$breadcrumbs = '<ol class="breadcrumb">';

		$count = count($breadcrumb) - 1;
		foreach ($breadcrumb as $key => $value) {
		$breadcrumbs .= '<li>' . $value . '</li>';
		}
		$breadcrumbs .= '</ol>';

		return $breadcrumbs;
	}
}

/**
 * Search block form alter.
 */
function sunrise_form_alter(&$form, &$form_state, $form_id) {
	if ($form_id == 'search_block_form') {
	    unset($form['search_block_form']['#title']);
	    $form['search_block_form']['#title_display'] = 'invisible';
		$form_default = t('Search this website...');
	    $form['search_block_form']['#default_value'] = $form_default;

		$form['actions']['submit']['#attributes']['value'][] = '';

	 	$form['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '{$form_default}';}", 'onfocus' => "if (this.value == '{$form_default}') {this.value = '';}" );
	}
}


/**
 * Add Javascript for Google Map
 */
if (theme_get_setting('google_map_js', 'sunrise')) {

	drupal_add_js('jQuery(document).ready(function($) { 

    var map;
    var myLatlng;
    var myZoom;
    var marker;
	
	});',
	array('type' => 'inline', 'scope' => 'header')
	);
    
	drupal_add_js('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false',array('type' => 'external', 'scope' => 'header', 'group' => 'JS_THEME'));

	$google_map_latitude=theme_get_setting('google_map_latitude','sunrise');
	$google_map_longitude=theme_get_setting('google_map_longitude','sunrise');
	$google_map_zoom=theme_get_setting('google_map_zoom','sunrise');
	$google_map_canvas=theme_get_setting('google_map_canvas','sunrise');
	$google_map_show=theme_get_setting('google_map_show','sunrise');
	$google_map_hide=theme_get_setting('google_map_hide','sunrise');
	
	drupal_add_js('jQuery(document).ready(function($) { 

	if ($("#'.$google_map_canvas.'").length) {
	
		myLatlng = new google.maps.LatLng('.$google_map_latitude.', '.$google_map_longitude.');
		myZoom = '.$google_map_zoom.';
		
		function initialize() {
		
			var mapOptions = {
			zoom: myZoom,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: myLatlng,
            scrollwheel: false
			};
			
			map = new google.maps.Map(document.getElementById("'.$google_map_canvas.'"),mapOptions);
			
			marker = new google.maps.Marker({
			map:map,
			draggable:true,
			position: myLatlng
			});
			
			google.maps.event.addDomListener(window, "resize", function() {
			map.setCenter(myLatlng);
			});
	
		}
	
		google.maps.event.addDomListener(window, "load", initialize);
		
	}
	
	});',
	array('type' => 'inline', 'scope' => 'header')
	);
	/**
	 * Add Javascript
	 */
	drupal_add_js('
	function hideMap(){
	jQuery("#map-anchor").html("<a href=\"javascript:showMap()\" class=\"map-toggle expand\">'.$google_map_show.'</a>");
	jQuery("#map-canvas").hide();
	}
	
	function showMap() {
	jQuery("#map-anchor").html("<a href=\"javascript:hideMap()\" class=\"map-toggle expand collapsed\">'.$google_map_hide.' </a>");
	jQuery("#map-canvas").show();
	google.maps.event.trigger(map, "resize");
	map.setCenter(myLatlng);
	map.setZoom(myZoom);
	}
	',
	array('type' => 'inline', 'scope' => 'header'));
	//EOF:Javascript
	
}

/**
 * Add Javascript for quicksand plugin
 */
if (theme_get_setting('quicksand_js','sunrise')):
drupal_add_js(drupal_get_path('theme', 'sunrise') .'/js/plugins/jquery.quicksand.js');
drupal_add_js(drupal_get_path('theme', 'sunrise') .'/js/plugins/quicksand_initialize.js');
endif;	

/**
 * Add jquery.prettyPhoto.js and prettyPhoto.css files for portfolio items
 */
if (theme_get_setting('prettyphoto_js','sunrise')):
	
	drupal_add_js(drupal_get_path('theme', 'sunrise') . '/js/plugins/jquery.prettyPhoto.js');
	drupal_add_css(drupal_get_path('theme', 'sunrise') . '/css/plugins/prettyPhoto.css');
	
	$prettyphoto_theme=theme_get_setting('prettyphoto_theme','sunrise');
	$prettyphoto_social_tools=theme_get_setting('prettyphoto_social_tools','sunrise');

	if ($prettyphoto_social_tools):
		drupal_add_js('
			jQuery("a[data-rel^=prettyPhoto], a.prettyPhoto, a[rel^=prettyPhoto]").prettyPhoto({
			    overlay_gallery: false,
			    theme: "'.$prettyphoto_theme.'",
			});', array('type' => 'inline', 'scope' => 'footer', 'weight' => 15)
		);
	else:
		drupal_add_js('
			jQuery("a[data-rel^=prettyPhoto], a.prettyPhoto, a[rel^=prettyPhoto]").prettyPhoto({
			    overlay_gallery: false,
			    theme: "'.$prettyphoto_theme.'",
			    social_tools: false,
			});', array('type' => 'inline', 'scope' => 'footer', 'weight' => 15)
		);
	endif;


endif;




