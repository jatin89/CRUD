<?php
class DataGateway{

	public function getCategories(){
		$dbres = mysql_query("SELECT name FROM jqm_categories ORDER BY name ASC") or die(mysql_error());
			
		$categories = array();
		while (($obj = mysql_fetch_object($dbres)) != NULL){
			$categories[] = $obj;
		}
		
		return $categories;
	}
	
	public function selectById($id, $cat){
		
		$dbId = mysql_real_escape_string($id);
        $dbCat = mysql_real_escape_string($cat);
		
		if($dbCat == 'Notebooks'){
			$dbres = mysql_query("SELECT * FROM jqm_notebooks WHERE id=$dbId");
			return mysql_fetch_object($dbres);
		}else if($dbCat == 'Smartphones'){
			$dbres = mysql_query("SELECT * FROM jqm_smartphones WHERE id=$dbId");
        	return mysql_fetch_object($dbres);
		}else if ($dbCat == 'Tablets'){
			$dbres = mysql_query("SELECT * FROM jqm_tablets WHERE id=$dbId");
        	return mysql_fetch_object($dbres);
		}else{
			echo "Application error when Inserting record: model/DataGateway->selectById()\n";
		}
	}
	
	public function getProducts(){
		$dbres = mysql_query("SELECT * FROM jqm_notebooks UNION SELECT * FROM jqm_smartphones UNION SELECT * FROm jqm_tablets ORDER BY category ASC") or die(mysql_error());	
		
		$products = array();
		while(($obj = mysql_fetch_object($dbres)) != NULL){
			$products[] = $obj;
		}
		
		return $products;
	}
	
	public function insert($cat, $name, $manufac, $price){
		
		$dbCat = ($cat != NULL) ?"'".mysql_real_escape_string($cat)."'":'NULL';
		$dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        $dbManufac = ($manufac != NULL)?"'".mysql_real_escape_string($manufac)."'":'NULL';
        $dbPrice = ($price != NULL)?"'".mysql_real_escape_string($price)."'":'NULL';
		
		if($cat == "Notebooks"){
			mysql_query("INSERT INTO jqm_notebooks (category, name, manufacturer, price) VALUES ($dbCat, $dbName, $dbManufac, $dbPrice)");
			return mysql_insert_id();
		}else if($cat == 'Smartphones'){
			mysql_query("INSERT INTO jqm_smartphones (category, name, manufacturer, price) VALUES ($dbCat, $dbName, $dbManufac, $dbPrice)");
        	return mysql_insert_id();
		}else if ($cat == 'Tablets'){
			mysql_query("INSERT INTO jqm_tablets (category, name, manufacturer, price) VALUES ($dbCat, $dbName, $dbManufac, $dbPrice)");
        	return mysql_insert_id();
		}else{
			echo "Application error when Inserting record: model/DataGateway->setProduct()\n";
		}
	}
	
	public function update($id, $cat, $name, $manufac, $price){
		
		$dbID = mysql_real_escape_string($id);
		$dbCat = ($cat != NULL) ?"'".mysql_real_escape_string($cat)."'":'NULL';
		$dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        $dbManufac = ($manufac != NULL)?"'".mysql_real_escape_string($manufac)."'":'NULL';
        $dbPrice = ($price != NULL)?"'".mysql_real_escape_string($price)."'":'NULL';
	
		if($cat == 'Notebooks'){
			mysql_query("UPDATE jqm_notebooks SET name= $dbName, manufacturer= $dbManufac, price= $dbPrice WHERE id= $dbID");
		
		}else if($cat == 'Smartphones'){
			mysql_query("UPDATE jqm_smartphones SET name= $dbName, manufacturer= $dbManufac, price= $dbPrice WHERE id= $dbID");
			
		}else if ($cat == 'Tablets'){
			mysql_query("UPDATE jqm_tablets SET name= $dbName, manufacturer= $dbManufac, price= $dbPrice WHERE id= $dbID");
			
		}else{
			echo "Application error when Inserting record: model/DataGateway->update()\n";
		}
	}
	
	public function delete($id, $cat) {
        $dbId = mysql_real_escape_string($id);
		$dbCat = mysql_real_escape_string($cat);
		
		if($cat == 'Notebooks'){
			mysql_query("DELETE FROM jqm_notebooks WHERE id=$dbId");
		}else if($cat == 'Smartphones'){
			mysql_query("DELETE FROM jqm_smartphones WHERE id=$dbId");
		}else if ($cat == 'Tablets'){
			mysql_query("DELETE FROM jqm_tablets WHERE id=$dbId");
		}else{
			echo "Application error when Inserting record: model/DataGateway->update()\n";
		}
        
    }
}
?>