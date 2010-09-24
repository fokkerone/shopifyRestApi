<?php
/**
 * Shopify model for bit.ly CakePHP plugin
 *
 * @author fokkerone <fokkerone@adessivo.com>
 * @link http://www.addesivo.com
 * @copyright (c) 2010 fokkerone
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class Product extends ShopifyAppModel {

  /**
   * Name of the model
   * 
   * @var string
   */
  	public $name ='Product';

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
	'count'  => true,
	);


	/**
	* Receive a count of all Products
	* Get a count of all products of a given collection
 	* 
	* Available URL Query parameters:
 	* 
	* vendor — Filter by product vendor
	* product_type — Filter by product type
	* collection_id — Filter by collection id
	* created_at_min — Show products created after date (format: 2008-01-01 03:00)
	* created_at_max — Show products created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show products last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show products last updated before date (format: 2008-01-01 03:00)
	* GET /admin/products/count.xml
	* Count all products
	**/
	public function _findCount($state, $query = array(), $results = array()) {
		if ($state == 'before') {   
			$this->setQueryParams( $query );
			$this->request['uri']['path'] = '/admin/products/count.xml';
      	return $query;
		} else {
			return $this->renderAsXML( $results );
    }
  }
  

  	/**
	* Receive a list of all Products
	* Get all products of a given collection
  	* 
	* Available URL Query parameters:
  	* 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* vendor — Filter by product vendor
	* product_type — Filter by product type
	* collection_id — Filter by collection id
	* created_at_min — Show products created after date (format: 2008-01-01 03:00)
	* created_at_max — Show products created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show products last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show products last updated before date (format: 2008-01-01 03:00)
	**/
	public function _findList($state, $query = array(), $results = array()) {
		if ($state == 'before') { 
			$url = "/admin/products";
			if( isset ($query['id']) ) {
				$id = $query['id'] ;
				$url .= "/{$id}.xml";
			} else {
				$url .= ".xml";
			}
			
			$this->request['uri']['query']['limit'] = isset($query["limit"]) 	? $query["limit"] : 50;
			$this->request['uri']['query']['page'] = isset($query["page"]) 	? $query["limit"] : 1 ;
			
			$this->setQueryParams( $query );
						 
			$this->request['uri']['path'] = $url;
			return $query;
		} else {
	 		return $results;
		}
  	}//find Product ID

	/** 
	* Create a new Product
	* Create a new product
   	* 
	* POST: /admin/products.xml
	**/	
	function create( $data = null, $validate = true, $fieldList = array() ){
		$this->data = $data;
	   	$response = $this->save( '/admin/products.xml' );
		debug ($response);
		return $response;		
	}
	
	
	function deleteProduct( $id ){

		$this->id = $id;
	   $response = $this->delete( "/admin/products/{$id}.xml" );
		debug ($response);
		return $response;		
	}
	
	
	private function setQueryParams( $query = array( ) ){
		if (isset ($query["vendor"]) ) 			$this->request['uri']['query']['vendor']  				= $query["vendor"];
		if (isset ($query["product_type"]) ) 	$this->request['uri']['query']['product_type']  		= $query["product_type"];
		if (isset ($query["collection_id"]) ) 	$this->request['uri']['query']['collection_id']  		= $query["collection_id"];
		if (isset ($query['created_at_min']) ) 	$this->request['uri']['query']['created_at_min']  	= $query["created_at_min"];
		if (isset ($query['created_at_max']) ) 	$this->request['uri']['query']['created_at_max'] 	= $query["created_at_max"];
		if (isset ($query['updated_at_min']) ) 	$this->request['uri']['query']['updated_at_min']  	= $query["updated_at_min"];
		if (isset ($query['updated_at_max']) ) 	$this->request['uri']['query']['updated_at_max']  	= $query["updated_at_max"];
	}
	
}//end Class

?>