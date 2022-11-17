<?php 
//FOR ADMIN FUCNYUINON
//get all admin 
function getAllAdmin($db) {

    $sql = 'Select * FROM admin '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get admin by id 
function getAdmin($db, $adminId) {

    $sql = 'Select a.adminName, a.password, a.email FROM admin a  ';
    $sql .= 'Where a.adminid = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $adminId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new admin 
function createAdmin($db, $form_data) { 
    
    $sql = 'Insert into admin (adminName, password, email)'; 
    $sql .= 'values (:adminName, :password, :email)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':adminName', $form_data['adminName']); 
    $stmt->bindParam(':password', $form_data['password']);   
    $stmt->bindParam(':email', ($form_data['email']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete admin by id 
function deleteAdmin($db,$adminId) { 

    $sql = ' Delete from admin where adminId = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$adminId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update admin by id 
function updateAdmin($db,$form_dat,$adminId) { 

    $sql = 'UPDATE admin SET adminName = :adminName , password = :password ,  email = :email'; 
    $sql .=' WHERE adminId = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$adminId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->bindParam(':adminName', $form_dat['adminName']); 
    $stmt->bindParam(':password', $form_dat['password']); 
    $stmt->bindParam(':email',($form_dat['email']));
    $stmt->execute(); 
}

//Register
//get all registered runners
function getAllRegister($db) {

    
    $sql = 'Select * FROM register '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get registered runner by id 
function getRegister($db, $registerId) {

    $sql = 'Select o.runnerName, o.age, o.phone, o.address FROM register o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $registerId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new register
function createRegister($db, $form_data) { 
  
    $sql = 'Insert into register ( runnerName, age, phone, address)'; 
    $sql .= 'values (:runnerName, :age, :phone, :address)';  
    $stmt = $db->prepare ($sql);   
    $stmt->bindParam(':runnerName', ($form_data['runnerName']));
    $stmt->bindParam(':age', ($form_data['age']));
    $stmt->bindParam(':phone', ($form_data['phone']));
    $stmt->bindParam(':address', ($form_data['address']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete registered runner by id 
function deleteRegister($db,$registerId) { 

    $sql = ' Delete from register where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$registerId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update registered runner by id 
function updateRegister($db,$form_data,$registerId) { 

    
    $sql = 'UPDATE register SET runnerName = :runnerName , age = :age , phone = :phone , address = :address'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$registerId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
    $stmt->bindParam(':runnerName', ($form_data['runnerName']));
    $stmt->bindParam(':age', ($form_data['age']));
    $stmt->bindParam(':phone', ($form_data['phone']));
    $stmt->bindParam(':address', ($form_data['address']));
    $stmt->execute(); 
}