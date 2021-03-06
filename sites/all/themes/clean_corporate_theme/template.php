<?php
/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 *
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "adaptivetheme_subtheme" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "adaptivetheme_subtheme".
 * 2. Uncomment the required function to use.
 */
  
/**
 * Override or insert variables for the html templates.
 */
function clean_corporate_theme_preprocess_html(&$vars) {
  $meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'content' =>  'IE=edge,chrome=1',
      'http-equiv' => 'X-UA-Compatible',
    )
  );  
  // Add header meta tag for IE to head
  drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
}

/**
 * Implements hook_preprocess_contact_site_form().
 */
function clean_corporate_theme_preprocess_comment_form__node_jobs(&$variables) {
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

function clean_corporate_theme_preprocess_comment(&$variables) {
	if($variables['elements']['#node']->type=='jobs'){
		unset($variables['content']['links']['comment']['#links']['comment-reply']);
	}
	//$variables['theme_hook_suggestion'][] = 'comment__node_' . $variables['node']->type;
}

function clean_corporate_theme_comment_post_forbidden($variables) {
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


