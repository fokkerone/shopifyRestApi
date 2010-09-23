<?php
/**
 * CakePHP DataSource for accessing the Shopify API.
 *
 * 
 *
 * @author fokkerone <fokkerone@adessivo.com>
 * @link http://blog.adessivo.com
 * @copyright (c) 2010 fokkerOne
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class ShopifySource extends DataSource {

  /**
   * The description of this data source
   *
   * @var string
   */
  public $description = 'Shopify DataSource';

  /**
   * Instance of CakePHP core HttpSocket class
   *
   * @var HttpSocket
   */
  public $Http = null;

  /**
   * Loads HttpSocket class
   *
   * @param array $config
   * @param HttpSocket $Http
   */
  public function __construct($config, $Http = null) {
    parent::__construct($config);
    if (!$Http) {
      App::import('Core', 'HttpSocket');
      $Http = new HttpSocket();
    }
    $this->Http = $Http;
  }


  	/**
   	* Sets method = POST in request if not already set
   	*
   	* @param AppModel $model
   	* @param array $fields Unused
   	* @param array $values Unused
   	*/
	public function create( &$model, $path ) {
		
		$model->request['method'] = 'POST';
		$model->request['header']['Content-Type'] 	= "application/xml";		
	 	return $this->postCall( $model, $path );
	}



  /**
   * Sets method = GET in request if not already set
   *
   * @param AppModel $model
   * @param array $queryData Unused
   */
	public function read(&$model, $queryData = array()) {

	  	$model->request = array_merge(array('method' => 'GET'), $model->request);
	  	return $this->request($model);
	}



  /**
   * Sets method = PUT in request if not already set
   *
   * @param AppModel $model
   * @param array $fields Unused
   * @param array $values Unused
   */
  public function update(&$model, $fields = null, $values = null) {
		debug ("update");
    	$model->request = array_merge(array('method' => 'PUT'), $model->request);
    	return $this->request($model);
  }



  /**
   * Sets method = DELETE in request if not already set
   *
   * @param AppModel $model
   * @param mixed $id Unused
   */
	public function delete(&$model, $path) {

		
		$model->request['method'] = 'DELETE';		
		$this->getApiRestpoint( $model );
		$this->getAuth( $model );
	  

		$model->request['header']['Content-Type'] 	= "application/xml";
		$model->request['uri']['path'] 					= $path;	 
		
		$url = "http://" . 	$model->request['uri']['host'] . $path;
		
		$result = $this->Http->request( $model->request );
		
		return $result;
  	}

	

  /**
   * Issues request and returns response as an array decoded according to the
   * response's content type if the response code is 200, else triggers the
   * $model->onError() method (if it exists) and finally returns false.
   *
   * @param mixed $model Either a CakePHP model with a request property, or an
   * array in the format expected by HttpSocket::request or a string which is a
   * URI.
   * @return mixed The response or false
   */
	public function request(&$model) {
		
		$this->getApiRestpoint ( $model );
		$this->getAuth( $model );

		if (is_object($model)) {
			$request = $model->request;
		
		} elseif (is_array($model)) {
			$request = $model;
		
		} elseif (is_string($model)) {
			$request = array('uri' => $model);
		}
		
		return $this->checkResponse( $this->Http->request( array_intersect_key($request, $this->Http->request) ) );
		}


	/** 
	* PRIVATE functions 
	* do not edit down here hombre
	**/
	private function getApiRestpoint( &$model ){	
		if (!isset($model->request['uri']['host'])) {
			$model->request['uri']['host'] = $this->getURL();
		}		
	}
	
	private function getURL( ){		
		return $this->config['apiKey']. ':' . $this->config['login'] . '@' . $this->config['host'];
	}
	
	private function getAuth( &$model ){		
		 if (!isset($model->request['uri']['query']['login'])) {
			$model->request['uri']['query']['login'] = $this->config['login'];
	    }

	    if (!isset($model->request['uri']['query']['apiKey'])) {
			$model->request['uri']['query']['apiKey'] = $this->config['apiKey'];
	    }
	}
	
	
	/**
	* render REST API response to cakelike dataset Array 
	**/
	private function renderXml2Array( $response ) {
		App::import('Core', 'Xml');
      $Xml = new Xml($response);
      $response = $Xml->toArray(false); // Send false to get separate elements
      $Xml->__destruct();
      $Xml = null;
      unset($Xml);
		return $response;		
	}
	
	/**
	* call API via Post
	* @todo: clear this 
	**/
	private function postCall( &$model, $path ){
		$this->getApiRestpoint( $model );
		$this->getAuth( $model );
		$model->request['uri']['path'] = $path;		
		$url = $this->getURL() . $path;		
		$response =  $this->Http->post($url, $model->data, $model->request );
		return $this->renderXml2Array( $this->checkResponse ($response));
	}
	
	/**
	* check Response on Response Status, Content-type and return the parsed api response
	**/
	private function checkResponse( $response ){
		// Get content type header
		
		// Check response status code for success or failure
		if (substr($this->Http->response['status']['code'], 0, 1) != 2) {
			return false;
		}
		
		$contentType = $this->Http->response['header']['Content-Type'];
		
		// Extract content type from content type header
		if (preg_match('/^([a-z0-9\/\+]+);\s*charset=([a-z0-9\-]+)/i', $contentType, $matches)) {
			$contentType = $matches[1];
			$charset = $matches[2];
		}
		// Decode response according to content type
		switch ($contentType) {
			case 'application/xml':
			case 'application/atom+xml':
			case 'application/rss+xml':
				$response = $this->renderXml2Array( $response );
				break;
			case 'application/json':	
			case 'text/javascript':
				$response = json_decode($response, true);
				break;
		}		
			return $response;
	}
	
}//end Class
?>