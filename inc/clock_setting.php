<?php if ( !defined( 'ABSPATH' ) )
	exit; // Exit if directly accessed

/**
 * Fired during plugin activation
 */
if ( !class_exists( 'Clock_tik_tik_class' ) ) {
	class Clock_tik_tik_class {

		public function __construct() {
			/*Menu hook*/
			add_action( 'admin_menu', [$this, 'my_add_clock_sub_menu'] );
			/*Register Styling Scripts*/
			add_action( 'admin_enqueue_scripts', [$this, 'my_clock_time_function'] );

			$variable = ['submit_clock_css'];

			foreach ( $variable as $key => $value ) {
				add_action( 'wp_ajax_'.$value, [$this,$value] );
				add_action( 'wp_ajax_nopriv_'.$value, [$this,$value] );
			}
		}

		public function my_add_clock_sub_menu() {
			if ( is_admin() ) {

				add_menu_page( 'Clock Tik Tik', 'Clock Tik Tik', 'edit_pages', 'MCWC_listing',[$this, 'MCWC_Sub_menu_template'], 'dashicons-clock', 30 );

				add_submenu_page( 'MCWC_listing','Add Clock','Add Clock','administrator','MCWC_add_clock',[$this, 'MCWC_add_clock_template'] );
			}
		}


		public function my_clock_time_function( $hook ) {

			$if_page = ["toplevel_page_MCWC_listing","clock-tik-tik_page_MCWC_add_clock"];

			if ( !in_array( $hook, $if_page ) )
				return;

			wp_enqueue_style( 'global-css', CLOCK_TIK_URL . '/assets/css/global.css' );
			wp_enqueue_style( 'select2-css', CLOCK_TIK_URL . '/assets/css/select2.min.css' );
			wp_enqueue_style( 'fontawesome', CLOCK_TIK_URL . '/assets/css/fontawesome.all.css' );

	    wp_enqueue_script( 'sweet_alert',CLOCK_TIK_URL."/assets/js/sweetalert.min.js" );
	    wp_enqueue_script( 'select2-js',CLOCK_TIK_URL."/assets/js/select2.min.js" );

			wp_enqueue_script( 'custom_js',CLOCK_TIK_URL."/assets/js/ajax_main.js" );
		  wp_localize_script( 'custom_js', 'ajax_script', array('ajax_url' => admin_url('admin-ajax.php')) );
		}

		public function MCWC_add_clock_template() {

			if ( is_admin() && current_user_can('manage_options') ) {
				require CLOCK_TIK_PATH.'/templates/add_new_clock_template.php';
			} else {
				_e( 'Denied ! Only admin can see this.', 'clock-tik-tik' );
			}

		}

		public function MCWC_Sub_menu_template() {

			if ( is_admin() && current_user_can( 'manage_options' ) ) {
				require CLOCK_TIK_PATH.'/templates/clock_list_template.php';
			} else {
				_e( 'Denied ! Only admin can see this.', 'clock-tik-tik' );
			}

		}

		public function submit_clock_css() {

			foreach ( $_POST as $key => $value ) {
				if ( $key == "post_id" ) continue;
					if ( $value == "" ) {
						$err['status'] = false;
				    	$err['error'] = __("Please Fill The Fields",'clock-tik-tik' );
						return $this->response_json( $err );
					}
			}

			if ( $_POST['post_id'] == "" ) {

				$post_data = [
				  'post_title'=> $this->MCWC_validator_function( $_POST['timezone_name'] ),
				  'post_status'=> "publish",
				  'post_type'=>"time_clock_tik_tik",
				];

				$err['error'] = __("Clock Added Successfully",'clock-tik-tik' );
				$post_id = wp_insert_post($post_data);
			}

			else
			{
				$post_data = [
				  'ID'         => self::MCWC_validator_function( $_POST['post_id'] ),
				  'post_title' => self::MCWC_validator_function( $_POST['timezone_name'] ),
				  'post_status'=> "publish",
				  'post_type'  => "time_clock_tik_tik",
				];

				$err['error'] = __("Clock Update Successfully",'clock-tik-tik' );
				$post_id = wp_update_post($post_data);
			}

			  foreach ( $_POST as $key => $value ) {
			      if ( $key == "action" ) {continue;}
			      if ( $key == "post_id" ) {continue;}
			      update_post_meta( $post_id,$key,self::MCWC_validator_function( $value ) );
			  }
			 if ( $post_id ) {
			    $err['status'] = true;
			    $err['auto_redirect'] = true;
				$err['redirect_url'] = admin_url( "admin.php?page=MCWC_add_clock&id=".$post_id );
			    
			 } else {
			    $err['status'] = false;
			    $err['error'] = __( "Something Wrong Please Try Again",'clock-tik-tik' );
			 }
			return $this->response_json( $err );
		}

	
		static public function get_clock_list()
			{

				if ( $_GET['action'] == "remove" && $_GET['id'] != "" ) {
				  wp_delete_post( self::MCWC_validator_function( $_GET['id'] ) );
				  wp_redirect( home_url().'/wp-admin/admin.php?page=MCWC_listing' );
				  exit();
				}

				return  get_posts([
				  'post_status'=> "publish",
				  'post_type'=>"time_clock_tik_tik",
				  'order'  => 'DESC',
				  'orderby'=>'ID',
				  'posts_per_page' => -1,
				]);
			}

        public  static function getAllTimeZoneName( $zone_name )
	        {
	        	$zones_id = ["1","2","4","8","16","32","64","128","256","512"];
	        	foreach ( $zones_id as $Zkey => $Zvalue ) {

		        	foreach ( timezone_identifiers_list( $Zvalue ) as $key => $value ) {

		          		$select = ($zone_name == $value) ? "selected" : "";
				  		$data .= '<option value="'.$value.'" '.$select.'>'.$value.'</option>';

					}

				}

			  	return $data;
	        }


        public function response_json( $request )
        {
          _e( json_encode( $request ) );
          exit();
        }
       

		public static function MCWC_validator_function( $field ) {
			if (empty( $field )) {
				return;
			}
			$field = sanitize_text_field( $field );
			$field = trim( $field );
			$field = stripslashes( $field );
			$field = htmlspecialchars( $field );
			return $field;
		}
	}
	 new Clock_tik_tik_class();
}










