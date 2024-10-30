<?php if (!defined('ABSPATH'))
  exit; // Exit if directly accessed
?>

<div class="row">
	<div class="MCWC_add_new_class">
		  <h3><b><?php _e('Clock','clock-tik-tik') ?></b></h3>
		  <a href="<?php  _e(admin_url("admin.php?page=MCWC_add_clock")) ?>"><?php _e('Add New','clock-tik-tik') ?></a>
	</div>

	<div class="card">
		<div class="card-header">
		  	<p style="font-size: 20px;"><?php _e('You Clock Shortcode & List','clock-tik-tik') ?> </p>
		</div>

		<div class="card-body">
		    <table class="wp-list-table widefat fixed striped table-view-list posts">
			 	<thead>
				 	<tr>
						<th><?php _e('Title','clock-tik-tik') ?></th>
						<th><?php _e('Time Zones','clock-tik-tik') ?></th>
						<th><?php _e('Shortcode','clock-tik-tik') ?></th>
						<th><?php _e('action','clock-tik-tik') ?></th>
				  	</tr>
			 	</thead>
			  	<tbody id="the-list">
					<?php 
				    	foreach (Clock_tik_tik_class::get_clock_list() as $key => $value){ 
				    	$data = get_post($value->ID);
					  ?>
				    <tr>
				    	<td><?php _e($data->title) ?></td>
				      	<td><?php _e($data->timezone_name) ?></td>
				     	<td>[<?php _e($data->clock_type) ?> clockid="<?php _e($value->ID) ?>"]</td>
				      	<td>
					        <a href="<?php _e(admin_url().'/admin.php?page=MCWC_listing&id='.$value->ID.'&action=remove') ?>">
					        	<?php _e('Delete','clock-tik-tik') ?></a> |
					        <a href="<?php _e(admin_url().'/admin.php?page=MCWC_add_clock&id='.$value->ID) ?>">
					        	<?php _e('Edit','clock-tik-tik') ?></a>
			   		  	</td>
				   	</tr>

					<?php }

						if (empty(Clock_tik_tik_class::get_clock_list())) {
						 	_e("<tr><td>No Clock is Created</td></tr>",'clock-tik-tik');
						}
					?>
			  	</tbody>
			</table>
		</div>
	</div>
</div>

