<div class="panel panel-list-item">
	<div class="panel-body">
		<h3><a href="<?php print $variables['node_url']; ?>"><?php print $variables['title']; ?></a></h3>
		<?php print render($variables['content']['body']); ?>
		<div class="clearfix list-actions">
			<div class="pull-right"><?php print render($variables['content']['links']['comment']); ?></div>
			<div class="pull-right"><?php print render($variables['content']['links']['node']); ?></div>
		</div>
		<div class="clearfix field-group"><?php print render($variables['content']['field_work_location']); ?></div>
		<div class="clearfix field-group"><?php print render($variables['content']['field_company']); ?></div>
		<div class="clearfix field-group"><?php print render($variables['content']['field_years_of_experience']); ?></div>
		<div class="clearfix field-group"><?php print render($variables['content']['field_skills']); ?></div>
		<div class="clearfix field-group"><?php print render($variables['content']['field_emploment_type']); ?></div>
		<div class="clearfix field-group"><?php print render($variables['content']['field_occupational_field']); ?></div>
	</div>
	<div class="panel-heading">
		<span class="pull-right"><?php print ($variables['date']); ?></span>
	</div>
</div>
