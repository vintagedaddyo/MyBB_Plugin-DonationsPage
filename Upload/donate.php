<?php
/* 
* MyBB: Donations Page 
* 
* File: donate.php 
* 
* Authors: (MyBBWebhost)Zash & Vintagedaddyo 
* 
* MyBB Version: 1.8 
* 
* Plugin Version: 2.2
* 
* Copyright 2009-2010 MyBBWebHost, all rights reserved.
* http://www.mybbwebhost.com
* This plugin is provided as-as.  You may edit the plugin as you please, but you may not remove this in-file copyright.
* You may not distribute this plugin or claim it as your own.
*
*/

define('IN_MYBB', 1); 

define('THIS_SCRIPT', 'donate.php');

require_once "./global.php";

global $lang;

$lang->load("donationpage");

$message = $mybb->settings['dp_message'];

if ( $mybb->user['username'] == '' ) {
$username = $lang->donationpage_username;
} 

else {
$username = $mybb->user['username'];
}

if ( $mybb->settings['dp_credits'] == "1" ) {
$credits = '<div class="smalltext" style="text-align:right;">'.$lang->donationpage_credits_note.' <a href="http://www.mybbwebhost.com" title="MyBBWebHost - MyBB Oriented Hosting">'.$lang->donationpage_credits_by.'</a>.</div>';
} 

else {
$credits = '';
}

$minimum = $mybb->settings['dp_minimum'];

$formcheck = '<script type="text/javascript">
<!--
function validate_form ( )
{
valid = true;
if ( document.donation_form.amount.value < '. $minimum .' )
{
alert ( "Please enter a minimum of '. $minimum . ' ' .$mybb->settings['dp_currency'] .'." );
valid = false;
}
return valid;
}
//-->
</script>';


$value = $mybb->settings['dp_value'];

if ( $mybb->settings['dp_guests'] == "0" && $mybb->user['uid'] == "0" ) {
$paypalform = '<div style="margin-top:10px;margin-bottom:5px;font-weight:bold;text-align:center;">'.$lang->donationpage_guest_note_1.' <a <a href="member.php?action=login">'.$lang->donationpage_guest_login.'</a> '.$lang->donationpage_guest_note_2.' <a href="member.php?action=register">'.$lang->donationpage_guest_register.'</a> '.$lang->donationpage_guest_note_3.'</div>';
} 

else {
$paypalform = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin-top:10px;text-align:center;" name="donation_form" onsubmit="return validate_form ( );">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="'.$mybb->settings['dp_email'].'" />
<input type="hidden" name="item_name" value="'.$mybb->settings['bbname'].' Donation from '. $username .'">
<input type="hidden" name="no_note" value="0" />
<input type="hidden" name="currency_code" value="'.$mybb->settings['dp_currency'].'">
<input name="return" value="'.$mybb->settings['bburl'].'" type="hidden">
<input name="cancel_return" value="'.$mybb->settings['bburl'].'" type="hidden">
<input type="hidden" name="tax" value="0" />
<label><strong>'.$lang->donationpage_form_username.'</strong> '. $username .'</label><br style="margin-bottom:5px;" />
<label style="font-weight:bold;">'.$lang->donationpage_form_amount.' (in '. $mybb->settings['dp_currency'] .'):</label><br />
<input type="text" class="textbox" name="amount" style="width:120px;text-align:left;margin:7px;" value="'. $value .'" /><br />
<input type="image" src="https://www.paypal.com/'.$mybb->settings['dp_btnlocale'].'/i/btn/btn_donateCC_LG.gif" style="border:0;" name="submit" alt="PayPal - The safer, easier way to pay online!" />
</form>';
}

$title = $mybb->settings['dp_title'];

add_breadcrumb($title, "donate.php");

eval("\$donate = \"".$templates->get("donation_page")."\";"); 
output_page($donate); 

?>