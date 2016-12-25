<?php

/**

* Overrides theme_menu_tree().

* Add bootstrap 'navbar-nav' class to Top Navigation menu

*/
function jbs_preprocess_page(&$variables){
  global $user ;
  $main_menu = menu_tree('main-menu');
  $featured_jobs_menu = menu_tree('menu-featured-jobs-categories');
  $main_menu_output = drupal_render($main_menu);
  $variables['main_menu_output'] = $main_menu_output;
  $variables['featured_jobs_menu'] = drupal_render($featured_jobs_menu);
  
  if($user->uid >0){
    $variables['user_name'] = $user->name;
  }else{
    $variables['user_name'] = t('Login');
  }

}

function jbs_menu_tree__main_menu(&$variables) {
  return '<ul class="dropdown-menu">' . $variables['tree'] . '</ul>';

}

function jbs_menu_tree__menu_featured_jobs_categories(&$variables) {
  return '<ul class="tabs">' . $variables['tree'] . '</ul>';

}

/**
 * theme_textfield
 * @param unknown $variables
 * @return string
 */
function jbs_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
  _form_set_class($element, array('form-text form-control'));

  $extra = '';
  if ($element['#autocomplete_path'] && !empty($element['#autocomplete_input'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#autocomplete_input']['#id'];
    $attributes['value'] = $element['#autocomplete_input']['#url_value'];
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }
  $output = '<div class="col-sm-10"><input' . drupal_attributes($element['#attributes']) . ' /></div>';
  return $output . $extra;
}

/**
 * theme_textarea
 * @param unknown $variables
 */
function jbs_textarea($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'cols', 'rows'));
  _form_set_class($element, array('form-textarea form-control'));

  $wrapper_attributes = array(
      'class' => array('form-textarea-wrapper'),
  );

  // Add resizable behavior.
  if (!empty($element['#resizable'])) {
    drupal_add_library('system', 'drupal.textarea');
    $wrapper_attributes['class'][] = 'resizable';
  }

  $output = '<div' . drupal_attributes($wrapper_attributes) . '>';
  $output .= '<textarea' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>';
  $output .= '</div>';
  return $output;
}

/**
 * Returns HTML for a select form element.
 *
 * It is possible to group options together; to do this, change the format of
 * $options to an associative array in which the keys are group labels, and the
 * values are associative arrays in the normal $options format.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #value, #options, #description, #extra,
 *     #multiple, #required, #name, #attributes, #size.
 *
 * @ingroup themeable
 */
function jbs_select($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'size'));
  _form_set_class($element, array('form-select', 'form-control'));

  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}


/**
 * Returns HTML for a password form element.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #value, #description, #size, #maxlength,
 *     #required, #attributes.
 *
 * @ingroup themeable
 */
function jbs_password($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'password';
  element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
  _form_set_class($element, array('form-text form-control'));

  return '<div class="col-sm-10"><input' . drupal_attributes($element['#attributes']) . ' /></div>';
}

/**
 * Returns HTML for a button form element.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #attributes, #button_type, #name, #value.
 *
 * @ingroup themeable
 */
function jbs_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'btn btn-default form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  return '<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><input' . drupal_attributes($element['#attributes']) . ' /></div></div>';
}


/**
 * Returns HTML for a form element.
 *
 * Each form element is wrapped in a DIV container having the following CSS
 * classes:
 * - form-item: Generic for all form elements.
 * - form-type-#type: The internal element #type.
 * - form-item-#name: The internal form element #name (usually derived from the
 *   $form structure and set via form_builder()).
 * - form-disabled: Only set if the form element is #disabled.
 *
 * In addition to the element itself, the DIV contains a label for the element
 * based on the optional #title_display property, and an optional #description.
 *
 * The optional #title_display property can have these values:
 * - before: The label is output before the element. This is the default.
 *   The label includes the #title and the required marker, if #required.
 * - after: The label is output after the element. For example, this is used
 *   for radio and checkbox #type elements as set in system_element_info().
 *   If the #title is empty but the field is #required, the label will
 *   contain only the required marker.
 * - invisible: Labels are critical for screen readers to enable them to
 *   properly navigate through forms but can be visually distracting. This
 *   property hides the label for everyone except screen readers.
 * - attribute: Set the title attribute on the element to create a tooltip
 *   but output no label element. This is supported only for checkboxes
 *   and radios in form_pre_render_conditional_form_element(). It is used
 *   where a visual label is not needed, such as a table of checkboxes where
 *   the row and column provide the context. The tooltip will include the
 *   title and required marker.
 *
 * If the #title property is not set, then the label and any required marker
 * will not be output, regardless of the #title_display or #required values.
 * This can be useful in cases such as the password_confirm element, which
 * creates children elements that have their own labels and required markers,
 * but the parent element should have neither. Use this carefully because a
 * field without an associated label can cause accessibility challenges.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #title_display, #description, #id, #required,
 *     #children, #type, #name.
 *
 * @ingroup themeable
 */
