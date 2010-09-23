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
class MetafieldsController extends ShopifyAppController {

  /**
   * The name of this controller
   *
   * @var string
   * @access public
   */
	public $name = 'Metafields';

  /**
   * Demo action for showing the most recent Shopify links from your account. Note
   * these are fetched from your account's recent links RSS feeds.
   *
   * @return void
   * @access public
   */
	public function index() {
	 	debug ($this->Metafield->find('count', array("vendor" => "fokkerone")));
    	$Metafields = $this->Metafield->find('list');
 		$this->set(compact('$Metafields'));
		debug ($Metafields);
  }

  /**
   * Demo action for creating a Shopify link in your account
   * 
   * @return void
   * @access public
   */
  public function add( $xml = null ) {	
	
		$xml = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>
				<metafield>
				  <namespace>inventory</namespace>
				  <value type="integer">25</value>
				  <key>warehouse</key>
				  <value-type>integer</value-type>
				</metafield>';
	
	 $metafields = $this->Metafield->create( $xml );
	debug ($metafields);
  }

  /**
   * Demo action for displaying the click information for a given Shopify hash
   */
	public function view( $id ) {
    	$metafield = $this->Metafield->find('list', array("id" => $id));
		$this->set(compact('metafield'));
		debug ($metafield);
	}
	

	public function delete( $id ){
		$metafield = $this->Product->deleteProduct( $id );	
	}

}
?>
