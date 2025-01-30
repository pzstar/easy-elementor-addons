<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$eead_general_settings = get_option('eead_general_settings');
$eead_widgets = get_option('eead_widgets');
$eead_extenders = get_option('eead_extenders');
$gmap_access_token = isset($eead_general_settings['gmap_access_token']) && $eead_general_settings['gmap_access_token'] ? $eead_general_settings['gmap_access_token'] : '';
$weather_api_key = isset($eead_general_settings['weather_api_key']) && $eead_general_settings['weather_api_key'] ? $eead_general_settings['weather_api_key'] : '';


$eead_all_widgets = array(
    'accordion' => array(
        'name' => 'Accordion',
        'icon' => 'eead-icons-accordion'
    ),
    'advanced-button' => array(
        'name' => 'Advanced Button',
        'icon' => 'eead-icons-button'
    ),
    'advanced-heading' => array(
        'name' => 'Advanced Heading',
        'icon' => 'eead-icons-advanced-heading'
    ),
    'advanced-icon-box' => array(
        'name' => 'Advanced Icon Box',
        'icon' => 'eead-icons-icon-text'
    ),
    'advanced-map' => array(
        'name' => 'Advanced Map',
        'icon' => 'eead-icons-map'
    ),
    'animated-heading' => array(
        'name' => 'Animated Heading',
        'icon' => 'eead-icons-animated-heading'
    ),
    'business-hour' => array(
        'name' => 'Business Hour',
        'icon' => 'eead-icons-business-hours'
    ),
    'circular-progressbar' => array(
        'name' => 'Circular Progressbar',
        'icon' => 'eead-icons-circular-bar'
    ),
    'countdown' => array(
        'name' => 'Countdown',
        'icon' => 'eead-icons-count-down'
    ),
    'counter' => array(
        'name' => 'Counter',
        'icon' => 'eead-icons-counter'
    ),
    'drop-bar' => array(
        'name' => 'Drop Bar',
        'icon' => 'eead-icons-drop-box'
    ),
    'dual-button' => array(
        'name' => 'Dual Button',
        'icon' => 'eead-icons-dual-buttons'
    ),
    'dual-heading' => array(
        'name' => 'Dual Heading',
        'icon' => 'eead-icons-dual-heading'
    ),
    'feature-list' => array(
        'name' => 'Feature List',
        'icon' => 'eead-icons-feature-list'
    ),
    'flip-box' => array(
        'name' => 'Flip Box',
        'icon' => 'eead-icons-flip-box'
    ),
    'horizontal-tab' => array(
        'name' => 'Horizontal Tab',
        'icon' => 'eead-icons-horizontal-tab'
    ),
    'horizontal-timeline' => array(
        'name' => 'Horizontal Timeline',
        'icon' => 'eead-icons-horizontal-timeline'
    ),
    'hotspot' => array(
        'name' => 'Hotspot',
        'icon' => 'eead-icons-hot-spot'
    ),
    'icon-list' => array(
        'name' => 'Icon List',
        'icon' => 'eead-icons-icon-list'
    ),
    'image-accordion' => array(
        'name' => 'Image Accordion',
        'icon' => 'eead-icons-image-accordion'
    ),
    'image-comparison' => array(
        'name' => 'Image Comparison',
        'icon' => 'eead-icons-compare'
    ),
    'image-gallery' => array(
        'name' => 'Filterable Gallery',
        'icon' => 'eead-icons-image-gallery'
    ),
    'link-effect' => array(
        'name' => 'Link Effect',
        'icon' => 'eead-icons-link'
    ),
    'logo-carousel' => array(
        'name' => 'Logo Carousel',
        'icon' => 'eead-icons-logo-carousel'
    ),
    'logo-grid' => array(
        'name' => 'Logo Grid',
        'icon' => 'eead-icons-logo-grid'
    ),
    'lottie' => array(
        'name' => 'Lottie',
        'icon' => 'eead-icons-lottie'
    ),
    'one-page-navigation' => array(
        'name' => 'One Page Navigation',
        'icon' => 'eead-icons-one-page-nav'
    ),
    'pie-chart' => array(
        'name' => 'Pie Chart',
        'icon' => 'eead-icons-pie-chart'
    ),
    'popup-modal' => array(
        'name' => 'Popup Modal',
        'icon' => 'eead-icons-popup'
    ),
    'popup-video' => array(
        'name' => 'Popup Video',
        'icon' => 'eead-icons-video-popup'
    ),
    'portfolio' => array(
        'name' => 'Portfolio',
        'icon' => 'eead-icons-portfolio-grid'
    ),
    'portfolio-grid' => array(
        'name' => 'Portfolio Grid',
        'icon' => 'eead-icons-portfolio-grid'
    ),
    'pricing-list' => array(
        'name' => 'Pricing List',
        'icon' => 'eead-icons-pricing-list'
    ),
    'pricing-table' => array(
        'name' => 'Pricing Table',
        'icon' => 'eead-icons-pricing-table'
    ),
    'progressbar' => array(
        'name' => 'Progressbar',
        'icon' => 'eead-icons-progress-bar'
    ),
    'scroll-image' => array(
        'name' => 'Scroll Image',
        'icon' => 'eead-icons-scroll-image'
    ),
    'slider' => array(
        'name' => 'Slider',
        'icon' => 'eead-icons-slider'
    ),
    'social-share' => array(
        'name' => 'Social Share',
        'icon' => 'eead-icons-social-share'
    ),
    'step-flow' => array(
        'name' => 'Step Flow',
        'icon' => 'eead-icons-step-flow'
    ),
    'sticky-video' => array(
        'name' => 'Sticky Video',
        'icon' => 'eead-icons-sticky-video'
    ),
    'switcher' => array(
        'name' => 'Switcher',
        'icon' => 'eead-icons-switcher'
    ),
    'team-member' => array(
        'name' => 'Team',
        'icon' => 'eead-icons-team'
    ),
    'team-carousel' => array(
        'name' => 'Team Carousel',
        'icon' => 'eead-icons-team-carousel'
    ),
    'testimonial' => array(
        'name' => 'Testimonial',
        'icon' => 'eead-icons-testimonial'
    ),
    'testimonial-carousel' => array(
        'name' => 'Testimonial Carousel',
        'icon' => 'eead-icons-testimonial-carousel'
    ),
    'toggle' => array(
        'name' => 'Toggle',
        'icon' => 'eead-icons-toggle'
    ),
    'twitter-feed' => array(
        'name' => 'Twitter Feed',
        'icon' => 'eead-icons-twitter-x'
    ),
    'vertical-tab' => array(
        'name' => 'Vertical Tab',
        'icon' => 'eead-icons-vertical-tab'
    ),
    'vertical-timeline' => array(
        'name' => 'Vertical Timeline',
        'icon' => 'eead-icons-vertical-timeline'
    ),
    'video-player' => array(
        'name' => 'Video Player',
        'icon' => 'eead-icons-video-player'
    ),
    'weather' => array(
        'name' => 'Weather Block',
        'icon' => 'eead-icons-weather'
    ),
);
?>

