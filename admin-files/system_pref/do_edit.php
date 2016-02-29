<?php
camp_load_translation_strings("system_pref");
require_once($GLOBALS['g_campsiteDir']."/classes/SystemPref.php");
require_once($GLOBALS['g_campsiteDir'].'/classes/Input.php');
require_once($GLOBALS['g_campsiteDir'].'/classes/Log.php');
require_once($GLOBALS['g_campsiteDir']."/classes/GeoNames.php");

if (!SecurityToken::isValid()) {
    camp_html_display_error(getGS('Invalid security token!'));
    exit;
}

// Check permissions
if (!$g_user->hasPermission('ChangeSystemPreferences')) {
    camp_html_display_error(getGS("You do not have the right to change system preferences."));
    exit;
}

if(SaaS::singleton()->hasPermission('ManageSystemPreferences')) {
	$f_collect_statistics = Input::Get('f_collect_statistics');
	$f_cache_engine = Input::Get('f_cache_engine');
	$f_template_cache_handler = Input::Get('f_template_cache_handler');
	$f_smtp_host = strip_tags(Input::Get('f_smtp_host'));
	$f_smtp_port = Input::Get('f_smtp_port', 'int');
    $f_email_contact = strip_tags(Input::Get('f_email_contact'));
    $f_email_from_address = strip_tags(Input::Get('f_email_from_address'));
	$f_editor_image_ratio = Input::Get('f_editor_image_ratio', 'int', null, true);
	$f_editor_image_width = Input::Get('f_editor_image_width', 'int', null, true);
	$f_editor_image_height = Input::Get('f_editor_image_height', 'int', null, true);
	$f_editor_image_zoom = Input::Get('f_editor_image_zoom');
    $f_media_richtext_captions = Input::Get("f_media_richtext_captions");
    $f_media_caption_length = Input::Get("f_media_caption_length");
	$f_external_subs_management = Input::Get('f_external_subs_management');
	$f_use_replication = Input::Get('f_use_replication');
	$f_db_repl_host = strip_tags(Input::Get('f_db_repl_host'));
	$f_db_repl_user = strip_tags(Input::Get('f_db_repl_user'));
	$f_db_repl_pass = strip_tags(Input::Get('f_db_repl_pass'));
	$f_db_repl_port = Input::Get('f_db_repl_port', 'int');
	$f_template_filter = Input::Get('f_template_filter', '', 'string', true);
	$f_external_cron_management = Input::Get('f_external_cron_management');
} else {
	$f_collect_statistics = SystemPref::Get('CollectStatistics');
	$f_cache_engine = SystemPref::Get('DBCacheEngine');
	$f_template_cache_handler = SystemPref::Get('TemplateCacheHandler');
	$f_smtp_host = SystemPref::Get("SMTPHost");
	$f_smtp_port = SystemPref::Get("SMTPPort");
    $f_email_contact = SystemPref::Get("EmailContact");
    $f_email_from_address = SystemPref::Get("EmailFromAddress");
	$f_editor_image_ratio = SystemPref::Get("EditorImageRatio");
	$f_editor_image_width = SystemPref::Get("EditorImageResizeWidth");
	$f_editor_image_height = SystemPref::Get("EditorImageResizeHeight");
	$f_editor_image_zoom = SystemPref::Get("EditorImageZoom");
    $f_media_richtext_captions = SystemPref::Get("MediaRichTextCaptions");
    $f_media_caption_length = SystemPref::Get("MediaCaptionLength");
	$f_external_subs_management = SystemPref::Get("ExternalSubscriptionManagement");
	$f_use_replication = SystemPref::Get("UseDBReplication");
	$f_db_repl_host = SystemPref::Get("DBReplicationHost");
	$f_db_repl_user = SystemPref::Get("DBReplicationUser");
	$f_db_repl_pass = SystemPref::Get("DBReplicationPass");
	$f_db_repl_port = SystemPref::Get("DBReplicationPort");
	$f_template_filter = SystemPref::Get("TemplateFilter");
	$f_external_cron_management = SystemPref::Get("ExternalCronManagement");
}
$f_campsite_online = Input::Get('f_campsite_online');
$f_site_title = strip_tags(Input::Get('f_site_title'));
$f_site_metakeywords = strip_tags(Input::Get('f_site_metakeywords'));
$f_site_metadescription = strip_tags(Input::Get('f_site_metadescription'));
$f_time_zone = Input::Get('f_time_zone');
$f_secret_key = strip_tags(Input::Get('f_secret_key'));
$f_session_lifetime = Input::Get('f_session_lifetime', 'int');
$php_ini_gc_works = ini_get('session.gc_probability');
if (!empty($php_ini_gc_works)) {
    $php_ini_max_seconds = 0 + ini_get('session.gc_maxlifetime');
    if (!empty($php_ini_max_seconds)) {
        if ($f_session_lifetime > $php_ini_max_seconds) {
            $f_session_lifetime = $php_ini_max_seconds;
        }
    }
}
$f_imagecache_lifetime = Input::Get('f_imagecache_lifetime', 'int');
$f_keyword_separator = strip_tags(Input::Get('f_keyword_separator'));
$f_login_num = Input::Get('f_login_num', 'int');
$f_max_upload_filesize = strip_tags(Input::Get('f_max_upload_filesize'));
$f_password_recovery = Input::Get('f_password_recovery');
$f_password_recovery_from = Input::Get('f_password_recovery_from');
if ($f_external_subs_management != 'Y' && $f_external_subs_management != 'N') {
    $f_external_subs_management = SystemPref::Get('ExternalSubscriptionManagement');
}
if ($f_external_cron_management != 'Y' && $f_external_cron_management != 'N') {
    $f_external_cron_management = SystemPref::Get('ExternalCronManagement');
}
if ($f_external_cron_management == 'N'
        && !is_readable(CS_INSTALL_DIR.DIR_SEP.'cron_jobs'.DIR_SEP.'all_at_once')) {
    $f_external_cron_management = 'Y';
}

