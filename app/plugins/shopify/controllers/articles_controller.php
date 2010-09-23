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
class ArticlesController extends ShopifyAppController {

  /**
   * The name of this controller
   *
   * @var string
   * @access public
   */
	public $name = 'Articles';

  /**
   * Demo action for showing the most recent Shopify links from your account. Note
   * these are fetched from your account's recent links RSS feeds.
   *
   * @return void
   * @access public
   */
	public function index() {
	 	debug ($this->Article->find('count', array("vendor" => "fokkerone")));
    	$articles = $this->Article->find('list');
 		$this->set(compact('$articles'));
		debug ($articles);
  }

  /**
   * Demo action for creating a Shopify link in your account
   * 
   * @return void
   * @access public
   */
  public function add( $xml ) {	
	 $products = $this->Article->create( $xml );
  }

  /**
   * Demo action for displaying the click information for a given Shopify hash
   */
	public function view( $id ) {
    	$product = $this->Article->find('list', array("id" => $id));
		$this->set(compact('product'));
		debug ($product);
	}
	

	public function delete( $id ){
		$product = $this->Product->deleteProduct( $id );	
	}

}
?>