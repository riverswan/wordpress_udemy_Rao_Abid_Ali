<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/riverswan/
 * @since      1.0.0
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rocket_Books
 * @subpackage Rocket_Books/admin
 * @author     Paul Swan <my@esad.com>
 */
class Rocket_Books_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rocket_Books_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rocket_Books_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rocket-books-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rocket_Books_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rocket_Books_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rocket-books-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_admin_menu() {
		//      add_menu_page(
		//          'Rocket books settings',
		//          'Rocket books',
		//          'manage_options',
		//          'rocket-books',
		//          array($this,'admin_page_display'),
		//          'dashicons-chart-pie',
		//          60
		//      );
		add_submenu_page(
			'edit.php?post_type=book',
			'Rocket Books Settings Page',
			'Rocket Books',
			'manage_options',
			'rocket-books',
			array( $this, 'admin_page_display' )
		);
	}

	public function admin_page_display() {
		include 'partials/rocket-books-admin-display.php';
	}

	public function admin_init() {
		$this->add_settings_section();
		$this->add_settings_fields();
		$this->save_fields();
	}

	public function add_settings_section() {
		add_settings_section(
			'rbr-general-section',
			'General Settings',
			function () {
				echo '<p>these are general settings</p>';
			},
			'rbr-settings-page'
		);

		add_settings_section(
			'rbr-advanced-section',
			'Advanced Settings',
			function () {
				echo '<p>these are advanced settings</p>';
			},
			'rbr-settings-page'
		);
	}

	public function add_settings_fields() {
		add_settings_field(
			'rbr_test_field',
			'Test Field',
			array( $this, 'markup_text_fields_cb' ),
			'rbr-settings-page',
			'rbr-general-section',
			array(
				'name'  => 'rbr_test_field',
				'value' => get_option( 'rbr_test_field' ),
			)
		);

		add_settings_field(
			'rbr_advanced_field1',
			'Advanced Field 1',
			array( $this, 'markup_text_fields_cb' ),
			'rbr-settings-page',
			'rbr-advanced-section',
			array(
				'name'  => 'rbr_advanced_field1',
				'value' => get_option( 'rbr_advanced_field1' ),
			)
		);

		add_settings_field(
			'rbr_advanced_field2',
			'Advanced Field 2',
			array( $this, 'markup_text_fields_cb' ),
			'rbr-settings-page',
			'rbr-advanced-section',
			array(
				'name'  => 'rbr_advanced_field2',
				'value' => get_option( 'rbr_advanced_field2' ),
			)
		);

		add_settings_field(
			'rbr_archive_column',
			'Column Amount',
			array( $this, 'markup_select_fields_cb' ),
			'rbr-settings-page',
			'rbr-general-section',
			array(
				'name'    => 'rbr_archive_column',
				'value'   => get_option( 'rbr_archive_column' ),
				'options' => array(
					'column-two'   => __( 'Two columns', 'rocket-books' ),
					'column-three' => __( 'Three columns', 'rocket-books' ),
					'column-four'  => __( 'Four columns', 'rocket-books' ),
					'column-five'  => __( 'Five columns', 'rocket-books' ),
				),
			)
		);

	}

	public function save_fields() {
		register_setting(
			'rbr-settings-page-options-group',
			'rbr_test_field',
			'',
		);
		register_setting(
			'rbr-settings-page-options-group',
			'rbr_advanced_field1',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			),
		);
		register_setting(
			'rbr-settings-page-options-group',
			'rbr_advanced_field2',
			'',
		);

		register_setting(
			'rbr-settings-page-options-group',
			'rbr_archive_column',
			'',
		);
	}

	public function markup_text_fields_cb( $args ) {
		if ( ! is_array( $args ) ) {
			return null;
		}

		$name  = isset( $args['name'] ) ? esc_html( $args['name'] ) : '';
		$value = isset( $args['value'] ) ? esc_html( $args['value'] ) : '';
		?>

		<input type="text"
			   name="<?php echo $name; ?>"
			   value="<?php echo $value; ?>"
		/>
		<?php
	}

	public function markup_select_fields_cb( $args ) {
		if ( ! is_array( $args ) ) {
			return null;
		}

		$name    = isset( $args['name'] ) ? esc_html( $args['name'] ) : '';
		$value   = isset( $args['value'] ) ? esc_html( $args['value'] ) : '';
		$options = ( isset( $args['options'] ) && is_array( $args['options'] ) ) ? $args['options'] : array();
		?>

		<select name="<?php echo $name; ?>" class="field-<?php echo $name; ?>">
			<?php
			foreach ( $options as $option_key => $option_label ) {
				echo "<option value=$option_key" . selected( $option_key, $value ) . ">$option_label</option>";
			}
			?>
		</select>
		<?php
	}

	public function add_plugin_action_links( $links ) {
		$links[] = '<a href=' . admin_url( 'edit.php?post_type=book&page=rocket-books' ) . '>Settings</a>';

		return $links;
	}

	public function plugin_menu_settings_using_helper() {
		require_once ROCKET_BOOKS_BASE_DIR . 'vendor/boo-settings-helper/class-boo-settings-helper.php';
		$rocket_books_settings = array(
			'prefix'   => 'rbr_',
			'menu'     => array(
				'slug'       => 'rocket-books',
				'page_title' => __( 'Rocket Books Settings', 'rocket-books' ),
				'menu_title' => __( 'Rocket Books', 'rocket-books' ),
				'parent'     => 'edit.php?post_type=book',
				'submenu'    => true,

			),
			'sections' => array(
				array(
					'id'    => 'rbr_general_section',
					'title' => __( 'General section', 'rocket-books' ),
					'desc'  => __( 'These are general settings', 'rocket-books' ),
				),

				array(
					'id'    => 'rbr_advance_section',
					'title' => __( 'Advance section', 'rocket-books' ),
					'desc'  => __( 'These are advance settings', 'rocket-books' ),
				),
			),
			'fields'   => array(
				'rbr_general_section' => array(
					array(
						'id'    => 'test_field',
						'label' => __( 'Test field', 'rocket-books' ),
					),
					array(
						'id'      => 'archive_column',
						'label'   => __( 'Archive column', 'rocket-books' ),
						'type'    => 'select',
						'options' => array(
							'column-two'   => __( 'Two columns', 'rocket-books' ),
							'column-three' => __( 'Three columns', 'rocket-books' ),
							'column-four'  => __( 'Four columns', 'rocket-books' ),
							'column-five'  => __( 'Five columns', 'rocket-books' ),
						),
					),
				),
				'rbr_advance_section' => array(
					array(
						'id'    => 'advanced_field1',
						'label' => __( 'Advance field 1', 'rocket-books' ),
					),
					array(
						'id'    => 'advanced_field2',
						'label' => __( 'Advance field 2', 'rocket-books' ),
					),
				),
			),
		);
		new Boo_Settings_Helper( $rocket_books_settings );
	}

}
