<?php
/**
 * Shopify model for bit.ly CakePHP plugin
 *
 * @author fokkerone <fokkerone@adessivo.com>
 * @link http://www.addesivo.com
 * @copyright (c) 2010 fokkerone
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class Blog extends ShopifyAppModel {

  /**
   * Name of the model
   * 
   * @var string
   */
  	public $name ='Blog';

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
	* Receive a count of all Blogs
	* Get a count of all Blogs of a given collection
 	* 
	* Available URL Query parameters:
 	* 
	* vendor — Filter by Blog vendor
	* Blog_type — Filter by Blog type
	* collection_id — Filter by collection id
	* created_at_min — Show Blogs created after date (format: 2008-01-01 03:00)
	* created_at_max — Show Blogs created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show Blogs last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show Blogs last updated before date (format: 2008-01-01 03:00)
	* GET /admin/Blogs/count.xml
	* Count all Blogs
	**/
	public function _findCount($state, $query = array(), $results = array()) {
		if ($state == 'before') {   
			$url = "/admin/blogs/count.xml";			
			$this->request['uri']['path'] = $url;
      	return $query;
		} else {
			return $this->renderAsXML( $results );
    }
  }
  

  	/**
	* Receive a list of all Blogs
	* Get all Blogs of a given collection
  	* 
	* Available URL Query parameters:
  	* 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* vendor — Filter by Blog vendor
	* Blog_type — Filter by Blog type
	* collection_id — Filter by collection id
	* created_at_min — Show Blogs created after date (format: 2008-01-01 03:00)
	* created_at_max — Show Blogs created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show Blogs last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show Blogs last updated before date (format: 2008-01-01 03:00)
	**/
	public function _findList($state, $query = array(), $results = array()) {
		if ($state == 'before') { 
			$url  = "/admin/blogs";
			if( isset ($query['id']) ) {
				$id = $query['id'] ;
				$url .= "/{$id}/Blogs";
			} else {
				
				$url .= ".xml";
			}
				 
			$this->request['uri']['path'] = $url;
			return $query;
		} else {
	 		return $this->renderAsXML( $results );
		}
  	}//find Blog ID

	/** 
	* Create a new Blog
	* Create a new Blog
   	* 
	* POST: /admin/Blogs.xml
	**/	
	function create( $data = null, $validate = true, $fieldList = array() ){
		$this->data = $data;
	   	$response = $this->save( '/admin/blogs/count.xml' );
		debug ($response);
		return $response;		
	}
	
	
	function deleteBlog( $id ){

		$this->id = $id;
	   	$response = $this->delete( "/admin/Blogs/{$id}.xml" );
		debug ($response);
		return $response;		
	}
	

	
}//end Class

?>