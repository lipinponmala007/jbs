<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to main-menu administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
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
<div class="clearfix"></div>
<!-- Search Banner start -->
<div class="search-block-wrap home-page">
	<!-- Top band start -->
	<div class="top-band">
		<div class="container">
			<?php print $messages ;?>
		
			<?php print $featured_jobs_menu ;?>
		</div>
	</div>
	<!-- Top band start -->
	<?php print render($page['search_bar']); ?>
<!-- Search Banner end -->
</div>
<div class="clearfix"></div>
<!-- Partner Logo Block start -->
<div class="partner_logos text-center">
	<div class="container">
		<img src="img/partner-logos.png" alt="" class="img-responsive">
	</div>
</div>
<!-- Partner Logo Block end -->
<div class="clearfix"></div>
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
<div class="clearfix"></div>
<!-- Footer Starts -->
<footer class="footer">
	<div class="container">
		<p class="copyright">Copyrights &copy; 2016, All rights received.
	
	</div>
</footer>
<!-- Footer Ends -->
<?php print $closure ?>
<!-- javascripts -->

<script>

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
<script>

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

