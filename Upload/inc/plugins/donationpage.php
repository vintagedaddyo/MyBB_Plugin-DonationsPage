<?php
/* 
* MyBB: Donations Page 
* 
* File: donationspage.php 
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

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

// Add Hooks

$plugins->add_hook("build_friendly_wol_location_end", "donationpage_online");

// Plugin Information

function donationpage_info()
{
	
global $lang;

$lang->load("donationpage");
   $lang->donationpage_info_description = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->donationpage_info_description;
        	
    return array(
        "name"        => $lang->donationpage_info_name,
        "description" => $lang->donationpage_info_description,
        "website"     => $lang->donationpage_info_website,
        "author"      => $lang->donationpage_info_author,
        "authorsite"  => $lang->donationpage_info_authorsite,
        "version"     => $lang->donationpage_info_version,
	"compatibility" => $lang->donationpage_info_compatibility,
	"guid"        => $lang->donationpage_info_guid
        );
}

function donationpage_is_installed()
{
	global $db;

if ($db->num_rows($db->simple_select("settings","name","name='dp_title'")) >= 1)	
{
		return true;
	}

	return false;
}

// Install and Activate

function donationpage_activate() {

global $db, $lang;

$lang->load("donationpage");

    $dp_group = array(
        "gid" => "0",
        "name" => "donationpage",
        "title" => $lang->donationpage_settinggroup_title,
        "description" => $lang->donationpage_settinggroup_description,
        "disporder" => "35",
        "isdefault" => "0"
        );
    $db->insert_query("settinggroups", $dp_group);
    
    $gid = $db->insert_id();
    
    $dp_1 = array(
        "sid" => "0",
        "name" => "dp_title",
        "title" => $lang->donationpage_setting_1_title,
        "description" => $lang->donationpage_setting_1_description,
        "optionscode" => "text",
        "value" => $lang->donationpage_setting_1_value,
        "disporder" => "1",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_1);

    $dp_2 = array(
        "sid" => "0",
        "name" => "dp_guests",
        "title" => $lang->donationpage_setting_2_title,
        "description" => $lang->donationpage_setting_2_description,
        "optionscode" => "yesno",
        "value" => "1",
        "disporder" => "2",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_2);

    $dp_3 = array(
        "sid" => "0",
        "name" => "dp_currency",
        "title" => $lang->donationpage_setting_3_title,
        "description" => $lang->donationpage_setting_3_description,
        "optionscode" => "select
USD= US Dollars
AUD= Australian Dollars
GBP= British Pound
CAD= Canadian Dollars
JPY= Japanese Yen
DKK= Danish Krone
HKD= Hong Kong Dollar
JPY= Japanese Yen
CHF= Swiss Franc
PLN= Polish Zloty
SGD= Singapore Dollar
EUR= Euro",
        "value" => $lang->donationpage_setting_3_value,
        "disporder" => "3",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_3);

    $dp_4 = array(
        "sid" => "0",
        "name" => "dp_email",
        "title" => $lang->donationpage_setting_4_title,
        "description" => $lang->donationpage_setting_4_description,
        "optionscode" => "text",
        "value" => $lang->donationpage_setting_4_value,
        "disporder" => "5",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_4);

    $dp_5 = array(
        "sid" => "0",
        "name" => "dp_message",
        "title" => $lang->donationpage_setting_5_title,
        "description" => $lang->donationpage_setting_5_description,
        "optionscode" => "textarea",
        "value" => $lang->donationpage_setting_5_value,
        "disporder" => "6",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_5);

    $dp_6 = array(
        "sid" => "0",
        "name" => "dp_value",
        "title" => $lang->donationpage_setting_6_title,
        "description" => $lang->donationpage_setting_6_description,
        "optionscode" => "text",
        "value" => $lang->donationpage_setting_6_value,
        "disporder" => "7",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_6);

    $dp_7 = array(
        "sid" => "0",
        "name" => "dp_minimum",
        "title" => $lang->donationpage_setting_7_title,
        "description" => $lang->donationpage_setting_7_description,
        "optionscode" => "text",
        "value" => $lang->donationpage_setting_7_value,
        "disporder" => "8",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_7);

    $dp_8 = array(
        "sid" => "0",
        "name" => "dp_credits",
        "title" => $lang->donationpage_setting_8_title,
        "description" => $lang->donationpage_setting_8_description,
        "optionscode" => "yesno",
        "value" => "1",
        "disporder" => "9",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_8);
    
    $dp_9 = array(
        "sid" => "0",
        "name" => "dp_btnlocale",
        "title" => $lang->donationpage_setting_9_title,
        "description" => $lang->donationpage_setting_9_description,
        "optionscode" => "select
en_US= en_US
en_GB= en_GB
es_ES= es_ES
fr_FR= fr_FR
it_IT= it_IT",
        "value" => $lang->donationpage_setting_9_value,
        "disporder" => "4",
        "gid" => intval($gid)
        );
        
    $db->insert_query("settings", $dp_9);    
    

$insert_array = array(
		'title' => 'donation_page',
		'template' => $db->escape_string('<html>
<head>
<title>{$mybb->settings[\'bbname\']} - {$mybb->settings[\'dp_title\']}</title>
{$headerinclude}
{$formcheck}
</head>
<body>
{$header}
<table border="0" cellspacing="{$theme[\'borderwidth\']}" cellpadding="{$theme[\'tablespace\']}" class="tborder">
<tr>
<td class="thead"><strong>{$mybb->settings[\'dp_title\']}</strong></td>
</tr>
<tr>
<td width="100%" class="trow1">
{$message}
{$paypalform}
{$credits}
</td>
</tr>
</table>
{$footer}
</body>
</html>'),
		'sid' => '-1',
		'version' => '',
		'dateline' => TIME_NOW
	);
	
	$db->insert_query("templates", $insert_array);


rebuild_settings();

}

// Deactivate and Uninstall

function donationpage_deactivate() {

global $db, $mybb;

    require "../inc/adminfunctions_templates.php";
    
    $query = $db->query("SELECT gid FROM ".TABLE_PREFIX."settinggroups WHERE name='donationpage'");
    
    $g = $db->fetch_array($query);
    
    $db->query("DELETE FROM ".TABLE_PREFIX."settinggroups WHERE gid='".$g['gid']."'");
    
    $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE gid='".$g['gid']."'");
    $db->delete_query("templates","title='donation_page'");

rebuild_settings();

}

function donationpage_online(&$plugin_array)
{
	
global $lang;

$lang->load("donationpage");	
	
if (preg_match('/donate\.php/',$plugin_array['user_activity']['location']))
{
$plugin_array['location_name'] = "{$lang->donationpage_wol_viewing} <a href=\"donate.php\">{$lang->donationpage_wol_viewing_page}</a>";
}

return $plugin_array;
}
?>