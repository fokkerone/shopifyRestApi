<?php
/**
 * Rudimentary code for the purpose of demonstrating plugin functionality and
 * model API through which the plugin functionality is intended to be accessed.
 *
 * @author fokkerone <fokkerone@adessivo.com>
 * @link http://www.addesivo.com
 * @copyright (c) 2010 fokkerone
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class CustomcollectionsController extends ShopifyAppController {

  /**
   * The name of this controller
   *
   * @var string
   * @access public
   */
	public $name = 'Customcollections';

  /**
   * Demo action for showing the most recent Shopify links from your account. Note
   * these are fetched from your account's recent links RSS feeds.
   *
   * @return void
   * @access public
   */
	public function index() {
	 	debug ($this->Customcollection->find('count')  );
    	$Customcollections = $this->Customcollection->find('list');
 		$this->set(compact('$Customcollections'));
		debug ($Customcollections);
  }

  /**
   * Demo action for creating a Shopify link in your account
   * 
   * @return void
   * @access public
   */
  public function add( $xml = null ) {	
	
		// $xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>
		// 				<customcollection>
		// 				  <namespace>inventory</namespace>
		// 				  <value type="integer">25</value>
		// 				  <key>warehouse</key>
		// 				  <value-type>integer</value-type>
		// 				</customcollection>';
		// 	
		// 	 $customcollections = $this->Customcollection->create( $xml );
		// 	debug ($customcollections);
  }

  /**
   * Demo action for displaying the click information for a given Shopify hash
   */
	public function view( $id ) {
    	$customcollection = $this->Customcollection->find('list', array("id" => $id));
		$this->set(compact('customcollection'));
		debug ($customcollection);
	}
	

	public function delete( $id ){
		$customcollection = $this->Product->deleteProduct( $id );	
	}

}
?>
