<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title>
			<?php echo wp_get_document_title(); ?>
		</title>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action('eead/template/before_header'); ?>
<div class="eead-template-content-markup eead-template-content-header eead-template-content-theme-support">
<?php
	$template = \EEAD\Modules\Header_Footer\Activator::template_ids();
	echo \EEAD\Utils::render_elementor_content($template[0]); 
?>
</div>
<?php do_action('eead/template/after_header'); ?>
