<?php

/**
* Shopify Datasource 0.1
* Shopify datasource to communicate with the Shopify API.
* API URL: http://api.shopify.com/comment.html
* References(Credits):
* 
* http://bakery.cakephp.org/articles/view/twitter-component
* http://debuggable.com/posts/new-google-analytics-api:480f4dd6-c59c-445f-8ce0-4202cbdd56cb
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
*
* @author fokkerOne <fokkerone@uscreen.de>
* @copyright (c) 2010 fokkerOne
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @link -- more to come
* @see http//api.shopify.com
* @created September 7, 2010
* @version 0.2 
*/
App::import('Core', array('Xml', 'HttpSocket'));

class ShopifySource extends DataSource
{
	var $username 		= "";
	var $password 		= "";
	var $description 	= "Shopify API";
	var $Http 			= null;

	function __construct($config){
		parent::__construct($config);
		$this->Http =& new HttpSocket();
		$this->username 	= $this->config['username'];
		$this->password 	= $this->config['password'];
		$this->restUrl 		= $this->config['url'];	
		$this->private 		= $this->config['private'];
		
	/*	if (isset($params['signature'])){
			$timestamp = $params['timestamp'];
			$expireTime = time() - (24 * 86400);
			if (!$this->validate_signature($params) || $expireTime > $timestamp){
				throw new Exception('Invalid signature: Possible malicious login.');
			}
		}
	*/
	}

	//###########################################################    SHOP     #########################################################################################
	/**
	* Shopify API – Shop
   * 
	* top
	* Receive a single Shop
	* Get the configuration of the shop account
   * 
	* GET: /admin/shop.xml
	**/
	function getShop(){
		//@toDo
	}
	
	
	//########################################################   REDIRECTS/ROUTING    ########################################################################################
	/**
	* Receive a list of all Redirects
	* Get a list of all URL redirects for your shop.
  * 
	* Available URL Query parameters:
  * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* path — Show Redirects with given path
	* target — Show Redirects with given target
	* GET /admin/redirects.xml
	**/
	function getRedirects(){
		//@toDo
	}

	/**
	* Receive a single Redirect
	* Get a single redirect.
  * 
	* GET /admin/redirects/#{id}.xml
	* Get a single redirect by its ID.
	**/
	function getRedirect( $id = false){
		//@toDo
	}
	
	/**
	* Get a count of all URL redirects for your shop.
  	* 
	* Available URL Query parameters:
  	* 
	* path — Count Redirects with given path
	* target — Count Redirects with given target
	* GET /admin/redirects/count.xml
	* 
	**/
	function countRedirects(){
		//@toDo
	}
	
	
	/**
	* Create a new Redirect
	* Create a new redirect.
  	* 
	* POST /admin/redirects.xml
	* We expect users might try going to /ipod in order to find about one of our popular products, 
	* but we want to redirect them to /itunes because that's where we have the information they're looking for.
	**/
	function createRedirect(){
		//@toDo
	}
	
	/**
	* Modify an existing Redirect
	* Update a redirect's path and/or target URIs.
  * 
	* PUT /admin/redirects/#{id}.xml
	* Change a redirect so that it activates for a different request path:
	**/
	function updateRedirect(){
		//@toDo
	}
	
	/**
	* Remove a Redirect from the database
	* Delete a redirect
  * 
	* DELETE /admin/redirects/#{id}.xml
	* Remove an exisiting redirect from a shop
	**/
	function deleteRedirect( $id = false ){
	 //@toDo
	}
	
	
	
//#############################################################   COUNTRIES    ###########################################################################################
	/**
	* Receive a list of all Countries
	* Get a list of all countries
    * 
	* GET /admin/countries.xml
	* Get all countries
	**/
	function getAllCountries(){
		$api_call = "/admin/countries.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_call ), false, $this->__getAuthHeader( ) ) );
	}
	
