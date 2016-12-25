<div class="col-sm-8 col-md-6 login_form_parent"> 
  <div class="form-horizontal login-page">
  	<?php print drupal_render_children($form);?>
  	<a href="<?php print url('user/login');?>" class="forgot_link"><?php print t('Login') ;?></a>
  </div>
</div>
