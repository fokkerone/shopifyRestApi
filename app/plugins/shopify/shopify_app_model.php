<?php

class ShopifyAppModel extends AppModel{
	/**
	 * The datasource all models in this plugin use
	 *
	 * @var string
	 */
	var $useDbConfig = 'Shopify.Shopify';

	/**
	 * The models in the plugin get data from the web service, so they don't need
	 * a table.
	 *
	 * @var string
	 */
	var $useTable = false;

	/**
	 * The methods in the models affect this request property which is then used
	 * in the datasource. The request property value set in each of the methods is
	 * in the format of HttpSocket::request.
	 *
	 * @var array
	 */
	var $request = array();

	var $datasource  = null;
	 
	
	function __construct($config){

		parent::__construct($config);
		$this->datasource = ConnectionManager::getDataSource('shopify');
	}

	/**
	 * Overloads the Model::find() method. Resets request array in between calls
	 * to Model::find()
	 *
	 * @param string $type
	 * @param array $options
	 * @return mixed
	 */
	public function find($type, $options = array()) {
	  $this->request = array();
	  return parent::find($type, $options);
	}
	

	/**
	* Overwrites the Model::save
	**/
	public function save( $data = array() ) {
		pr ("- Save method------");
	  	debug ( $this->request);
		$this->datasource->create($this);
		debug ( $this->request);
		$result = $this->connection->post($url, $xmlsrc, $request);
	}
	
	/**
	* New Model::update
	**/
	public function update( $data = array() ){
		$this->request = array();
		ConnectionManager::getDataSource('shopify')->update($this);	  	
	  	
	}
	
	/**
	* Overwrites the Model::delete
	**/
	public function delete( $data = array() ){
		$this->request = array();
		ConnectionManager::getDataSource('shopify')->delete($this);	  	  	
	}

	
	
	/**
	* Returns ApiXML as DataArray
	*
	* @param string $result
	* @return mixed
	*/
	protected function renderAsXML( $results = Xml ){
		App::import('Core', 'Xml');
		$Xml = new Xml( $results );
	   return $Xml->toArray();
	}

}//end Class
?>