// geolocation
$f_geo = array(
    'map_center_latitude_default' => Input::Get('f_map_center_latitude_default', 'float'),
    'map_center_longitude_default' => Input::Get('f_map_center_longitude_default', 'float'),
    'map_display_resolution_default' => Input::Get('f_map_display_resolution_default', 'int'),
    'map_view_width_default' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_view_width_default', 'int', 600, true) : SystemPref::Get('MapViewWidthDefault'),
    'map_view_height_default' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_view_height_default', 'int', 400, true) : SystemPref::Get('MapViewHeightDefault'),
    'map_auto_cSS_file' => strip_tags(Input::Get('f_map_auto_cSS_file')),
    'map_auto_focus_default' => Input::Get('f_map_auto_focus_default', 'int', 0, true),
    'map_auto_focus_max_zoom' => Input::Get('f_map_auto_focus_max_zoom', 'int', 18, true),
    'map_auto_focus_border' => Input::Get('f_map_auto_focus_border', 'int', 100, true),
    'map_provider_available_google_v3' => Input::Get('f_map_provider_available_google_v3', 'int', 0, true),
    'map_provider_available_map_quest' => Input::Get('f_map_provider_available_map_quest', 'int', 0, true),
    'map_provider_available_oSM' => Input::Get('f_map_provider_available_oSM', 'int', 0, true),
    'map_provider_default' => Input::Get('f_map_provider_default', 'string'),
    'geo_search_local_geonames' => Input::Get('f_geo_search_local_geonames', 'int', 0, true),
    'geo_search_mapquest_nominatim' => Input::Get('f_geo_search_mapquest_nominatim', 'int', 0, true),
    'geo_search_preferred_language' => Input::Get('f_geo_search_preferred_language', 'string'),
    'map_marker_directory' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_marker_directory', 'string') : SystemPref::Get('MapMarkerDirectory'),
    'map_marker_source_default' => Input::Get('f_map_marker_source_default', 'string'),
    'map_popup_width_min' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_popup_width_min', 'int') : SystemPref::Get('MapPopupWidthMin'),
    'map_popup_height_min' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_popup_height_min', 'int') : SystemPref::Get('MapPopupHeightMin'),
    'map_video_width_you_tube' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_video_width_you_tube', 'int') : SystemPref::Get('MapVideoWidthYouTube'),
    'map_video_height_you_tube' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_video_height_you_tube', 'int') : SystemPref::Get('MapVideoHeightYouTube'),
    'map_video_width_vimeo' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_video_width_vimeo', 'int') : SystemPref::Get('MapVideoWidthVimeo'),
    'map_video_height_vimeo' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_video_height_vimeo', 'int') : SystemPref::Get('MapVideoHeightVimeo'),
    'map_video_width_flash' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_video_width_flash', 'int') : SystemPref::Get('MapVideoWidthFlash'),
    'map_video_height_flash' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_map_video_height_flash', 'int') : SystemPref::Get('MapVideoHeightFlash'),
    'flash_server' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_flash_server', 'string') : SystemPref::Get('FlashServer'),
    'flash_directory' => SaaS::singleton()->hasPermission('ManageSystemPreferences') ? Input::Get('f_flash_directory', 'string') : SystemPref::Get('FlashDirectory'),
);

