<?php
/**
 * BitlyLink model for bit.ly CakePHP plugin
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2010 Neil Crookes
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
  public $_schema = array(
   
  );

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
	'getproducts' => true,
	'getproduct' => true,
	'getproductcount'  => true,
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
	public function _findGetproductcount($state, $query = array(), $results = array()) {
		if ($state == 'before') {   
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
  public function _findGetproduct($state, $query = array(), $results = array()) {
	if ($state == 'before') {   
		$this->request['uri']['path'] = '/admin/products.xml';
      return $query;
	} else {
		return $this->renderAsXML( $results );
    }
  }


	public function _findGetproducts($state, $query = array(), $results = array()) {
		if ($state == 'before') { 
		 
			$url = "/admin/products";
			if( isset ($query['id']) ) {
				$id = $query['id'] ;
				$url .= "/{$id}.xml";
			} else {
				$url .= ".xml";
			}
			
				$this->request['uri']['path'] = $url;
				return $query;
		} else {
	 		return $this->renderAsXML( $results );
		}
  }//find Product ID

	/** 
	* Create a new Product
	* Create a new product
   * 
	* POST: /admin/products.xml
	* Create a new product with multiple product variants
	* 
	* 
	* REQUEST:
	* <?xml version="1.0" encoding="UTF-8"?>
	* <product>
	*   <product-type>Snowboard</product-type>
	*   <body-html>&lt;strong&gt;Good snowboard!&lt;/strong&gt;</body-html>
	*   <title>Burton Custom Freestlye 151</title>
	*   <variants type="array">
	*     <variant>
	*       <option1>First</option1>
	*       <price>10.00</price>
	*     </variant>
	*     <variant>
	*       <option1>Second</option1>
	*       <price>20.00</price>
	*     </variant>
	*   </variants>
	*   <vendor>Burton</vendor>
	* </product>
  	* 
	* POST: /admin/products.xml
  	* Create a new product with the default product variant
  	* 
  	* REQUEST:
  	* <?xml version="1.0" encoding="UTF-8"?>
  	* <product>
  	*   <product-type>Snowboard</product-type>
  	*   <body-html>&lt;strong&gt;Good snowboard!&lt;/strong&gt;</body-html>
  	*   <title>Burton Custom Freestlye 151</title>
  	*   <tags>Barnes &amp; Noble, John's Fav, "Big Air"</tags>
  	*   <vendor>Burton</vendor>
  	* </product>
	*
	*
	* Create a new product with the default variant and base64 encoded image
   * 
   * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <product>
	*   <product-type>Snowboard</product-type>
	*   <body-html>&lt;strong&gt;Good snowboard!&lt;/strong&gt;</body-html>
	*   <title>Burton Custom Freestlye 151</title>
	*   <images type="array">
	*     <image>
	*       <attachment>R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==
	* </attachment>
	*     </image>
	*   </images>
	*   <vendor>Burton</vendor>
	* </product>
   * 
   * 
	**/	
	function createProduct( $data = null, $validate = true, $fieldList = array() ){
		debug ('createProduct');
		$this->request['uri']['path'] = '/admin/products.xml';	 
	   $response = $this->save( $data );
		debug ($response);
		return $response;
	}
	
}//end Class

?>