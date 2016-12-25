<div class="panel panel-list-item">
	<div class="panel-body">
		<h3><a href="<?php print $variables['node_url']; ?>"><?php print $variables['title']; ?></a></h3>
		<?php print render($variables['content']['body']); ?>
		<?php print render($variables['content']['links']['node']); ?>
		<?php print render($variables['content']['links']['comment']); ?>
		<?php print render($variables['content']['field_work_location']); ?>
		<?php print render($variables['content']['field_company']); ?>
		<?php print render($variables['content']['field_years_of_experience']); ?>
		<?php print render($variables['content']['field_skills']); ?>
		<?php print render($variables['content']['field_emploment_type']); ?>
		<?php print render($variables['content']['field_occupational_field']); ?>
	</div>
	<div class="panel-heading">
		<span class="pull-right"><?php print ($variables['date']); ?></span>
	</div>
</div>
