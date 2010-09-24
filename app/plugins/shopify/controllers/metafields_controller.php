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
	 	//debug ($this->Metafield->find('count', array("vendor" => "fokkerone")));
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
				  <created-at type="datetime">2010-09-01T08:57:29-04:00</created-at>
				  <description nil="true">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</description>
				  <id type="integer">909327677</id>
				  <key>warehouse</key>
				  <namespace>inventory</namespace>
				  <updated-at type="datetime">2010-09-01T08:57:29-04:00</updated-at>
				  <value>25</value>
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
		$m = $this->Metafield->delete( $id );
		debug ($m);	
	}

}
?>
