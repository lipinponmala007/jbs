<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */

function flat_zymphonies_theme_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function flat_zymphonies_theme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
	$breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}

/**
 * Override or insert variables into the page template.
 */
function flat_zymphonies_theme_preprocess_page(&$vars) {
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function flat_zymphonies_theme_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function flat_zymphonies_theme_preprocess_node(&$variables) {
  $node = $variables['node'];
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

function medical_page_alter($page) {
  // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
    'name' =>  'viewport',
    'content' =>  'width=device-width'
    )
  );
  drupal_add_html_head($viewport, 'viewport');
}

/**
 * Implements hook_preprocess_contact_site_form().
 */
function flat_zymphonies_theme_preprocess_comment_form__node_jobs(&$variables) {
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

function flat_zymphonies_preprocess_comment(&$variables) {
	if($variables['elements']['#node']->type=='jobs'){
		unset($variables['content']['links']['comment']['#links']['comment-reply']);
	}
	//$variables['theme_hook_suggestion'][] = 'comment__node_' . $variables['node']->type;
}

function flat_zymphonies_theme_comment_post_forbidden($variables) {
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


