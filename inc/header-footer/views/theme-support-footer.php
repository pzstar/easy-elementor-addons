<?php do_action('eead/template/before_footer'); ?>
<div class="eead-template-content-markup eead-template-content-footer eead-template-content-theme-support">
<?php
	$template = \EEAD\Modules\Header_Footer\Activator::template_ids();
	echo \EEAD\Utils::render_elementor_content($template[1]);
?>
</div>
<?php do_action('eead/template/after_footer'); ?>
<?php wp_footer(); ?>

</body>
</html>
