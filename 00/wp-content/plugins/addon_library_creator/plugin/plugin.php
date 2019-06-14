<?php
/**
 * @package Addon Creator for Addon Library
 * @author UniteCMS http://unitecms.net
 * @copyright Copyright (c) 2016 UniteCMS
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('ADDON_LIBRARY_INC') or die ('restricted aceess');

class AddonLibraryCreatorPluginUC extends UniteCreatorPluginBase{
	
	protected $extraInitParams = array();
	
	private $version = "1.0.4";
	private $pluginName = "create_addons";
	private $title = "Addon Creator for Addon Library";
	private $description = "Give the ability to create, duplicate and export custom addons";
	
	
	
	/**
	 * constructor
	 */
	public function __construct(){
		
		parent::__construct();
				
		$this->init();
	}
	
		
	
	/**
	 * add menu items to manager single menu
	 */
	public function addItems_managerMenuSingle($arrMenu){
		
		$arrNewItems = array();
		$arrNewItems[] = array("key"=>"duplicate",
							   "text"=>__("Duplicate",ADDONLIBRARY_TEXTDOMAIN),
							   "insert_after"=>"remove_item");
		
		$arrNewItems[] = array("key"=>"export_addon",
							   "text"=>__("Export Addon",ADDONLIBRARY_TEXTDOMAIN),
							   "insert_after"=>"test_addon_blank");
		
		$arrMenu = UniteFunctionsUC::insertToAssocArray($arrMenu, $arrNewItems);
		
		
		return($arrMenu);
	}

	/**
	 * add menu items to manager single menu
	 */
	public function addItems_managerMenuMultiple($arrMenu){
	
		$arrNewItems = array();
		$arrNewItems[] = array("key"=>"duplicate",
				"text"=>__("Duplicate",ADDONLIBRARY_TEXTDOMAIN),
				"insert_after"=>"bottom");
		
		$arrMenu = UniteFunctionsUC::insertToAssocArray($arrMenu, $arrNewItems);
	
	
		return($arrMenu);
	}
	
	
	/**
	 * add items to menu field
	 */
	public function addItems_managerMenuField($arrMenu){
		
		$arrNewItems[] = array("key"=>"add_addon",
				"text"=>__("Add Addon",ADDONLIBRARY_TEXTDOMAIN),
				"insert_after"=>"top");
		
		$arrMenu = UniteFunctionsUC::insertToAssocArray($arrMenu, $arrNewItems);
		
		return($arrMenu);
	}

	/**
	 * add items to menu field
	 */
	public function addItems_managerMenuCategory($arrMenu){
	
		$arrNewItems[] = array("key"=>"export_cat_addons",
				"text"=>__("Export Category Addons",ADDONLIBRARY_TEXTDOMAIN),
				"insert_after"=>"bottom");
		
		$arrMenu = UniteFunctionsUC::insertToAssocArray($arrMenu, $arrNewItems);
	
		return($arrMenu);
	}
	
	
	
	/**
	 * draw item buttons 1
	 */
	public function drawItemButtons1(){
		?>
 				<a data-action="add_addon" type="button" class="unite-button-secondary unite-button-blue button-disabled uc-button-item uc-button-add"><?php _e("Add Addon",ADDONLIBRARY_TEXTDOMAIN)?></a> 
		<?php 
	}
	
	/**
	 * draw item buttons 1
	 */
	public function drawItemButtons2(){
		?>
		
	 			<a data-action="duplicate_item" type="button" class="unite-button-secondary button-disabled uc-button-item"><?php _e("Duplicate",ADDONLIBRARY_TEXTDOMAIN)?></a>
		
		<?php 
	}
	
	/**
	 * draw item buttons 1
	 */
	public function drawItemButtons3(){
		?>
	 		
	 		<a data-action="export_addon" type="button" class="unite-button-secondary button-disabled uc-button-item uc-single-item"><?php _e("Export Addon",ADDONLIBRARY_TEXTDOMAIN)?></a>
		
		<?php 
	}

	/**
	 * add edit addon extra buttons
	 */
	public function addEditAddonExtraButtons(){
		?>
			<div class="unite-float-right mright_10">
				<a id="button_export_addon" href="javascript:void(0)" class="unite-button-secondary " ><?php _e("Export Addon", ADDONLIBRARY_TEXTDOMAIN)?></a>
			</div>
	<?php
	}
	
	
	/**
	* edit globals
	*/
	public function editGlobals(){
	
		GlobalsUC::$permisison_add = true;
	
	}
	
	
	/**
	 * init the plugin
	 */
	protected function init(){
		
		$this->register($this->pluginName, $this->title, $this->version, $this->description, $this->extraInitParams);
				
		$this->addFilter(self::FILTER_MANAGER_MENU_SINGLE, "addItems_managerMenuSingle");
		$this->addFilter(self::FILTER_MANAGER_MENU_MULTIPLE, "addItems_managerMenuMultiple");
		$this->addFilter(self::FILTER_MANAGER_MENU_FIELD, "addItems_managerMenuField");
		$this->addFilter(self::FILTER_MANAGER_MENU_CATEGORY, "addItems_managerMenuCategory");
		
		$this->addAction(self::ACTION_MANAGER_ITEM_BUTTONS1, "drawItemButtons1");
		$this->addAction(self::ACTION_MANAGER_ITEM_BUTTONS2, "drawItemButtons2");
		$this->addAction(self::ACTION_MANAGER_ITEM_BUTTONS3, "drawItemButtons3");
		$this->addAction(self::ACTION_EDIT_ADDON_EXTRA_BUTTONS, "addEditAddonExtraButtons");
		
		
		$this->addAction(self::ACTION_EDIT_GLOBALS, "editGlobals");
	}
	
}

//run the plugin

$filepathProvider = dirname(__FILE__)."/../plugin_provider.php";
if(file_exists($filepathProvider)){
	
	require $filepathProvider;
	new AddonLibraryCreatorPluginProviderUC();
	
}else{
	new AddonLibraryCreatorPluginUC();
}

