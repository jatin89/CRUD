<?php
require_once 'model/DataService.php';

class DataController {
	
	private $dataService = NULL;
	
	public function __construct(){
		$this->dataService = new DataService();
	}
	
	public function redirect($location) {
		header('Location: '.$location);
	}
	
	public function handleRequest() {
		
		$op = isset($_GET["op"]) ? $_GET["op"] : NULL;
		try{	
			if ( !$op || $op == "list" ) {
					$this->listProducts();
			} else if ($op == "new" ) {
					$this->newProduct();
			} else if ($op == "update"){
				$this->updateProduct();
			} else if ($op == "delete"){
				$this->deleteProduct();
			} else {
					$this->showError("Page not found", "Page for operation ".$op." was not found!");
			}
			
		} catch ( Exception $e ) {
			$this->showError("Application error", $e->getMessage());
        }
	}
	
	public function listCategories(){
		$list = $this->dataService->getAllCategories();
		include 'view/_insert.php';
	}
	
	public function listProducts(){
		$products = $this->dataService->getAllProducts();
		include 'view/_home.php';	
	}
	
	public function newProduct(){
		
		$category = '';
		$name = '';
		$manufacturer = '';
		$price = '';
		
		$list = $this->dataService->getAllCategories();
		
		$errors = array();
		
		if ( isset($_POST['form-submitted']) ) {
			
			$category = isset($_POST['category']) ? $_POST['category'] : NULL;
			$name = isset($_POST['name']) ? $_POST['name'] : NULL;
			$manufacturer = isset($_POST['manufacturer']) ? $_POST['manufacturer'] : NULL;
			$price = isset($_POST['price']) ? $_POST['price'] : NULL;
	
			try {
				$this->dataService->setProduct($category, $name, $manufacturer, $price);
				$this->redirect('index.php');
				return;
			} catch (Validate $e) {
				$errors = $e->getErrors();
			}
		}
        
        include 'view/_insert.php';
	}
	
	public function updateProduct() {
		$id = isset($_GET["id"])?$_GET["id"]:NULL;
		$cat = $_GET["category"];
		
		if ( !$id ) {
            throw new Exception('Internal error.');
        }
		
		$data = $this->dataService->getTable($id,$cat);
		
		if ( isset($_POST['form-submitted']) ) {
			
			$name       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $manufac      = isset($_POST['manufacturer'])?   $_POST['manufacturer'] :NULL;
            $price      = isset($_POST['price'])?   $_POST['price'] :NULL;
            
            try {
                $this->dataService->updateProduct($id, $cat, $name, $manufac, $price);
                $this->redirect('index.php');
                return;
            } catch (Validate $e) {
                $errors = $e->getErrors();
            }
        }
		include 'view/_update.php';
	}
	
	public function deleteProduct(){
		
		$id = isset($_GET["id"])?$_GET["id"]:NULL;
		$cat = $_GET["category"];

		if ( !$id ) {
            throw new Exception('Internal error.');
        }
		try{		
			$this->dataService->deleteProduct($id,$cat);
			$this->redirect('index.php');
		}catch (Exception $e){
			throw $e;
		}
	}
	
	 public function showError($title, $message) {
        include 'view/error.php';
    }

}

?>