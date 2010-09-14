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


	public function _findGetproduct($state, $query = array(), $results = array()) {
		if ($state == 'before') { 
		 	$id = $query['id'];
			$url = "/admin/products";
			if($id) {
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
   * Overrides Model::save() as that just returns boolean - we need to return
   * the full response from bit.ly after creating a short url.
   */
  public function save($data = null, $validate = true, $fieldList = array()) {

    $this->request = array(
      'method' => 'GET',
      'uri' => array(
        'path' => 'v3/shorten',
        'query' => array(
          'longUrl' => $data['---------']['longUrl'],
        ),
      ),
    );

    if (isset($data['Product']['domain'])) {
      $this->request['uri']['query']['domain'] = $data['Product']['domain'];
    }

    if (isset($data['Product']['x_login'])) {
      $this->request['uri']['query']['x_login'] = $data['Product']['x_login'];
    }

    if (isset($data['Product']['x_apiKey'])) {
      $this->request['uri']['query']['x_apiKey'] = $data['Product']['x_apiKey'];
    }

    $result = parent::save($data, $validate, $fieldList);

    if ($result) {
      $result = $this->response;
    }

    return $result;
    
  }

}//end Class

?>