	/**
	* Receive a single Country
	* Show country
    * 
	* GET /admin/countries/#{id}.xml
	* Show country
	**/
	function getCountry(){
	//	$api_url = "/admin/countries.xml";
	//	return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}	
	
	/**
	* Create a new Country
	* Create a country
    * 
	* POST /admin/countries.xml
	* Create a country using Shopify's tax rate for the country
    * 
	* REQUEST:
	* <?xml version="1.0" encoding="UTF-8"?>
	* <country>
	*   <code>FR</code>
	* </country>
	*
	* 
	* POST /admin/countries.xml
	* Create a country using a custom tax rate
    * 
	* REQUEST:
	* <?xml version="1.0" encoding="UTF-8"?>
	* <country>
	*   <tax type="float">0.2</tax>
	*   <code>FR</code>
	* </country>
	**/
	function createCountry( $code ){
	//	$api_url = "/admin/countries.xml";
	//	return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}
	
	/**
	* Receive a count of all Countries
	* Get a count of all countries
    * 
	* GET /admin/countries/count.xml
	* Count all countries
	**/
	function countCountries(){
			$api_url = "/admin/countries/count.xml";
			return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}
	
	/**
 	* Modify an existing Country
 	* Update a country
 	* 
 	* PUT /admin/countries/#{id}.xml
 	* Update the country's tax rate
 	* 
 	* Request
 	* 
 	* 
 	* <?xml version="1.0" encoding="UTF-8"?>
 	* <country>
 	*   <tax type="float">0.1</tax>
 	*   <id type="integer">879921427</id>
 	* </country>
	**/
	function updateCountry(){
		//@toDo
	}
	
	/**
	* Remove a Country from the database
	* Delete a country
    * 
	* DELETE /admin/countries/#{id}.xml
	* Delete a country along with all shipping rates
	**/
	function deleteCountry(){
		//@toDo
	}
	

	//##########################################################   PROVINCE    ##########################################################################################
	/**
	* Receive a list of all Provinces
	* Get all provinces
  * 
	* Available URL Query parameters:
  * 
	* country_id — The id of the country the province belongs to
	* GET /admin/countries/#{id}/provinces.xml
	* Get all provinces for a country
	**/
	function getProvinces( $country_id = false ){
		//@toDo
	}
	
	/**
	* Receive a single Province
	* Get a single province for a country
  * 
	* Available URL Query parameters:
  * 
	* country_id — The id of the country the province belongs to
	* GET /admin/countries/#{id}/provinces/#{id}.xml
	* Show province
	**/
	function getProvince(  $country_id = false ){
		
	}
	
	/**
	* Count all Provinces
	* Get a count of all provinces
  * 
	* Available URL Query parameters:
  * 
	* country_id — The id of the country the province belongs to
	* GET /admin/countries/#{id}/provinces/count.xml
	* Count all provinces for a country
	**/
	function countProvinces(){
		//@toDo
	}
	
	/**
	* Modify an existing Province
	* PUT /admin/countries/#{id}/provinces/#{id}.xml
	* Update a province's tax rate
	**/
	function updateProvince( ){
		//@toDo
	}
	

	
	//##########################################################   PRODUCTS    ##########################################################################################
	

	function getProducts($params){
			return $this->__process($this->Http->get($this->__apicall( $url ), $params, $this->__getAuthHeader( ) ));	
	}
	
	
	/**
	* Receive a single Product
	* Get a single product
  * 
	* GET /admin/products/#{id}.xml
	* Get a single product by ID
	**/
	function getProduct( $id = false, $params = array()){
		$url = "/admin/products";
		if($id) {
			$url .= "/{$id}.xml";
		} else {
			$url .= ".xml";
		}
		return $this->__process($this->Http->get($this->__apicall( $url ), $params, $this->__getAuthHeader( ) ));	
	}
	

	
	
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
	* Request
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
	function createProduct( $request = false){
		//if(!$request) return false;
		
		$request = '<' . '?xml version="1.0" encoding="UTF-8"?' . '>
		<product>
		  <product-type>Snowboard</product-type>
		  <body-html>&lt;strong&gt;Good snowboard!&lt;/strong&gt;</body-html>
		  <title>Burton Custom Freestlye 151</title>
		  <vendor>Burton</vendor>
		</product>';
		
		
// $input = '<' . '?xml version="1.0" encoding="UTF-8" ?' . '>    <container>        <element id="first-el">            <name>My element</name>            <size>20</size>        </element>        <element>            <name>Your element</name>            <size>30</size>        </element>    </container>';
	//	$fields = new XML($input);
	//	$fields = array('product' => $request);
	
		return  $this->__process( $this->Http->post( $this->__apicall('/admin/products.xml'), $request, $this->__getAuthHeader( "POST" ) ) );
		
	}
	
	
	/**
	*Modify an existing Product
	*Update a product and associated variants and images
    *
	*PUT /admin/products/#{id}.xml
	*Update a product's tags
    *
	*Request
    *
    *
	*<?xml version="1.0" encoding="UTF-8"?>
	*<product>
	*  <id type="integer">632910392</id>
	*  <tags>Barnes &amp; Noble, John's Fav</tags>
	*</product>
	*	
	*
	* for all samples see here: http://api.shopify.com/product.html
 	*
	**/
	
	function updateProduct( $id=false){
		if(!$id) exit;
		
		//@toDo here
		
	}
	
	function deleteProduct(){
		//@toDo here
	}
	
	/**
	* DELETE a Product
	* /admin/products/#{id}.xml
	**/
	
	//########################################################   PRODUCT-IMAGES    ########################################################################################	
	/**
	* Receive a list of all Product Images
	* Get all product images
  * 
	* GET /admin/products/#{id}/images.xml
	* Get all product images for a product
	**/
	function getProductImages(){
		//@toDo
	}
	
	/**
	* Receive a single Product Image
	* Get a single product image by id
  * 
	* GET /admin/products/#{id}/images/#{id}.xml
	* Show product image
	**/
	function getProductImage( $id = false ){
		//@toDo
	}
	
	/**
	* Create a new Product Image
	* Create a new product image
  * 
	* POST /admin/products/#{id}/images.xml
	* Create a new product image using a source URL that will be downloaded by Shopify
	**/
	function createProductImage(){
		//@toDo
	}
	
	/**
	*	Remove a Product Image from the database
	*	DELETE /admin/products/#{id}/images/#{id}.xml
	*	Delete a product image
	**/
	function deleteProducImage(){
		//@toDo
	}
	
	//########################################################   PRODUCT-VARIANT    ########################################################################################	
	/**
	* Receive a list of all Product Variants
	* Get a list of product variants
  * 
	* GET /admin/products/#{id}/variants.xml
	* Get all variants for a product
	**/
	function getProductVariants(){
		//@toDo
	}
	
	/**
	* Receive a single Product Variant
	* Get a single product variant by id
  * 
	* GET /admin/products/#{id}/variants/#{id}.xml
	* Get a product variant by id
	**/
	function getProductVariant( $id = false){
		//@toDo 
	}
	
	/**
	* Receive a count of all Product Variants
	* Get a count of product variants
  * 
	* GET /admin/products/#{id}/variants/count.xml
	* Count all variants for a product
	**/
	function countProductsVariants(){
		//@toDo
	}
	
	
	/**
	* Create a new Product Variant
	* Create a new product variant
  * 
	* POST /admin/products/#{id}/variants.xml
	* Create a new product variant
	**/
	function createProductVariant( $id = false ){
		//@toDo
	}
	
	/**
	* Modify an existing Product Variant
	* Update an existing product variant
  * 
	* PUT /admin/products/#{id}/variants/#{id}.xml
	* Update the inventory count an existing variant
	**/
	function updateProductVariant(){
		//@toDo
	}
	
	
	/**
	* Remove a Product Variant from the database
	* DELETE /admin/products/#{id}/variants/#{id}.xml
	* Delete a product variant
	**/
	function deleteProductVariant( $id = false ){
		
	}
	
	
	//########################################################   COLLECTIONS    ########################################################################################	
	/**
	* Receive a list of all Collects
	* List all collects or only those for specific products or collections
    * 
	* GET:  /admin/collects.xml
	* List all collects for your shop
    * 
	* GET /admin/collects.xml?collection_id=841564295
	* List only collects for a certain collection
	*
	* GET /admin/collects.xml?product_id=632910392
	* List only collects for a certain product
	**/
	function getCollections( $collection_id = false ){
		$api_url = "/admin/collects.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}
	
	
	/**
	* Receive a count of all Collects
	* Get a count of all collects or only those for specific products or collections
    * 
	* GET /admin/collects/count.xml
	* Count all collects for your shop
	*
	* GET /admin/collects/count.xml?collection_id=841564295
	* Count only collects for a certain collection
	*
	* GET /admin/collects/count.xml?product_id=632910392
	* Count only collects for a certain product
	**/
	function countCollections($collection_id = false, $product_id = false){
		$api_url = "/admin/collects/count.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );	
	} 
	
	
	/**
	* Receive a single Collect
	* Get the collect with a certain id, or for a given product AND collection
    * 
	* GET /admin/collects/#{id}.xml
	* Return a collect with a certain id
	**/
	function getCollection(){
		//@toDo
	}
	
	
	/**
	* Create a new Collect
	* Add a product to a collection
    * 
	* POST /admin/collects.xml
	* Create a new link between an existing product an an existing collection
	* 
	* REQUEST:
	* <?xml version="1.0" encoding="UTF-8"?>
	* <collect>
	*   <product-id type="integer">921728736</product-id>
	*   <collection-id type="integer">841564295</collection-id>
	* </collect>
	**/
	function createCollection(){
		//@toDo
	}
	
	
	/**
	* Remove a Collect from the database
	* Remove a product from a collection
    * 
	* DELETE /admin/collects/#{id}.xml
	* Destroy the link between a product an a collection
	**/
	function deleteCollection( $id = false){
		//@toDo
	} 
	
	
	
	//########################################################   CUSTOM COLLECTIONS    ########################################################################################
	/**
   	* Receive a list of all CustomCollections
   	* Get a list of all custom collections that contain a given product
   	* 
   	* Available URL Query parameters:
   	* 
   	* limit — Amount of results (default: 50) (maximum: 250)
   	* page — Page to show (default: 1)
   	* title — Show custom collections with given title
   	* product_id — Show custom collections that includes given product
   	* updated_at_min — Show custom collections last updated after date (format: 2008-01-01 03:00)
   	* updated_at_max — Show custom collections last updated before date (format: 2008-01-01 03:00)
   	* GET /admin/custom_collections.xml
   	* List all collections
	**/
	function getCustomCollections(){
		$api_url = "/admin/custom_collections.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}
	
	
	/** 
	* getCollectionCount
	* Available URL Query parameters:
    * 
	* title — Count custom collections with given title
	* product_id — Count custom collections that includes given product
	* updated_at_min — Count custom collections last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Count custom collections last updated before date (format: 2008-01-01 03:00)
	* GET /admin/custom_collections/count.xml
	*
	* GET /admin/custom_collections/count.xml?product_id=632910392
	 *Count all custom collections for a certain product_id
	*/	
	function countCustomCollections( $title = false, $product_id = false, $updated_at_min = false, $updated_at_max = false ){
		$api_url = "/admin/custom_collections/count.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}
	
	/**
	* Receive a single CustomCollection
	* Get a single custom collection
    * 
	* GET /admin/custom_collections/#{id}.xml
	* Get a specific collection by ID
	**/
	function getCustomCollection(){
		//@toDo
	}
	
	/**
	* Create a new CustomCollection
	* Create a new custom collection
    * 
	* POST /admin/custom_collections.xml
	* Create a collection with title Macbooks
    * 
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <custom-collection>
	*   <title>Macbooks</title>
	* </custom-collection>
	**/
	function createCustomCollection(){
		//@toDo
	}
	
	
	/**
	* Modify an existing CustomCollection
	* Update an existing custom collection
    * 
	* PUT /admin/custom_collections/#{id}.xml
	* Change the description of the IPod collection
	*
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <custom-collection>
	*   <handle>ipods</handle>
	*   <body-html>&lt;p&gt;5000 songs in your pocket&lt;/p&gt;</body-html>
	*   <template-suffix nil="true"></template-suffix>
	*   <title>IPods</title>
	*   <updated-at type="datetime">2008-02-02T00:00:00Z</updated-at>
	*   <sort-order>manual</sort-order>
	*   <id type="integer">841564295</id>
	*   <published-at type="datetime">2008-02-02T00:00:00Z</published-at>
	* </custom-collection>
	**/
	
	/**
	* PUT /admin/custom_collections/#{id}.xml
	* Show a hidden collection by changing the published attribute to true
    * 
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <custom-collection>
	*   <published type="boolean">true</published>
	*   <id type="integer">841564295</id>
	* </custom-collection>
	**/
	function updateCustomCollection(){
		//@toDo
	}
	
	/**
	* Remove a CustomCollection from the database
	* DELETE /admin/custom_collections/#{id}.xml
	* Remove ipod custom collection
	**/
	function deleteCustomCollection(){
		//@toDo
	}
	
	//########################################################   SMART COLLECTION    ########################################################################################
	
	/**
	* Receive a list of all SmartCollections
	* Get a list of all smart collections that contain a given product
  * 
	* Available URL Query parameters:
  * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* title — Show custom collections with given title
	* product_id — Show custom collections that includes given product
	* updated_at_min — Show custom collections last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show custom collections last updated before date (format: 2008-01-01 03:00)
	* GET /admin/smart_collections.xml
	* List all collections
	**/
	function getSmartCollections(){
		//@toDo
	}
	
	/**
	* GET /admin/smart_collections.xml?product_id=632910392
	* List all smart collections for a certain product_id
  * 
	* Response
	**/
	function getProductSmartCollections(){ 
		//@toDo
	}
	
	/**
	* Receive a count of all SmartCollections
	* Get a count of all smart collections that contain a given product
  * 
	* Available URL Query parameters:
  * 
	* title — Show custom collections with given title
	* product_id — Show custom collections that includes given product
	* updated_at_min — Show custom collections last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show custom collections last updated before date (format: 2008-01-01 03:00)
	* GET /admin/smart_collections/count.xml
	* Count all collections
	**/
	function countSmartColletions(){
		//@toDo
	}
	
	/**
	* Receive a single SmartCollection
	* Get a single smart collection
  * 
	* GET /admin/smart_collections/#{id}.xml
	* Get a specific collection by ID
	**/
	function getSmartCollection(){
		//@toDo
	}
	

	/**
	* Create a new SmartCollection
	* Create a new smart collection. 
	* Valid values for Rule fields:
  * 
	* column - title, type, vendor, variant_price, variant_compare_at_price, variant_weight, variant_inventory, variant_title
	* relation - equals, greater_than, less_than, starts_with, ends_with, contains
	* condition - any string
	* POST /admin/smart_collections.xml
	* Create a collection of all products starting with the term IPod
	**/
	function createSmartCollection(){
		//@toDo
	}
	
	/**
	* Modify an existing SmartCollection
	* Update an existing smart collection
  * 
	* PUT /admin/smart_collections/#{id}.xml
	* Change the description of the Smart iPods collection
	**/
	function updateSmartCollection(){
		//@toDo
	}
	
	/**
	* Remove a SmartCollection from the database
	* DELETE /admin/smart_collections/#{id}.xml
	* Remove Smart iPods smart collection 
	**/
	function deleteSmartCollection(){
		//@toDo
	}
	
	//########################################################   ASSETS    ########################################################################################
	/**
	* Receive a list of all Assets
	* Listing theme assets does not return their contents. In order to access the contents of assets, you must request them individually.
    * 
	* GET /admin/assets.xml
	* Get a list of all theme assets
	* 
	**/
	function getAssets(){
		$api_url = "/admin/assets.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );
	}
	
	/**
	* Receive a single Asset
	* There are different buckets which hold different kinds of assets, each corresponding to one of the folders within a theme's zip file: layout, templates, and assets. 
	* The full key of an asset always starts with the bucket name, and the path separator is a forward slash, like layout/theme.liquid or assets/bg-body.gif.
    * 
	* GET /admin/assets.xml?asset[key]=templates/index.liquid
	**/
	function getAsset(){
		//@toDo
	}
	
	/**
	* Creating or Modifying an Asset
	* PUT takes care of both creating new assets and updating existing ones
    * 
	* PUT /admin/assets.xml
	* Change an existing liquid template's value
	* 
    * 
	* REQUEST:
	* <?xml version="1.0" encoding="UTF-8"?>
	* <asset>
	*   <value>&lt;img src='backsoon-postit.png'&gt;&lt;p&gt;We are busy updating the store for you and will be back within the hour.&lt;/p&gt;</value>
	*   <key>templates/index.liquid</key>
	* </asset>
	* 
	* See all samples here: http://api.shopify.com/asset.html
	**/
	function updateAsset(){
		//@toDo
	}
	
	/**
	* Remove a Asset from the database
	* Remove assets from your shop
    * 
	* DELETE /admin/assets.xml?asset[key]=assets/bg-body.gif
	* Delete an image from your theme
	**/
	function deleteAsset(){
		//@toDo
	}
	


	



	

	//########################################################   BLOGS    ########################################################################################
	/**
	* Available URL Query parameters:
    * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* created_at_min — Show articles created after date (format: 2008-01-01 03:00)
	* created_at_max — Show articles created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show articles last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show articles last updated before date (format: 2008-01-01 03:00)
	* published_at_min — Show articles published after date (format: 2008-01-01 03:00)
	* published_at_max — Show articles published before date (format: 2008-01-01 03:00)
	* published_status
	* published - Show only published articles
	* unpublished - Show only unpublished articles
	* any - Show all articles (default)
	* GET /admin/blogs/#{id}/articles.xml
	*/
	
	
	/** 
	* Blog
	**/
	function getBlogs(){
		return  $this->__process( $this->Http->get( $this->__apicall('/admin/blogs.xml'), false, $this->__getAuthHeader( ) ) );
	}
	
	
	function countBlogs(){
		return  $this->__process( $this->Http->get( $this->__apicall('/admin/blogs/count.xml'), false, $this->__getAuthHeader( ) ) );
	}
	
	

	
	function getSingleBlog($id=false ) {
			
			$url = "/admin/blogs";
		
			if($id != false) {
				$url .= "/{$id}.xml";
			} else {
				$url .= ".xml";
			}
			
			
			return  $this->__process( $this->Http->get( $this->__apicall( $url ), false, $this->__getAuthHeader( ) ) );
			
		}
	
	
	//########################################################   ARTICLE    ########################################################################################
	/**
	*   Shopify API – Article
    *
	*   top
	*   Receive a list of all Articles
	*   Get a list of all articles from a certain blog
    *
	*   Available URL Query parameters:
    *
	*   limit — Amount of results (default: 50) (maximum: 250)
	*   page — Page to show (default: 1)
	*   created_at_min — Show articles created after date (format: 2008-01-01 03:00)
	*   created_at_max — Show articles created before date (format: 2008-01-01 03:00)
	*   updated_at_min — Show articles last updated after date (format: 2008-01-01 03:00)
	*   updated_at_max — Show articles last updated before date (format: 2008-01-01 03:00)
	*   published_at_min — Show articles published after date (format: 2008-01-01 03:00)
	*   published_at_max — Show articles published before date (format: 2008-01-01 03:00)
	*   published_status
	*   published - Show only published articles
	*   unpublished - Show only unpublished articles
	*   any - Show all articles (default)
	*  GET: /admin/blogs/#{id}/articles.xml
	*/
	
	function getArticles( $id=false){
		//@toDo
	}
	
	/**
	* Receive a count of all Articles
	* Get a count of all articles from a certain blog
    * 
	* Available URL Query parameters:
    * 
	* created_at_min — Count articles created after date (format: 2008-01-01 03:00)
	* created_at_max — Count articles created before date (format: 2008-01-01 03:00)
	* updated_at_min — Count articles last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Count articles last updated before date (format: 2008-01-01 03:00)
	* published_at_min — Count articles published after date (format: 2008-01-01 03:00)
	* published_at_max — Count articles published before date (format: 2008-01-01 03:00)
	* published_status
	* published - Count only published articles
	* unpublished - Count only unpublished articles
	* any - Count all articles (default)
	* GET /admin/blogs/#{id}/articles/count.xml
	*/
	function countArticles(){
		//@toDo
	}

	/**
	* Receive a single Article
	* Get a single article by its ID and the ID of the parent blog
    * 
	* GET /admin/blogs/#{id}/articles/#{id}.xml
	* Get a single article
	*/	
	function getArticle( $id=false){
		//@toDo
	}
	
	/** 
	* Create a new Article
	* Create a new article for a blog
    * 
	* POST /admin/blogs/#{id}/articles.xml
	* Create a new article with html markup and upload it to a blog.
	**/
	function createArticle(){
		//@toDo
	}
	
	/**
	* Create a new Article
	* Create a new article for a blog
    * 
	* POST /admin/blogs/#{id}/articles.xml
	* Create a new article with html markup and upload it to a blog.
	**/
	function updateArticle(){
		//@toDo
	}
	
	/** 
	* Remove a Article from the database
	* Delete an article of a blog
    * 
	* DELETE /admin/blogs/#{id}/articles/#{id}.xml
	* Remove an exisiting article from a blog
	**/
	function deleteArticle(){
		//@toDo
	}
	
	//########################################################   COMMENTS    ########################################################################################
	
	/**
	* RECEIVE A LIST OF ALL COMMENTS
	* Get a list of all comments for an article
    * 
	* Available URL Query parameters:
    * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* created_at_min — Show comments created after date (format: 2008-01-01 03:00)
	* created_at_max — Show comments created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show comments last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show comments last updated before date (format: 2008-01-01 03:00)
	* published_at_min — Show comments published after date (format: 2008-01-01 03:00)
	* published_at_max — Show comments published before date (format: 2008-01-01 03:00)
	* published_status
	* published - Show only published comments
	* unpublished - Show only unpublished comments
	* any - Show all comments (default)
	* status
	* pending - All pending comments
	* published - Show only published comments
	* unapproved - Show only unapproved comments
	* 
	* GET /admin/comments.xml?article_id=134645308&blog_id=241253187
 	* Get all the comments for a certain article of a blog
	**/
	function getComments(){
		
		$api_url = "/admin/comments.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );	
	}

	/**
	* Receive a count of all Comments
	* Get a count of all comments for an article
    * 
	* Available URL Query parameters:
    * 
	* created_at_min — Count comments created after date (format: 2008-01-01 03:00)
	* created_at_max — Count comments created before date (format: 2008-01-01 03:00)
	* updated_at_min — Count comments last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Count comments last updated before date (format: 2008-01-01 03:00)
	* published_at_min — Count comments published after date (format: 2008-01-01 03:00)
	* published_at_max — Count comments published before date (format: 2008-01-01 03:00)
	* published_status
	* published - Count only published comments
	* unpublished - Count only unpublished comments
	* any - Count all comments (default)
	* status
	* pending - All pending comments
	* published - Count only published comments
	* unapproved - Count only unapproved comments
	*
	* GET: /admin/comments/count.xml?article_id=134645308&blog_id=241253187
	* Count all comments for a certain article of a blog
	**/
	function countComments(){
		
		$api_url = " /admin/comments/count.xml";
		return  $this->__process( $this->Http->get( $this->__apicall( $api_url ), false, $this->__getAuthHeader( ) ) );	
	}
	
	/**
	* Receive a single Comment
	* Get a single comment by its ID
    * 
	* GET: /admin/comments/#{id}.xml
	* Get a single comment
	**/
	function getComment(){
		//@toDo
	}
	
	/**
	* Create a new Comment
	* Create a new comment for an article
    * 
	* POST /admin/comments.xml
	* Create a new comment with basic textile markup for a certain article of a blog
	*
	* REQUEST:
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <comment>
	*   <author>Your name</author>
	*   <body>I like comments
	* And I like posting them *RESTfully*.</body>
	*   <blog-id type="integer">241253187</blog-id>
	*   <article-id type="integer">134645308</article-id>
	*   <email>your@email.com</email>
	* </comment>
	**/
	function createComment(){
		//@toDo
	}
	
	/**
	* Modify an existing Comment
	* Update a comment of an article within a blog
    * 
	* PUT /admin/comments/#{id}.xml
	* Update an existing comment body
	* 
	* REQUEST:
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <comment>
	*   <author>Your new name</author>
	*   <body>You can even update through a web service.</body>
	*   <id type="integer">118373535</id>
	*   <published-at type="datetime">2010-09-01T12:56:48Z</published-at>
	*   <email>your@updated-email.com</email>
	* </comment>
	**/
	function updateComment(){
		//@toDo
	}
	
	/**
	* Mark a Comment as spam
	* POST /admin/comments/#{id}/spam.xml
	* Mark a comment as spam, helping to train our spam detection as well as remove the comment sometime soon
    * 
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <comment>
	*   <body-html>&lt;p&gt;Hi author, I really &lt;em&gt;like&lt;/em&gt; what you're doing there.&lt;/p&gt;</body-html>
	*   <created-at type="datetime">2010-09-01T12:55:51Z</created-at>
	*   <author>Soleone</author>
	*   <body>Hi author, I really _like_ what you're doing there.</body>
	*   <updated-at type="datetime">2010-09-01T12:55:51Z</updated-at>
	*   <blog-id type="integer">241253187</blog-id>
	*   <id type="integer">653537639</id>
	*   <article-id type="integer">134645308</article-id>
	*   <ip>127.0.0.1</ip>
	*   <published-at nil="true"></published-at>
	*   <user-agent>Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1</user-agent>
	*   <status>unapproved</status>
	*   <email>sole@one.de</email>
	* </comment>
	**/
	function spamComment(){
		//@toDo
	}

	/**
	* Approve a Comment
	* POST /admin/comments/#{id}/approve.xml
	* Approve a comment that is currently pending unapproved so that it will be published on the site
    * 
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <comment>
	*   <body-html>&lt;p&gt;Hi author, I really &lt;em&gt;like&lt;/em&gt; what you're doing there.&lt;/p&gt;</body-html>
	*   <created-at type="datetime">2010-09-01T12:55:51Z</created-at>
	*   <author>Soleone</author>
	*   <body>Hi author, I really _like_ what you're doing there.</body>
	*   <updated-at type="datetime">2010-09-01T12:55:51Z</updated-at>
	*   <blog-id type="integer">241253187</blog-id>
	*   <id type="integer">653537639</id>
	*   <article-id type="integer">134645308</article-id>
	*   <ip>127.0.0.1</ip>
	*   <published-at nil="true"></published-at>
	*   <user-agent>Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1</user-agent>
	*   <status>unapproved</status>
	*   <email>sole@one.de</email>
	* </comment>
	**/
	function approveComment(){
		//@toDo
	}
	
	
	
	//########################################################   EVENTS    ########################################################################################
	/** 
	* Event
	* Receive a list of all Events
	* Receive a single Event
	* Receive a count of all Events
	**/
	
	/**
	* Receive a list of all Events
	* Available URL Query parameters:
    * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* created_at_min — Show events created at or after date and time (format: 2008-01-01 03:00)
	* created_at_max — Show events created at or before date and time (format: 2008-01-01 03:00)
	* GET /admin/orders/#{id}/events.xml?limit=1&page=2
	* Get a 'page' of events from a particular order
	**/
	function getAllOrderEvents(){
		//@toDo
	}
	
	/**
	* GET /admin/orders/#{id}/events.xml
	* Get all the events from a particular order
	**/
	function getAllOrderEventsDetail(){
		//@toDo
	}
	
	/**
	* GET /admin/products/#{id}/events.xml
	* Get all the events from a particular product
	* 
	**/
	function getAllProductEvents(){
		//@toDo
	}
	
	
	/**
	* GET /admin/events.xml?created_at_min=2007-12-31 21:00:00
	* The created_at_min and created_at_max parameters are interpreted using the shop's timezone.
	**/
	function getAllEventsSince(){
		//@toDo
	}
	
	
	/**
	* GET /admin/events.xml
	* The events you get back with this method are the same ones that show up in the shop's admin dashboard. 
	* Only events from the shop itself are returned; this does not include changelog entries or announcements from the Shopify blog.
	**/
	function getDashboardEvents(){
		//@toDo
	}
	
	
	/**
	* Receive a single Event
	* GET /admin/events/#{id}.xml
	* Shows the same fields as the list action.
	**/
	function getEvent(){
		//@toDo
	}
	
	
	/**
	* Receive a count of all Events
	* Available URL Query parameters:
    * 
	* created_at_min — Count events created at or after date and time (format: 2008-01-01 03:00)
	* created_at_max — Count events created at or before date and time (format: 2008-01-01 03:00)
	* GET /admin/events/count.xml?created_at_min=2007-12-31 21:00:00
	* Count the number of events since a particular time
	**/
	function countEvents(){
		//@toDo
	}
	

	//########################################################   FULFILLMENTS    ########################################################################################
	/**
	* Receive a list of all Fulfillments
	* Available URL Query parameters:
    * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* created_at_min — Show fulfillments created after date (format: 2008-01-01 03:00)
	* created_at_max — Show fulfillments created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show fulfillments last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show fulfillments last updated before date (format: 2008-01-01 03:00)
	* GET /admin/orders/#{id}/fulfillments.xml
	* Get a list of all fulfillments for an orde
	**/
	function getFulfillments(){
		//@toDo
	}
	
	/**
	* Receive a single Fulfillment
	* GET /admin/orders/#{id}/fulfillments/#{id}.xml
	* Get the XML Representation of a specific fulfillment.
	**/
	function getFulfillment(){
		//@toDo
	}
	
	/**
	* Receive a count of all Fulfillments
	* Available URL Query parameters:
    * 
	* created_at_min — Count fulfillments created after date (format: 2008-01-01 03:00)
	* created_at_max — Count fulfillments created before date (format: 2008-01-01 03:00)
	* updated_at_min — Count fulfillments last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Count fulfillments last updated before date (format: 2008-01-01 03:00)
	* GET /admin/orders/#{id}/fulfillments/count.xml
	* Count all the total number of fulfillments for an order.
	**/
	function countFulfillment(){
		//@toDo
	}
	
	
	/**
	* Create a new Fulfillment
	* POST /admin/orders/#{id}/fulfillments.xml
	* Fulfill a single line item by explicitly specifying the line items to be fulfilled.
    * 
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <fulfillment>
	*   <line-items type="array">
	*     <line-item>
	*       <id type="integer">466157049</id>
	*     </line-item>
	*   </line-items>
	*   <tracking-number nil="true"></tracking-number>
	* </fulfillment>
	**/
	function createFulfillment(){
		//@toDo
	}
	
	/**
	* Fulfill all line items for an order and send the shipping confirmation email. Not specifying line item IDs causes all line items for the order to be fulfilled.
    * 
	* Request
    * 
    * 
	* <?xml version="1.0" encoding="UTF-8"?>
	* <fulfillment>
	*   <notify-customer type="boolean">true</notify-customer>
	*   <tracking-number>123456789</tracking-number>
	* </fulfillment>
	**/
	function createFulfillmentNotificationWithTrackingNumber(){
		//@toDo
	}
	
	
	/**
	* POST /admin/orders/#{id}/fulfillments.xml
	* Fulfill line items without a tracking number
	**/
	function createFulfillmentNotification(){
		//@toDo
	}
	
	
	/**
	* Modify an existing Fulfillment
	* PUT /admin/orders/#{id}/fulfillments/#{id}.xml
	* Update tracking number for a fulfillment.
	*
	* REQUEST:
	* <?xml version="1.0" encoding="UTF-8"?>
	* <fulfillment>
	*   <id type="integer">255858046</id>
	*   <tracking-number>987654321</tracking-number>
	* </fulfillment>
	**/
	function updateFulfillment(){
		//@toDo
	}
	
	
	

	//########################################################   ORDERS    ########################################################################################
	
	/**
	* Receive a single Order
	* Available URL Query parameters:
    * 
	* fields — comma-separated list of fields to include in the response
	* GET: /admin/orders/#{id}.xml
	* Get an XML representation of a single order
	* 
	* GET /admin/orders/#{id}.xml?fields=id,line_items,name,total_price
	**/
	function getOrder( $id = false, $fields = false ){
		
	}
	
	/**
	* Receive a list of all Orders
	* Available URL Query parameters:
    * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* created_at_min — Show orders created after date (format: 2008-01-01 03:00)
	* created_at_max — Show orders created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show orders last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show orders last updated before date (format: 2008-01-01 03:00)
	* status
	* open - All open orders (default)
	* closed - Show only closed orders
	* any - Any order status
	* financial_status
	* authorized - Show only authorized orders
	* pending - Show only pending orders
	* paid - Show only paid orders
	* abandoned - Show only abandoned orders
	* any - Show all authorized, pending, and paid orders (default)
	* fulfillment_status
	* shipped - Show orders that have been shipped
	* partial - Show partially shipped orders
	* unshipped - Show orders that have not yet been shipped
	* any - Show orders with any fulfillment_status. (default)
	* fields — comma-separated list of fields to include in the response
	* GET /admin/orders.xml
	* List all orders
	*
	* API: http://api.shopify.com/order.html
	**/
	function listOrders(){
		//@toDo
	}
	
	/**
	* Receive a count of all Orders
	* Available URL Query parameters:
  * 
	* created_at_min — Count orders created after date (format: 2008-01-01 03:00)
	* created_at_max — Count orders created before date (format: 2008-01-01 03:00)
	* updated_at_min — Count orders last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Count orders last updated before date (format: 2008-01-01 03:00)
	* status
	* open - Open orders (default)
	* closed - Only closed orders
	* any - Any order status
	* financial_status
	* authorized - Only authorized orders
	* pending - Only pending orders
	* paid - Only paid orders
	* abandoned - Only abandoned orders
	* any - All authorized, pending, and paid orders (default)
	* fulfillment_status
	* shipped - Orders that have been shipped
	* partial - Partially shipped orders
	* unshipped - Orders that have not yet been shipped
	* any - Orders with any fulfillment_status. (default)
	* GET /admin/orders/count.xml
	* Count all orders
	**/
	function countOrders(){
		//@toDo
	}
	
	
	/**
	* Close an Order
	* POST /admin/orders/#{id}/close.xml
	* Close a processed order.
	*
	* POST: XML --> http://api.shopify.com/order.html#close
	**/
	function closeOrder( $id = false, $_xml = false){
		//@toDo
	}

	/**
	* Re-open a closed Order
	* POST /admin/orders/#{id}/open.xml
	* Re-opening a closed Order:
	**/
	function reopenOrder ( $id = false, $_xml = false ){
		//@toDo
	}
	
	/**
	* Change an Order’s note, note-attributes, email, and buyer-accepts-marketing state (the only attributes modifiable through the API)
	* PUT:  /admin/orders/#{id}.xml  
	* API: http://api.shopify.com/order.html#update
	* Add Note to order.
	**/
	function updateOrder( $id = false, $_xml = false ){
		//@toDo
	}
	
	/**
	* Remove a Order from the database
	* DELETE /admin/orders/#{id}.xml
	* Delete Order on this URL.
	**/
	function deleteOrder(){
		//@toDo
	}
	
	
	
	//#####################################################   TRANSACTIONS    ####################################################################################
	/**
	* Receive a list of all Transactions
	* GET /admin/orders/#{id}/transactions.xml
	* Get the XML Representation of all money transfers on a given order.
	**/
	function getTransactions(){
		//@toDo
	}
	
	/**
	* Receive a single Transactions
	* GET /admin/orders/#{id}/transactions/#{id}.xml
	* Get the XML Representation of a specific transaction.
	**/
	function getTransaction( $id = false){
		//@toDo
	}
	
	/**
	* Receive a count of all Transactions
	* GET /admin/orders/#{id}/transactions/count.xml
	* Count all a given order’s money transfers.
	**/
	function countTransactions(){
		//@toDo
	}
	
	/**
	* Create a new Transactions
	* POST /admin/orders/#{id}/transactions.xml
	* Capture a previously authorized order for the full amount
	**/
	function createTransaction(){
		//@toDo
	}
	
	
	//########################################################   PAGES    ########################################################################################
	/**
	* Receive a list of all Pages
	* Get a list of all pages
  * 
	* Available URL Query parameters:
  * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* title — Show pages by Title
	* created_at_min — Show pages created after date (format: 2008-01-01)
	* created_at_max — Show pages created before date (format: 2008-01-01)
	* updated_at_min — Show pages last updated after date (format: 2008-01-01)
	* updated_at_max — Show pages last updated before date (format: 2008-01-01)
	* published_status
	* published - Show only published pages
	* unpublished - Show only unpublished pages
	* any - Show all pages (default)
	* GET /admin/pages.xml
	* Get all pages for a shop
	**/
	function getPages(){
		//@toDo
	}
	
	
	/**
	* Receive a count of all Pages
	* Get a count of all pages
  * 
	* Available URL Query parameters:
  * 
	* title — Pages with a given title
	* created_at_min — Pages created after date (format: 2008-01-01)
	* created_at_max — Pages created before date (format: 2008-01-01)
	* updated_at_min — Pages last updated after date (format: 2008-01-01)
	* updated_at_max — Pages last updated before date (format: 2008-01-01)
	* published_status
	* published - Only published pages
	* unpublished - Only unpublished pages
	* any - All pages (default)
	* GET /admin/pages/count.xml
	* Count all pages for a shop
 	**/
	function countPages(){
		//@toDo
	}
	
	/**
	* Receive a single Page
	* Get a single page by its ID
  * 
	* GET /admin/pages/#{id}.xml
	* Get a single page
	**/
	function getPage( $id = false ){
		
	}
	
	/**
	* Create a new Page
	* Create a new page
  * 
	* POST /admin/pages.xml
	* Create a new page with html markup and upload it to the shop
	* 
	* API: http://api.shopify.com/page.html
	**/
	function createPage( $_xml = false ){
		//@toDo
	}
	
	/**
	* Modify an existing Page
	* Update a page
  * 
	* PUT /admin/pages/#{id}.xml
	* Update an exisiting page body_html
	*
	* API: http://api.shopify.com/page.html
	**/
	function updatePage(){
		//@toDo
	}
	
	/**
	* Remove a Page from the database
	* Delete a page
  * 
	* DELETE /admin/pages/#{id}.xml
	* Remove an exisiting page from a shop
	**/
	function deletePage( $id = false){
		//@toDo
	}

	//########################################################   METAFIELDS    ########################################################################################
	/**
	* Receive a list of all Metafields
	* Get a list of metafields.
    * 
	* Available URL Query parameters:
    * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* created_at_min — Show metafields created after date (format: 2008-01-01 03:00)
	* created_at_max — Show metafields created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show metafields last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show metafields last updated before date (format: 2008-01-01 03:00)
	* namepace — Show metafields with given namespace
	* key — Show metafields with given key
	* value_type
	* string - Show only metafields with string value types
	* integer - Show only metafields with integer value types
	* 
	* GET /admin/products/#{id}/metafields.xml
	* Get all metafields that belong to a product
	*
	* ERE
	**/
	function getProductMetaFields($id){
		//@toDo		
	}
	
	
	/**
	* GET /admin/metafields.xml
	* Get all metafields that belong to a shop
	**/
	function getAllMetaFields(){
		//@toDo
	}
	
	
	/**
	* Receive a single Metafield
	* Get a single metafield by its ID.
    * 
	* GET /admin/products/#{id}/metafields/#{id}.xml
	* Get a single product metafield using the metafield's nested resource path.
	**/
	function getProductMetaField( $id ){
		//@toDo
	}
	
	
	/**
	* GET /admin/metafields/#{id}.xml
	* Get a single shop metafield by ID. A metafield belonging to any resource can be found this way.
	**/
	function getShopMetaField( $id ){
		//@toDo
	}
	
	/**
	* Create a new Metafield
	* Create a new metafield.
    * 
	* POST /admin/products/#{id}/metafields.xml
	* Create a new metafield for a product.
	**/
	function createProductMetaField( $id ){
		//@toDo
	}
	
	
	/**
	* POST /admin/metafields.xml
	* Create a new metafield for a shop.
	**/
	function createShopMetaField(){
		//@toDo
	}
	
	/**
	* Modify an existing Metafield
	* Update a metafield.
    * 
	* PUT /admin/products/#{id}/metafields/#{id}.xml
	* Update an existing metafield belonging to a product using the metafield's nested resource path. 
	* Namespace and key of an existing metafield cannot be changed.
	**/
	function updateProductMetaField( $id = false){
		//@toDo
	}
	
	/**
	* PUT /admin/metafields/#{id}.xml
	* Update an existing shop metafield. A metafield belonging to any resource can be updated this way. 
	* Namespace and key of an existing metafield cannot be changed.
	**/
	function updateShopMetaField( $id = false){
		//@toDo
	}
	
	/**
	* Remove a Metafield from the database
	* Delete a metafield
    * 
	* DELETE /admin/metafields/#{id}.xml
	* Delete an existing shop metafield by id. A metafield belonging to any resource can be deleted this way.
	**/
	function deleteMetaField( $id = false ){
		//@toDo	
	}
	
	//######################################################   WEBHOOKS    #######################################################################################
	/**
	* Receive a list of all Webhooks
	* A webhook’s “topic” attribute determines the event that causes the webhook to send a http POST to the URL set in its “address” attribute.
  * 
	* Available URL Query parameters:
  * 
	* limit — Amount of results (default: 50) (maximum: 250)
	* page — Page to show (default: 1)
	* created_at_min — Show webhooks created after date (format: 2008-01-01 03:00)
	* created_at_max — Show webhooks created before date (format: 2008-01-01 03:00)
	* updated_at_min — Show webhooks last updated after date (format: 2008-01-01 03:00)
	* updated_at_max — Show webhooks last updated before date (format: 2008-01-01 03:00)
	* topic — Show webhooks with a given topic. Available topics: orders/create, orders/updated, orders/paid, orders/fulfilled, app/uninstalled
	* address — Show webhooks with a given address
	* GET /admin/webhooks.xml
	* Get a list of all webhooks for your shop.
	**/
	function getWebHooks(){
		//@toDo
	}
	
	function getWebHook(){
		//@toDo
	}
	
	function countWebHook(){
		//@toDo
	}
	
	function createWebHook(){
		//@toDo
	}

	function updateWebHook(){
		//@toDo
	}
	
	function deleteWebHook(){
		//@toDo
	}
	
	
	//######################################################   PRIVATE FUNCTIONS    #######################################################################################
	/**
	 * Generate APICallString
	 * @return array credentials
	 */
	function __apicall( $_method) {
		return $this->restUrl . $_method;
	}	
	
	/**
	 * Credentials array for method with mandatory auth
	 * @return array credentials
	 * @param method : GET, POST, PUT, DELETE
	 */
	function __getAuthHeader($method = 'GET') {
		$reqw = array(  
			  'method' => $method,    
				// 'uri' => array(        
				// 						'scheme' => 'http',       
				// 						'host' => null,       
				// 						'port' => 80,        
				// 						'user' => $this->username,        
				// 						'pass' => $this->password,        
				// 						'path' => null,        
				// 						'query' => null,       
				// 						 'fragment' => null   
				// 				 ),
				'auth' => array(        
					'method' => 'Basic',        
					'user' => $this->username,        
					'pass' => $this->password
			    ),    
				'version' => '1.1',    
				'body' => '',   
				'line' => null,    
				'header' => array(       
					 'Connection' => 'close',       
					 'User-Agent' => 'cakephpShopifyApibyFokkerOne'    
				),   
				'raw' => null,    
				'cookies' => array()
		);
		
		return $reqw;
	}

	/**
	 *
	 * @param string data to process
	 * @return array Shopify API response
	 */
	function __process( $response ) {
		$xml = new XML($response);
		$array = $xml->toArray();

		$xml->__destruct();
		$xml = null;
		unset($xml);
		return $array;
	}
	
	
	/**
	 * Returns an HTTP 200 OK response code and a format-specific response if authentication was successful.
	 *
	 * @see 
	 */
	function __account_verify_credentials() {
		
		$url = "http://dcalz.myshopify.com/admin/";
		//$this->Http->get($url, null, $this->__getAuthHeader());
		return $this->__process($this->Http->get($url, null, $this->__getAuthHeader()));
	}

	/**
	 * Ends the session of the authenticating user, returning a null cookie.
	 *
	 * @see 
	 */
	function account_end_session() {
		$url = "end_session";
		$this->Http->get($url, null, $this->__getAuthHeader());
	}
}
?>