function jbs_form_element($variables) {
  $element = &$variables['element'];
  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
      '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  // Add element's #type and #name as class to aid with JS/CSS selectors.
  $attributes['class'] = array('form-item');
  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }
  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
  }
  switch ($element['#type']) {
    case 'textfield':
    case 'password':
      $attributes['class'][] = 'form-group';
      break;

  }


  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }
  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";
  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;

    case 'after':
      $output .= ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if (!empty($element['#description'])) {
    //$output .= '<div class="description">' . $element['#description'] . "</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}


/**
 * Returns HTML for a form element label and required marker.
 *
 * Form element labels include the #title and a #required marker. The label is
 * associated with the element itself by the element #id. Labels may appear
 * before or after elements, depending on theme_form_element() and
 * #title_display.
 *
 * This function will not be called for elements with no labels, depending on
 * #title_display. For elements that have an empty #title and are not required,
 * this function will output no label (''). For required elements that have an
 * empty #title, this will output the required marker alone within the label.
 * The label will use the #id to associate the marker with the field that is
 * required. That is especially important for screenreader users to know
 * which field is required.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #required, #title, #id, #value, #description.
 *
 * @ingroup themeable
 */
function jbs_form_element_label($variables) {
  $element = $variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if ((!isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
    return '';
  }

  // If the element is required, a required marker is appended to the label.
  $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';

  $title = filter_xss_admin($element['#title']);

  $attributes = array();
  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'] = 'option';
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }

  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  switch ($element['#type']) {
    case 'textfield':
    case 'password':
      if (isset($attributes['class'])){
        $attributes['class'] .= ' col-sm-2 control-label';
      }
      else {
        $attributes['class'] = 'col-sm-2 control-label';
      }
      break;

  }

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $t('!title !required', array('!title' => $title, '!required' => $required)) . "</label>\n";
}

// function jbs_file($variables) {
//   $element = $variables['element'];
//   $element['#attributes']['type'] = 'file';
//   element_set_attributes($element, array('id', 'name', 'size'));
//   _form_set_class($element, array('form-file form-control'));

//   $required_class= '';
//   if (form_get_error($element)) {
//     $required_class = "custom-required";
//   }
//   return '<div class="input-group col-sm-12">
//                                                     <label class="input-group-btn">
//                     <span class="btn btn-primary">
//                         Browse… <input' . drupal_attributes($element['#attributes']) . '  style="display: none;" multiple=""/>
//                     </span>
//                                             </label>
//                                             <input type="text" class="form-control ' . $required_class . '" readonly="" placeholder="Upload a file...">

//       </div>';
// }

function jbs_preprocess_node(&$variables) {
  // call any specific field hooks after
  if (isset($variables['type'])) {
    $function = 'jbs_preprocess_node__' . $variables['type'];
    if (function_exists($function)) {
      $function($variables);
    }
  }
}



/**
 * Implements hook_preprocess_contact_site_form().
 */
function jbs_preprocess_comment_form__node_jobs(&$variables) {
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

function jbs_preprocess_comment(&$variables) {
	if($variables['elements']['#node']->type=='jobs'){
		unset($variables['content']['links']['comment']['#links']['comment-reply']);
	}
	//$variables['theme_hook_suggestion'][] = 'comment__node_' . $variables['node']->type;
}

function jbs_comment_post_forbidden($variables) {
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


