<?php

get_header(); ?>


    <!--HEADER-->
<!--    	<div class="vidtok-header">-->
<!--        	<div class="vidtok-logo"><a href="http://vidtok.co" target="_blank"><img src="--><?php //echo VIDTOK_PLUGINFULLURL; ?><!--vidtok-package/images/vidtok-logo.png" alt="Vidtok Video Chat" /></a></div>-->
<!--        </div>-->


    <div class="container">
    <!--VIDTOK VIDEO-->

        <a class="play button large alert radius" href="<?php echo get_home_url(); ?>">Finish <span class="timer">45:00</span> </a>
        <script type="text/javascript">
            var interval = setInterval(function() {
                var timer = $('.timer').html();
                timer = timer.split(':');
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                seconds -= 1;
                if (minutes < 0) return clearInterval(interval);
                if (minutes < 10 && minutes.length != 2) minutes = '0' + minutes;
                if (seconds < 0 && minutes != 0) {
                    minutes -= 1;
                    seconds = 59;
                }
                else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;
                $('.timer').html(minutes + ':' + seconds);

                if (minutes == 0 && seconds == 0)
                    clearInterval(interval);
                    window.location.replace("<?php echo get_home_url(); ?>");
            }, 1000);
        </script>


    	<div class="vidtok-w">


        
            <!--VIDTOK PUBLISHER-->
                <div class="vidtok-video-h" id="vidtok-pub">
                	<div class="vidtok-publisher-loading" id="vidtok-publisher-loader"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/large-loader-cyan.gif" alt="loading" /><p>Connecting to Vidtok Video...</p></div>	
                    <div id="vidtok-publisher"></div>
                </div>


            <!--VIDTOK SUBSCRIBER-->
                <div class="vidtok-video-h" id="vidtok-sub">	
                    <div id="vidtok-subscriber" class="vidtok-suscriber-large"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/vidtok-logo-v-large.png" alt="Vitok Video Chat" /></div>
                </div> 
                
                
          	<!--VIDTOK CONTROLS-->
            	<div class="vidtok-controls-w">
                	<p>record this video chat useing the controls below.</p>
                    <div class="vidtok-controls-h">
                        <button id="vStartArchive" class="vidtok-button" style="margin-right:10px;">START RECORDING</button> 
                        <button id="vStopArchive" class="vidtok-button">STOP RECORDING</button>        
                    </div>
        		</div>
                
        </div>


    <!--VIDTOK SHARE LINK-->
		<div class="vidtok-share-w" id="vidtok-share-panel">
            
        	<form>
                <label>Send to</label>
                <input type="text" id="vidtok-email" name="vidtok-email" value="" size="20" />
                <input type="button" id="vidtok-submit" name="vidtok-submit" class="vidtok-button" value="Send Invite" />
            </form>
            
            <div class="vidtok-share-divide">|</div>
            
            
