<?php

class ShopifyAppModel extends AppModel{
	/**
	 * The datasource all models in this plugin use
	 *
	 * @var string
	 */
	var $useDbConfig = 'shopify';

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

}
?>