<div class="eead-wrap">

    <div class="eead-admin-header-section">
        <h1 class="eead-admin-header-text">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160.64 160.67" fill="#111">
                <path d="M74.55 14.94A14.93 14.93 0 0 0 59.64 0H14.91A14.93 14.93 0 0 0 0 14.94v44.73a14.93 14.93 0 0 0 14.91 14.91h44.73a14.93 14.93 0 0 0 14.91-14.91Zm0 86.09a14.92 14.92 0 0 0-14.91-14.91H14.91A14.92 14.92 0 0 0 0 101v44.73a14.93 14.93 0 0 0 14.91 14.91h44.73a14.93 14.93 0 0 0 14.91-14.91Zm86.09 0a14.92 14.92 0 0 0-14.91-14.91H101A14.9 14.9 0 0 0 86.09 101v44.73A14.92 14.92 0 0 0 101 160.67h44.73a14.93 14.93 0 0 0 14.91-14.91ZM133.8 4.33a14.81 14.81 0 0 0-20.92 0l-22.5 22.5a14.79 14.79 0 0 0 0 20.91l22.5 22.5a14.79 14.79 0 0 0 20.92 0l22.49-22.5a14.77 14.77 0 0 0 0-20.9z" />
            </svg>
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
                        <div class="eead-desc">
                            <?php esc_html_e('Tutorial to create ', 'easy-elementor-addons'); ?> <a target="_blank" href="https://hashthemes.com/articles/create-a-google-maps-api-key/" target="_blank"><?php esc_html_e('Google Map Access Token', 'easy-elementor-addons'); ?></a>
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
                    <?php
                    foreach($eead_all_widgets as $key => $val) {
                        $this->get_widget_field($val['name'], $key, $val['icon']);
                    }
                    ?>
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
            <h3>Description</h3>
            <p>Easy Elementor Addons is an all in one element pack extension for Elementor page builder. It provides 50+ creative widgets to provide an outstanding look to your Elementor based WordPress website. The elements are multi concept and contain amazing features to make your website more effective by placing the spectacular widgets and enhance the engagement rate.</p>

            <p>Easy Elementor Addons is a highly editable addon for Elementor with limitless possibilities. You can easily customize each element as per your preference and build a beautiful website beyond your imagination. The plugin has an intuitive UI where you can easily drag drop any elements of your choice and start the configuration. Also, you can follow the drag and drop process to reorder or shuffle any elements.</p>

            <p>Easy Elementor Addons is built using all the modern trends and is well optimized with speed and SEO. So, you can be assured that the extension won’t make any impact on the SEO or the speed of your WordPress website. </p>

            <p><a href="https://demo.hashthemes.com/easy-elementor-addons/" target="_blank">See Demos of All Elementor Widgets</a></p>

            <h3>Elements Available in the Extension:</h3>

            <p>1) <a href="https://demo.hashthemes.com/easy-elementor-addons/accordion/" target="_blank">Accordions</a> - Displays the FAQ of your clients within a beautiful UI.</p>

            <p>2) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-button/" target="_blank">Advanced Button</a> - Allows you to place responsive buttons with different animations, hover effects and many more.</p>

            <p>3) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-heading/" target="_blank">Advanced Heading</a> - Place a unique heading with border, animations, etc.</p>

            <p>4) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-icon-box/" target="_blank">Advanced Icon Box</a> - Lets you create an icon box where you can place an icon with the title, and description.</p>

            <p>5) <a href="https://demo.hashthemes.com/easy-elementor-addons/advanced-map/" target="_blank">Advanced Map</a> - Add fully customizable maps with advanced styling and multiple location markers.</p>

            <p>6) <a href="https://demo.hashthemes.com/easy-elementor-addons/animated-heading/" target="_blank">Animated Heading</a> - Place the animated heading to display your deals, offers, discounts or features of your services in an eye catchy way.</p>

            <p>7) <a href="https://demo.hashthemes.com/easy-elementor-addons/business-hour/" target="_blank">Business Hour</a> - Displays the timetable of the business hour of your company.</p>

            <p>8) <a href="https://demo.hashthemes.com/easy-elementor-addons/circular-progress-bar/" target="_blank">Circular Progress Bar</a> - Displays the work progress of your company in a circular layout.</p>

            <p>9) <a href="https://demo.hashthemes.com/easy-elementor-addons/countdown/" target="_blank">Countdown</a> - Create engaging countdown timers to highlight offers, events, or launches.</p>

            <p>10) <a href="https://demo.hashthemes.com/easy-elementor-addons/counter/" target="_blank">Counter</a> - Let you place a beautiful stats counter of your business by highlighting the achievements.</p>

            <p>11) <a href="https://demo.hashthemes.com/easy-elementor-addons/drop-bar/" target="_blank">Drop Bar</a> - Display a short information on the drop bar and display it in different positions, animation effects.</p>

            <p>12) <a href="https://demo.hashthemes.com/easy-elementor-addons/dual-button/" target="_blank">Dual Button</a> - Design stylish dual-action buttons with unique layouts and effects.</p>

            <p>13) <a href="https://demo.hashthemes.com/easy-elementor-addons/dual-heading/" target="_blank">Dual Heading</a> - Allows you to display the heading in dual effects.</p>

            <p>14) <a href="https://demo.hashthemes.com/easy-elementor-addons/feature-list/" target="_blank">Feature List</a> - Showcase features or services with icons, text, and custom layouts.</p>

            <p>15) <a href="https://demo.hashthemes.com/easy-elementor-addons/flip-box/">Flip Box</a> - Display your information, custom text or even product detail in a customizable flip box.</p>

            <p>16) <a href="https://demo.hashthemes.com/easy-elementor-addons/image-gallery/" target="_blank">Filterable Gallery</a> - Build dynamic, filterable image or video galleries with ease.</p>

            <p>17) <a href="https://demo.hashthemes.com/easy-elementor-addons/horizontal-tab/" target="_blank">Horizontal Tab</a> - Allows you to showcase different information in a responsive horizontal tab.</p>

            <p>18) <a href="https://demo.hashthemes.com/easy-elementor-addons/horizontal-timeline/" target="_blank">Horizontal Timeline</a> - Adds a horizontal timeline to display the evolution, history and success story of your company in a responsive timeline.</p>

            <p>19) <a href="https://demo.hashthemes.com/easy-elementor-addons/hotspot/" target="_blank">Hotspot Block</a> - Add hotspot tooltips of different parts of the images.</p>

            <p>20) <a href="https://demo.hashthemes.com/easy-elementor-addons/icon-list/" target="_blank">Icon List</a> - List down your contents with beautiful icons or png images.</p>

            <p>21) <a href="https://demo.hashthemes.com/easy-elementor-addons/image-accordion/" target="_blank">Image Accordion</a> - Images are displayed in a stacked layout that expands or collapses when clicked, showing or hiding additional images or content</p>

            <p>22) <a href="https://demo.hashthemes.com/easy-elementor-addons/image-comparison/" target="_blank">Image Comparison</a> - To showcase the images before and after editing the images.</p>

            <p>23) <a href="https://demo.hashthemes.com/easy-elementor-addons/link-effect/" target="_blank">Link Effect</a> - Customize your hyperlink by adding different animation effects.</p>

            <p>24) <a href="https://demo.hashthemes.com/easy-elementor-addons/logo-carousel/" target="_blank">Logo Carousel</a> - Highlight the logo of your clients, partners, or sponsor in a beautiful carousel.</p>

            <p>25) <a href="https://demo.hashthemes.com/easy-elementor-addons/logo-grid/" target="_blank">Logo Grid</a> - Highlight the logo of your clients, partners, or sponsor in a beautiful logo grid.</p>

            <p>26) <a href="https://demo.hashthemes.com/easy-elementor-addons/lottie/" target="_blank">Lottie</a> - Embed lightweight, animated Lottie files to enhance interactivity.</p>

            <p>27) <a href="https://demo.hashthemes.com/easy-elementor-addons/one-page-navigation/" target="_blank">One Page Navigation</a> - Place an extra navigator to navigate different contents present in a single page.</p>

            <p>28) <a href="https://demo.hashthemes.com/easy-elementor-addons/pie-chart/" target="_blank">Pie Chart</a> - Display your company progress in a beautiful pie chart.</p>

            <p>29) <a href="https://demo.hashthemes.com/easy-elementor-addons/popup/" target="_blank">Popup Modal</a> - Place an animated popup with different animations.</p>

            <p>30) <a href="https://demo.hashthemes.com/easy-elementor-addons/video-popup/" target="_blank">Popup Video</a> - Add eye-catching video popups to boost user engagement.</p>

            <p>31) <a href="https://demo.hashthemes.com/easy-elementor-addons/portfolios/" target="_blank">Portfolio Block</a> - Allows you to create a beautiful portfolio gallery of your work with an amazing light box image.</p>

            <p>32) <a href="https://demo.hashthemes.com/easy-elementor-addons/pricing-grid/" target="_blank">Portfolio Grid</a> - Organize and display portfolios in a clean, grid-style layout.</p>

            <p>33) <a href="https://demo.hashthemes.com/easy-elementor-addons/pricing-list/" target="_blank">Pricing List</a> - Showcase the pricing of your products in a unique fashion.</p>

            <p>34) <a href="https://demo.hashthemes.com/easy-elementor-addons/pricing-table/" target="_blank">Pricing Table</a> - Display the pricing plan of your services in a beautifully designed pricing table.</p>

            <p>35) <a href="https://demo.hashthemes.com/easy-elementor-addons/progress-bar/" target="_blank">Progress Bar</a> - Allows you to showcase your work progress in an attractive progress bar.</p>

            <p>36) <a href="https://demo.hashthemes.com/easy-elementor-addons/scroll-image/" target="_blank">Scroll Image</a> - Let’s you showcase a long and full width image in a short space. Automatically scroll the images when hovered over.</p>

            <p>37) <a href="https://demo.hashthemes.com/easy-elementor-addons/slider/" target="_blank">Slider Block</a> - Highlight your announcements, deals or even products in a responsive slider.</p>

            <p>38) <a href="https://demo.hashthemes.com/easy-elementor-addons/social-share/" target="_blank">Social Share</a> - Add social share buttons to share your pages or posts to different social media networks in a single click.</p>

            <p>39) <a href="https://demo.hashthemes.com/easy-elementor-addons/step-flow/" target="_blank">Step Flow</a> - Present step-by-step processes with a clean and professional layout.</p>

            <p>40) <a href="https://demo.hashthemes.com/easy-elementor-addons/sticky-video/" target="_blank">Sticky Video</a> - Keep videos visible while users scroll through the page.</p>

            <p>41) <a href="https://demo.hashthemes.com/easy-elementor-addons/switcher/" target="_blank">Switcher</a> - To display multiple web contents in a switcher for comparison.</p>

            <p>42) <a href="https://demo.hashthemes.com/easy-elementor-addons/team-member/" target="_blank">Team</a> - Display your team members of your company/organization.</p>

            <p>43) <a href="https://demo.hashthemes.com/easy-elementor-addons/team-carousel/" target="_blank">Team Carousel</a> - Display your team members of your company/organization in an attractive carousel.</p>

            <p>44) <a href="https://demo.hashthemes.com/easy-elementor-addons/testimonial/" target="_blank">Testimonial</a> - Showcase the positive words given by your clients in a stunning way.</p>

            <p>45) <a href="https://demo.hashthemes.com/easy-elementor-addons/testimonial-carousel/" target="_blank">Testimonial Carousel</a> - Showcase the positive words given by your client in a beautiful slider.</p>

            <p>46) <a href="https://demo.hashthemes.com/easy-elementor-addons/toggle/" target="_blank">Toggle</a> - Display multiple contents and toggle them for comparison.</p>

            <p>47) <a href="https://demo.hashthemes.com/easy-elementor-addons/twitter-feed/" target="_blank">Twitter Feed</a> - Display real-time Twitter feeds directly on your website.</p>

            <p>48) <a href="https://demo.hashthemes.com/easy-elementor-addons/vertical-tab/" target="_blank">Vertical Tab</a> - Allows you to showcase different information in a responsive vertical tab.</p>

            <p>49) <a href="https://demo.hashthemes.com/easy-elementor-addons/vertical-timeline/" target="_blank">Vertical Timeline</a> - Adds a vertical timeline to represent the evolution, history and success story of your company in a responsive timeline.</p>

            <p>50) <a href="https://demo.hashthemes.com/easy-elementor-addons/video-player/" target="_blank">Video Player</a> - Allow you to embed the videos from Youtube, Vimeo or from your local computer.</p>

            <p>51) <a href="https://demo.hashthemes.com/easy-elementor-addons/weather/" target="_blank">Weather Block</a> - Adds a weather report of a city with humidity, Pressure and Wind Speed.</p>

            <p>More Comming</p>

            <h3>Compatibility:</h3>
            <p>Easy Elementor Addons is compatible with all types of free and premium WordPress themes. The only thing is that you will need to install Elementor Plugin.</p>

            <h3>Support:</h3>
            <p>If you have any issues while using our plugin, feel free to contact us for support. Our support team will be more than happy to help you resolve your issue. You can chat with us or email us at our website <a href="https://hashthemes.com/" target="_blank">here</a>.</p>

            <p style="height:40px;"></p>
        </div>

        <div class="eead-admin-notificn" style="display: none;"></div>
    </div>
</div>