if (!Input::IsValid()) {
    camp_html_display_error(getGS('Invalid input: $1', Input::GetErrorString()), $_SERVER['REQUEST_URI']);
    exit;
}

$msg_ok = 1;

// Site On-line
SystemPref::Set('SiteOnline', $f_campsite_online);

// Allow Password Recovery
SystemPref::Set('PasswordRecovery', $f_password_recovery);
SystemPref::Set('PasswordRecoveryFrom', $f_password_recovery_from);

// Site title
SystemPref::Set('SiteTitle', $f_site_title);

// Site Meta Keywords
SystemPref::Set('SiteMetaKeywords', $f_site_metakeywords);

// Site Meta Description
SystemPref::Set('SiteMetaDescription', $f_site_metadescription);

// Site Time Zone
SystemPref::Set('TimeZone', $f_time_zone);

// DB Caching
if (SystemPref::Get('DBCacheEngine') != $f_cache_engine) {
    if (!$f_cache_engine || CampCache::IsSupported($f_cache_engine)) {
        SystemPref::Set('DBCacheEngine', $f_cache_engine);
        CampCache::singleton()->clear('user');
        CampCache::singleton()->clear();
    } else {
        $msg_ok = 0;
        camp_html_add_msg(getGS('Invalid: You need PHP $1 enabled in order to use the caching system.', $f_cache_engine));
    }
}

// Template Caching
if (SystemPref::Get('TemplateCacheHandler') != $f_template_cache_handler && $f_template_cache_handler) {
    $handler = CampTemplateCache::factory($f_template_cache_handler);
    if ($handler && CampTemplateCache::factory($f_template_cache_handler)->isSupported()) {
        SystemPref::Set('TemplateCacheHandler', $f_template_cache_handler);
        CampTemplateCache::factory($f_template_cache_handler)->clean();
    } else {
        $msg_ok = 0;
        camp_html_add_msg(getGS('Invalid: You need PHP $1 enabled in order to use the template caching system.'
            , $f_template_cache_handler));
    }
} else {
    SystemPref::Set('TemplateCacheHandler', $f_template_cache_handler);
}

// Image cache lifetime
SystemPref::Set('ImagecacheLifetime', $f_imagecache_lifetime);

// Secret key
SystemPref::Set('SiteSecretKey', $f_secret_key);

// Session life time
SystemPref::Set('SiteSessionLifeTime', $f_session_lifetime);

// Keyword Separator
SystemPref::Set("KeywordSeparator", $f_keyword_separator);

// Number of failed login attempts
if ($f_login_num >= 0) {
    SystemPref::Set("LoginFailedAttemptsNum", $f_login_num);
}

// Max Upload File Size
$max_upload_filesize_bytes = camp_convert_bytes($f_max_upload_filesize);
if ($max_upload_filesize_bytes > 0 &&
        $max_upload_filesize_bytes <= min(camp_convert_bytes(ini_get('post_max_size')), camp_convert_bytes(ini_get('upload_max_filesize')))) {
    SystemPref::Set("MaxUploadFileSize", $f_max_upload_filesize);
} else {
    $msg_ok = 0;
    camp_html_add_msg(getGS('Invalid Max Upload File Size value submitted'));
}

