<?php
/**
 * The template for displaying the footer.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>

</div>
</div>
<!-- #content-wrapper -->

<?php get_sidebar(); ?>

<footer id="footer">
	<div class="container">
		<div class="columns twelve">
			<?php do_action( 'sampression_credits' ); ?>
			<div id="btn-top-wrapper">
				<a href="javascript:pageScroll('.top');" class="btn-top"></a>
			</div>
		</div>
	</div><!--.container-->
</footer><!--#footer-->
<?php wp_footer(); ?>
</body>
</html>