<?php defined( 'ABSPATH' ) || exit; ?>
<div class="eead-live-editor-iframe-modal">
	<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox elementor-templates-modal eead-dynamic-content-modal" id="elementor-template-eead-live-editor-modal-container" style="display:none">
		<div class="dialog-widget-content dialog-lightbox-widget-content">
			<div class="dialog-header dialog-lightbox-header">
				<div class="elementor-templates-modal__header">
					<div class="elementor-templates-modal__header__logo-area">
						<div class="elementor-templates-modal__header__logo">
							<span class="elementor-templates-modal__header__logo__icon-wrapper" id="eead-live-editor-logo">
								<span class="eead-template-modal-header-logo-icon"></span>
							</span>

							<span class="elementor-templates-modal__header__logo__title"><?php esc_html_e('Template Editor', 'easy-elementor-addons'); ?></span>
							<div class="eead-live-editor-title">
								<input type="text" id="eead-live-temp-title" name="premiumLiveTempTitle" placeholder="<?php esc_attr_e('Enter template name...', 'easy-elementor-addons'); ?>">

								<button id="eead-insert-live-temp" class="elementor-template-library-template-action eead-template-insert elementor-button elementor-button-success">
									<?php esc_html_e('Save & Insert Template', 'easy-elementor-addons'); ?>
								</button>

								<span class="eead-live-temp-notice"><?php esc_html_e('(Make sure to click update button first)', 'easy-elementor-addons'); ?></span>
							</div>
						</div>
					</div>

					<div class="elementor-templates-modal__header__items-area">
						<div class="elementor-templates-modal__header__close elementor-templates-modal__header__close--normal elementor-templates-modal__header__item">
							<i class="eicon-close" aria-hidden="true" title="<?php esc_attr_e('Close', 'easy-elementor-addons'); ?>"></i>
							<span class="elementor-screen-only"><?php esc_html_e('Close', 'easy-elementor-addons'); ?></span>
						</div>

						<div class="elementor-templates-modal__header__expand  elementor-templates-modal__header__item eead-expand">
							<i class="eicon-frame-expand" aria-hidden="true" title="<?php esc_attr_e('Expand', 'easy-elementor-addons'); ?>"></i>
							<span class="elementor-screen-only"><?php esc_html_e('Expand', 'easy-elementor-addons'); ?></span>
						</div>
					</div>
				</div>
			</div>

			<div class="dialog-message dialog-lightbox-message">
				<div class="dialog-content dialog-lightbox-content" style="display: block;">
					<div id="elementor-template-library-templates" data-template-source="remote">
						<div id="elementor-template-library-templates-container">
							<iframe id="eead-live-editor-control-iframe"></iframe>
						</div>
					</div>
				</div>

				<div class="dialog-loading dialog-lightbox-loading" style="display: block;">
					<div id="elementor-template-library-loading">
						<div class="elementor-loader-wrapper">
							<div class="elementor-loader">
								<div class="elementor-loader-boxes">
									<div class="elementor-loader-box"></div>
									<div class="elementor-loader-box"></div>
									<div class="elementor-loader-box"></div>
									<div class="elementor-loader-box"></div>
								</div>
							</div>

							<div class="elementor-loading-title"><?php esc_html_e('Loading', 'easy-elementor-addons'); ?></div>
						</div>
					</div>
				</div>
			</div>

			<div class="dialog-buttons-wrapper dialog-lightbox-buttons-wrapper"></div>
		</div>
	</div>
</div>
