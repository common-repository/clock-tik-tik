<?php if (!defined('ABSPATH'))
  exit; // Exit if directly accessed
  
/**
 * Fired during plugin activation
 */
if (!class_exists('Clock_tik_shortcode_class')) {
	class Clock_tik_shortcode_class {
	  
		function __construct() {
			add_shortcode('tik_analog_clock', array($this,'tik_analog_clock'));
			add_shortcode('tik_digital_clock', array($this,'tik_digital_clock'));
		}

		public function tik_digital_clock( $attr ){

			$data = get_post($attr["clockid"]);

			if ($data == "")
				return __("Unknown or invalid clockid",'clock-tik-tik' );
			   
			$time = $this->getTimesZoneName($data->timezone_name,true);

			if (!$time['status'])
				return "<p>$time[msg]</p>";

			$id = $data->ID;
			$hours  = $time['h'];
			$mint   = $time['i'];
			$second = $time['s'];
			
			?>

			<style>
			  	.clock_dedital_<?php echo esc_attr($id); ?>{
					background-color: <?php echo esc_attr($data->background_color_d); ?>;
					color: <?php echo esc_attr($data->digit_color); ?>;
					width: fit-content;
					position: relative;
					padding: 11px 20px;
					font-size: <?php echo esc_attr($data->font_size); ?>;
					border-radius: 5px;
					left: 0%;
					margin-bottom: 10px;
					top: 0px;
					margin: 0px auto;
					margin-bottom: 10px;
				}

				.clockk .col_last {
					margin-top: 50px;
				}

				.clock_dedital_<?php echo esc_attr($id); ?> span  {
					font-size: <?php echo esc_attr($data->font_size); ?>;
					line-height: initial;
				}
			</style>

			 	<!-- end digital clock css -->

				<!-- Start digital clock HTML -->

			<div class='tikDClock clock_dedital_<?php echo esc_attr($id); ?>' id='<?php echo esc_attr("clock_".$id); ?>'> </div>

			<!-- end digital clock HTML -->

			<!-- Start digital clock script -->

			<script>
				var hours_<?php echo esc_js($id); ?>  = <?php echo esc_js($hours);  ?>;
				var mint_<?php echo esc_js($id); ?>   = <?php echo esc_js($mint);   ?>;
				var second_<?php echo esc_js($id); ?> = <?php echo esc_js($second); ?>;

				function showTime_<?php echo esc_js($id);?>(){
				  
					if(mint_<?php echo esc_js($id);?>%60==0 && mint_<?php echo esc_js($id);?> != 0) { 
						mint_<?php echo esc_js($id);?>=0; hours_<?php echo esc_js($id);?>++;
					}
				  
				  	if(hours_<?php echo esc_js($id);?> == 25) { 
				  		hours_<?php echo esc_js($id);?>=1;
				  	}
				  
					if(second_<?php echo esc_js($id);?>%60==0) { 
						second_<?php echo esc_js($id);?> =0; mint_<?php echo esc_js($id);?>++;
					}
				  	// to get current time/ date.
				  	// var date = new Date();
				  	// to get the current hour
					  
					var h_<?php echo esc_js($id);?> = hours_<?php echo esc_js($id);?>;
					// to get the current minutes
					var m_<?php echo esc_js($id);?> = mint_<?php echo esc_js($id);?>;
					//to get the current second
					var s_<?php echo esc_js($id);?> = second_<?php echo esc_js($id);?>++;
					var session_<?php echo esc_js($id);?> = '';
					
					if (<?php echo esc_js($data->is_24hour);?> == 12) {
					  // AM, PM setting
					   session_<?php echo esc_js($id);?> = 'AM'; 
					 	//conditions for times behavior 
						if ( h_<?php echo esc_js($id);?> == 0 ) {
							h_<?php echo esc_js($id);?> = 12;
					  	}
					  	if( h_<?php echo esc_js($id);?> >= 12 ){
							session_<?php echo esc_js($id);?> = 'PM';
						}

						if ( h_<?php echo esc_js($id);?> > 12 ){
							h_<?php echo esc_js($id);?> = h_<?php echo esc_js($id);?> - 12;
						}

					}
					
					m_<?php echo esc_js($id);?> = ( m_<?php echo esc_js($id);?> < 10 ) ? m_<?php echo esc_js($id);?> = '0' + m_<?php echo esc_js($id);?> : m_<?php echo esc_js($id);?>;

					s_<?php echo esc_js($id);?> = ( s_<?php echo esc_js($id);?> < 10 ) ? s_<?php echo esc_js($id);?> = '0' + s_<?php echo esc_js($id);?> : s_<?php echo esc_js($id);?>;
					  
					  //putting time in one variable

					var time_<?php echo esc_js($id);?> = `<span class='h h_<?php echo esc_js($id);?>'>`+ h_<?php echo esc_js($id);?> + `</span>:<span class='m m_<?php echo esc_js($id);?>'>` + m_<?php echo esc_js($id);?> + `</span>:<span class='s s_<?php echo esc_js($id);?>'>` + s_<?php echo esc_js($id);?> + `</span> <span class='is_12 is_<?php echo esc_js($id);?>'> ` + session_<?php echo esc_js($id);?>+`</span>`;

					//putting time in our div
					jQuery('#clock_<?php echo esc_js($id);?>').html(time_<?php echo esc_js($id);?>); 
					//to change time in every seconds
					setTimeout( showTime_<?php echo esc_js($id); ?> , 1000 );
				}

				showTime_<?php echo esc_js($id);?>();

			</script>

				<!-- end digital clock script -->

			<?php
		}


		public function tik_analog_clock( $attr ) {

			$data = get_post($attr["clockid"]);
			$id = $data->ID;

			if ($data == "")
				return __( "<p>Unknown or invalid clockid</p>",'clock-tik-tik' );
			   
			$time = $this->getTimesZoneName($data->timezone_name);

			if (!$time['status'])
				return "<p>$time[msg]</p>";
			
			$hours  = $time['h'];
			$mint   = $time['i'];
			$second = $time['s'];

			//Start analog clock style
			?>
			<style>
				.clock_<?php echo esc_attr($id); ?> {
				  background: <?php echo esc_attr($data->background_color); ?>;
				  text-align: center;
				  font-size: 10px !important;
				  width: <?php echo esc_attr($data->size); ?>;
				  height: <?php echo esc_attr($data->size); ?>;
				  border: 7px solid <?php echo esc_attr($data->background_color); ?>;
				  box-shadow: -4px -4px 10px rgba(67,67,67,0.5),
								inset 4px 4px 10px rgba(0,0,0,0.5),
								inset -4px -4px 10px rgba(67,67,67,0.5),
								4px 4px 10px rgba(0,0,0,0.3);
				  border-radius: <?php echo esc_attr($data->radius); ?>;
				  margin: 50px auto;
				  position: relative;
				  padding: 2rem;
					}

				.outer-clock-face_<?php echo esc_attr($id); ?> {
				  position: relative;
				  width: 100%;
				  height: 100%;
				  border-radius: 100%;
				  background: <?php echo esc_attr($data->background_color); ?>;
				  overflow: hidden;
				}

				.outer-clock-face_<?php echo esc_attr($id); ?>::after {
				  -webkit-transform: rotate(90deg);
				  -moz-transform: rotate(90deg);
				  transform: rotate(90deg)
				}

				.outer-clock-face_<?php echo esc_attr($id); ?>::before,
				.outer-clock-face_<?php echo esc_attr($id); ?>::after,
				.outer-clock-face_<?php echo esc_attr($id); ?> .marking_<?php echo esc_attr($id); ?>{
				  content: "";
				  position: absolute;
				  width: 5px;
				  height: 100%;
				  background: <?php echo esc_attr($data->bold_marker_color); ?>;
				  z-index: 0;
				  left: 49%;
				}

				.outer-clock-face_<?php echo esc_attr($id); ?> .marking_<?php echo esc_attr($id); ?> {
				  background: <?php echo esc_attr($data->marker_color); ?>;
				  width: 3px;
				}

				.outer-clock-face_<?php echo esc_attr($id); ?> .marking_<?php echo esc_attr($id); ?>.marking-one_<?php echo esc_attr($id); ?> {
				  -webkit-transform: rotate(30deg);
				  -moz-transform: rotate(30deg);
				  transform: rotate(30deg)
				}

				.outer-clock-face_<?php echo esc_attr($id); ?> .marking_<?php echo esc_attr($id); ?>.marking-two_<?php echo esc_attr($id); ?> {
				  -webkit-transform: rotate(60deg);
				  -moz-transform: rotate(60deg);
				  transform: rotate(60deg)
				}

				.outer-clock-face_<?php echo esc_attr($id); ?> .marking_<?php echo esc_attr($id); ?>.marking-three_<?php echo esc_attr($id); ?> {
				  -webkit-transform: rotate(120deg);
				  -moz-transform: rotate(120deg);
				  transform: rotate(120deg)
				}

				.outer-clock-face_<?php echo esc_attr($id); ?> .marking_<?php echo esc_attr($id); ?>.marking-four_<?php echo esc_attr($id); ?> {
				  -webkit-transform: rotate(150deg);
				  -moz-transform: rotate(150deg);
				  transform: rotate(150deg)
				}

				.inner-clock-face_<?php echo esc_attr($id); ?> {
				  position: absolute;
				  top: 10%;
				  left: 10%;
				  width: 80%;
				  height: 80%;
				  background: <?php echo esc_attr($data->background_color); ?>;
				  -webkit-border-radius: 100%;
				  -moz-border-radius: 100%;
				  border-radius: 100%;
				  z-index: 1;
				}

				.inner-clock-face_<?php echo esc_attr($id); ?>::before {
				  content: "";
				  position: absolute;
				  top: 50%;
				  left: 50%;
				  width: 16px;
				  height: 16px;
				  border-radius: 18px;
				  margin-left: -9px;
				  margin-top: -6px;
				  background: #4d4b63;
				  z-index: 11;
				}

				.hand_<?php echo esc_attr($id); ?> {
				  width: 50%;
				  right: 50%;
				  height: 6px;
				  background: <?php echo esc_attr($data->hand_color); ?>;
				  position: absolute;
				  top: 50%;
				  border-radius: 6px;
				  transform-origin: 100%;
				  transform: rotate(90deg);
				  transition-timing-function: cubic-bezier(0.1, 2.7, 0.58, 1);
				}

				.hand_<?php echo esc_attr($id); ?>.hour-hand_<?php echo esc_attr($id); ?> {
				  width: 30%;
				  z-index: 3;
				}

				.hand_<?php echo esc_attr($id); ?>.min-hand_<?php echo esc_attr($id); ?> {
				  height: 3px;
				  z-index: 10;
				  width: 40%;
				}

				.hand_<?php echo esc_attr($id); ?>.second-hand_<?php echo esc_attr($id); ?> {
				  width: 45%;
				  height: 2px;
				}
			</style>

			<!-- end analog clock style -->

			<!-- Start analog clock HTML -->

			<div class="tikAClock clock_<?php echo esc_attr($id); ?>">
				<div class="outer-clock-face_<?php echo esc_attr($id); ?>">
					<div class="marking_<?php echo esc_attr($id); ?> marking-one_<?php echo esc_attr($id); ?>"></div>
					<div class="marking_<?php echo esc_attr($id); ?> marking-two_<?php echo esc_attr($id); ?>"></div>
					<div class="marking_<?php echo esc_attr($id);?> marking-three_<?php echo esc_attr($id);?>"></div>
					<div class="marking_<?php echo esc_attr($id); ?> marking-four_<?php echo esc_attr($id);?>"></div>
				   <div class="inner-clock-face_<?php echo esc_attr($id); ?>">
						<div class="hand_<?php echo esc_attr($id); ?> hour-hand_<?php echo esc_attr($id); ?>"></div>
						<div class="hand_<?php echo esc_attr($id); ?> min-hand_<?php echo esc_attr($id); ?>"></div>
						<div class="hand_<?php echo esc_attr($id); ?> second-hand_<?php echo esc_attr($id); ?>"></div>
				   </div>
				</div>
			</div>

				
			<!-- end analog clock HTML -->


			<!-- Start analog clock script -->

			<script>
				var hours_<?php echo esc_js($id); ?> = <?php echo esc_js($hours); ?>;
				var mint_<?php echo esc_js($id); ?> = <?php echo esc_js($mint); ?>;
				var second_<?php echo esc_js($id); ?> = <?php echo esc_js($second); ?>;

				const secondHand_<?php echo esc_js($id); ?> = document.querySelector(".second-hand_<?php echo esc_js($id); ?>");
				const minsHand_<?php echo esc_js($id); ?> = document.querySelector(".min-hand_<?php echo esc_js($id); ?>");
				const hourHand_<?php echo esc_js($id); ?> = document.querySelector(".hour-hand_<?php echo esc_js($id); ?>");

				function setDate_<?php echo esc_js($id); ?>() {

					const now = new Date();

				   	if(second_<?php echo esc_js($id); ?>%60==0) { 
					   	second_<?php echo esc_js($id); ?> = 0; 
					   	mint_<?php echo esc_js($id); ?>++;
				   	}
				   
					const seconds_<?php echo esc_js($id); ?> = second_<?php echo esc_js($id); ?>++;
					const secondsDegrees = ((seconds_<?php echo esc_js($id); ?> / 60) * 360) + 90;
					secondHand_<?php echo esc_js($id); ?>.style.transform = `rotate(${secondsDegrees}deg)`;

					const mins_<?php echo esc_js($id); ?> = mint_<?php echo esc_js($id); ?>;
					const minsDegrees = ((mins_<?php echo esc_js($id); ?> / 60) * 360) + ((seconds_<?php echo esc_js($id); ?>/60)*6) + 90;

				  	minsHand_<?php echo esc_js($id); ?>.style.transform = `rotate(${minsDegrees}deg)`;

					const hour_<?php echo esc_js($id); ?> = hours_<?php echo esc_js($id); ?>;
					const hourDegrees = ((hour_<?php echo esc_js($id); ?> / 12) * 360) + ((mins_<?php echo esc_js($id); ?>/60)*30) + 90;
				  	hourHand_<?php echo esc_js($id); ?>.style.transform = `rotate(${hourDegrees}deg)`;
				}

				setInterval(setDate_<?php echo esc_js($id); ?>, 1000);
				setDate_<?php echo esc_js($id); ?>();
			</script>

			<!-- end analog clock script -->

			<?php

		}


	   	public function getTimesZoneName( $zoneName, $is24 = false ) {
		  try {
				$dateTimeObj = new DateTimeZone($zoneName);
				$currentTime = new DateTime("now", $dateTimeObj);
				$return['h'] = $currentTime->format(($is24) ? 'H' : 'h');
				$return['i'] = $currentTime->format('i');
				$return['s'] = $currentTime->format('s');
				$return['status'] = true;

				return $return;
		   } catch (Exception $e) {

				$return['msg'] = $e->getMessage();
				$return['status'] = false;
				return $return;
			}
		}
	}
}

new Clock_tik_shortcode_class();
?>