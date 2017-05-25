<?php
/**
 * Footer.php outputs the code for footer hooks and closing body/html tags
 *
 * @since 1.0
 */ ?>
	
	</div><!-- #main-content -->
</div><!-- #box-wrap -->

	<?php
	// Show footer if enabled
	if ( wpex_get_option( 'footer', true ) ) : ?>
	
		<?php
		// Before footer hook
		wpex_hook_footer_before(); ?>

			<div id="footer-wrap" class="clr">

				<?php
				// Top footer hook
				wpex_hook_footer_top(); ?>

				<footer id="footer">
					<div id="footer-widgets" class="row">
						<div class="footer-box col span_4 clr">
							<?php dynamic_sidebar( 'footer-one' ); ?>
						</div><!-- /footer-box -->
						<div class="footer-box col span_4 clr">
							<?php dynamic_sidebar( 'footer-two' ); ?>
						</div><!-- /footer-box -->
						<div class="footer-box col span_4 clr">
							<?php dynamic_sidebar( 'footer-three' ); ?>
						</div><!-- /footer-box -->
					</div><!-- /footer-widgets -->
				</footer><!-- /footer -->

				<?php
				// Botom footer hook
				wpex_hook_footer_bottom(); ?>

			</div><!-- /footer-wrap -->

		<?php
		// After footer hook
		wpex_hook_footer_after(); ?>
	
	<?php endif; ?>

</div><!-- #wrap -->

<?php
// Show footer copyright if enabled in the admin
if ( wpex_get_option( 'copyright', true ) && wpex_get_option( 'custom_copyright', true ) ) : ?>
	<div id="copyright" class="container">
		<?php echo wp_kses_post( do_shortcode( wpex_get_option( 'custom_copyright', '<a href="'. wpex_get_theme_info( 'url' ) .'" target="_blank" title="'. wpex_get_theme_info( 'name' ) .'">Fresh &amp; Clean</a> Theme by <a href="http://themeforest.net/user/wpexplorer?ref=WPExplorer" target="_blank" title="WPExplorer Themes">WPExplorer</a> Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>' ) ) ); ?>
	</div><!-- #copyright -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>