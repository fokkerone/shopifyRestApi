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
    $products = $this->Product->find('getproducts');
 	$this->set(compact('products'));
	debug ($products);
  }

  /**
   * Demo action for creating a Shopify link in your account
   * 
   * @return void
   * @access public
   */
  public function add() {
		$xmlsrc = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>
				<product>
				    <title>pickelBacke</title>
				    <body>This is the description.</body>
				    <product-type>Photoshop</product-type>
				    <variants type="array">
				        <variant>
				            <price>99898.00</price>
				            <option1>Single-Use</option1>
				        </variant>
				        <variant>
				            <price>9898.00</price>
				            <option1>Buyout</option1>
				        </variant>
				    </variants>
				    <vendor>fokkerone</vendor>
				</product>';
   	$products = $this->Product->createProduct( $xmlsrc );
  }

  /**
   * Demo action for displaying the click information for a given Shopify hash
   */
	public function view($id) {
    	$product = $this->Product->find('getproduct', array("id" => $id));
		$this->set(compact('product'));
	}

	public function delete( $id ){
		$product = $this->Product->deleteProduct( $id );	
	}
	public function makemehappy(){
		$this->Product->createProduct();
	//	debug ($this->Product->makemehappy());
		
	}
}?>
