<?php
/**
 * @package Addon Creator for Addon Library
 * @author UniteCMS http://unitecms.net
 * @copyright Copyright (c) 2016 UniteCMS
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('ADDON_LIBRARY_INC') or die ('restricted aceess');

class AddonLibraryCreatorPluginProviderUC extends AddonLibraryCreatorPluginUC{
	
	private $pluginNameWP = "addon_library_creator";
	
	/**
	 * modify submenu pages
	 */
	public function modifySubmenuPages($arrPages){
		
		dmp($arrPages);exit();
		
	}
	
	/**
	 * init function wp
	 */
	protected function init(){
		
		parent::init();
		
		
	}
	
	public function __construct(){
		$this->extraInitParams["plugin_wp_name"] = $this->pluginNameWP;

		parent::__construct();
	}
}