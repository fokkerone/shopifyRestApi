<?php
/**
 * Rudimentary code for the purpose of demonstrating plugin functionality and
 * model API through which the plugin functionality is intended to be accessed.
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2010 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class ProductsController extends ShopifyAppController {

  /**
   * The name of this controller
   *
   * @var string
   * @access public
   */
  public $name = 'Products';

  /**
   * Demo action for showing the most recent Shopify links from your account. Note
   * these are fetched from your account's recent links RSS feeds.
   *
   * @return void
   * @access public
   */
  public function index() {
    $products = $this->Product->find('list');
  #  $this->set(compact('products'));
	debug ($products);
  }

  /**
   * Demo action for creating a Shopify link in your account
   * 
   * @return void
   * @access public
   */
  public function add() {
    
    if (!empty($this->data)) {
      $product = $this->Product->save($this->data);
      $this->set(compact('product	'));
    }

  }

  /**
   * Demo action for displaying the click information for a given Shopify hash
   */
	public function view($id) {
    	$product = $this->Product->find('id', array("id" => $id));
		$this->set(compact('product'));
		debug ($product);
  }//end view
}
?>
