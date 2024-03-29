<?php
	//only admins can get this
	if(!function_exists("current_user_can") || !current_user_can("manage_options"))
	{
		die(__("You do not have permissions to perform this action.", "pmpro"));
	}	
	
	global $wpdb, $msg, $msgt, $kleo_pay_settings;
   	
	//get/set settings	
	if(!empty($_REQUEST['savesettings']))
	{                   		
		//other settings
		pmpro_setOption("nonmembertext");
		pmpro_setOption("notloggedintext");
		pmpro_setOption("rsstext");		
		pmpro_setOption("showexcerpts");
		pmpro_setOption("hideads");
    //pmpro_setOption("hideadslevels",$_REQUEST['hideadslevels'] );
		pmpro_setOption("redirecttosubscription");					
						
		//captcha
		pmpro_setOption("recaptcha");
		pmpro_setOption("recaptcha_publickey");
		pmpro_setOption("recaptcha_privatekey");					
		
		//tos
		pmpro_setOption("tospage");		
		
		//footer link
		pmpro_setOption("hide_footer_link");
		
		//assume success
		$msg = true;
		$msgt = __("Your advanced settings have been updated.", "pmpro");	
        
    //save kleo settings
    update_option('kleo_restrict_sweetdate',$_REQUEST['kleo_restrict_sweetdate'] );
    update_option('kleo_membership_popular',$_REQUEST['kleo_membership_popular']);
    update_option('kleo_pmpro_levels_order',$_REQUEST['kleo_pmpro_levels_order']);
	}

	$nonmembertext = pmpro_getOption("nonmembertext");
	$notloggedintext = pmpro_getOption("notloggedintext");
	$rsstext = pmpro_getOption("rsstext");	
	$hideads = pmpro_getOption("hideads");
	$showexcerpts = pmpro_getOption("showexcerpts");
  $hideadslevels = pmpro_getOption("hideadslevels");
    
  //get kleo restrictions
  $kleo_restrict_sweetdate = get_option('kleo_restrict_sweetdate');
  $kleo_membership_popular = get_option('kleo_membership_popular');
  $kleo_pmpro_levels_order = get_option('kleo_pmpro_levels_order');

	if(is_multisite())
		$redirecttosubscription = pmpro_getOption("redirecttosubscription");
	
	$recaptcha = pmpro_getOption("recaptcha");
	$recaptcha_publickey = pmpro_getOption("recaptcha_publickey");
	$recaptcha_privatekey = pmpro_getOption("recaptcha_privatekey");
	
	$tospage = pmpro_getOption("tospage");
	
	$hide_footer_link = pmpro_getOption("hide_footer_link");
		
	//default settings
	if(!$nonmembertext)
	{
		$nonmembertext = "This content is for !!levels!! members only. <br><a class='button small radius' href=\"" . pmpro_url("levels") . "\">Upgrade</a><br><br>";
		pmpro_setOption("nonmembertext", $nonmembertext);
	}			
	if(!$notloggedintext)
	{
		$notloggedintext = "This content is only for members!<br><a class='button small radius secondary' href=\"" . wp_login_url( get_permalink() ) . "\">Login</a> <a class='button small radius' href=\"" . wp_login_url() . "?action=register\">Register</a><br><br>";
		pmpro_setOption("notloggedintext", $notloggedintext);
	}			
	if(!$rsstext)
	{
		$rsstext = "This content is for members only. Visit the site and log in/register to read.";
		pmpro_setOption("rsstext", $rsstext);
	}   				
		
	$levels = $wpdb->get_results( "SELECT * FROM {$wpdb->pmpro_membership_levels}", OBJECT );
	
	require_once(dirname(__FILE__) . "/admin_header.php");		