<!--            <script>function fbs_click() { u=location.href; t=document.title; window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=500,height=360');return false;}</script>-->
<!--            <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank">-->
<!--            <img src="--><?php //echo VIDTOK_PLUGINFULLURL; ?><!--vidtok-package/images/icons/icons-48/facebook.png" alt="" /></a>-->
<!---->
<!--            <div class="vidtok-share-divide">|</div>-->
<!---->
<!--            <script>function tw_click() { u=location.href; t=document.title; window.open('http://twitter.com/intent/tweet?text=--><?php //echo urlencode('Join our Vidtok video chat! '. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?><!--','sharer','toolbar=0,status=0,width=500,height=360');return false;}</script>-->
<!--            <a rel="nofollow" href="#" onclick="return tw_click()" target="_blank">-->
<!--            <img src="--><?php //echo VIDTOK_PLUGINFULLURL; ?><!--vidtok-package/images/icons/icons-48/twitter.png" alt="" /></a>-->
<!---->
<!--            <div class="vidtok-share-divide">|</div>-->
            
            <div class="vidtok-share-panel-handle"><p>Share Panel</p><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-26/share.png" alt="Vidtok Share Panel" /></div>
        
        </div>

	
    
    <!--VIDTOK TOOL PANEL-->
        <div id="vidtok-tool-panel">
            <div class="vidtok-tool-panel-w">
               
               <!--VIDTOK TOOLS-->
                    <div class="vidtok-tool-panel-handle"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-26/tools.png" alt="Vidtok Tool Panel" /><p>Tool Panel</p></div>
                    <div class="vidtok-tool-panel-h">
                        <div class="vidtok-tool-panel-c" id="vidtok-tools-refresh"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-26/refresh.png" alt="Refresh Vidtok Video"/><p>Refresh</p></div>
                        <div class="vidtok-tool-panel-c" id="vidtok-tools-network"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-26/network.png" alt="Vidtok Network Connection"/><p>Network Connection</p></div>
                        <div class="vidtok-tool-panel-c" id="vidtok-tools-settings"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-26/settings.png" alt="Vidtok Settings"/><p>Settings</p></div>
                    </div>
                
                
                <!--VIDTOK DIALOG--> 
                    <div class="vidtok-tool-panel-dialog">
                    
                        <!--NETWORK-->
                            <div class="vidtok-tool-panel-dialog-c" id="vidtok-dialog-network">
                                <div class="vidtok-dialog-loading" id="vidtok-loading-network"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/large-loader-cyan.gif" alt="" /><p>Loading Network Data...<br/>Data will load when you click the allow button...</p></div> 
                                <div class="vidtok-show-network">              
                                    <h2>Connection Quality</h2>
                                    <p><span id="vidtok-connection-alert"></span><br/><br/><a href="http://www.tokbox.com/user-diagnostic/" style="text-decoration:none; color:#098CC2; text-transform:uppercase;" target="_blank">Diagnostic Tool</a></p>	
                                </div>
                            </div>
    
    
                        <!--SETTINGS-->
                            <div class="vidtok-tool-panel-dialog-c" id="vidtok-dialog-settings">
                            	<div class="vidtok-dialog-loading" id="vidtok-loading-settings"><img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/large-loader-cyan.gif" alt="" /><p>Loading Connected Devices...</p></div>
    							<div class="vidtok-show-settings">
                                	<div class="vidtok-settings-button"><button class="vidtok-button" id="vidtok-change-device" onClick="$.vidtok.panel();">Change Device</button></div>
                                	<h2>Connected Devices</h2>
                                    <p>Below you will see the current connected devices to your video and audio, you can select different devices by clicking on the change devices button.</p>
                                	<div class="vidtok-tool-panel-device">
                                    	<img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-72/webcam.png" alt="Vidtok Video Chat" />
                                        <p id="vidtok-selected-camera"></p>
                                    </div>
                                    <div class="vidtok-tool-panel-device">
                                    	<img src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/icons/icons-72/mic.png" alt="Vidtok Video Chat" />
                                        <p id="vidtok-selected-mic"></p>
                                    </div>
                                </div>
                            </div>             
                    
                    </div>	

            </div>
        </div>
    </div>


    <?php get_footer(); ?>

<!--MAIN CSS-->
<link href="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/css/main.css" rel="stylesheet" />

<!--INDIVIDUAL APP CSS-->
<link href="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/css/individual.advanced.css" rel="stylesheet" />

<!--JQUERY-->
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

<!--TOXBOX-->
<script src="http://static.opentok.com/v0.91/js/TB.min.js" ></script>

<!--PLUGINS-->
<script src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/js/plugins.js"></script>

<!--VIDTOK-->
<script src="http://static.vidtok.co/v1.0/js/vidtok.min.js"></script>

<!--GLOBAL-->
<script src="<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/js/globals.js"></script>

<!--VIDTOK OPTIONS-->
<?php $options = get_option('vidtok_options'); ?>
<?php

/*WORDPRSS DATABASE*/
global $wpdb;

/*VARIABLES*/
$vid = $_GET['vid'];

/*QUERY*/
$query = 'select * from ' . $wpdb->get_blog_prefix() . "vidtok_sessions WHERE vid = %s";

$vidtok = $wpdb->get_row($wpdb->prepare($query, $vid));

/*OPENTOK SDK*/
require_once VIDTOK_PLUGINFULLDIR.'libs/opentok-sdk/OpenTokSDK.php';

/*CREATE TOKEN*/
$apiObj = new OpenTokSDK($options['oapi'], $options['osecert']);

$token = $apiObj->generateToken($vidtok->opentok_session_id);


?>

<!--VIDTOK SHARE-->
<script type="text/javascript">

    jQuery(document).ready(function(e) {

        /*Authorize Vidtok*/
        jQuery.vidtok.authorize({ vApi : '<?php echo $options['vapi']; ?>', vArchive : '', vType : 'individual', vPlatform : 'wordpress', oApi : '<?php echo $options['oapi']; ?>', oSession : '<?php echo $vidtok->opentok_session_id; ?>', oToken : '<?php echo $token; ?>' });

        /*Vidtok Video Share*/
        jQuery('#vidtok-submit').click(function(){

            /*Variables*/
            var email 	= jQuery('#vidtok-email').val();
            var url		= window.location.href;


            if(isValidEmailAddress(email) === true){

                /*Send Email*/
                jQuery.ajax({

                    type		: 'POST',
                    url		: '<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/actions/email.php',
                    data		: { email : email, url : url },
                    success	: function(){

                        /*Clear Email*/
                        jQuery('#vidtok-email').val('');

                        /*Notification*/
                        $.gritter.add({

                            title		: 'Invitation Sent',
                            text		: 'You have successfully sent your invitation to join your Vidtok Video Chat.',
                            image		: "<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/vidtok-logo-notices.png",
                            sticky		: false

                        });

                    }
                });

            }else{

                /*Notification*/
                $.gritter.add({

                    title		: 'Invalid Email Address',
                    text		: 'There was an error with the entered email address, please check the email address and resend the invitation.',
                    image		: "<?php echo VIDTOK_PLUGINFULLURL; ?>vidtok-package/images/vidtok-logo-notices.png",
                    sticky	: false

                });

            }

        });


    });
</script>

</body>
</html>        