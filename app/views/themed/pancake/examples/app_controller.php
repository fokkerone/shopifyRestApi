<?php
/**
 * Short description for file.
 *
 * @package         default
 * @subpackage      examples
 * @version         $Revision$ ($Date$)
 * @author          Created by Marcus Spiegel on 2010-06-25. Last Editor: $Author$
 * @license		 http://creativecommons.org/licenses/by-sa/3.0/
 */
class AppController extends Controller {
    var $view  = 'Theme';
    var $theme = 'pancake';
	var $appName = 'PanCake 1.0';
	var $searchable = true;
	
/**
 * Called before the controller action.
 *
 * @access public
 * @link http://book.cakephp.org/view/984/Callbacks
 */
	function beforeFilter() {
		$tabs = array(
			'publikationen' => array(
				'text'   => __('Publikationen', true), 
			), 
			'projekte' => array(
				'text'   => __('Projekte', true), 
			),
			'adressen' => array(
				'text'   => __('Adressen', true), 
			),
			'schlagworte' => array(
				'text'   => __('Schlagworte', true), 
			),
			'api' => array(
				'text'   => __('API', true), 
			),
		);

		// activate the current action-tab
		if(!empty($tabs[$this->viewPath])){
			$tabs[$this->viewPath]['active'] = true;
		}
		$this->set('tabs', $tabs);
		$this->set('appName', $this->appName);
	}
}
?>
