<?php
$eead_general_settings = get_option('eead_general_settings');
$eead_widgets = get_option('eead_widgets');
$eead_extenders = get_option('eead_extenders');
$gmap_access_token = isset($eead_general_settings['gmap_access_token']) && $eead_general_settings['gmap_access_token'] ? $eead_general_settings['gmap_access_token'] : '';
$weather_api_key = isset($eead_general_settings['weather_api_key']) && $eead_general_settings['weather_api_key'] ? $eead_general_settings['weather_api_key'] : '';
?>

<div class="eead-wrap">

    <div class="eead-admin-header-section">
        <h1 class="eead-admin-header-text">
            <?php echo esc_html__('Easy Elementor Addons Setttings', 'easy-elementor-addons'); ?>
        </h1>
        <div class="eead-version">v<?php echo EEAD_VERSION; ?></div>
    </div>

    <nav class="eead-nav-tab-wrapper">
        <a href="javascript:void(0)" class="nav-tab-active eead-tab" data-tab="eead-api-settings-content" data-tohide="tab-content">
            <i class="mdi mdi-cog"></i><?php esc_html_e('Settings', 'easy-elementor-addons'); ?>
        </a>

        <a href="javascript:void(0)" class="eead-tab" data-tab="eead-widgets-section-content" data-tohide="tab-content">
            <i class="mdi mdi-widgets-outline"></i><?php esc_html_e('Widgets', 'easy-elementor-addons'); ?>
        </a>

        <a href="javascript:void(0)" class="eead-tab" data-tab="eead-about-section-content" data-tohide="tab-content">
            <i class="mdi mdi-file-document-multiple-outline"></i><?php esc_html_e('About', 'easy-elementor-addons'); ?>
        </a>
    </nav>

    <div class="eead-tab-contents">
        <div id="eead-api-settings-content" class="tab-content">
            <form id="eead-general-settings-form">
                <div class="eead-google-api-key">
                    <div class="eead-settings-field">
                        <label><?php esc_html_e('Google Map Access Token', 'easy-elementor-addons') ?></label>
                        <div class="eead-settings-input-field">
                            <input type="text" name="gmap_access_token" placeholder="Enter Your Gmap Access Token" value="<?php echo esc_attr($gmap_access_token); ?>">
                        </div>
                    </div>

                    <div class="eead-settings-field">
                        <label><?php esc_html_e('Weather API Key', 'easy-elementor-addons') ?></label>
                        <div class="eead-settings-input-field">
                            <input type="text" name="weather_api_key" placeholder="Enter Your API Key" value="<?php echo esc_attr($weather_api_key); ?>">
                        </div>
                        <div class="eead-desc">
                        <?php esc_html_e('To get the api key click', 'easy-elementor-addons') ?> <a target="_blank" href="https://weatherstack.com/quickstart" target="_blank">here</a>
                        </div>
                    </div>
                </div>

                <div class="eaad-save-button-wrap">
                    <button class="eead-save-button" id="eead-general-settings-save">
                        <i class="mdi mdi-content-save"></i>
                        <?php esc_html_e('Save', 'easy-elementor-addons'); ?>
                        <span class="eead-loader"></span></button>
                </div>
            </form>
        </div>

        <div id="eead-widgets-section-content" class="tab-content" style="display: none;">
            <div class="eead-widget-action-buttons">
                <button class="eead-widget-action-btn eead-widget-enable-all"><i class="mdi mdi-check-circle-outline"></i><?php esc_html_e('Enable All', 'easy-elementor-addons') ?></button>
                <button class="eead-widget-action-btn eead-widget-disable-all"><i class="mdi mdi-close-circle-outline"></i><?php esc_html_e('Disable All', 'easy-elementor-addons') ?></button>
            </div>

            <form id="eead-widget-selection-form">
                <div class="eead-widget-section-inner-wrap">
                    <?php $this->get_widget_field('Accordion', 'accordion', 'eead-icons-accordion'); ?>
                    <?php $this->get_widget_field('Advanced Button', 'advanced-button', 'eead-icons-button'); ?>
                    <?php $this->get_widget_field('Advanced Heading', 'advanced-heading', 'eead-icons-advanced-heading'); ?>
                    <?php $this->get_widget_field('Advanced Icon Box', 'advanced-icon-box', 'eead-icons-icon-text'); ?>
                    <?php $this->get_widget_field('Advanced Map', 'advanced-map', 'eead-icons-map'); ?>
                    <?php $this->get_widget_field('Animated Heading', 'animated-heading', 'eead-icons-animated-heading'); ?>
                    <?php //$this->get_widget_field('Animated Icon', 'animated-icon', 'eead-icons-animated-icon'); //premium ?>
                    <?php $this->get_widget_field('Business Hour', 'business-hour', 'eead-icons-business-hours'); ?>
                    <?php //$this->get_widget_field('Caption Hover Effect', 'caption-hover-effect', 'eead-icons-'); //premium ?>
                    <?php //$this->get_widget_field('Charts', 'charts', 'eead-icons-chart'); //premium ?>
                    <?php $this->get_widget_field('Circular Progressbar', 'circular-progressbar', 'eead-icons-circular-bar'); ?>
                    <?php $this->get_widget_field('Countdown', 'countdown', 'eead-icons-count-down'); ?>
                    <?php $this->get_widget_field('Counter', 'counter', 'eead-icons-counter'); ?>
                    <?php $this->get_widget_field('Drop Bar', 'drop-bar', 'eead-icons-drop-box'); ?>
                    <?php $this->get_widget_field('Dual Button', 'dual-button', 'eead-icons-dual-buttons'); ?>
                    <?php $this->get_widget_field('Dual Heading', 'dual-heading', 'eead-icons-dual-heading'); ?>
                    <?php $this->get_widget_field('Feature List', 'feature-list', 'eead-icons-feature-list'); ?>
                    <?php //$this->get_widget_field('Filterable Gallery', 'filterable-gallery', 'eead-icons-gallery-grid'); //premium ?>
                    <?php $this->get_widget_field('Flip Box', 'flip-box', 'eead-icons-flip-box'); ?>
                    <?php //$this->get_widget_field('Flip Box Advanced', 'flip-box-advanced', 'eead-icons-flip-box');//premium ?>
                    <?php //$this->get_widget_field('Horizontal Scroll', 'horizontal-scroll', 'eead-icons-'); //premium ?>
                    <?php $this->get_widget_field('Horizontal Tab', 'horizontal-tab', 'eead-icons-horizontal-tab'); ?>
                    <?php $this->get_widget_field('Horizontal Timeline', 'horizontal-timeline', 'eead-icons-horizontal-timeline'); ?>
                    <?php $this->get_widget_field('Hotspot', 'hotspot', 'eead-icons-hot-spot'); ?>
                    <?php $this->get_widget_field('Icon List', 'icon-list', 'eead-icons-icon-list'); ?>
                    <?php $this->get_widget_field('Image Accordion', 'image-accordion', 'eead-icons-image-accordion'); ?>
                    <?php $this->get_widget_field('Image Comparison', 'image-comparison', 'eead-icons-compare'); ?>
                    <?php $this->get_widget_field('Image Gallery', 'image-gallery', 'eead-icons-image-gallery'); ?>
                    <?php $this->get_widget_field('Link Effect', 'link-effect', 'eead-icons-link'); ?>
                    <?php $this->get_widget_field('Logo Carousel', 'logo-carousel', 'eead-icons-logo-carousel'); ?>
                    <?php $this->get_widget_field('Logo Grid', 'logo-grid', 'eead-icons-logo-grid'); ?>
                    <?php $this->get_widget_field('Lottie', 'lottie', 'eead-icons-lottie'); ?>
                    <?php //$this->get_widget_field('Morphing Layouts', 'morphing-layouts', 'eead-icons-'); //premium ?>
                    <?php //$this->get_widget_field('Multi Scroll', 'multi-scroll', 'eead-icons-'); //premium ?>
                    <?php $this->get_widget_field('One Page Navigation', 'one-page-navigation', 'eead-icons-one-page-nav'); ?>
                    <?php $this->get_widget_field('Pie Chart', 'pie-chart', 'eead-icons-pie-chart'); ?>
                    <?php $this->get_widget_field('Popup Modal', 'popup-modal', 'eead-icons-popup'); ?>
                    <?php $this->get_widget_field('Popup Video', 'popup-video', 'eead-icons-video-popup'); ?>
                    <?php $this->get_widget_field('Portfolio', 'portfolio', 'eead-icons-portfolio-grid'); ?>
                    <?php $this->get_widget_field('Portfolio Grid', 'portfolio-grid', 'eead-icons-portfolio-grid'); // ?>
                    <?php $this->get_widget_field('Pricing List', 'pricing-list', 'eead-icons-pricing-list'); ?>
                    <?php $this->get_widget_field('Pricing Table', 'pricing-table', 'eead-icons-pricing-table'); ?>
                    <?php $this->get_widget_field('Progressbar', 'progressbar', 'eead-icons-progress-bar'); ?>
                    <?php $this->get_widget_field('Scroll Image', 'scroll-image', 'eead-icons-scroll-image'); ?>
                    <?php //$this->get_widget_field('Scroll Nav', 'scroll-nav', 'eead-icons-');  //premium ?>
                    <?php $this->get_widget_field('Slider', 'slider', 'eead-icons-slider'); ?>
                    <?php //$this->get_widget_field('Slinky Vertical Menu', 'slinky-vertical-menu', 'eead-icons-'); //premium ?>
                    <?php $this->get_widget_field('Social Share', 'social-share', 'eead-icons-social-share'); ?>
                    <?php $this->get_widget_field('Step Flow', 'step-flow', 'eead-icons-step-flow'); ?>
                    <?php $this->get_widget_field('Sticky Video', 'sticky-video', 'eead-icons-sticky-video'); ?>
                    <?php $this->get_widget_field('Switcher', 'switcher', 'eead-icons-switcher'); ?>
                    <?php $this->get_widget_field('Team Member', 'team-member', 'eead-icons-team'); ?>
                    <?php $this->get_widget_field('Team Member Carousel', 'team-member-carousel', 'eead-icons-team-carousel'); ?>
                    <?php $this->get_widget_field('Testimonial', 'testimonial', 'eead-icons-testimonial'); ?>
                    <?php $this->get_widget_field('Testimonial Slider', 'testimonial-slider', 'eead-icons-testimonial-slider'); ?>
                    <?php //$this->get_widget_field('Text Marquee', 'text-marquee', 'eead-icons-');//premium ?>
                    <?php //$this->get_widget_field('3D Text', 'threed-text', 'eead-icons-');//premium ?>
                    <?php //$this->get_widget_field('360 Image', 'threesixty-image', 'eead-icons-image360'); //premium ?>
                    <?php //$this->get_widget_field('Tilt Hover Image', 'tilt-hover-image', 'eead-icons-'); //premium ?>
                    <?php $this->get_widget_field('Toggle', 'toggle', 'eead-icons-toggle'); ?>
                    <?php $this->get_widget_field('Twitter Feed', 'twitter-feed', 'eead-icons-twitter-x'); ?>
                    <?php $this->get_widget_field('Twitter Feed Carousel', 'twitter-feed-carousel', 'eead-icons-twitter-x'); ?>
                    <?php $this->get_widget_field('Vertical Tab', 'vertical-tab', 'eead-icons-vertical-tab'); ?>
                    <?php $this->get_widget_field('Vertical Timeline', 'vertical-timeline', 'eead-icons-vertical-timeline'); ?>
                    <?php $this->get_widget_field('Video Player', 'video-player', 'eead-icons-video-player'); ?>
                    <?php $this->get_widget_field('Weather Block', 'weather', 'eead-icons-weather'); ?>
                </div>

                <div class="eaad-save-button-wrap">
                    <button name="eead-widget-enable" id="eead-widget-selection-btn" class="eead-save-button">
                        <i class="mdi mdi-content-save"></i><?php esc_html_e('Save', 'easy-elementor-addons'); ?>
                        <span class="eead-loader"></span>
                    </button>
                </div>
            </form>
        </div>

        <div id="eead-about-section-content" class="tab-content" style="display: none;">
            <h2><?php esc_html_e('About US', 'easy-elementor-addons'); ?></h2>

            <p>Easy Elementor Addons is an all in one element pack extension for Elementor page builder. It provides 40 creative widgets to provide an outstanding look to your Elementor based WordPress website. The elements are multi concept and contain amazing features to make your website more effective by placing the spectacular widgets and enhance the engagement rate.</p>

            <p>Easy Elementor Addons is a highly editable addon for Elementor with limitless possibilities. You can easily customize each element as per your preference and build a beautiful website beyond your imagination. The plugin has an intuitive UI where you can easily drag drop any elements of your choice and start the configuration. Also, you can follow the drag and drop process to reorder or shuffle any elements.</p>

            <p>Easy Elementor Addons is built using all the modern trends and is well optimized with speed and SEO. So, you can be assured that the extension won’t make any impact on the SEO or the speed of your WordPress website.</p>

            <p><a href="https://demo.hashthemes.com/easy-elementor-addons/" target="_blank">See Demos of All Elementor Widgets</a></p>

            <h3>Elements Available in the Extension:</h3>

            <p>1) <a href="https://demo.hashthemes.com/easy-elementor-addons/social-share/" target="_blank">Social Share</a> - Add social share buttons to share your pages or posts to different social media networks in a single click.</p>

            <p>2) <a href="https://demo.hashthemes.com/easy-elementor-addons/vertical-timeline/" target="_blank">Vertical Timeline</a> - Adds a vertical timeline to represent the evolution, history and success story of your company in a responsive timeline.</p>

            <p>3) <a href="https://demo.hashthemes.com/easy-elementor-addons/horizontal-timeline/" target="_blank">Horizontal Timeline</a> - Adds a horizontal timeline to display the evolution, history and success story of your company in a responsive timeline.</p>

            <p>4) <a href="https://demo.hashthemes.com/easy-elementor-addons/image-comparison/" target="_blank">Image Comparison</a> - To showcase the images before and after editing the images.</p>

            <p>5) <a href="https://demo.hashthemes.com/easy-elementor-addons/hotspot/" target="_blank">Hotspot Block</a> - Add hotspot tooltips of different parts of the images.</p>

            <p>6) <a href="https://demo.hashthemes.com/easy-elementor-addons/business-hour/" target="_blank">Business Hour</a> - Displays the timetable of the business hour of your company.</p>

            <p>7) <a href="https://demo.hashthemes.com/easy-elementor-addons/switcher/" target="_blank">Switcher</a> - To display multiple web contents in a switcher for comparison.</p>

            <p>8) <a href="https://demo.hashthemes.com/easy-elementor-addons/vertical-tab/" target="_blank">Vertical Tab</a> - Allows you to showcase different information in a responsive vertical tab.</p>

            <p>9) <a href="https://demo.hashthemes.com/easy-elementor-addons/vertical-tab/" target="_blank">Horizontal Tab</a> - Allows you to showcase different information in a responsive horizontal tab.</p>

            <p>10) <a href="https://demo.hashthemes.com/easy-elementor-addons/accordion/" target="_blank">Accordions</a> - To display the FAQ of your clients within a beautiful UI.</p>

            <p>11) <a href="https://demo.hashthemes.com/easy-elementor-addons/animated-heading/" target="_blank">Animated Heading</a> - Place the animated heading to display your deals, offers, discounts or features of your services in an eye catchy way.</p>

            <p>12) <a href="https://demo.hashthemes.com/easy-elementor-addons/pricing-list/" target="_blank">Pricing List</a> - Showcase the pricing of your products in a unique fashion.</p>

            <p>13) <a href="https://demo.hashthemes.com/easy-elementor-addons/pricing-table/" target="_blank">Pricing Table</a> - Display the pricing plan of your services in a beautifully designed pricing table.</p>

            <p>14) <a href="https://demo.hashthemes.com/easy-elementor-addons/scroll-image/" target="_blank">Scroll Image</a> - Let’s you showcase a long and full width image in a short space. Automatically scroll the images when hovered over.</p>

            <p>15) <a href="https://demo.hashthemes.com/easy-elementor-addons/image-gallery/" target="_blank">Image Gallery</a> - Creates a beautiful image gallery to let you showcase your work portfolio.</p>

            <p>16) <a href="https://demo.hashthemes.com/easy-elementor-addons/video-player/" target="_blank">Video Player</a> - Allow you to embed the videos from Youtube, Vimeo or from your local computer.</p>

            <p>17) <a href="https://demo.hashthemes.com/easy-elementor-addons/weather/" target="_blank">Weather Block</a> - Adds a weather report of a city with humidity, Pressure and Wind Speed.</p>

            <p>18) <a href="https://demo.hashthemes.com/easy-elementor-addons/circular-progress-bar/" target="_blank">Circular Progress Bar</a> - Displays the work progress of your company in a circular layout.</p>

            <p>19) <a href="http://demo.hashthemes.com/easy-elementor-addons/progress-bar/" target="_blank">Progress Bar</a> - Allows you to showcase your work progress in an attractive progress bar.</p>

            <p>20) <a href="https://demo.hashthemes.com/easy-elementor-addons/counter/" target="_blank">Counter</a> - Let you place a beautiful stats counter of your business by highlighting the achievements.</p>

            <p>21) <a href="https://demo.hashthemes.com/easy-elementor-addons/portfolios/" target="_blank">Portfolio Block</a> - Allows you to create a beautiful portfolio gallery of your work with an amazing light box image.</p>

            <p>22) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-button/" target="_blank">Advanced Button</a> - Allows you to place responsive buttons with different animations, hover effects and many more.</p>

            <p>23) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-icon-box/" target="_blank">Advanced Icon Box</a> - Lets you create an icon box where you can place an icon with the title, and description.</p>

            <p>24) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-heading/" target="_blank">Advanced Heading</a> - Place a unique heading with border, animations, etc.</p>

            <p>25) <a href="https://demo.hashthemes.com/easy-elementor-addons/drop-bar/" target="_blank">Drop Bar</a> - Display a short information on the drop bar and display it in different positions, animation effects.</p>

            <p>26) <a href="https://demo.hashthemes.com/easy-elementor-addons/flip-box/" target="_blank">Flip Box</a> - Display your information, custom text or even product detail in a customizable flip box.</p>

            <p>27) <a href="https://demo.hashthemes.com/easy-elementor-addons/dual-heading/" target="_blank">Dual Heading</a> - Allows you to display the heading in dual effects.</p>

            <p>28) <a href="https://demo.hashthemes.com/easy-elementor-addons/link-effect/" target="_blank">Link Effect</a> - Customize your hyperlink by adding different animation effects.</p>

            <p>29) <a href="https://demo.hashthemes.com/easy-elementor-addons/one-page-navigation/" target="_blank">One Page Navigation</a> - Place an extra navigator to navigate different contents present in a single page.</p>

            <p>30) <a href="https://demo.hashthemes.com/easy-elementor-addons/icon-list/" target="_blank">Icon List</a> - List down your contents with beautiful icons or png images.</p>

            <p>31) <a href="https://demo.hashthemes.com/easy-elementor-addons/toggle/" target="_blank">Toggle Block</a> - Display multiple contents and toggle them for comparison.</p>

            <p>32) <a href="https://demo.hashthemes.com/easy-elementor-addons/logo-grid/" target="_blank">Logo Grid</a> - Highlight the logo of your clients, partners, or sponsor in a beautiful logo grid.</p>

            <p>33) <a href="https://demo.hashthemes.com/easy-elementor-addons/logo-carousel/" target="_blank">Logo Carousel</a> - Highlight the logo of your clients, partners, or sponsor in a beautiful carousel.</p>

            <p>34) <a href="https://demo.hashthemes.com/easy-elementor-addons/team-member/" target="_blank">Team Member</a> - Display your team members of your company/organization.</p>

            <p>35) <a href="https://demo.hashthemes.com/easy-elementor-addons/team-carousel/" target="_blank">Team Carousel</a> - Display your team members of your company/organization in an attractive carousel.</p>

            <p>36) <a href="https://demo.hashthemes.com/easy-elementor-addons/pie-chart/" target="_blank">Pie Chart</a> - Display your company progress in a beautiful pie chart.</p>

            <p>37) <a href="https://demo.hashthemes.com/easy-elementor-addons/popup/" target="_blank">Popup Modal</a> - Place an animated popup with different animations.</p>

            <p>38) <a href="https://demo.hashthemes.com/easy-elementor-addons/testimonial/" target="_blank">Testimonial</a> - Showcase the positive words given by your clients in a stunning way.</p>

            <p>39) <a href="https://demo.hashthemes.com/easy-elementor-addons/testimonial-slider/" target="_blank">Testimonial Slider</a> - Showcase the positive words given by your client in a beautiful slider.</p>

            <p>40) <a href="https://demo.hashthemes.com/easy-elementor-addons/slider/" target="_blank">Slider Block</a> - Highlight your announcements, deals or even products in a responsive slider.</p>


            <h3>Compatibility:</h3>
            <p>Easy Elementor Addons is compatible with all types of free and premium WordPress themes. The only thing is that you will need to install Elementor Plugin.</p>

            <h3>Support:</h3>
            <p>If you have any issues while using our plugin, feel free to contact us for support. Our support team will be more than happy to help you resolve your issue. You can chat with us or email us at our website <a href="https://hashthemes.com/" target="_blank">here</a>.</p>


            <h3>Installation</h3>
            <p>The easy way to install the plugin is via WordPress.org plugin directory.</p>

            <ol>
                <li>Go to WordPress Dashboard > Plugins > Add New</li>
                <li>Search for "Easy Elementor Addons" and install the plugin.</li>
                <li>Activate Plugin from "Plugins" menu in WordPress.</li>
            </ol>
            <p style="height:40px;"></p>
        </div>

        <div class="eead-admin-notificn" style="display: none;"></div>
    </div>
</div>