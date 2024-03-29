<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header('buddypress'); ?>

<?php get_template_part('page-parts/buddypress-before-wrap'); ?>

<?php


    //Show profile only for coaches and friends
    if ( is_current_user_coach() || is_profile_coach() || is_profile_owner() || is_current_user_admin() || ( is_user_logged_in() and is_current_user_friend() ) ) :?>

    <?php get_template_part('page-parts/buddypress-profile-header'); ?>

    <div id="item-nav">
        <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
            <ul>

                <?php bp_get_displayed_user_nav(); ?>

                <?php do_action('bp_member_options_nav'); ?>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div><!-- #item-nav -->

    <div id="item-body">

        <?php do_action('bp_before_member_body');

        if (bp_is_user_activity() || !bp_current_component()) :
            locate_template(array('members/single/activity.php'), true); elseif (bp_is_user_blogs()) :
            locate_template(array('members/single/blogs.php'), true); elseif (bp_is_user_friends()) :
            locate_template(array('members/single/friends.php'), true); elseif (bp_is_user_groups()) :
            locate_template(array('members/single/groups.php'), true); elseif (bp_is_user_messages()) :
            locate_template(array('members/single/messages.php'), true); elseif (bp_is_user_profile()) :
            locate_template(array('members/single/profile.php'), true); elseif (bp_is_user_forums()) :
            locate_template(array('members/single/forums.php'), true); elseif (bp_is_user_settings()) :
            locate_template(array('members/single/settings.php'), true); // If nothing sticks, load a generic template
        else :
            locate_template(array('members/single/plugins.php'), true);

        endif;

        do_action('bp_after_member_body'); ?>

    </div><!-- #item-body -->
    <?php do_action('bp_after_member_home_content'); ?>


<?php
    else:
        echo "<h2>Sorry, only friends and coaches can view the profile.</h2>";
    endif;
?>

<?php get_template_part('page-parts/buddypress-after-wrap'); ?>
<?php get_footer('buddypress'); ?>


