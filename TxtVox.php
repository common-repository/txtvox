<?php
/* 
Plugin Name: TxtVox
Plugin URI: http://www.txtvox.com/publisher/wordpress/
Description: The TxtVox Plugin lets you mobilize your blog and provide readers with free SMS alerts when new posts are available, while generating revenue for you.
Version: 1.1
Author: TxtVox
Author URI: http://www.txtvox.com/
*/

$wid = get_option('txtvox_wid');
$trackid = get_option('txtvox_trackid');

// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() 
{
    // Add a new submenu under Options:
    add_options_page('TxtVox', 'TxtVox', 8, null, 'DrawOptions');
}

function DrawOptions()
{
	?>
	<div id="wpbody">
	<div class="wrap">
	<h2>TxtVox Options</h2>
	<p>The <a href="http://www.txtvox.com/publisher/" target="txtvox">TxtVox</a> Plugin lets you mobilize your blog and provide readers with free SMS alerts when new posts are available, while generating revenue for you.</p>
	<p>To make this widget work, you must have a <a href="http://www.txtvox.com/publisher/gettingstarted.aspx" target="txtvox">TxtVox account</a> and enter your TxtVox Widget information below. You can retrieve this information <a href="http://www.txtvox.com/publisher/my/widgets.aspx">here</a>:</p>
		<p>
			<a href="http://www.txtvox.com/publisher/my/widgets.aspx">
				<img src="widgets.png" alt="Widgets screen"></img>
			</a>
		</p>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
		<tr valign="top">
		<th scope="row"><label for="txtvox_wid">Widget Id:</label></th>
		<td><input type="text" name="txtvox_wid" value="<?php echo get_option('txtvox_wid'); ?>" /></td>
		</tr>
		<tr valign="top">
		<th scope="row"><label for="txtvox_trackid">Tracking Id:</label></th>
		<td><input type="text" name="txtvox_trackid" value="<?php echo get_option('txtvox_trackid'); ?>" /></td></tr></table>
		<br/>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="txtvox_wid,txtvox_trackid" />
		<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
	</form>
		<p>
			<strong>Don't have an account?</strong>
			<a href="http://www.txtvox.com/publisher/gettingstarted.aspx" target="txtvox">Visit TxtVox to create an account!</a>
		</p>
	</div>
	</div>
	<?php
}

function txtvox_script()
{
	global $wid;
	echo "<script src='http://www.txtvox.com/publisher/widget/js.aspx?wid=$wid' type='text/javascript'></script>";
}

function txtvox_display() 
{
	global $trackid;
	echo "<br/><a title=\"Get this blog on your cell phone\" onclick=\"return TxtVox.Widget.draw('')\" href=\"http://www.txtvox.com/services/track.aspx?id=$trackid&cmd=1\" rel=\"nofollow\"><img src='http://www.txtvox.com/services/track.aspx?id=$trackid' border='0' /></a>";
}

add_action('wp_head', 'txtvox_script');
add_action('wp_meta', 'txtvox_display');
?>