// SMTP Host/Port
if (empty($f_smtp_host)) {
    $f_smtp_host = 'localhost';
}
SystemPref::Set('SMTPHost', $f_smtp_host);
if ($f_smtp_port <= 0) {
    $f_smtp_port = 25;
}
SystemPref::Set('SMTPPort', $f_smtp_port);
SystemPref::Set('EmailContact', $f_email_contact);
SystemPref::Set('EmailFromAddress', $f_email_from_address);

// Statistics collecting
SystemPref::Set('CollectStatistics', $f_collect_statistics);

// Image resizing for WYSIWYG editor
if ($f_editor_image_ratio < 1 || $f_editor_image_ratio > 100) {
    $f_editor_image_ratio = 100;
}
SystemPref::Set('EditorImageRatio', $f_editor_image_ratio);
SystemPref::Set('EditorImageResizeWidth', $f_editor_image_width);
SystemPref::Set('EditorImageResizeHeight', $f_editor_image_height);
SystemPref::Set('EditorImageZoom', $f_editor_image_zoom);

// Rich text captions for media
SystemPref::Set('MediaRichTextCaptions', $f_media_richtext_captions);
if ($f_media_richtext_captions == 'Y') {
    SystemPref::Set('MediaCaptionLength', $f_media_caption_length);
} else {
    // Override and set to 255 chars max
    SystemPref::Set('MediaCaptionLength', 255);
}

// External subscription management
SystemPref::Set('ExternalSubscriptionManagement', $f_external_subs_management);

// Replication
if ($f_use_replication == 'Y') {
    // Database Replication Host, User and Password
    if (!empty($f_db_repl_host) && !empty($f_db_repl_user)) {
        SystemPref::Set("DBReplicationHost", $f_db_repl_host);
        SystemPref::Set("DBReplicationUser", $f_db_repl_user);
        SystemPref::Set("DBReplicationPass", $f_db_repl_pass);
        SystemPref::Set("UseDBReplication", $f_use_replication);
    } else {
        $msg_ok = 0;
        camp_html_add_msg(getGS("Database Replication data incomplete"));
    }
    // Database Replication Port
    if (empty($f_db_repl_port) || !is_int($f_db_repl_port)) {
        $f_db_repl_port = 3306;
    }
    SystemPref::Set("DBReplicationPort", $f_db_repl_port);
} else {
    SystemPref::Set("UseDBReplication", 'N');
}

// template filter
SystemPref::Set("TemplateFilter", $f_template_filter);

// External cron management
SystemPref::Set('ExternalCronManagement', $f_external_cron_management);

// geolocation
foreach ($f_geo as $key => $value) {
    $name = '';
    foreach (explode('_', $key) as $part) {
        $name .= ucfirst($part);
    }
    SystemPref::Set($name, $value);
}
$f_mysql_client_command_path = Input::Get('f_mysql_client_command_path', 'string');
SystemPref::Set('MysqlClientCommandPath', $f_mysql_client_command_path);
require_once($GLOBALS['g_campsiteDir'].'/bin/cli_script_lib.php');
global $Campsite;
global $g_ado_db;
if ((!camp_geodata_loaded($g_ado_db)) && (!empty($f_mysql_client_command_path))) {
    camp_load_geodata($f_mysql_client_command_path, $Campsite['db']);
}

$keys = array(
    'mailchimp_apikey', 'mailchimp_listid',
    'facebook_appid', 'facebook_appsecret',
);

foreach ($keys as $key) {
    if (array_key_exists($key, $_POST)) {
        SystemPref::Set($key, $_POST[$key]);
    }
}

// Success message if everything was ok
if ($msg_ok == 1) {
    camp_html_add_msg(getGS("System preferences updated."), "ok");
}

CampPlugin::PluginAdminHooks(__FILE__);

camp_html_goto_page("/$ADMIN/system_pref/");
