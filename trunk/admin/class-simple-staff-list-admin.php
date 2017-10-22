<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.brettshumaker.com
 * @since      1.17
 *
 * @package    Simple_Staff_List
 * @subpackage Simple_Staff_List/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Staff_List
 * @subpackage Simple_Staff_List/admin
 * @author     Brett Shumaker <brettshumaker@gmail.com>
 */
class Simple_Staff_List_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.17
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.17
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.17
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.17
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Staff_List_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Staff_List_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/simple-staff-list-admin.css',
			array(),
			$this->version,
			'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.17
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Staff_List_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Staff_List_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( isset($_GET['post_type']) && $_GET['post_type'] == 'staff-member' ) {

			wp_enqueue_script( $this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'js/simple-staff-list-admin.js',
				array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ),
				$this->version,
				false );

		}

	}

	/**
	 * Flush Rewrite Rules after saving plugin options
	 *
	 * @since   2.0
	 */
	public function ajax_flush_rewrite_rules() {

		flush_rewrite_rules();

		wp_send_json_success();

	}

	/**
	 * Register admin menu items.
	 *
	 * @since   1.17
	 */
	public function register_menu() {

		// Order page
		add_submenu_page(
			'edit.php?post_type=staff-member',
			__( 'Simple Staff List Order', $this->plugin_name ),
			__( 'Order', $this->plugin_name ),
			'edit_pages',
			'staff-member-order',
			array( $this, 'display_order_page' )
		);

		// Templates page
		add_submenu_page(
			'edit.php?post_type=staff-member',
			__( 'Display Templates', $this->plugin_name ),
			__( 'Templates', $this->plugin_name ),
			'edit_pages',
			'staff-member-template',
			array( $this, 'display_templates_page' )
		);

		// Usage page
		add_submenu_page(
			'edit.php?post_type=staff-member',
			__( 'Simple Staff List Usage', $this->plugin_name ),
			__( 'Usage', $this->plugin_name ),
			'edit_pages',
			'staff-member-usage',
			array( $this, 'display_usage_page' )
		);

		// Options page
		add_submenu_page(
			'edit.php?post_type=staff-member',
			__( 'Simple Staff List Options', $this->plugin_name ),
			__( 'Options', $this->plugin_name ),
			'edit_pages',
			'staff-member-options',
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Display Order page content.
	 *
	 * @since   1.17
	 */
	public function display_order_page() {
		include_once( 'partials/simple-staff-list-order-display.php' );
	}

	/**
	 * Display Template page content.
	 *
	 * @since   1.17
	 */
	public function display_templates_page() {
		include_once( 'partials/simple-staff-list-template-display.php' );
	}

	/**
	 * Display Usage page content.
	 *
	 * @since   1.17
	 */
	public function display_usage_page() {
		include_once( 'partials/simple-staff-list-usage-display.php' );
	}

	/**
	 * Display Usage page content.
	 *
	 * @since   1.17
	 */
	public function display_options_page() {
		include_once( 'partials/simple-staff-list-options-display.php' );
	}

	/**
	 * Hide unwanted meta boxes on staff member screen.
	 *
	 * @since 1.17
	 *
	 * @param $hidden
	 * @param $screen
	 *
	 * @return array
	 */
	public function hide_meta_boxes( $hidden, $screen ) {

		if ( 'staff-member' == $screen->id ) {
			$hidden = array( 'postexcerpt' );
		}

		return $hidden;

	}

	/**
	 * Change name of title meta box on staff member screen.
	 *
	 * @since 1.17
	 *
	 * @param $title string Title box text
	 *
	 * @return mixed Title box text
	 */
	public function staff_member_change_title( $title ) {

		$screen = get_current_screen();

		if ( $screen->post_type == 'staff-member' ) {
			$title = __( 'Staff Name', $this->plugin_name );
		}

		return $title;
	}

	/**
	 * Handle staff member featured image text
	 *
	 * @since 1.17
	 * @deprecated Function deprecated in release 2.0.0
	 */
	public function staff_member_featured_image_text() {

	}

	/**
	 * Add theme support for post thumbnails
	 *
	 * @since 2.0
	 */
	public function add_featured_image_support() {

		$supportedTypes = get_theme_support( 'post-thumbnails' );

		if ( $supportedTypes === false ) {

			add_theme_support( 'post-thumbnails', 'staff-member' );

		} else if ( is_array( $supportedTypes ) ) {

			$supportedTypes[0][] = 'staff-member';
			add_theme_support( 'post-thumbnails', $supportedTypes[0] );

		}

	}

	/**
	 * Register staff member meta boxes.
	 *
	 * @since 1.17
	 */
	public function staff_member_add_meta_boxes() {

		add_meta_box( 'staff-member-info',
			__( 'Staff Member Info', $this->plugin_name ),
			array( $this, 'staff_member_info_meta_box' ),
			'staff-member',
			'normal',
			'high' );

		add_meta_box( 'staff-member-bio',
			__( 'Staff Member Bio', $this->plugin_name ),
			array( $this, 'staff_member_bio_meta_box' ),
			'staff-member',
			'normal',
			'high' );

	}

	/**
	 * Register staff member custom columns.
	 *
	 * @since 1.17
	 *
	 * @param $cols
	 *
	 * @return array Custom columns
	 */
	public function staff_member_custom_columns( $cols ) {

		$cols = array(
			'cb'                  => '<input type="checkbox" />',
			'title'               => __( 'Name', $this->plugin_name ),
			'photo'               => __( 'Photo', $this->plugin_name ),
			'_staff_member_title' => __( 'Position', $this->plugin_name ),
			'_staff_member_bio'   => __( 'Bio', $this->plugin_name ),
		);

		return $cols;
	}

	/**
	 * Display staff member info meta box.
	 *
	 * @since 1.17
	 */
	public function staff_member_info_meta_box() {

		global $post;

		$custom              = get_post_custom( $post->ID );
		$_staff_member_title = isset( $custom["_staff_member_title"][0] ) ? $custom["_staff_member_title"][0] : '';
		?>

		<div class="sslp_admin_wrap">
			<label for="_staff-member-title">
				<?php _e( 'Position:', 'simple-staff-list' ); ?>
				<input type="text"
				       name="_staff_member_title"
				       id="_staff_member_title"
				       placeholder="<?php if ( $_staff_member_title == '' ) {
					       _e( 'Staff Member\'s Position',
						       'simple-staff-list' );
				       } ?>"
				       value="<?php if ( $_staff_member_title != '' ) {
					       echo $_staff_member_title;
				       } ?>"/>
			</label>
		</div>
		<?php

	}

	/**
	 * Display staff member warnings.
	 *
	 * @since 1.17
	 */
	public function sslp_staff_member_warning_meta_box() {

		_e( '<p><strong>Your current theme does not support post thumbnails. Unfortunately, you will not be able to add photos for your Staff Members</strong></p>',
			'simple-staff-list' );

	}

	/**
	 * Display staff member bio meta box.
	 *
	 * @since 1.17
	 */
	public function staff_member_bio_meta_box() {

		global $post;

		$custom            = get_post_custom( $post->ID );
		$_staff_member_bio = isset( $custom["_staff_member_bio"][0] ) ? $custom["_staff_member_bio"][0] : '';

		wp_editor( $_staff_member_bio,
			'_staff_member_bio',
			$settings = array(
				'textarea_rows' => 8,
				'media_buttons' => false,
				'tinymce'       => true, // Disables actual TinyMCE buttons // This makes the rich content editor
				'quicktags'     => true // Use QuickTags for formatting    // work within a metabox.
			) );
		?>

		<?php wp_nonce_field( 'sslp_post_nonce', 'sslp_add_edit_staff_member_noncename' ) ?>

		<?php

	}

	/**
	 * Display staff member custom columns.
	 *
	 * @since 1.17
	 *
	 * @param $column
	 */
	public function staff_member_display_custom_columns( $column ) {

		global $post;

		$custom              = get_post_custom();
		$_staff_member_title = isset( $custom["_staff_member_title"][0] ) ? $custom["_staff_member_title"][0] : '';
		$_staff_member_bio   = isset( $custom["_staff_member_bio"][0] ) ? $custom["_staff_member_bio"][0] : '';

		switch ( $column ) {
			case "photo":
				if ( has_post_thumbnail() ) {
					echo get_the_post_thumbnail( $post->ID, array( 75, 75 ) );
				}
				break;
			case "_staff_member_title":
				echo $_staff_member_title;
				break;
			case "_staff_member_bio":
				echo $this->get_staff_bio_excerpt( $_staff_member_bio, 10 );
				break;
		}

	}

	/**
	 * Save the staff member details post meta.
	 *
	 * @since 1.17
	 */
	public function save_staff_member_details() {

		global $post;

		if ( ! isset( $_POST['sslp_add_edit_staff_member_noncename'] )
		     || ! wp_verify_nonce( $_POST['sslp_add_edit_staff_member_noncename'], 'sslp_post_nonce' )
		) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post->ID;
		}

		update_post_meta( $post->ID,
			'_staff_member_bio',
			isset( $_POST['_staff_member_bio'] ) ? $_POST['_staff_member_bio'] : '' );
		update_post_meta( $post->ID,
			'_staff_member_title',
			isset( $_POST['_staff_member_title'] ) ? $_POST['_staff_member_title'] : '' );

	}

	/**
	 * Get staff bio excerpt.
	 *
	 * @since 1.17
	 *
	 * @param $text string Bio text
	 * @param $excerpt_length int Excerpt length
	 *
	 * @return mixed
	 */
	public function get_staff_bio_excerpt( $text, $excerpt_length ) {

		global $post;

		if ( ! $excerpt_length || ! is_int( $excerpt_length ) ) {
			$excerpt_length = 20;
		}

		if ( '' != $text ) {
			$text         = strip_shortcodes( $text );
			$text         = apply_filters( 'the_content', $text );
			$text         = str_replace( ']]>', ']]>', $text );
			$excerpt_more = " ...";
			$text         = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		}

		return apply_filters( 'the_excerpt', $text );

	}

	/**
	 * Update Staff Member order.
	 *
	 * @since 1.17
	 *
	 * @return mixed
	 */
	public function update_staff_member_order() {
		global $wpdb;

		$post_type     = $_POST['postType'];
		$order        = $_POST['order'];

		/**
		*    Expect: $sorted = array(
		*                menu_order => post-XX
		*            );
		*/
		foreach( $order as $menu_order => $post_id )
		{
			$post_id         = intval( str_ireplace( 'post-', '', $post_id ) );
			$menu_order     = intval($menu_order);
			wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );
		}

		die( '1' );
	}
}
