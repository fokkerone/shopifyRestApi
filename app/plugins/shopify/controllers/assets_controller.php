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
class AssetsController extends ShopifyAppController {

  /**
   * The name of this controller
   *
   * @var string
   * @access public
   */
	public $name = 'Assets';

  /**
   * Demo action for showing the most recent Shopify links from your account. Note
   * these are fetched from your account's recent links RSS feeds.
   *
   * @return void
   * @access public
   */
	public function index() {
    	$Assets = $this->Asset->find('list');
 		$this->set(compact('$Assets'));
		debug ($Assets);
  }

  /**
   * Demo action for creating a Shopify link in your account
   * 
   * @return void
   * @access public
   */
  public function add( $xml ) {	
	 $products = $this->Asset->create( $xml );
  }

  /**
   * Demo action for displaying the click information for a given Shopify hash
   */
	public function view( $id ) {
    	$product = $this->Asset->find('list', array("id" => $id));
		$this->set(compact('product'));
		debug ($product);
	}
	

	public function delete( $id ){
		$product = $this->Product->delete( $id );	
	}

}
?>
