<?php
/*
Plugin Name: Addon Library Creator Extension
Plugin URI: http://unitecms.net
Description: Give the Addon Library the ability to create addons 
Author: Unite CMS
Version: 1.0.3
Author URI: http://addon-library.com
*/

//ini_set("display_errors", "on");
//ini_set("error_reporting", E_ALL);

if(!defined("ADDON_LIBRARY_INC"))
	define("ADDON_LIBRARY_INC", true);

$mainFilepath = __FILE__;
$currentFolder = dirname($mainFilepath);


class AddonLibraryCreatorExtension{
	
	
	public function __construct(){
		add_action('addon_library_register_plugins', array($this, "onRegisterPlugin"));
	}
	
	
	/**
	 * on plugins loaded
	 */
	public function onRegisterPlugin(){
		
		$pathPlugin = dirname(__FILE__)."/plugin/plugin.php";
		
		require_once($pathPlugin);
	}
	
}


new AddonLibraryCreatorExtension();


