<?php if (!defined('ABSPATH')) {
  exit; // Exit if directly accessed
}

	$id = isset( $_GET['id'] ) ? Clock_tik_tik_class::MCWC_validator_function( $_GET['id'] ) : "";
	if (isset($_GET['id']) && $id != "") 
	{ 
		$metadata = get_post_meta( $id ); 
	} else { 
		$is_addUpdate = "MCWC_active "; 
	}

?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">

		    <?php if (!isset($_GET['id']) && $id == ""): ?>

		    <div class="MCWC_tab">
				  <button call="Analog" class="MCWC_tablinks btn <?php _e($is_addUpdate) ?>" >Analog Clock</button>
				  <button call="Digital" class="MCWC_tablinks btn"> <?php _e('Digital clock','clock-tik-tik') ?></button>
		    </div>
		      
		    <?php endif ?>

			<div class="card MCWC_tabcontent <?php _e($is_addUpdate.($metadata['clock_type'][0]=="tik_analog_clock") ? "MCWC_active" : "") ?>" id="Analog">
				<div class="card-header">
					<h3> <?php _e('Analog Clock','clock-tik-tik') ?> </h3>
				</div>

				<div class="card-body">
					<form class="form_for_submit" method="POST">

						<div class="form-group row">
						    <label class="col-sm-2 col-form-label"><?php _e('Title','clock-tik-tik') ?>:</label>
						    <div class="col-sm-10">
						    	<input class="form-control" type="text" name="title"  placeholder="eg : Main page , Post page" 
						      	value="<?php _e($metadata['title'][0]) ?>">
						    </div>
						</div>

						<div class="form-group row">
						    <label for="redirect69" class="col-sm-2 col-form-label"><?php _e('Select Timezone Name','clock-tik-tik') ?>:</label>
						    <div class="col-sm-10">
						    	<select class="form-control" id="time_zone_see" name="timezone_name">
						        	<option></option>
						        	<?php _e(Clock_tik_tik_class::getAllTimeZoneName($metadata['timezone_name'][0])); ?>
						    	</select>
						    </div>
						</div>

							<div class="row">
								<div class="form-group row col-sm-12 col-md-2 col-lg-2">
							    	<label class="col-sm-12 col-form-label"><?php _e('Color Setting','clock-tik-tik') ?></label>
								</div>

								<div class="form-group row col-sm-4 col-md-2 col-lg-2">
							    	<label class="col-sm-12 col-form-label"><?php _e('Background','clock-tik-tik') ?>:</label>
								    <div class="col-sm-12">
								    	<input type="color" name="background_color" placeholder="" value="<?php _e($metadata['background_color'][0]) ?>">
								    </div>
								</div>

								<div class="form-group row col-sm-4 col-md-2 col-lg-2">
									<label for="uname_email_login96" class="col-sm-12 col-form-label"><?php _e('Hand','clock-tik-tik') ?>:</label>
									<div class="col-sm-12">
								    	<input type="color"  name="hand_color" value="<?php _e($metadata['hand_color'][0]) ?>">
									</div>
								</div>

								<div class="form-group row col-sm-4 col-md-2 col-lg-2">
									<label for="pwd_login96" class="col-sm-12 col-form-label"><?php _e('Marker','clock-tik-tik') ?>:</label>
									<div class="col-sm-12">
								    	<input type="color"  name="marker_color" value="<?php _e($metadata['marker_color'][0]) ?>">
									</div>
								</div>

								<div class="form-group row col-sm-4 col-md-2 col-lg-2">
									<label for="pwd_login96" class="col-sm-12 col-form-label"><?php _e('Bold Marker','clock-tik-tik') ?>:</label>
									<div class="col-sm-12">
								    	<input type="color" name="bold_marker_color" value="<?php _e($metadata['bold_marker_color'][0]) ?>">
								    </div>
								</div>

								<div class="form-group row col-sm-4 col-md-2 col-lg-2">
								    <label for="pwd_login96" class="col-sm-12 col-form-label"><?php _e('Radius','clock-tik-tik') ?>:</label>
								    <div class="col-sm-12">
								    	<input type="text" class="form-control" name="radius" placeholder="10px, 12mm, 5cm." value="<?php _e(($metadata['radius'][0]) ? $metadata['radius'][0] : "50%") ?>">
								    </div>
								</div>

							    <div class="form-group row col-sm-4 col-md-2 col-lg-2">
								    <label for="pwd_login96" class="col-sm-12 col-form-label"><?php _e('Size','clock-tik-tik') ?>:</label>
								    <div class="col-sm-12">
								    	<input type="text" class="form-control" placeholder="19rem, 320px, 120mm, 10cm." name="size" value="<?php _e(($metadata['size'][0]) ? $metadata['size'][0] : "19rem") ?>">
								    </div>
								</div>

							</div>

						<div class="form-group row">
							<div class="col-sm-10">
								<input type="hidden" name="post_id" value="<?php echo esc_attr($_GET['id']) ?>">
								<input type="hidden" name="clock_type" value="tik_analog_clock">
								<input type="hidden" name="action" value="submit_clock_css">
								<button type="submit" name="save_register" class="btn btn-primary"><?php _e(($_GET['id']=="") ? "Add" : "Update") ?></button>
						    </div>
						</div>
					</form>
		  		</div>
			</div>


			<!-- ///////////  Digital clock  //////// -->

			<div class="card MCWC_tabcontent <?php _e(($metadata['clock_type'][0]=="tik_digital_clock") ? "MCWC_active" : "") ?> "id="Digital">
				<div class="card-header">
			  		<h3><?php _e('Digital clock','clock-tik-tik') ?></h3>
				</div>

				<div class="card-body">
					<form class="form_for_submit" method="POST">

						<div class="form-group row">
						    <label class="col-sm-2 col-form-label"><?php _e('Title','clock-tik-tik') ?>:</label>
						    <div class="col-sm-10">
						    	<input class="form-control" type="text" name="title" value="<?php _e($metadata['title'][0]) ?>" 
						      	placeholder="eg : Main page , Post page">
						    </div>
						</div>

						<div class="form-group row">
						    <label for="redirect69" class="col-sm-2 col-form-label"><?php _e('Select Timezone Name','clock-tik-tik') ?>:</label>
						    <div class="col-sm-10">
						    	<select class="form-control" id="time_zone_see1" name="timezone_name">
						       		<option></option>
						        	<?php _e(Clock_tik_tik_class::getAllTimeZoneName($metadata['timezone_name'][0])); ?>
						    	</select>
						    </div>
						</div> 

						<div class="row">
							<div class="form-group row col-sm-12 col-md-2 col-lg-2">
							    <label class="col-sm-12 col-form-label"><?php _e('Color Setting','clock-tik-tik') ?></label>
							</div>

							<div class="form-group row col-sm-4 col-md-2 col-lg-2" style="margin-right: 3%;">
							    <div class="col-sm-10" style="display: flex;">
							    	<label for="formit_is_24" class="col-sm-12 col-form-label"><?php _e('24-hour','clock-tik-tik') ?>:
								    	<input id="formit_is_24" checked type="radio" class="form-control" name="is_24hour"  value="24" 
								    	<?php _e(($metadata['is_24hour'][0] == "24") ? "checked" : "") ?>>
							    	</label>

							     	<label for="formit_is_12" class="col-sm-12 col-form-label"><?php _e('12-hour','clock-tik-tik') ?>:
								     	<input id="formit_is_12" type="radio" class="form-control" name="is_24hour" value="12"
								     	<?php _e(($metadata['is_24hour'][0] == "12") ? "checked" : "") ?>>
							     	</label>
							    </div>
							</div>

							<div class="form-group row col-sm-4 col-md-2 col-lg-2">
							    <label for="email_register96" class="col-sm-12 col-form-label"><?php _e('Font Size','clock-tik-tik') ?>:</label>
							    <div class="col-sm-10">
							     	<input type="text" class="form-control" name="font_size" placeholder="100px, 50mm, 5cm." value="<?php _e(($metadata['font_size'][0]) ? $metadata['font_size'][0] : "100px") ?>">
							    </div>
							</div>

							<div class="form-group row col-sm-4 col-md-2 col-lg-2">
							    <label  class="col-sm-12 col-form-label"><?php _e('Background Color','clock-tik-tik') ?>:</label>
							    <div class="col-sm-10">
							    	<input type="color"   name="background_color_d" value="<?php _e($metadata['background_color_d'][0]) ?>">
							    </div>
							</div>

							<div class="form-group row col-sm-4 col-md-2 col-lg-2">
							    <label  class="col-sm-12 col-form-label"><?php _e('Digit Color','clock-tik-tik'); ?>:</label>
							    <div class="col-sm-10">
							    	<input type="color"   name="digit_color" value="<?php _e($metadata['digit_color'][0]) ?>">
							    </div>
							</div>

						</div>

						<div class="form-group row">
						   	<div class="col-sm-10">
							    <input type="hidden" name="post_id" value="<?php echo esc_attr($_GET['id']); ?>">
							    <input type="hidden" name="clock_type" value="tik_digital_clock">
							    <input type="hidden" name="action" value="submit_clock_css">
							    <button type="submit" name="save_register" class="btn btn-primary"><?php _e(($_GET['id']=="") ? "Add" : "Update") ?></button>
						   	</div>
						</div>

					</form>
				</div>
			</div>


			<?php if (isset($_GET['id']) && $_GET['id'] != ""): ?>

			  	<div class="card" id="live_card">
				  	<div class="header" id="header"><span><i class="fa fa-arrows"></i></span> <span><?php _e('live Demo','clock-tik-tik') ?></span></div>	
				  	<div class="card-body">
				 		<?php do_shortcode('['.$metadata['clock_type'][0]." clockid=".$_GET['id'].']') ?>
					</div>
				</div>

			<?php endif ?>

			<!-- ///////////  Digital clock  //////// -->

		</div>
	</div>
