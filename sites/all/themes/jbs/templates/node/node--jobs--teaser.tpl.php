<div class="panel panel-list-item">
	<div class="panel-body">
		<h3><a href="<?php print $variables['node_url']; ?>"><?php print $variables['title']; ?></a></h3>

		<?php print render($variables['content']['body']); ?>
		<?php print render($variables['content']['links']); ?>
	</div>
	<div class="panel-heading">
		<span class="pull-right"><?php print ($variables['date']); ?></span>
	</div>
</div>
