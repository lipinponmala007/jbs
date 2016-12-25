
$(document).ready(function(){
	$('ul.main-nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).slideDown('fast');
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).slideUp('fast');
	});
});