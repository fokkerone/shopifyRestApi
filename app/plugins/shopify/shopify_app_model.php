<?php

class ShopifyAppModel extends AppModel{
	/**
	 * The datasource all models in this plugin use
	 *
	 * @var string
	 */
	var $useDbConfig 	= 'shopify';
	
	var $useTable 		= false;
	var $request 		= array();
	var $datasource 	= null;
	 
	
	function __construct( $config ){

		parent::__construct( $config );
		$this->datasource = $this->getDataSource( $this->useDbConfig );
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
	public function save( $path = null ) {
		$this->request = array();
		if (isset ($this->data ) ){
			return $this->datasource->create( $this, $path );
		}else{
			return false;
		}
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
	public function delete( $path ){
		$this->request = array();
		if (isset  ( $this->id ) ){
			return $this->datasource->delete( $this, $path );
		}else{
			debug ("sdfsdf");
			return false;
		}  	  	
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