<?php
/*
Plugin Name: Nxs languagepack
Version: 1.0.0
Plugin URI: http://nexusthemes.com
Description: Language pack
Author: Gert-Jan Bark
Author URI: http://nexusthemes.com
*/

function nxs_l18n_setupl18n()
{
	if (!defined('NXS_DEFINE_NXSTHEMETRANSLATIONLOADED'))
	{
		// 
		// localization
		//
		$domain = 'nxs_td';
		$locale = apply_filters('theme_locale', get_locale(), $domain);
		$mofile = dirname(__FILE__) . "/lang/nxs-theme-" . $locale . ".mo"; 

		if (!file_exists($mofile))
		{
			//echo "not found; $mofile";
			// if the specified locale is N/A, use English as the fallback
			$mofile = dirname(__FILE__) . "/lang/nxs-theme-en_US.mo";			
		}

		if (!file_exists($mofile))
		{
			//echo "not found; $mofile";
			// error_log("nxs_l18n_setupl18n; $mofile");
		}
		else
		{
			//echo "found; $mofile";
		}
		
		$res = load_textdomain($domain, $mofile);
		
		define('NXS_DEFINE_NXSTHEMETRANSLATIONLOADED', true);	// default to true (improved performance), false means all transients are ignored
	}
	else
	{
		// already loaded 
		// error_log("already loaded;nxs_l18n_setupl18n");
	}
}
add_action("nxs_load_l18ns", "nxs_l18n_setupl18n", 8);

/* --------------------------------------------------------------------- */
?>