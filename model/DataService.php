<?php
require_once 'model/DataGateway.php';
require_once 'model/Validate.php';

class DataService {
	private $dataGateway = NULL;
	
	private function openDb() {
		if (!mysql_connect("YOUR_HOST", "YOUR_USER_NAME", "YOUR_PASSWORD")) { // if statement has been altered to avoid security issues
        
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("testDB")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
    }
	
	private function closeDb() {
        mysql_close();
    }
	
	public function __construct(){
		$this->dataGateway = new DataGateway();	
	}
	
	private function validateProductParams($name, $manufac, $price) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
		if ( !isset($manufac) || empty($manufac) ) {
            $errors[] = 'Manufacturer is required';
        } 
		if ( !isset($price) || empty($price) ) {
            $errors[] = 'Price is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new Validate($errors);
    }
	
	public function getAllCategories(){
		try{
			$this->openDb();
			$res = $this->dataGateway->getCategories();
			$this->closeDb();
			return $res;
		}catch (Exception $e){
			$this->closeDb();
			throw $e;
		}
	}
	
	public function getTable($id,$cat){
		try{
			$this->openDb();
			$res = $this->dataGateway->selectById($id, $cat);
			$this->closeDb();
			return $res;
		}catch(Exception $e){
			$this->closeDb();
			throw $e;
		}
	}
	
	public function getAllProducts(){
		try{
			$this->openDb();
			$res = $this->dataGateway->getProducts();
			$this->closeDb();
			return $res;
		}catch (Exception $e){
			$this->closeDb();
			throw $e;
		}
	}
	
	public function setProduct($cat, $name, $manufac, $price){
		try{
			$this->openDB();
			$this->validateProductParams($name, $manufac, $price);
			$res = $this->dataGateway->insert($cat, $name, $manufac, $price);
			$this->closeDb();
			return $res;
			
		}catch (Exception $e){
			$this->closeDb();
			throw $e;
		}
	}
	
	public function updateProduct($id, $cat, $name, $manufac, $price){
		try{
			$this->openDB();
			$res = $this->dataGateway->update($id, $cat, $name, $manufac, $price);
			$this->closeDb();		
		}catch (Exception $e){
			$this->closeDb();
			throw $e;
		}
	}
	
	public function deleteProduct($id,$cat) {
        try {
            $this->openDb();
            $res = $this->dataGateway->delete($id,$cat);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
}
?>