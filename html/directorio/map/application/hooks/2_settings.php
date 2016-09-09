<?php defined('SYSPATH') or die('No direct script access.');

/**
* Default Settings From Database
*/

// Retrieve Cached Settings

$cache = Cache::instance();
$subdomain = Kohana::config('settings.subdomain');
$settings = $cache->get($subdomain.'_settings');
if ( ! $settings OR ! is_array($settings))
{ // Cache is Empty so Re-Cache
	$settings = Settings_Model::get_array();
	$cache->set($subdomain.'_settings', $settings, array('settings'), 60); // 1 Day
}

// Set Site Language
Kohana::config_set('locale.language', $settings['site_language']);
ush_locale::detect_language();

// Copy everything into kohana config settings.XYZ
foreach($settings as $key => $setting)
{
	Kohana::config_set('settings.'.$key, $setting);
}

// Set Site Timezone
if (function_exists('date_default_timezone_set'))
{
	$timezone = isset($settings['site_timezone']) ? $settings['site_timezone'] : null;
	// Set default timezone, due to increased validation of date settings
	// which cause massive amounts of E_NOTICEs to be generated in PHP 5.2+
	date_default_timezone_set(empty($timezone) ? date_default_timezone_get() : $timezone);
	Kohana::config_set('settings.site_timezone', $timezone);
}

// Cache Settings
$cache_pages = (isset($settings['cache_pages']) AND $settings['cache_pages']) ? TRUE : FALSE;
Kohana::config_set('cache.cache_pages', $cache_pages);
Kohana::config_set('cache.default.lifetime', isset($settings['cache_pages_lifetime']) ? $settings['cache_pages_lifetime'] : 1800);

$default_map = isset($settings['default_map']) ? $settings['default_map'] : 'osm_mapnik';
$map_layer = map::base($default_map);
if (! empty($map_layer->api_url))
{
	Kohana::config_set('settings.api_url', $map_layer->api_url);
}

// And in case you want to display all maps on one page...
$api_url_all = array();
foreach (map::base() as $layer)
{
	if (empty($layer->api_url)) continue;
	// Add to array, use url as key to avoid dupes
	$api_url_all[$layer->api_url] = $layer->api_url;
}
Kohana::config_set('settings.api_url_all', $api_url_all);

// Additional Mime Types (KMZ/KML)
Kohana::config_set('mimes.kml', array('text/xml'));
Kohana::config_set('mimes.kmz', array('text/xml'));

// Set 'settings.forgot_password_key' if not set already
if ( ! Kohana::config('settings.forgot_password_secret'))
{
	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+[]{};:,.?`~';
	$key = text::random($pool, 64);
	Settings_Model::save_setting('forgot_password_secret', $key);
	Kohana::config_set('settings.forgot_password_secret', $key);
	$cache->delete($subdomain.'_settings');
}

// Set dfault value for external site protocol
if ( ! Kohana::config('config.external_site_protocol'))
{
	Kohana::config_set('config.external_site_protocol', 'https');
}

// Default for allowed_html in case upgraders don't add it to config.php
if ( ! Kohana::config('config.allowed_html') )
{
  Kohana::config_set('config.allowed_html', 'a[href|title],p,img[src|alt],br,b,u,strong,em,i'); 
}
// Default for allowed iframe regexp, in case upgraders don't add it to config.php
if ( ! Kohana::config('config.allowed_iframe_regexp') )
{
  Kohana::config_set('config.allowed_iframe_regexp', '%^http://(www.youtube.com/embed/|player.vimeo.com/video/|w.soundcloud.com/player)%'); 
}
