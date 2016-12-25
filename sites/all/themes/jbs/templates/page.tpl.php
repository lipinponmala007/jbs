<?php ?>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
<!-- Header start -->
<header class="header dark-bg">
	<div class="container">
		<!--logo start-->
		<a href="index.html" class="logo">Job<span class="lite">Portal</span></a>
		<!--logo end-->
		<!-- Top Nav Starts -->
		<ul class="nav navbar-nav navbar-right main-nav">
			<li class="dropdown"><a href="#" class="dropdown-toggle"
				data-toggle="dropdown">Menu<b class="caret"></b></a>
        <?php print $main_menu_output?>
      </li>
		</ul>
		<!-- Top Nav Ends -->
	</div>
</header>
<!--header end-->
<?php print $messages ;?>
<!-- Search Banner start -->
<div class="search-block-wrap">
	<!-- Top band start -->
	<div class="top-band">
		<div class="container">
			<?php print $featured_jobs_menu ;?>
		</div>
	</div>

	<div class="container">
		<?php print render($page['search_bar']); ?>
	</div>
</div>
<!-- Top band end -->
	
<!-- Search Banner end -->
<div class="clearfix"></div>
<!-- Content Area start -->
<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-lg-8">
				<h2><?php print $title ;?></h2>
				<?php print $messages ;?>
				<?php print render($page['content']); ?>
				<?php if($page['content_right_bar']):?>
				<div class="col-lg-4">
					<?php print render($page['content_right_bar']); ?>
				</div>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<!-- Content Area  end -->

<!-- Partner Logo Block start -->
<div class="partner_logos text-center">
	<div class="container">
		<img src="img/partner-logos.png" alt="" class="img-responsive">
	</div>
</div>
<!-- Partner Logo Block end -->

<!-- Pre Footer Starts -->
<section class="pre-footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<h3 class="head">Information</h3>
				<ul class="pre-footer-links">
					<li><a href="#">About Us</a></li>
					<li><a href="#">Terms & Conditions</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Careers with Us</a></li>
					<li><a href="#">Sitemap</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">FAQs</a></li>
					<li><a href="#">Summons / Notices</a></li>
					<li><a href="#">Grievances</a></li>
					<li><a href="#">Fraud Alert</a></li>
				</ul>
			</div>
			<div class="col-xs-3">
				<h3 class="head">Jobseekers</h3>
				<ul class="pre-footer-links">
					<li><a href="#">About Us</a></li>
					<li><a href="#">Terms & Conditions</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Careers with Us</a></li>
					<li><a href="#">Sitemap</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">FAQs</a></li>
					<li><a href="#">Summons / Notices</a></li>
					<li><a href="#">Grievances</a></li>
					<li><a href="#">Fraud Alert</a></li>
				</ul>
			</div>
			<div class="col-xs-3">
				<h3 class="head">Browse Jobs</h3>
				<ul class="pre-footer-links">
					<li><a href="#">About Us</a></li>
					<li><a href="#">Terms & Conditions</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Careers with Us</a></li>
					<li><a href="#">Sitemap</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">FAQs</a></li>
					<li><a href="#">Summons / Notices</a></li>
					<li><a href="#">Grievances</a></li>
					<li><a href="#">Fraud Alert</a></li>
				</ul>
			</div>
			<div class="col-xs-3">
				<h3 class="head">Employers</h3>
				<ul class="pre-footer-links">
					<li><a href="#">About Us</a></li>
					<li><a href="#">Terms & Conditions</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Careers with Us</a></li>
					<li><a href="#">Sitemap</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<div class="sub-col">
					<h3 class="head">Follow us</h3>
					<ul class="pre-footer-links social-links">
						<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Pre Footer Starts -->

<!-- Footer Starts -->
<footer class="footer">
	<div class="container">
		<p class="copyright">Copyrights &copy; 2016, All rights received.</p>
	</div>
</footer>
<!-- Footer Ends --> 
<?php print $closure?>

<script>
//custom select box
$(function() {
  $('select.styled').customSelect();
});
</script>