<?php 

use Slim\Http\Request; //namespace 
use Slim\Http\Response; //namespace 

//include adminProc.php file 
include __DIR__ .'/function/registerProc.php';


//alow cors
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
//end


//FOR ADMIN
//read table admin 
$app->get('/admin', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table admin 
$app->get('/alladmin',function (Request $request, Response $response,  array $arg) { 

    $data = getAllAdmin($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table admin by condition (cust id) 
$app->get('/admin/[{id}]', function ($request, $response, $args){   
    $adminId = $args['id']; 
    if (!is_numeric($adminId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getAdmin($this->db, $adminId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method admin
$app->post('/admin/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createAdmin($this->db, $form_data); 
    if (is_null($data)) {

        return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200); 
    }  );


//delete row admin
$app->delete('/admin/del/[{id}]', function ($request, $response, $args){   
    $adminId = $args['id']; 
    
   if (!is_numeric($adminId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deleteAdmin($this->db,$adminId); 
       if (empty($data)) { 

           return $this->response->withJson(array($adminId=> 'is successfully deleted'), 202);}; }); 
 
   
//put table admin 
$app->put('/admin/put/[{id}]', function ($request, $response, $args){
    $adminId = $args['id']; 
    
    if (!is_numeric($adminId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updateAdmin($this->db,$form_dat,$adminId); if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});


// FOR registered Runners

//read table register
$app->get('/register', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table register 
$app->get('/allregister',function (Request $request, Response $response,  array $arg) { 

    $data = getAllRegister($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table register  by condition (register id) 
$app->get('/register/[{id}]', function ($request, $response, $args){   
    $registerId = $args['id']; 
    if (!is_numeric($registerId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getRegister($this->db, $registerId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method register 
$app->post('/register/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createRegister($this->db, $form_data); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


//delete row registered runner
$app->delete('/register/del/[{id}]', function ($request, $response, $args){   
    $registerId = $args['id']; 
    
   if (!is_numeric($registerId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deleteRegister($this->db,$registerId); 
       if (empty($data)) { 

           return $this->response->withJson(array($runnerId=> 'is successfully deleted'), 202);}; }); 
 

   
//put table register
$app->put('/register/put/[{id}]', function ($request, $response, $args){
    $registerId = $args['id']; 
    
    if (!is_numeric($registerId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updateRegister($this->db,$form_dat,$registerId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});
   