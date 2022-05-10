<div class="attr-modal attr-fade" id="eead_headerfooter_modal" tabindex="-1" role="dialog"
	aria-labelledby="eead_headerfooter_modalLabel">
	<div class="attr-modal-dialog attr-modal-dialog-centered" role="document">
		<form action="" method="get" id="eead-template-modalinput-form" data-open-editor="0"
			data-editor-url="<?php echo get_admin_url(); ?>" data-nonce="<?php echo wp_create_nonce('wp_rest');?>">
			<!-- <input type="hidden" name="post_author" value ="<?php echo get_current_user_id(); ?>"> -->
			<div class="attr-modal-content">
				<div class="attr-modal-header">
					<button type="button" class="attr-close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="attr-modal-title" id="eead_headerfooter_modalLabel"><?php esc_html_e('Template Settings', 'easy-elementor-addons'); ?></h4>
				</div>
				<div class="attr-modal-body" id="eead_headerfooter_modal_body">
					<div class="eead-input-group">
						<label class="attr-input-label"><?php esc_html_e('Title:', 'easy-elementor-addons'); ?></label>
						<input required type="text" name="title" class="eead-template-modalinput-title attr-form-control">
					</div>
					<br />
					<div class="eead-input-group">
						<label class="attr-input-label"><?php esc_html_e('Type:', 'easy-elementor-addons'); ?></label>
						<select name="type" class="eead-template-modalinput-type attr-form-control">
							<option value="header"><?php esc_html_e('Header', 'easy-elementor-addons'); ?></option>
							<option value="footer"><?php esc_html_e('Footer', 'easy-elementor-addons'); ?></option>
						</select>
					</div>
					<br />

					<div class="eead-template-headerfooter-option-container">
						<div class="eead-input-group">
							<label class="attr-input-label"><?php esc_html_e('Conditions:', 'easy-elementor-addons'); ?></label>
							<select name="condition_a" class="eead-template-modalinput-condition_a attr-form-control">
								<option value="entire_site"><?php esc_html_e('Entire Site', 'easy-elementor-addons'); ?></option>
								<option value="singular"><?php esc_html_e('Singular', 'easy-elementor-addons'); ?></option>
								<option value="archive"><?php esc_html_e('Archive', 'easy-elementor-addons'); ?></option>
							</select>
						</div>
						<br>

						<div class="eead-template-modalinput-condition_singular-container">
							<div class="eead-input-group">
								<label class="attr-input-label"></label>
								<select name="condition_singular"
									class="eead-template-modalinput-condition_singular attr-form-control">
									<option value="all"><?php esc_html_e('All Singulars', 'easy-elementor-addons'); ?></option>
									<option value="front_page"><?php esc_html_e('Front Page', 'easy-elementor-addons'); ?></option>
									<option value="all_posts"><?php esc_html_e('All Posts', 'easy-elementor-addons'); ?></option>
									<option value="all_pages"><?php esc_html_e('All Pages', 'easy-elementor-addons'); ?></option>
									<option value="selective"><?php esc_html_e('Selective Singular', 'easy-elementor-addons'); ?>
									</option>
									<option value="404page"><?php esc_html_e('404 Page', 'easy-elementor-addons'); ?></option>
								</select>
							</div>
							<br>

							<div class="eead-template-modalinput-condition_singular_id-container ekit_multipile_ajax_search_filed">
								<div class="eead-input-group">
									<label class="attr-input-label"></label>
									<select multiple name="condition_singular_id[]" class="eead-template-modalinput-condition_singular_id"></select>
								</div>
								<br />
							</div>
							<br>
						</div>


						<div class="eead-switch-group">
							<label class="attr-input-label"><?php esc_html_e('Activate/Deactivate:', 'easy-elementor-addons'); ?></label>
							<div class="eead-admin-input-switch">
								<input checked="" type="checkbox" value="yes"
									class="eead-admin-control-input eead-template-modalinput-activition"
									name="activation" id="ekit_activation_modal_input">
								<label class="eead-admin-control-label" for="ekit_activation_modal_input">
									<span class="eead-admin-control-label-switch" data-active="ON"
										data-inactive="OFF"></span>
								</label>
							</div>
						</div>
					</div>
					<br>
				</div>
				<div class="attr-modal-footer">
					<button type="button" class="attr-btn attr-btn-default eead-template-save-btn-editor"><img src="<?php echo \EEAD_Lite::lib_url(); ?>framework/assets/images/ekit_icon.svg" alt="Ekit Icon"><?php esc_html_e('Edit with Elementor', 'easy-elementor-addons'); ?></button>
					<button type="submit" class="attr-btn attr-btn-primary eead-template-save-btn"><i class="eead-admin-save-icon fa fa-check-circle"></i><?php esc_html_e('Save changes', 'easy-elementor-addons'); ?></button>
				</div>
				<div class="eead-spinner"></div>
			</div>
		</form>
	</div>
</div>