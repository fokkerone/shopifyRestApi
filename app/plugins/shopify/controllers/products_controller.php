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
    $products = $this->Product->find('count');
  #  $this->set(compact('products'));
#	debug ($products);
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
  public function view() {
    
    // If form submitted, redirect to same action with the form data in the url
    if (!empty($this->data['Product'])) {
      $this->redirect($this->data['Product']);
    }

    // If there is form data in the url, add it to Controller::data so it's
    // repopulated in the form, and specify it in the conditions option when
    // fetching the details from the web service.
    if (!empty($this->passedArgs)) {
      $this->data['Product'] = $this->passedArgs;
      $product = $this->Product->find('clicks', array('conditions' => $this->passedArgs));
      $this->set(compact('product'));
    }

  }
  
}
?>
