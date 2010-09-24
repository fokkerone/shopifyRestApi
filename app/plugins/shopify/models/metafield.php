<?php
/**
 * Shopify model for bit.ly CakePHP plugin
 *
 * @author fokkerone <fokkerone@adessivo.com>
 * @link http://www.addesivo.com
 * @copyright (c) 2010 fokkerone
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class Metafield extends ShopifyAppModel {

  /**
   * Name of the model
   * 
   * @var string
   */
  	public $name ='Metafield';

  /**
   * Model schema
   * 
   * @var array
   */
 	public $_schema = array();

  /**
   * Model primary key
   *
   * @var string
   */
  public $primaryKey = 'id';

  /**
   * Model validation rules
   * 
   * @var array
   */
  public $validate = array(
  );

	/**
	* The model's custom find types
	* 
	* @var array
	*/
	var $_findMethods = array(
	'list' => true,
	);
  

  	/**
	* Receive a list of all Metafields
	* Get all Metafields of a given collection
  	* 
	* Available URL Query parameters:
  	* 
	* limit 				— Amount of results (default: 50) (maximum: 250)
	* namespace 		— Filter by Metafield namespace
	* key 				— Filter by Metafield ky
	* value_type 		— Filter by collection value_type
	* created_at_min 	— Show Metafields created after date (format: 2008-01-01 03:00)
	* created_at_max 	— Show Metafields created before date (format: 2008-01-01 03:00)
	* updated_at_min 	— Show Metafields last updated after date (format: 2008-01-01 03:00)
	* updated_at_max 	— Show Metafields last updated before date (format: 2008-01-01 03:00)
	**/
	public function _findList($state, $query = array(), $results = array()) {
		if ($state == 'before') { 
			$url = "/admin/";
			if( isset ($query['id']) ) {
				$id = $query['id'] ;
				$url .= "products/{$id}/metafields.xml";
			} else {
				$url .= "metafields.xml";
			}
			
			$this->request['uri']['query']['limit'] = isset($query["limit"]) 	? $query["limit"] : 50;
			
			$this->setQueryParams( $query );			
			 
			$this->request['uri']['path'] = $url;
			return $query;
		} else {
	 		return $this->renderAsXML( $results );
		}
  	}//find Metafield ID

	/** 
	* Create a new Metafield
	* Create a new Metafield
   	* 
	* POST: /admin/Metafields.xml
	**/	
	function create( $data = null, $validate = true, $fieldList = array() ){
		$this->data = $data;
	   	$response = $this->save( '/admin/metafields.xml' );
		return $response;		
	}
	
	
	function delete( $id ){

		$this->id = $id;
	   	$response = parent::delete( "/admin/metafields/{$id}.xml" );
		return $response;		
	}
	
	
	private function setQueryParams( $query = array( ) ){
		if (isset ($query["namespace"]) ) 			$this->request['uri']['query']['namespace']  		= $query["namespace"];
		if (isset ($query["key"]) ) $this->request['uri']['query']['key']  									= $query["key"];
		if (isset ($query["value_type"]) ) 	$this->request['uri']['query']['value_type']  				= $query["value_type"];
		if (isset ($query["created_at_min"]) ) 	$this->request['uri']['query']['created_at_min']  	= $query["created_at_min"];
		if (isset ($query["created_at_max"]) ) 	$this->request['uri']['query']['created_at_max']  	= $query["created_at_max"];
		if (isset ($query["updated_at_min"]) ) 	$this->request['uri']['query']['updated_at_min']  	= $query["updated_at_min"];
		if (isset ($query["updated_at_max"]) ) 	$this->request['uri']['query']['updated_at_max']  	= $query["updated_at_max"];
	}
	
}//end Class

?>