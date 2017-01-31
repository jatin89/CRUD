<?php
/**
 * Created by PhpStorm.
 * User: Jatin
 * Student No: 0000000
 * NSID: abc123
 * Class: CMPT-350
 */

require 'Slim/Slim.php';
require 'rb.php';

$app = new Slim();

// custom class just to throw an exception
class ResourceNotFoundException extends Exception{}

R::setup('mysql:host=localhost; dbname=testDB','YOUR_DB_USERNAME','YOUR_DB_PASSWORD');
//R::setup('mysql:host=localhost; dbname=testDB','root','root');
R::freeze(true);

$app->get('/computers', 'getComputers');
$app->get('/computers/:id',	'getComputer');
$app->post('/computers', 'addComputer');
$app->put('/computers/:id', 'updateComputer');
$app->delete('/computers/:id',	'deleteComputer');

$app->run();


function getComputers() {
    global $app;

    $computers = R::find('jqm_notebooks');
    $app->response()->header('Content-type', 'application/json');
    echo '{"Computers": ' .json_encode(R::exportAll($computers)).'}';

}

function getComputer($id) {
    global $app;
    try{
        $computer = R::findOne('jqm_notebooks','id=?',array($id));
        if($computer){
            $app->response()->header('Content-Type','application/json');
            echo '{"Computer": ' .json_encode(R::exportAll($computer)).'}';
        }else{
            throw new ResourceNotFoundException();
        }
    }catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    }catch (Exception $e){
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', $e->getMessage());
    }
}

function addComputer(){
    global $app;
    $table = 'jqm_notebooks';

    // since i can't use _ next 3 lines are overriding R::dispense() 
    R::ext('xdispense', function( $type ){
        return R::getRedBean()->dispense( $type );
    });

    try{
        // get JSON req body
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body);
        // store record

        //$comp = R::Dispense($table);

        $comp = R::xdispense($table);
        $comp->category = "Notebooks";
        $comp->name = (string)$input->name;
        $comp->manufacturer = (string)$input->manufacturer;
        $comp->price = (int)$input->price;
        R::store($comp);

        //return JSON body
        $app->response()->header('Content-Type','application/json');
        echo '{"Computer": ' .json_encode(R::exportAll($comp)).'}';

    }catch (Exception $e){
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason',$e->getMessage());
    }
}

function updateComputer($id){
    global $app;
    $table = 'jqm_notebooks';
    try {
        // get and decode JSON request body
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body);

        // query database for single article
        $computer = R::findOne($table, 'id=?', array($id));
        $tmp = $computer;

        // store modified article
        // return JSON-encoded response body
        if ($computer) {
            $computer->category = "Notebooks";
            $computer->name = isset($input->name ) ? (string)$input->name : (string) $tmp->name;
            $computer->manufacturer = isset($input->manufacturer ) ? (string)$input->manufacturer : (string) $tmp->manufacturer;
            $computer->price = isset($input->price ) ? (string)$input->price : (string) $tmp->price;
            R::store($computer);
            $app->response()->header('Content-Type', 'application/json');
            echo '{"computer": ' .json_encode(R::exportAll($computer)).'}';
        } else {
            throw new ResourceNotFoundException();
        }
    } catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', $e->getMessage());
    }
}

function deleteComputer($id){
    global $app;
    $table = 'jqm_notebooks';
    try {
        // query database for notebook
        $request = $app->request();
        $computer = R::findOne($table, 'id=?', array($id));

        // delete notebook
        if ($computer) {
            R::trash($computer);
            $app->response()->status(204);
        } else {
            throw new ResourceNotFoundException();
        }
    } catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    } catch (Exception $e) {
        $app->response()->status(400);
        $app->response()->header('X-Status-Reason', $e->getMessage());
    }
}

?>