</div>

<script type="text/javascript">
	
	var id = '<?php echo isset($_GET['id']); ?>';
	var ids = '<?php echo esc_js($_GET['id']); ?>';


	if 	(id) {

			var clock_type = '<?php echo esc_js($metadata['clock_type'][0]); ?>';
			var live_card = document.getElementById("live_card");
			var clock = document.getElementById("clock_"+ids);
			clock_style = live_card.getElementsByTagName("style")[0];
			clock_style_html = clock_style.innerHTML;
	}

	if (id && clock_type == "tik_digital_clock" ) {

	    var font_size = document.getElementsByName("font_size");
	    var background_color = document.getElementsByName("background_color_d");
	    var color = document.getElementsByName("digit_color");

	    background_color[0].addEventListener("input",function (e) {
	    	clock.style.background = e.target.value;
	    });

	     color[0].addEventListener("input",function (e) {
	    	clock.style.color = e.target.value;
	    });

		font_size[0].addEventListener("input",function (e) {
			clock.style.fontSize = e.target.value;
		    clock_style.innerHTML = clock_style.innerHTML+'.clock_dedital_'+ids+' span{font-size:'+e.target.value+';}';
		});
	}
	else{

	    var main_clock_ = document.getElementsByClassName("clock_"+ids);
	    var outer_clock = document.getElementsByClassName("outer-clock-face_"+ids);
	    var inner_clock = document.getElementsByClassName("inner-clock-face_"+ids);
	    var marking = document.getElementsByClassName( "marking_"+ids);
	    var hand = document.getElementsByClassName( "hand_"+ids);

	    var background_color = document.getElementsByName("background_color");
	    var radius = document.getElementsByName("radius");
	    var marker_color = document.getElementsByName("marker_color");
	    var bold_marker_color = document.getElementsByName("bold_marker_color");
	    var hand_color = document.getElementsByName("hand_color");
	    var size = document.getElementsByName("size");


		 background_color[0].addEventListener("input",function (e) {
	    	main_clock_[0].style.background = e.target.value;
	    	outer_clock[0].style.background = e.target.value;
	    	inner_clock[0].style.background = e.target.value;
	    	main_clock_[0].style.borderColor = e.target.value;

	    });

		radius[0].addEventListener("input",function (e) {
	    	main_clock_[0].style.borderRadius = e.target.value;
	    });

	    marker_color[0].addEventListener("input",function (e) {
	    	marking[0].style.background = e.target.value;
	    	marking[1].style.background = e.target.value;
	    	marking[2].style.background = e.target.value;
	    	marking[3].style.background = e.target.value;

	    });

		hand_color[0].addEventListener("input",function (e) {
	    	hand[0].style.background = e.target.value;
	    	hand[1].style.background = e.target.value;
	    	hand[2].style.background = e.target.value;

	    });

	    bold_marker_color[0].addEventListener("input",function (e) {
	    	clock_style.innerHTML = clock_style_html+`.outer-clock-face_<?php echo esc_js($id) ?>::before,.outer-clock-face_<?php echo esc_js($id) ?>::after{background: `+e.target.value+`;}`;
	    });

	    size[0].addEventListener("input",function (e) {
	    	main_clock_[0].style.width = e.target.value;
	    	main_clock_[0].style.height = e.target.value;

	    });
	}


	if(id){

        // Get the elements to attach listeners, 
        // to get info and to update positions:
        var container = document.querySelector('body');
        var header = document.querySelector('#header');

        var circle = document.querySelector('#live_card');

        // "distX", "distY" will help us to know the distance
        // between the last position and the new, 
        // to keep the space between the click and the element, 
        // and of course, to move the element smooth
        var state = { distX: 0, distY: 0 };

        // These functions are declared outside of the elements
        // because they are going to be reused in two different
        // kind of events device: touch/mouse
        function onDown(e) {
            // Stop bubbling, this is important to avoid 
            // unexpected behaviours on mobile browsers:
            e.preventDefault();
            
            // Get the correct event source regardless the device:
            // Btw, "e.changedTouches[0]" in this case for simplicity 
            // sake we'll use only the first touch event
            // because we won't move more elements.
            var evt = e.type === 'touchstart' ? e.changedTouches[0] : e;
            
            // "Get the distance of the x/y", formula:
            // A: Get current position x/y of the circle. 
            // Example: circle.offsetLeft
            // B: Get the new position x/y. 
            // Example: evt.clientX
            // That's all.
            state.distX = Math.abs(circle.offsetLeft - evt.clientX);
            state.distY = Math.abs(circle.offsetTop - evt.clientY);
            
            // Disable pointer events in the circle to avoid
            // a bug whenever it's moving.
            circle.style.pointerEvents = 'none';
        };

        function onUp(e) {
            // Re-enable the "pointerEvents" in the circle element.
            // If this is not enabled, then the element won't move.
            circle.style.pointerEvents = 'initial';
        };

        function onMove(e) {
          // Update the position x/y of the circle element
          // only if the "pointerEvents" are disabled, 
          // (check the "onDown" function for more details.)
          if (circle.style.pointerEvents === 'none') {
            
            // Get the correct event source regardless the device:
            // Btw, "e.changedTouches[0]" in this case for simplicity 
            // sake we'll use only the first touch event
            // because we won't move more elements.
            var evt = e.type === 'touchmove' ? e.changedTouches[0] : e;
            
            // Update top/left directly in the dom element:
            circle.style.left = `${evt.clientX - state.distX}px`;
            circle.style.top = `${evt.clientY - state.distY}px`;
          };
        };


        // FOR MOUSE DEVICES:
        header.addEventListener('mousedown', onDown);
        container.addEventListener('mousemove', onMove);
        container.addEventListener('mouseup', onUp);

        // FOR TOUCH DEVICES:
        // circle.addEventListener('touchstart', onDown);
        container.addEventListener('touchmove', onMove);
        // container.addEventListener('touchend', onUp);

	}

</script>