?>

	<form action="" method="post" enctype="multipart/form-data"> 
		<h2><?php _e('Advanced Settings', 'pmpro');?></h2>
						
		<table class="form-table">
		<tbody>    
            
        <?php

            foreach ($kleo_pay_settings as $pays) :
            ?>
			<tr>
				<th scope="row" valign="top">
					<label for="<?php echo $pays['name'];?>"><?php echo $pays['title'];?></label>
				</th>
				<td>
					<select id="<?php echo $pays['name'];?>" name="kleo_restrict_sweetdate[<?php echo $pays['name'];?>][type]" onchange="pmpro_update<?php echo $pays['name'];?>TRs();">
            <option value="0" <?php if(!isset($kleo_restrict_sweetdate[$pays['name']]['type'])) { ?>selected="selected"<?php } ?>><?php _e('No', 'pmpro');?></option>
            <option value="1" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['type']) && $kleo_restrict_sweetdate[$pays['name']]['type'] == 1) { ?>selected="selected"<?php } ?>><?php _e('Restrict All Members', 'pmpro');?></option>
            <option value="2" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['type']) && $kleo_restrict_sweetdate[$pays['name']]['type'] == 2) { ?>selected="selected"<?php } ?>><?php _e('Restrict Certain Levels', 'pmpro');?></option>
        </select>                        
				</td>
			</tr> 	
      <tr id="<?php echo $pays['name'];?>levels_tr" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['type']) && $kleo_restrict_sweetdate[$pays['name']]['type'] != 2) { ?>style="display: none;"<?php } ?>>
				<th scope="row" valign="top">
					<label for="kleo_restrict_sweetdate[<?php echo $pays['name'];?>][levels][]"><?php _e('Choose Levels to Restrict', 'pmpro');?>:</label>
				</th>
				<td>
					<div class="checkbox_box" <?php if(count($levels) > 3) { ?>style="height: 100px; overflow: auto;"<?php } ?>>
            <div class="clickable"><label><input type="checkbox" id="<?php echo $pays['name'];?>levels_guest" name="kleo_restrict_sweetdate[<?php echo $pays['name'];?>][guest]" value="1" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['guest']) && $kleo_restrict_sweetdate[$pays['name']]['guest'] == 1) { ?>checked="checked"<?php } ?>> <?php echo __("Not logged in");?></label></div>
						<div class="clickable"><label><input type="checkbox" id="<?php echo $pays['name'];?>levels_not_member" name="kleo_restrict_sweetdate[<?php echo $pays['name'];?>][not_member]" value="1" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['not_member']) && $kleo_restrict_sweetdate[$pays['name']]['not_member'] == 1) { ?>checked="checked"<?php } ?>> <?php echo __("Not members");?></label></div>
              <?php 										
                            
							if(!is_array($kleo_restrict_sweetdate[$pays['name']]['levels']))
								$kleo_restrict_sweetdate[$pays['name']]['levels'] = explode(",", $kleo_restrict_sweetdate[$pays['name']]['levels']);
							
							$sqlQuery = "SELECT * FROM $wpdb->pmpro_membership_levels ";						
							$levels = $wpdb->get_results($sqlQuery, OBJECT);								
							foreach($levels as $level) 
							{ 
						?>
							<div class="clickable"><label><input type="checkbox" id="<?php echo $pays['name'];?>levels_<?php echo $level->id?>" name="kleo_restrict_sweetdate[<?php echo $pays['name'];?>][levels][]" value="<?php echo $level->id?>" <?php if(in_array($level->id, $kleo_restrict_sweetdate[$pays['name']]['levels'])) { ?>checked="checked"<?php } ?>> <?php echo $level->name?></label></div>
						<?php 
							} 
						?>
					</div> 
				</td>
			</tr> 
			<tr style="border-bottom:1px solid #ccc">
				<th scope="row" valign="top">
					<label><?php _e("Show field in memberships table");?></label>
				</th>
				<td>
					<select name="kleo_restrict_sweetdate[<?php echo $pays['name'];?>][showfield]">
            <option value="1" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['showfield']) && $kleo_restrict_sweetdate[$pays['name']]['showfield'] != 2) { ?>selected="selected"<?php } ?>><?php _e('Yes', 'pmpro');?></option>
            <option value="2" <?php if(isset($kleo_restrict_sweetdate[$pays['name']]['showfield']) && $kleo_restrict_sweetdate[$pays['name']]['showfield'] == 2) { ?>selected="selected"<?php } ?>><?php _e('No', 'pmpro');?></option>
					</select>                        
				</td>
			</tr> 
      
      <script>
			function pmpro_update<?php echo $pays['name'];?>TRs()
			{
				var <?php echo $pays['name'];?> = jQuery('#<?php echo $pays['name'];?>').val();
				if( <?php echo $pays['name'];?> == 2) 
				{
					jQuery('#<?php echo $pays['name'];?>levels_tr').show();
				} 
				else
				{
					jQuery('#<?php echo $pays['name'];?>levels_tr').hide();
				}
				
				if( <?php echo $pays['name'];?> > 0) 
				{
					jQuery('#<?php echo $pays['name'];?>_explanation').show();
				} 
				else
				{
					jQuery('#<?php echo $pays['name'];?>_explanation').hide();
				}
			}
			pmpro_update<?php echo $pays['name'];?>TRs();
            </script>
      <?php endforeach;?>
            
			<tr>
				<th scope="row" valign="top">
					<label><?php _e("Popular level",'pmpro');?></label>
				</th>
				<td>
					<select name="kleo_membership_popular">
            <option value='0'><?php _e("None", 'pmpro');?></option>
            <?php
            $sqlQuery = "SELECT * FROM $wpdb->pmpro_membership_levels ";						
            $levels = $wpdb->get_results($sqlQuery, OBJECT);		
            if ($levels) {
              foreach($levels as $level) 
              { 
              ?>
                <option value="<?php echo $level->id?>" <?php if($level->id == $kleo_membership_popular) { ?>selected="selected"<?php } ?>><?php echo $level->name?></option>
              <?php 
              }
            }
            ?>
					</select>                        
				</td>
			</tr>     
			<tr style="border-bottom:1px solid #ccc">
				<th scope="row" valign="top">
					<label for="nonmembertext"><?php _e('Order in Membership table', 'pmpro');?>:</label>
				</th>
				<td>
            <?php	
            if ($levels) {
              foreach($levels as $level) 
              { 
              ?>
              <?php echo $level->name?>: <input type="text" size="2" name="kleo_pmpro_levels_order[<?php echo $level->id;?>]" value="<?php if(isset($kleo_pmpro_levels_order[$level->id])) echo $kleo_pmpro_levels_order[$level->id]; else echo "0";?>"><br>
              <?php 
              }
            }
            ?>
				</td>
			</tr>  
			<tr>
				<th scope="row" valign="top">
					<label for="nonmembertext"><?php _e('Message for Logged-in Non-members', 'pmpro');?>:</label>
				</th>
				<td>
					<textarea name="nonmembertext" rows="3" cols="80"><?php echo stripslashes($nonmembertext)?></textarea><br />
					<small class="litegray"><?php _e('This message replaces the post content for non-members. Available variables', 'pmpro');?>: !!levels!!, !!referrer!!</small>
				</td>
			</tr> 
			<tr>
				<th scope="row" valign="top">
					<label for="notloggedintext"><?php _e('Message for Logged-out Users', 'pmpro');?>:</label>
				</th>
				<td>
					<textarea name="notloggedintext" rows="3" cols="80"><?php echo stripslashes($notloggedintext)?></textarea><br />
					<small class="litegray"><?php _e('This message replaces the post content for logged-out visitors.', 'pmpro');?></small>
				</td>
			</tr> 
			<tr>
				<th scope="row" valign="top">
					<label for="rsstext"><?php _e('Message for RSS Feed', 'pmpro');?>:</label>
				</th>
				<td>
					<textarea name="rsstext" rows="3" cols="80"><?php echo stripslashes($rsstext)?></textarea><br />
					<small class="litegray"><?php _e('This message replaces the post content in RSS feeds.', 'pmpro');?></small>
				</td>
			</tr> 
			
			<tr>
				<th scope="row" valign="top">
					<label for="showexcerpts"><?php _e('Show Excerpts to Non-Members?', 'pmpro');?></label>
				</th>
				<td>
					<select id="showexcerpts" name="showexcerpts">
						<option value="0" <?php if(!$showexcerpts) { ?>selected="selected"<?php } ?>><?php _e('No - Hide excerpts.', 'pmpro');?></option>
						<option value="1" <?php if($showexcerpts == 1) { ?>selected="selected"<?php } ?>><?php _e('Yes - Show excerpts.', 'pmpro');?></option>  
					</select>                        
				</td>
			</tr> 
            
            <?php /*
			<tr>
				<th scope="row" valign="top">
					<label for="hideads">Hide Ads From Members?</label>
				</th>
				<td>
					<select id="hideads" name="hideads" onchange="pmpro_updateHideAdsTRs();">
						<option value="0" <?php if(!$hideads) { ?>selected="selected"<?php } ?>><?php _e('No', 'pmpro');?></option>
						<option value="1" <?php if($hideads == 1) { ?>selected="selected"<?php } ?>><?php _e('Hide Ads From All Members', 'pmpro');?></option>
						<option value="2" <?php if($hideads == 2) { ?>selected="selected"<?php } ?>><?php _e('Hide Ads From Certain Members', 'pmpro');?></option>
					</select>                        
				</td>
			</tr> 				
			<tr id="hideads_explanation" <?php if($hideads < 2) { ?>style="display: none;"<?php } ?>>
				<th scope="row" valign="top">&nbsp;</th>
				<td>
					<p class="top0em"><?php _e('Ads from the following plugins will be automatically turned off', 'pmpro');?>: <em>Easy Adsense</em>, ...</p>
					<p><?php _e('To hide ads in your template code, use code like the following', 'pmpro');?>:</p>
				<pre lang="PHP">
if(pmpro_displayAds())
{
//insert ad code here
}
				</pre>                   
				</td>
			</tr>    
			<tr id="hideadslevels_tr" <?php if($hideads != 2) { ?>style="display: none;"<?php } ?>>
				<th scope="row" valign="top">
					<label for="hideadslevels"><?php _e('Choose Levels to Hide Ads From', 'pmpro');?>:</label>
				</th>
				<td>
					<div class="checkbox_box" <?php if(count($levels) > 5) { ?>style="height: 100px; overflow: auto;"<?php } ?>>
						<?php 																
							$hideadslevels = pmpro_getOption("hideadslevels", true);
							if(!is_array($hideadslevels))
								$hideadslevels = explode(",", $hideadslevels);
							
							$sqlQuery = "SELECT * FROM $wpdb->pmpro_membership_levels ";						
							$levels = $wpdb->get_results($sqlQuery, OBJECT);								
							foreach($levels as $level) 
							{ 
						?>
							<div class="clickable"><input type="checkbox" id="hideadslevels_<?php echo $level->id?>" name="hideadslevels[]" value="<?php echo $level->id?>" <?php if(in_array($level->id, $hideadslevels)) { ?>checked="checked"<?php } ?>> <?php echo $level->name?></div>
						<?php 
							} 
						?>
					</div> 
					<script>
						jQuery('.checkbox_box input').click(function(event) {
							event.stopPropagation()
						});

						jQuery('.checkbox_box div.clickable').click(function() {							
							var checkbox = jQuery(this).find(':checkbox');
							checkbox.attr('checked', !checkbox.attr('checked'));
						});
					</script>
				</td>
			</tr> 
			<?php if(is_multisite()) { ?>
			<tr>
				<th scope="row" valign="top">
					<label for="redirecttosubscription"><?php _e('Redirect all traffic from registration page to /susbcription/?', 'pmpro');?>: <em>(<?php _e('multisite only', 'pmpro');?>)</em></label>
				</th>
				<td>
					<select id="redirecttosubscription" name="redirecttosubscription">
						<option value="0" <?php if(!$redirecttosubscription) { ?>selected="selected"<?php } ?>><?php _e('No', 'pmpro');?></option>
						<option value="1" <?php if($redirecttosubscription == 1) { ?>selected="selected"<?php } ?>><?php _e('Yes', 'pmpro');?></option>                           
					</select>                        
				</td>
			</tr> 
			<?php } ?>				
			<tr>
				<th scope="row" valign="top">
					<label for="recaptcha"><?php _e('Use reCAPTCHA?', 'pmpro');?>:</label>
				</th>
				<td>
					<select id="recaptcha" name="recaptcha" onchange="pmpro_updateRecaptchaTRs();">
						<option value="0" <?php if(!$recaptcha) { ?>selected="selected"<?php } ?>><?php _e('No', 'pmpro');?></option>
						<option value="1" <?php if($recaptcha == 1) { ?>selected="selected"<?php } ?>><?php _e('Yes - Free memberships only.', 'pmpro');?></option>    
						<option value="2" <?php if($recaptcha == 2) { ?>selected="selected"<?php } ?>><?php _e('Yes - All memberships.', 'pmpro');?></option>
					</select><br />
					<small><?php _e('A free reCAPTCHA key is required.', 'pmpro');?> <a href="https://www.google.com/recaptcha/admin/create"><?php _e('Click here to signup for reCAPTCHA', 'pmpro');?></a>.</small>						
				</td>
			</tr> 
			<tr id="recaptcha_tr" <?php if(!$recaptcha) { ?>style="display: none;"<?php } ?>>
				<th scope="row" valign="top">&nbsp;</th>
				<td>                        
					<label for="recaptcha_publickey"><?php _e('reCAPTCHA Public Key', 'pmpro');?>:</label>
					<input type="text" name="recaptcha_publickey" size="60" value="<?php echo $recaptcha_publickey?>" />
					<br /><br />
					<label for="recaptcha_privatekey"><?php _e('reCAPTCHA Private Key', 'pmpro');?>:</label>
					<input type="text" name="recaptcha_privatekey" size="60" value="<?php echo $recaptcha_privatekey?>" />						
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">
					<label for="tospage"><?php _e('Require Terms of Service on signups?', 'pmpro');?></label>
				</th>
				<td>
					<?php
						wp_dropdown_pages(array("name"=>"tospage", "show_option_none"=>"No", "selected"=>$tospage));
					?>
					<br />
					<small><?php _e('If yes, create a WordPress page containing your TOS agreement and assign it using the dropdown above.', 'pmpro');?></small>
				</td>
			</tr> 
			
			<?php /*
			<tr>
				<th scope="row" valign="top">
					<label for="hide_footer_link">Hide the PMPro Link in the Footer?</label>
				</th>
				<td>
					<select id="hide_footer_link" name="hide_footer_link">
						<option value="0" <?php if(!$hide_footer_link) { ?>selected="selected"<?php } ?>>No - Leave the link. (Thanks!)</option>
						<option value="1" <?php if($hide_footer_link == 1) { ?>selected="selected"<?php } ?>>Yes - Hide the link.</option>  
					</select>                        
				</td>
			</tr> 
			*/ ?>
		</tbody>
		</table>
		<script>
			function pmpro_updateHideAdsTRs()
			{
				var hideads = jQuery('#hideads').val();
				if(hideads == 2) 
				{
					jQuery('#hideadslevels_tr').show();
				} 
				else
				{
					jQuery('#hideadslevels_tr').hide();
				}
				
				if(hideads > 0) 
				{
					jQuery('#hideads_explanation').show();
				} 
				else
				{
					jQuery('#hideads_explanation').hide();
				}
			}
			pmpro_updateHideAdsTRs();
			
			function pmpro_updateRecaptchaTRs()
			{
				var recaptcha = jQuery('#recaptcha').val();
				if(recaptcha > 0) 
				{
					jQuery('#recaptcha_tr').show();
				} 
				else
				{
					jQuery('#recaptcha_tr').hide();
				}										
			}
			pmpro_updateRecaptchaTRs();
		</script>
		
		<p class="submit">            
			<input name="savesettings" type="submit" class="button-primary" value="<?php _e('Save Settings', 'pmpro');?>" /> 		                			
		</p> 
	</form>

<?php
	require_once(dirname(__FILE__) . "/admin_footer.php");	
?>