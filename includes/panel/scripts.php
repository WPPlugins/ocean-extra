<?php
/**
 * Scripts Panel
 *
 * @package Ocean_Extra
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class Ocean_Extra_Scripts_Panel {

	/**
	 * Start things up
	 */
	public function __construct() {

		if ( is_admin() ) {

			// Add panel menu
			add_action( 'admin_menu', 				array( $this, 'add_page' ), 10 );

			// Add custom scripts
			add_action( 'admin_enqueue_scripts', 	array( $this, 'admin_scripts' ) );

			// Register panel settings
			add_action( 'admin_init', 				array( $this, 'register_settings' ) );

		} else {

			// Enqueue scripts
			add_action( 'wp_enqueue_scripts', 		array( $this, 'enqueue_scripts' ), 999 );

			// Add body classes
			add_filter( 'body_class', 				array( $this, 'body_classes' ) );

		}

	}

	/**
	 * Return scripts
	 *
	 * @since 1.2.1
	 */
	private static function get_scripts() {

		$scripts = array(
			'oe_customSelect_script' => array(
				'label' => esc_html__( 'Custom Select', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The customSelect.js script uses the native select box and add overlays a stylable <span> element in order to acheive the desired look.', 'ocean-extra' ),
				'type' 	=> 'js',
			),

			'oe_dropDownSearch_script' => array(
				'label' => esc_html__( 'Drop Down Search', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The dropDownSearch.js script is for the drop down search style in your navigation.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_headerReplaceSearch_script' => array(
				'label' => esc_html__( 'Header Replace Search', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The headerReplaceSearch.js script is for the header replace search style in your navigation.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_overlaySearch_script' => array(
				'label' => esc_html__( 'Overlay Search', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The overlaySearch.js script is for the overlay search style in your navigation.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_fitVids_script' => array(
				'label' => esc_html__( 'FitVids', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The fitVids.js script is to achieve fluid width videos in your responsive web design, your videos looks good on all devices.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_fixedFooter_script' => array(
				'label' => esc_html__( 'Fixed Footer', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The fixedFooter.js script adds a height to your content to keep your footer at the bottom of your page, the Fixed Footer option need to be activated in the customizer&rsquo;s Footer Widgets section.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_fullScreenMenu_script' => array(
				'label' => esc_html__( 'Full Screen Menu', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The fullScreenMenu.js script is to open your menu in overlay for the full screen header style, you can disable this function if you do not use this header style.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_headerSearchForm_script' => array(
				'label' => esc_html__( 'Header Search Form', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The headerSearchForm.js script is to add a class to the search form to make the label disappear when text is inserted, used on some header style like medium or full screen.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_infiniteScroll_script' => array(
				'label' => esc_html__( 'Infinite Scroll', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The infiniteScroll.js script create an infinite scrolling effect, used for the blog archives page if Infinite Scroll is selected as pagination style.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_isotope_script' => array(
				'label' => esc_html__( 'Isotope', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The isotope.js script is to filter & sort layouts, used for the masonry grid style of your blog and will be used in some extensions.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_lightbox_script' => array(
				'label' => esc_html__( 'Lightbox', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The lightbox.js script enables you to overlay your images on the current page, used for the gallerie, single product and content images.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_matchHeight_script' => array(
				'label' => esc_html__( 'Match Height', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The matchHeight.js is a responsive equal heights script makes the height of all selected elements exactly equal, used for the grid blog style.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_megaMenu_script' => array(
				'label' => esc_html__( 'Mega Menu', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The megaMenu.js script is to create the mega menus, so if you don&rsquo;t use mega menus at all on your website, you can disable this script.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_navNoClick_script' => array(
				'label' => esc_html__( 'Nav No Click', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The navNoClick.js script is to prevent clicking on your links, used for the "Disable link" field of your menu items.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_scrollEffect_script' => array(
				'label' => esc_html__( 'Scroll Effect', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The scrollEffect.js script create an animation to your anchor links, mainly used for a one page site but also for some links like the comment link on your single posts.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_scrollTop_script' => array(
				'label' => esc_html__( 'Scroll Top', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The scrollTop.js script is to displays the scroll up button and brings you back to the top of your page when you click on it.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_sidr_script' => array(
				'label' => esc_html__( 'Sidr', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The sidr.js script is for easily creating responsive side menus, used for the mobile menu.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_slick_script' => array(
				'label' => esc_html__( 'Slick', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The slick.js script is used for all the carousel of your site, gallerie images, WooCommerce single product images and thumbnails.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_smoothScroll_script' => array(
				'label' => esc_html__( 'SmoothScroll', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The smoothScroll.js script adds a smooth scrolling to the browser.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_superfish_script' => array(
				'label' => esc_html__( 'Superfish', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The superfish.js script adds usability enhancements to existing multi-level drop-down menus.', 'ocean-extra' ),
				'type' 	=> 'js',
			),
			'oe_wooGridList_script' => array(
				'label' => esc_html__( 'WooCommerce Grid/List Buttons', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The wooGridList.js script is to switch between grid and list view on your WooCommerce catalog products.', 'ocean-extra' ),
				'type' 	=> 'js',
				'condition' => OCEANWP_WOOCOMMERCE_ACTIVE,
			),
			'oe_wooMenuCart_script' => array(
				'label' => esc_html__( 'WooCommerce Menu Cart', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The wooMenuCart.js script is to display and hide your WooCommerce cart drop down in the navigation.', 'ocean-extra' ),
				'type' 	=> 'js',
				'condition' => OCEANWP_WOOCOMMERCE_ACTIVE,
			),
			'oe_wooCategoriesWidget_script' => array(
				'label' => esc_html__( 'WooCommerce Categories Widget', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The wooCategoriesWidget.js script adds a button to show your sub products categories when you click on it for the WooCommerce categories widget.', 'ocean-extra' ),
				'type' 	=> 'js',
				'condition' => OCEANWP_WOOCOMMERCE_ACTIVE,
			),
			'oe_wooQuantityButtons_script' => array(
				'label' => esc_html__( 'WooCommerce Quantity Buttons', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The wooQuantityButtons.js script is to add a up and down button for the quantity input number on your WooCommerce single products and cart pages.', 'ocean-extra' ),
				'type' 	=> 'js',
				'condition' => OCEANWP_WOOCOMMERCE_ACTIVE,
			),
			'oe_wooReviewsScroll_script' => array(
				'label' => esc_html__( 'WooCommerce Reviews Scroll', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The wooReviewsScroll.js script is to show and scroll down to your review tab to your WooCommerce single products when you click on the review link.', 'ocean-extra' ),
				'type' 	=> 'js',
				'condition' => OCEANWP_WOOCOMMERCE_ACTIVE,
			),

			'oe_fontAwesome_style' => array(
				'label' => esc_html__( 'Font Awesome Icons', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The fontAwesome.css style is all the css for the font awesome icons.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_simpleLineIcons_style' => array(
				'label' => esc_html__( 'Simple Line Icons', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The simpleLineIcons.css style is all the css for the simple line icons.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_topBar_style' => array(
				'label' => esc_html__( 'Top Bar', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The topBar.css style is all the css for the top bar.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_header_style' => array(
				'label' => esc_html__( 'Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The header.css style is all the css for the header.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_transparentHeader_style' => array(
				'label' => esc_html__( 'Transparent Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The transparentHeader.css style is all the css for the transparent header style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_topHeader_style' => array(
				'label' => esc_html__( 'Top Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The topHeader.css style is all the css for the top header style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_fullScreenHeader_style' => array(
				'label' => esc_html__( 'Full Screen Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The fullScreenHeader.css style is all the css for the full screen header style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_centerHeader_style' => array(
				'label' => esc_html__( 'Center Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The centerHeader.css style is all the css for the center header style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_mediumHeader_style' => array(
				'label' => esc_html__( 'Medium Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The mediumHeader.css style is all the css for the medium header style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_customHeader_style' => array(
				'label' => esc_html__( 'Custom Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The customHeader.css style is all the css for the custom header style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_navigation_style' => array(
				'label' => esc_html__( 'Navigation', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The navigation.css style is all the css for the navigation of the principal menu.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_socialMenu_style' => array(
				'label' => esc_html__( 'Social Icons Menu', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The socialMenu.css style is all the css for the social icons in the navigation of the header.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_pageHeader_style' => array(
				'label' => esc_html__( 'Page Header', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The pageHeader.css style is all the css for the page header (title).', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_blog_style' => array(
				'label' => esc_html__( 'Blog', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The blog.css style is all the css for the blog and post formats.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_blogLarge_style' => array(
				'label' => esc_html__( 'Blog Large Style', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The blogLarge.css style is all the css for the blog large style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_blogGrid_style' => array(
				'label' => esc_html__( 'Blog Grid Style', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The blogGrid.css style is all the css for the blog grid style.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_singlePostPrevNext_style' => array(
				'label' => esc_html__( 'Single Post Next/Prev Pagination', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The singlePostPrevNext.css style is all the css for the next/previous pagination on single post.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_singlePostAuthorBio_style' => array(
				'label' => esc_html__( 'Single Post Author Box', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The singlePostAuthorBio.css style is all the css for the author box on single post.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_singlePostRelatedPosts_style' => array(
				'label' => esc_html__( 'Single Post Related Posts', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The singlePostRelatedPosts.css style is all the css for the related posts on single post.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_sidebar_style' => array(
				'label' => esc_html__( 'Sidebar', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The sidebar.css style is all the css for the sidebar.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_comment_style' => array(
				'label' => esc_html__( 'Comment', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The comment.css style is all the css for the comments.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_pagination_style' => array(
				'label' => esc_html__( 'Pagination', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The pagination.css style is all the css for the pagination.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_footerWidgets_style' => array(
				'label' => esc_html__( 'Footer Widgets', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The footerWidgets.css style is all the css for the footer widgets area.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_footerBottom_style' => array(
				'label' => esc_html__( 'Footer Bottom', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The footerBottom.css style is all the css for the footer bottom area.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_scrollTop_style' => array(
				'label' => esc_html__( 'Scroll Top Button', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The scrollTop.css style is all the css for the scroll top button.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_errorPage_style' => array(
				'label' => esc_html__( '404 Page', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The errorPage.css style is all the css for the 404 error page.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
			'oe_responsive_style' => array(
				'label' => esc_html__( 'Responsive', 'ocean-extra' ),
				'desc' 	=> esc_html__( 'The responsive.css style is all the css for the responsive view.', 'ocean-extra' ),
				'type' 	=> 'css',
			),
		);

		// Apply filters and return
		return apply_filters( 'oe_theme_scripts', $scripts );

	}

	/**
	 * Add sub menu page
	 *
	 * @since 1.2.1
	 */
	public function add_page() {
		add_submenu_page(
			'oceanwp-panel',
			esc_html__( 'Scripts & Styles', 'ocean-extra' ),
			esc_html__( 'Scripts & Styles', 'ocean-extra' ),
			'manage_options',
			'oceanwp-panel-scripts',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Register a setting and its sanitization callback.
	 *
	 * @since 1.2.1
	 */
	public static function register_settings() {
		register_setting( 'oe_scripts_settings', 'oe_scripts_settings', array( 'Ocean_Extra_Scripts_Panel', 'validate_settings' ) );
	}

	/**
	 * Main Sanitization callback
	 *
	 * @since 1.2.1
	 */
	public static function validate_settings( $settings ) {

		// Get scripts array
		$scripts = self::get_scripts();

		foreach ( $scripts as $key => $val ) {

			$settings[$key] = ! empty( $settings[$key] ) ? true : false;

		}

		// Return the validated/sanitized settings
		return $settings;

	}

	/**
	 * Get settings.
	 *
	 * @since 1.2.1
	 */
	public static function get_setting( $option = '' ) {

		$defaults = self::get_default_settings();

		$settings = wp_parse_args( get_option( 'oe_scripts_settings', $defaults ), $defaults );

		return isset( $settings[ $option ] ) ? $settings[ $option ] : false;

	}

	/**
	 * Get default settings value.
	 *
	 * @since 1.2.1
	 */
	public static function get_default_settings() {

		// Get scripts array
		$scripts = self::get_scripts();

		// Add array
		$default = array();

		foreach ( $scripts as $key => $val ) {
			$default[$key] = 1;
		}

		// Return
		return apply_filters( 'oe_default_scripts', $default );

	}

	/**
	 * Settings page output
	 *
	 * @since 1.2.1
	 */
	public static function create_admin_page() {

		// If settings updated
		if ( isset( $_GET['settings-updated'] )
			&& 'true' == $_GET['settings-updated'] ) {
			self::generate_js();
			self::generate_css();
		}

		// Get scripts array
		$scripts = self::get_scripts(); ?>

		<div class="wrap oceanwp-scripts-panel oceanwp-clr">

			<h1><?php esc_attr_e( 'Scripts & Styles Panel', 'ocean-extra' ); ?></h1>

			<div class="oceanwp-desc notice notice-warning">
				<p><?php esc_html_e( 'Disable scripts and styles that you do not need to improve the loading speed of your website.', 'ocean-extra' ); ?></p>
			</div>

			<form id="oceanwp-scripts-panel-form" method="post" action="options.php">

				<?php settings_fields( 'oe_scripts_settings' ); ?>

				<div class="oceanwp-modules">

					<div class="modules-top clr">

						<?php submit_button(); ?>

						<ul class="btn-switcher clr">
							<li class="active"><a href="#all"><?php esc_html_e( 'All', 'ocean-extra' ); ?></a></li>
							<li><a href="#js"><?php esc_html_e( 'JS', 'ocean-extra' ); ?></a></li>
							<li><a href="#css"><?php esc_html_e( 'CSS', 'ocean-extra' ); ?></a></li>
						</ul>

					</div>

					<div class="modules-inner clr">

						<?php
						// Loop through scripts
						foreach ( $scripts as $key => $val ) :

							// Display setting?
							$display = true;
							if ( isset( $val['condition'] ) ) {
								$display = $val['condition'];
							}

							// Var
							$label  = isset( $val['label'] ) ? $val['label'] : '';
							$desc  	= isset( $val['desc'] ) ? $val['desc'] : '';
							$type  	= isset( $val['type'] ) ? $val['type'] : '';

							// Classes
							$classes = 'column-wrap';
							$classes .= ! $display ? ' hidden' : '';

							// Get settings
							$settings = self::get_setting( $key ); ?>

							<div class="<?php echo esc_attr( $classes ); ?>" data-type="<?php echo esc_attr( $type ); ?>">

								<?php if ( $type ) { ?>
									<div class="type <?php echo esc_attr( $type ); ?>"><?php echo esc_attr( $type ); ?></div>
								<?php } ?>

								<div class="column-inner clr">

									<h3 class="info"><?php echo esc_attr( $label ); ?></h3>
									<?php if ( $desc ) { ?>
										<p class="desc"><?php echo esc_attr( $desc ); ?></p>
									<?php } ?>

									<div class="bottom-column">
										<label for="oceanwp-[<?php echo esc_attr( $key ); ?>]" class="title"><?php esc_attr_e( 'Enable or Disable', 'ocean-extra' ); ?></label>
										<input type="checkbox" name="oe_scripts_settings[<?php echo esc_attr( $key ); ?>]" value="true" id="oceanwp-[<?php echo esc_attr( $key ); ?>]" <?php checked( $settings ); ?>>
									</div>

								</div>

							</div>

						<?php endforeach; ?>

					</div><!-- .modules-inner -->

					<?php submit_button(); ?>

				</div><!-- .oceanwp-modules -->

			</form>

		</div>

	<?php
	}

	/**
	 * Admin Scripts
	 *
	 * @since 1.2.1
	 */
	public static function admin_scripts( $hook ) {

		// Only load scripts when needed
		if ( OE_ADMIN_PANEL_HOOK_PREFIX . '-scripts' != $hook ) {
			return;
		}

		// CSS
		wp_enqueue_style( 'oceanwp-scripts-panel', plugins_url( '/assets/css/scripts.min.css', __FILE__ ) );

		// JS
		wp_enqueue_script( 'oceanwp-scripts-panel', plugins_url( '/assets/js/scripts.min.js', __FILE__ ), false, true );

	}

	/**
	 * Returns all JS needed
	 *
	 * @since 1.2.1
	 */
	public static function generate_js() {

		// Return if is not OceanWP or not writable
		if ( ! class_exists( 'OCEANWP_Theme_Class' )
			|| ! self::is_writable( 'js' ) ) {
			return;
		}

		// Scripts
		$customSelect 			= self::get_setting( 'oe_customSelect_script' );
		$dropDownSearch 		= self::get_setting( 'oe_dropDownSearch_script' );
		$headerReplaceSearch 	= self::get_setting( 'oe_headerReplaceSearch_script' );
		$overlaySearch 			= self::get_setting( 'oe_overlaySearch_script' );
		$fitVids 				= self::get_setting( 'oe_fitVids_script' );
		$fixedFooter 			= self::get_setting( 'oe_fixedFooter_script' );
		$fullScreenMenu 		= self::get_setting( 'oe_fullScreenMenu_script' );
		$headerSearchForm 		= self::get_setting( 'oe_headerSearchForm_script' );
		$infiniteScroll 		= self::get_setting( 'oe_infiniteScroll_script' );
		$isotope 				= self::get_setting( 'oe_isotope_script' );
		$lightbox 				= self::get_setting( 'oe_lightbox_script' );
		$matchHeight 			= self::get_setting( 'oe_matchHeight_script' );
		$megaMenu 				= self::get_setting( 'oe_megaMenu_script' );
		$navNoClick 			= self::get_setting( 'oe_navNoClick_script' );
		$scrollEffect 			= self::get_setting( 'oe_scrollEffect_script' );
		$scrollTop 				= self::get_setting( 'oe_scrollTop_script' );
		$sidr 					= self::get_setting( 'oe_sidr_script' );
		$slick 					= self::get_setting( 'oe_slick_script' );
		$smoothScroll 			= self::get_setting( 'oe_smoothScroll_script' );
		$superfish 				= self::get_setting( 'oe_superfish_script' );
		$wooGridList 			= self::get_setting( 'oe_wooGridList_script' );
		$wooMenuCart 			= self::get_setting( 'oe_wooMenuCart_script' );
		$wooCategoriesWidget 	= self::get_setting( 'oe_wooCategoriesWidget_script' );
		$wooQuantityButtons 	= self::get_setting( 'oe_wooQuantityButtons_script' );
		$wooReviewsScroll 		= self::get_setting( 'oe_wooReviewsScroll_script' );

		// Get js directory uri
		$tDir 	= OCEANWP_JS_DIR_URI;
		$pDir 	= OE_URL .'assets/js/';

		// If a script is disabled
		if ( ! $customSelect
			|| ! $dropDownSearch
			|| ! $headerReplaceSearch
			|| ! $overlaySearch
			|| ! $fitVids
			|| ! $fixedFooter
			|| ! $fullScreenMenu
			|| ! $headerSearchForm
			|| ! $infiniteScroll
			|| ! $isotope
			|| ! $lightbox
			|| ! $matchHeight
			|| ! $megaMenu
			|| ! $navNoClick
			|| ! $scrollEffect
			|| ! $scrollTop
			|| ! $sidr
			|| ! $slick
			|| ! $smoothScroll
			|| ! $superfish
			|| ! $wooGridList
			|| ! $wooMenuCart
			|| ! $wooCategoriesWidget
			|| ! $wooQuantityButtons
			|| ! $wooReviewsScroll ) {

		    // Array
		    $aFiles = array();

		    // Load customSelect js
			if ( $customSelect ) {
				$aFiles[] = $tDir .'devs/customselect.js';
				$aFiles[] = $pDir .'customSelect.js';
			}

		    // Load dropDownSearch js
			if ( $dropDownSearch ) {
				$aFiles[] = $pDir .'dropDownSearch.js';
			}

		    // Load headerReplaceSearch js
			if ( $headerReplaceSearch ) {
				$aFiles[] = $pDir .'headerReplaceSearch.js';
			}

		    // Load overlaySearch js
			if ( $overlaySearch ) {
				$aFiles[] = $pDir .'overlaySearch.js';
			}

			// Load fitVids js
			if ( $fitVids ) {
				$aFiles[] = $tDir .'devs/fitvids.js';
				$aFiles[] = $pDir .'fitVids.js';
			}

			// Load fixedFooter js
			if ( $fixedFooter ) {
				$aFiles[] = $pDir .'fixedFooter.js';
			}

			// Load fullScreenMenu js
			if ( $fullScreenMenu ) {
				$aFiles[] = $pDir .'fullScreenMenu.js';
			}

			// Load headerSearchForm js
			if ( $headerSearchForm ) {
				$aFiles[] = $pDir .'headerSearchForm.js';
			}

			// Load infiniteScroll js
			if ( $infiniteScroll
				&& 'infinite_scroll' == get_theme_mod( 'ocean_blog_pagination_style', 'standard' ) ) {
				$aFiles[] = $tDir .'dynamic/infinitescroll.js';
				$aFiles[] = $pDir .'infiniteScroll.js';
			}

			// Load isotope js
			if ( $isotope ) {
				$aFiles[] = $tDir .'devs/isotope.js';
				$aFiles[] = $pDir .'isotope.js';
			}

			// Load lightbox js
			if ( $lightbox ) {
				$aFiles[] = $tDir .'devs/chocolat.js';
				$aFiles[] = $pDir .'lightbox.js';
			}

			// Load matchHeight js
			if ( $matchHeight ) {
				$aFiles[] = $tDir .'devs/matchHeight.js';
				$aFiles[] = $pDir .'matchHeight.js';
			}

			// Load megaMenu js
			if ( $megaMenu ) {
				$aFiles[] = $pDir .'megaMenu.js';
			}

			// Load navnoclick js
			if ( $navNoClick ) {
				$aFiles[] = $pDir .'navNoClick.js';
			}

			// Load scrollEffect js
			if ( $scrollEffect ) {
				$aFiles[] = $pDir .'scrollEffect.js';
			}

			// Load scrollTop js
			if ( $scrollTop ) {
				$aFiles[] = $pDir .'scrollTop.js';
			}

			// Load sidr js
			if ( $sidr ) {
				$aFiles[] = $tDir .'devs/sidr.js';
				$aFiles[] = $pDir .'sidr.js';
			}

			// Load slick js
			if ( $slick ) {
				$aFiles[] = $tDir .'devs/slick.js';
				$aFiles[] = $pDir .'slick.js';
			}

			// Load smoothScroll js
			if ( $smoothScroll ) {
				$aFiles[] = $tDir .'devs/smoothscroll.js';
			}

			// Load superfish js
			if ( $superfish ) {
				$aFiles[] = $tDir .'devs/superfish.js';
				$aFiles[] = $pDir .'superfish.js';
			}

			// If WooCommerce exist
			if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {

		    	// Load wooGridList js
		    	if ( $wooGridList ) {
					$aFiles[] = $tDir .'devs/cookie.js';
					$aFiles[] = $pDir .'woo/wooGridList.js';
				}

		    	// Load wooMenuCart js
		    	if ( $wooMenuCart ) {
					$aFiles[] = $pDir .'woo/wooMenuCart.js';
				}

		    	// Load wooCategoriesWidget js
		    	if ( $wooCategoriesWidget ) {
					$aFiles[] = $pDir .'woo/wooCategoriesWidget.js';
				}

		    	// Load wooQuantityButtons js
		    	if ( $wooQuantityButtons ) {
					$aFiles[] = $pDir .'woo/wooQuantityButtons.js';
				}

		    	// Load wooReviewsScroll js
		    	if ( $wooReviewsScroll ) {
					$aFiles[] = $pDir .'woo/wooReviewsScroll.js';
				}

			}
				
			// Check WP_Filesystem
			global $wp_filesystem;
			self::init_filesystem();

			// Get JS files content
			$strJS = '';
			foreach( $aFiles as $file ) :
			    $strJS .= $wp_filesystem->get_contents( $file );
			endforeach;

			// Minifying JS files
			$jsMignifier = oceanwp_minify_js( $strJS );

			// Putting all the scripts into one JS file
			$wp_filesystem->put_contents( self::get_file( 'js', 'path' ), $jsMignifier );
		    
		} else {

			if ( file_exists( self::get_file( 'js', 'path' ) ) ) {
				unlink( self::get_file( 'js', 'path' ) );
			}

		}

	}

	/**
	 * Returns all CSS needed
	 *
	 * @since 1.2.1
	 */
	public static function generate_css() {

		// Return if is not OceanWP or not writable
		if ( ! class_exists( 'OCEANWP_Theme_Class' )
			|| ! self::is_writable( 'css' ) ) {
			return;
		}

		// Styles & scripts
		$customSelect 			= self::get_setting( 'oe_customSelect_script' );
		$dropDownSearch 		= self::get_setting( 'oe_dropDownSearch_script' );
		$headerReplaceSearch 	= self::get_setting( 'oe_headerReplaceSearch_script' );
		$overlaySearch 			= self::get_setting( 'oe_overlaySearch_script' );
		$lightbox 				= self::get_setting( 'oe_lightbox_script' );
		$megaMenu 				= self::get_setting( 'oe_megaMenu_script' );
		$sidr 					= self::get_setting( 'oe_sidr_script' );
		$wooMenuCart 			= self::get_setting( 'oe_wooMenuCart_script' );
		$wooCategoriesWidget 	= self::get_setting( 'oe_wooCategoriesWidget_script' );
		$wooQuantityButtons 	= self::get_setting( 'oe_wooQuantityButtons_script' );
		$fontAwesome 			= self::get_setting( 'oe_fontAwesome_style' );
		$simpleLineIcons 		= self::get_setting( 'oe_simpleLineIcons_style' );
		$topBar 				= self::get_setting( 'oe_topBar_style' );
		$header 				= self::get_setting( 'oe_header_style' );
		$transparentHeader 		= self::get_setting( 'oe_transparentHeader_style' );
		$topHeader 				= self::get_setting( 'oe_topHeader_style' );
		$fullScreenHeader 		= self::get_setting( 'oe_fullScreenHeader_style' );
		$centerHeader 			= self::get_setting( 'oe_centerHeader_style' );
		$mediumHeader 			= self::get_setting( 'oe_mediumHeader_style' );
		$customHeader 			= self::get_setting( 'oe_customHeader_style' );
		$navigation 			= self::get_setting( 'oe_navigation_style' );
		$socialMenu 			= self::get_setting( 'oe_socialMenu_style' );
		$pageHeader 			= self::get_setting( 'oe_pageHeader_style' );
		$blog 					= self::get_setting( 'oe_blog_style' );
		$blogLarge 				= self::get_setting( 'oe_blogLarge_style' );
		$blogGrid 				= self::get_setting( 'oe_blogGrid_style' );
		$singlePostPrevNext 	= self::get_setting( 'oe_singlePostPrevNext_style' );
		$singlePostAuthorBio 	= self::get_setting( 'oe_singlePostAuthorBio_style' );
		$singlePostRelatedPosts = self::get_setting( 'oe_singlePostRelatedPosts_style' );
		$sidebar 				= self::get_setting( 'oe_sidebar_style' );
		$comment 				= self::get_setting( 'oe_comment_style' );
		$pagination 			= self::get_setting( 'oe_pagination_style' );
		$footerWidgets 			= self::get_setting( 'oe_footerWidgets_style' );
		$footerBottom 			= self::get_setting( 'oe_footerBottom_style' );
		$scrollTop 				= self::get_setting( 'oe_scrollTop_style' );
		$errorPage 				= self::get_setting( 'oe_errorPage_style' );
		$responsive 			= self::get_setting( 'oe_responsive_style' );
		$slick 					= self::get_setting( 'oe_slick_script' );

		// Get css directory uri
		$pDir 	= OE_URL .'assets/css/';

		// If a style is disabled
		if ( ! $customSelect
			|| ! $dropDownSearch
			|| ! $headerReplaceSearch
			|| ! $overlaySearch
			|| ! $lightbox
			|| ! $megaMenu
			|| ! $sidr
			|| ! $wooMenuCart
			|| ! $wooCategoriesWidget
			|| ! $wooQuantityButtons
			|| ! $fontAwesome
			|| ! $simpleLineIcons
			|| ! $topBar
			|| ! $header
			|| ! $transparentHeader
			|| ! $topHeader
			|| ! $fullScreenHeader
			|| ! $centerHeader
			|| ! $mediumHeader
			|| ! $customHeader
			|| ! $navigation
			|| ! $socialMenu
			|| ! $pageHeader
			|| ! $blog
			|| ! $blogLarge
			|| ! $blogGrid
			|| ! $singlePostPrevNext
			|| ! $singlePostAuthorBio
			|| ! $singlePostRelatedPosts
			|| ! $sidebar
			|| ! $comment
			|| ! $pagination
			|| ! $footerWidgets
			|| ! $footerBottom
			|| ! $scrollTop
			|| ! $errorPage
			|| ! $responsive
			|| ! $slick ) {

		    // Array
		    $aFiles = array();

		    // Main CSS
		    $aFiles[] = $pDir .'main.css';

		    // Load customSelect css
			if ( $customSelect ) {
				$aFiles[] = $pDir .'customSelect.css';
			}

			// Load dropDownSearch css
			if ( $dropDownSearch ) {
				$aFiles[] = $pDir .'dropDownSearch.css';
			}

		    // Load headerReplaceSearch css
			if ( $headerReplaceSearch ) {
				$aFiles[] = $pDir .'headerReplaceSearch.css';
			}

		    // Load overlaySearch css
			if ( $overlaySearch ) {
				$aFiles[] = $pDir .'overlaySearch.css';
			}

			// Load lightbox css
			if ( $lightbox ) {
				$aFiles[] = $pDir .'lightbox.css';
			}

		    // Load megaMenu css
			if ( $megaMenu ) {
				$aFiles[] = $pDir .'megaMenu.css';
			}

		    // Load sidr css
			if ( $sidr ) {
				$aFiles[] = $pDir .'sidr.css';
			}

			// Load fontAwesome css
			if ( $fontAwesome ) {
				$aFiles[] = $pDir .'fontAwesome.css';
			}

			// Load simpleLineIcons css
			if ( $simpleLineIcons ) {
				$aFiles[] = $pDir .'simpleLineIcons.css';
			}

			// Load topBar css
			if ( $topBar ) {
				$aFiles[] = $pDir .'topBar.css';
			}

			// Load header css
			if ( $header ) {
				$aFiles[] = $pDir .'header.css';
			}

			// Load transparentHeader css
			if ( $transparentHeader ) {
				$aFiles[] = $pDir .'transparentHeader.css';
			}

			// Load topHeader css
			if ( $topHeader ) {
				$aFiles[] = $pDir .'topHeader.css';
			}

			// Load fullScreenHeader css
			if ( $fullScreenHeader ) {
				$aFiles[] = $pDir .'fullScreenHeader.css';
			}

			// Load centerHeader css
			if ( $centerHeader ) {
				$aFiles[] = $pDir .'centerHeader.css';
			}

			// Load mediumHeader css
			if ( $mediumHeader ) {
				$aFiles[] = $pDir .'mediumHeader.css';
			}

			// Load customHeader css
			if ( $customHeader ) {
				$aFiles[] = $pDir .'customHeader.css';
			}

			// Load navigation css
			if ( $navigation ) {
				$aFiles[] = $pDir .'navigation.css';
			}

			// Load socialMenu css
			if ( $socialMenu ) {
				$aFiles[] = $pDir .'socialMenu.css';
			}

			// Load pageHeader css
			if ( $pageHeader ) {
				$aFiles[] = $pDir .'pageHeader.css';
			}

			// Load blog css
			if ( $blog ) {
				$aFiles[] = $pDir .'blog.css';
			}

			// Load blogLarge css
			if ( $blogLarge ) {
				$aFiles[] = $pDir .'blogLarge.css';
			}

			// Load blogGrid css
			if ( $blogGrid ) {
				$aFiles[] = $pDir .'blogGrid.css';
			}

			// Load singlePostPrevNext css
			if ( $singlePostPrevNext ) {
				$aFiles[] = $pDir .'singlePostPrevNext.css';
			}

			// Load singlePostAuthorBio css
			if ( $singlePostAuthorBio ) {
				$aFiles[] = $pDir .'singlePostAuthorBio.css';
			}

			// Load singlePostRelatedPosts css
			if ( $singlePostRelatedPosts ) {
				$aFiles[] = $pDir .'singlePostRelatedPosts.css';
			}

			// Load sidebar css
			if ( $sidebar ) {
				$aFiles[] = $pDir .'sidebar.css';
			}

			// Load comment css
			if ( $comment ) {
				$aFiles[] = $pDir .'comment.css';
			}

			// Load pagination css
			if ( $pagination ) {
				$aFiles[] = $pDir .'pagination.css';
			}

			// Load footerWidgets css
			if ( $footerWidgets ) {
				$aFiles[] = $pDir .'footerWidgets.css';
			}

			// Load footerBottom css
			if ( $footerBottom ) {
				$aFiles[] = $pDir .'footerBottom.css';
			}

			// Load scrollTop css
			if ( $scrollTop ) {
				$aFiles[] = $pDir .'scrollTop.css';
			}

			// Load errorPage css
			if ( $errorPage ) {
				$aFiles[] = $pDir .'errorPage.css';
			}

			// Load responsive css
			if ( $responsive ) {
				$aFiles[] = $pDir .'responsive.css';
			}

			// If WooCommerce exist
			if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {

		    	// Load wooCommerce css
				$aFiles[] = $pDir .'woo/wooCommerce.css';

		    	// Load wooMenuCart css
				if ( $wooMenuCart ) {
					$aFiles[] = $pDir .'woo/wooMenuCart.css';
				}

			    // Load wooCategoriesWidget css
				if ( $wooCategoriesWidget ) {
					$aFiles[] = $pDir .'woo/wooCategoriesWidget.css';
				}

			    // Load wooQuantityButtons css
				if ( $wooQuantityButtons ) {
					$aFiles[] = $pDir .'woo/wooQuantityButtons.css';
				}

			}

		    // Load slick css to the end to prevent conflict
			if ( $slick ) {
				$aFiles[] = $pDir .'slick.css';
			}
				
			// Check WP_Filesystem
			global $wp_filesystem;
			self::init_filesystem();

			// Get CSS files content
			$strCSS = '';
			foreach( $aFiles as $file ) :
				$contents 	= $wp_filesystem->get_contents( $file );
				$strCSS 	.= str_replace( "\xEF\xBB\xBF", '', $contents );
			endforeach;

			// Minifying CSS files
			$cssMignifier = wp_strip_all_tags( oceanwp_minify_css( $strCSS ) );

			// Putting all the scripts into one CSS file
			$wp_filesystem->put_contents( self::get_file( 'css', 'path' ), $cssMignifier );
		    
		} else {

			if ( file_exists( self::get_file( 'css', 'path' ) ) ) {
				unlink( self::get_file( 'css', 'path' ) );
			}

		}

	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.2.1
	 */
	public static function enqueue_scripts() {

		// Add filter to altering via child theme
		$enqueue_scripts = apply_filters( 'ocean_enqueue_generated_files', true );

		// Return if enqueue_scripts is set to false through the filter
		if ( ! $enqueue_scripts ) {
			return;
		}

		// Get current theme version
		$theme_version = wp_get_theme()->get( 'Version' );

		// If script exist
		if ( file_exists( self::get_file( 'js', 'path' ) ) ) {

			// Unregister default scripts
			wp_deregister_script( 'oceanwp-main' );
			if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {
				wp_deregister_script( 'oceanwp-woocommerce' );
			}
			if ( 'infinite_scroll' == get_theme_mod( 'ocean_blog_pagination_style', 'standard' ) ) {
				wp_deregister_script( 'oceanwp-infinitescroll' );
			}

			// Enqueue the JS
			wp_enqueue_script( 'oceanwp-main', self::get_file( 'js', 'uri' ), array( 'jquery' ), $theme_version, true );

			// Localize array
			wp_localize_script( 'oceanwp-main', 'oceanwpLocalize', OCEANWP_Theme_Class::localize_array() );

		}

		// If style exist
		if ( file_exists( self::get_file( 'css', 'path' ) ) ) {

			// Unregister default style
			wp_deregister_style( 'oceanwp-style' );
			wp_deregister_style( 'font-awesome' );
			wp_deregister_style( 'simple-line-icons' );
			if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {
				wp_deregister_style( 'oceanwp-woocommerce' );
			}

			// Enqueue the CSS
			wp_enqueue_style( 'oceanwp-style', self::get_file( 'css', 'uri' ), false, $theme_version );

		}

	}

	/**
	 * Add body classes
	 *
	 * @since 1.2.1
	 */
	public static function body_classes( $classes ) {

		// If the isotope script is disabled
		if ( ! self::get_setting( 'oe_isotope_script' ) ) {
			$classes[] = 'no-isotope';
		}

		// If the lightbox script is disabled
		if ( ! self::get_setting( 'oe_lightbox_script' ) ) {
			$classes[] = 'no-lightbox';
		}

		// If the scroll up script is disabled
		if ( ! self::get_setting( 'oe_scrollTop_style' ) ) {
			$classes[] = 'no-scroll-top';
		}

		// If the sidr script is disabled
		if ( ! self::get_setting( 'oe_sidr_script' ) ) {
			$classes[] = 'no-sidr';
		}

		// If the carousel script is disabled
		if ( ! self::get_setting( 'oe_slick_script' ) ) {
			$classes[] = 'no-carousel';
		}

		// If the match height script is disabled
		if ( ! self::get_setting( 'oe_matchHeight_script' ) ) {
			$classes[] = 'no-matchheight';
		}

		// Return classes
		return $classes;
	}

	/**
	 * Instantiates the WordPress filesystem
	 *
	 * @since 1.2.1
	 */
	public static function init_filesystem() {

		// The Wordpress filesystem.
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		return $wp_filesystem;

	}

	/**
	 * Gets file path or url
	 *
	 * @since 1.2.1
	 * @link http://aristath.github.io/blog/avoid-dynamic-css-in-head
	 */
	private static function get_file( $return = 'js', $target = 'path' ) {

		// Get the upload directory
		$upload_dir 	= wp_upload_dir();

		$js_file   		= 'main-scripts.js';
		$css_file   	= 'main-style.css';
		$folder_path 	= $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'oceanwp';

		// The complete path to the files
		$js_path 		= $folder_path . DIRECTORY_SEPARATOR . $js_file;
		$css_path 		= $folder_path . DIRECTORY_SEPARATOR . $css_file;

		// Get the URL directory
		$uri_folder 	= $upload_dir['baseurl'];

		// Build the URL of the files
		$js_uri 		= trailingslashit( $uri_folder ) . 'oceanwp/' . $js_file;
		$css_uri 		= trailingslashit( $uri_folder ) . 'oceanwp/' . $css_file;

		// Return the JS path
		if ( 'js' == $return
			&& 'path' == $target ) {
			return $js_path;
		}

		// Return the CSS path
		elseif ( 'css' == $return
			&& 'path' == $target ) {
			return $css_path;
		}

		// Return the JS URL
		elseif ( 'js' == $return
			&& 'uri' == $target ) {
			return $js_uri;
		}

		// Return the CSS URL
		elseif ( 'css' == $return
			&& 'uri' == $target ) {
			return $css_uri;
		}

	}

	/**
	 * Check if the file is writable
	 *
	 * @since 1.2.1
	 * @link http://aristath.github.io/blog/avoid-dynamic-css-in-head
	 */
	public static function is_writable( $return = 'js' ) {

		// Get the upload directory
		$upload_dir 	= wp_upload_dir();

		$js_file   		= '/main-scripts.js';
		$css_file   	= '/main-style.css';
		$folder_path 	= $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'oceanwp';

		// Check if the folder exist
		if ( file_exists( $folder_path ) ) {

			// If JS file
			if ( 'js' == $return ) {

				// Check if the folder is writable
				if ( ! is_writable( $folder_path ) ) {

					// If the folder is not writable, check if the file is
					if ( ! file_exists( $folder_path . $js_file ) ) {
						return false;
					} else {
						// Check if the file writable
						if ( ! is_writable( $folder_path . $js_file ) ) {
							return false;
						}
					}

				} else {

					// If the folder is writable, check if the file is
					if ( file_exists( $folder_path . $js_file ) ) {
						// Check if the file writable
						if ( ! is_writable( $folder_path . $js_file ) ) {
							return false;
						}
					}

				}

			}

			// If CSS file
			elseif ( 'css' == $return ) {

				// Check if the folder is writable
				if ( ! is_writable( $folder_path ) ) {

					// If the folder is not writable, check if the file is
					if ( ! file_exists( $folder_path . $css_file ) ) {
						return false;
					} else {
						// Check if the file writable
						if ( ! is_writable( $folder_path . $css_file ) ) {
							return false;
						}
					}

				} else {

					// If the folder is writable, check if the file is
					if ( file_exists( $folder_path . $css_file ) ) {
						// Check if the file writable
						if ( ! is_writable( $folder_path . $css_file ) ) {
							return false;
						}
					}

				}

			}

		} else {
			// Returns true or false
			return wp_mkdir_p( $folder_path );
		}

		// If we passed all of the above tests, the file is writable.
		return true;

	}

}
new Ocean_Extra_Scripts_Panel();