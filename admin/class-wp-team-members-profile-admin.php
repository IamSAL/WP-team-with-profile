<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/IamSAL
 * @since      1.0.0
 *
 * @package    Wp_Team_Members_Profile
 * @subpackage Wp_Team_Members_Profile/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Team_Members_Profile
 * @subpackage Wp_Team_Members_Profile/admin
 * @author     Sk salman <benshadle@gmail.com>
 */
class Wp_Team_Members_Profile_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);   
		add_action('admin_init', array( $this, 'registerAndBuildFields' )); 

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
		 * defined in Wp_Team_Members_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Team_Members_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-team-members-profile-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wp_Team_Members_Profile_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Team_Members_Profile_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-team-members-profile-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function addPluginAdminMenu() {
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		//add_menu_page(  $this->plugin_name, 'Wp Team Members Profile', 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'dashicons-chart-area', 26 );

		//add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		//add_submenu_page( $this->plugin_name, 'Wp Team Members Profile Settings', 'Settings', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayPluginAdminSettings' ));
	}
	public function displayPluginAdminDashboard() {
		require_once 'partials/'.$this->plugin_name.'-admin-display.php';
  }
	public function displayPluginAdminSettings() {
		// set this var to be used in the settings-display view
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
		if(isset($_GET['error_message'])){
				add_action('admin_notices', array($this,'settingsPageSettingsMessages'));
				do_action( 'admin_notices', $_GET['error_message'] );
		}
		require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
	}
	public function settingsPageSettingsMessages($error_message){
		switch ($error_message) {
				case '1':
						$message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );                 $err_code = esc_attr( 'Wp_Team_Members_Profile_example_setting' );                 $setting_field = 'Wp_Team_Members_Profile_example_setting';                 
						break;
		}
		$type = 'error';
		add_settings_error(
					$setting_field,
					$err_code,
					$message,
					$type
			);
	}
	public function registerAndBuildFields() {
			/**
		 * First, we add_settings_section. This is necessary since all future settings must belong to one.
		 * Second, add_settings_field
		 * Third, register_setting
		 */     
		add_settings_section(
			// ID used to identify this section and with which to register options
			'Wp_Team_Members_Profile_general_section', 
			// Title to be displayed on the administration page
			'',  
			// Callback used to render the description of the section
				array( $this, 'Wp_Team_Members_Profile_display_general_account' ),    
			// Page on which to add this section of options
			'Wp_Team_Members_Profile_general_settings'                   
		);
		unset($args);
		$args = array (
							'type'      => 'input',
							'subtype'   => 'text',
							'id'    => 'Wp_Team_Members_Profile_example_setting',
							'name'      => 'Wp_Team_Members_Profile_example_setting',
							'required' => 'true',
							'get_options_list' => '',
							'value_type'=>'normal',
							'wp_data' => 'option'
					);
		add_settings_field(
			'Wp_Team_Members_Profile_example_setting',
			'Example Setting',
			array( $this, 'Wp_Team_Members_Profile_render_settings_field' ),
			'Wp_Team_Members_Profile_general_settings',
			'Wp_Team_Members_Profile_general_section',
			$args
		);


		register_setting(
						'Wp_Team_Members_Profile_general_settings',
						'Wp_Team_Members_Profile_example_setting'
						);

	}
	public function Wp_Team_Members_Profile_display_general_account() {
		echo '<p>These settings apply to all Plugin Name functionality.</p>';
	} 
	public function Wp_Team_Members_Profile_render_settings_field($args) {
			/* EXAMPLE INPUT
								'type'      => 'input',
								'subtype'   => '',
								'id'    => $this->plugin_name.'_example_setting',
								'name'      => $this->plugin_name.'_example_setting',
								'required' => 'required="required"',
								'get_option_list' => "",
									'value_type' = serialized OR normal,
			'wp_data'=>(option or post_meta),
			'post_id' =>
			*/     
		if($args['wp_data'] == 'option'){
			$wp_data_value = get_option($args['name']);
		} elseif($args['wp_data'] == 'post_meta'){
			$wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
		}

		switch ($args['type']) {

			case 'input':
					$value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
					if($args['subtype'] != 'checkbox'){
							$prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
							$prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
							$step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
							$min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
							$max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
							if(isset($args['disabled'])){
									// hide the actual input bc if it was just a disabled input the info saved in the database would be wrong - bc it would pass empty values and wipe the actual information
									echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
							} else {
									echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
							}
							/*<input required="required" '.$disabled.' type="number" step="any" id="'.$this->plugin_name.'_cost2" name="'.$this->plugin_name.'_cost2" value="' . esc_attr( $cost ) . '" size="25" /><input type="hidden" id="'.$this->plugin_name.'_cost" step="any" name="'.$this->plugin_name.'_cost" value="' . esc_attr( $cost ) . '" />*/

					} else {
							$checked = ($value) ? 'checked' : '';
							echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
					}
					break;
			default:
					# code...
					break;
		}
	}

	public function wptmp_register_team_member_post_type() {

		register_post_type('team_member',
			array(
				'labels'      => array(
					'name'          => __( 'Team members', 'textdomain' ),
					'singular_name' => __( 'Team member', 'textdomain' ),
					'featured_image'        => __( 'Profile photo', 'textdomain' ),
					'set_featured_image'    =>  __( 'Set Profile photo', 'textdomain' ),
					'set_featured_image'    =>  __( 'Set Profile photo', 'textdomain' ),
					'add_new'                  =>  __( 'Add new', 'textdomain' ),
					'add_new_item'             =>  __( 'Add new member', 'textdomain' ),
					'edit_item'                =>  __( 'Edit member', 'textdomain' ),
					'new_item'                 =>  __( 'New member', 'textdomain' ),
					'view_item'                => __( 'View member', 'textdomain' ),
					'view_items'               => __( 'View members', 'textdomain' ),		
					'item_published'           => __( 'Member Added', 'textdomain' ),
					'item_reverted_to_draft'   =>__( 'Member moved to draft', 'textdomain' ),
					'item_updated'             => __( 'Member details updated', 'textdomain' ),
				),
				'public'      => true,
				'has_archive' => true,
				'show_in_menu'=>true,
				'show_in_rest'=>true,
				'supports'=>array('title','editor','thumbnail','revisions'),
			
			
			)
		);
	}

	public function wptmp_addAndSaveMetaBox(){
	
		function post_metadata_team_member(){
			global $post;
			$custom = get_post_custom( $post->ID );
			$currentMember = $custom[ "_designation" ][ 0 ];
			echo "<input class=\"fw_metabox\" type=\"text\" name=\"_designation\" value=\"".$currentMember."\" placeholder=\"Member designation\">";
		}

		function post_meta_box_team_member(){
			global $post;
			$custom = get_post_custom( $post->ID );
			$currentInputData = $custom[ "_designation" ][ 0 ];
			echo "<input class=\"fw_metabox\" type=\"text\" name=\"_designation\" value=\"".$currentInputData."\" placeholder=\"Member designation\">";
		}

		function wptmp_add_meta_boxes() {
			add_meta_box(
				'post_metadata_team_member',
				'Designation',
				'post_meta_box_team_member',
				'team_member',
	
			);
		}
		add_action( 'admin_init',  'wptmp_add_meta_boxes' );
		function wptmp_save_meta_boxes() {
			global $post;
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			update_post_meta( $post->ID, "_designation", sanitize_text_field( $_POST[ "_designation" ] ) );
		}
		add_action('save_post','wptmp_save_meta_boxes');
		//remove yoast
		function my_remove_wp_seo_meta_box() {
			remove_meta_box('wpseo_meta', 'team_member', 'normal');
		}
		add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box', 100);

		add_action('rest_api_init', 'register_rest_images' );
		function register_rest_images(){
			register_rest_field( array('team_member'),
				'image',
				array(
					'get_callback'    => 'get_rest_featured_image',
					'update_callback' => null,
					'schema'          => null,
				)
			);
		}
		function get_rest_featured_image( $object, $field_name, $request ) {
			if( $object['featured_media'] ){
				$img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
				return $img[0];
			}
			return false;
		}


		add_action('rest_api_init', 'register_meta_val' );
		function register_meta_val(){
			register_rest_field( array('team_member'),
				'designation',
				array(
					'get_callback'    => 'get_rest_designation_meta',
					'update_callback' => null,
					'schema'          => null,
				)
			);
		}
		function get_rest_designation_meta( $object, $field_name, $request ) {
			if( $object['id'] ){
				$designation = get_post_meta( $object['id'], '_designation', true );
				return $designation;
			}
			return false;
		}

	
	}
	
}
