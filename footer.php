</div><!-- .content -->

<footer id="colophon" role="contentinfo" class="footer">
	<div class="social-media">
		<div class="twitter">
			<h2><a href="https://twitter.com/lawcha_org"><span class="icon-twitter"></span> Twitter</a></h2>
			<p><span>Follow us on Twitter</span> <a href="https://twitter.com/lawcha_org">@LAWCHA_ORG</a> or <a href="https://twitter.com/laboronline">@LaborOnline</a> to take part in the discussion.</p>
		</div>
		<div class="facebook">
			<h2><a href="https://www.facebook.com/laborandworkingclasshistory"><span class="icon-facebook"></span> Facebook</a></h2>
			<p><span>Follow us on</span> <a href="https://www.facebook.com/laborandworkingclasshistory">Facebook page</a> to receive the latest updates. Don't forget to like us!</p>
		</div>
		<div class="news-categories">
			<h2><span class="icon-folder"></span> News Categories</h2>
			<?=wp_nav_menu(array("menu" => "News Categories"))?>
		</div>
	</div>
	<div class="site-info">
		<p>&copy 1998-Present LAWCHA. All Rights Reserved.</p>

		<p>Supported for the <strong>latest versions</strong> of:
			<a href="http://www.google.com/chrome/" class="icon-chrome"><span>Chrome</span></a>
			<a href="https://www.mozilla.org/en-US/firefox/new/" class="icon-firefox"><span>Firefox<span></span></a>
			<a href="https://www.microsoft.com/en-us/windows/microsoft-edge" class="icon-IE"><span>Edge</span></a>
			<a href="http://www.opera.com/" class="icon-opera"><span>Opera</span></a>
		</p>

		<p><strong><a href="#top">Return to Top</a></strong></p>
	</div>
</footer><!-- .site-footer -->

</div><!-- .page -->

<?php lawcha_wp_footer(); ?>

<script>
    var masonries = document.querySelectorAll('.grid');
		console.log({ masonries })
    Array.from(masonries).forEach(element => {
      var optionsString = element.getAttribute("data-masonry");
			var options = optionsString ? JSON.parse(optionsString) : {};
			var optionsWithDefaults = Object.assign({
				itemSelector: '.grid-item',
				columnWidth: 100,
				gutter: 8,
				fitWidth: true,
				resize: true,
				transitionDuration: '0.2s'
			},
				options
			);
      window.fk2 = new Masonry(element, optionsWithDefaults);
    });
</script>

</body>
</html>
