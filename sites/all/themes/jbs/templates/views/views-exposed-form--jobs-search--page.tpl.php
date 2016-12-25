<?php 
/**
 * Views exposed fileter tempolate field
 */
?>
<div class="container">
	<h3 class="hdg-3"><?php print t('Search jobs') ?></h3>
	<div class="row form-wrap">
		<div class="col-lg-4">
			<?php print render($variables['form']['field_work_location_tid'])?>
		</div>
		<div class="col-lg-3">
		  <?php print render($variables['form']['field_skills_tid']);?>
		</div>
		<div class="col-lg-2">
			<?php print render($variables['form']['field_company_tid']);?>
		</div>
		<div class="col-lg-2">
			<?php print render($variables['form']['field_occupational_field_tid']);?>
		</div>
		<div class="col-lg-1">
			<button type="submit" id="edit-submit-jobs-search" class="btn btn-primary submit"><?php print t('Submit'); ?></button>
		</div>
	</div>
</div>