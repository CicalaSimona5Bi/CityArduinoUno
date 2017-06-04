<?php

session_start();

include 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){

    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){

        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'La conferma della password deve corrispondere alla password.'; 
        }else{

            $prevCon['where'] = array('email'=>$_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Questa email esiste già, utilizza una email diversa.';
            }else{

                $userData = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'phone' => $_POST['phone']
                );
                $insert = $user->insert($userData);

                if($insert){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Ti sei registrato correttamente, accedi con le tue credenziali.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Si è verificato un problema, riprova.';
                }
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Tutti i campi sono obbligatori, compilare tutti i campi.'
		; 
    }
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'registration.php';
    
    header("Location:".$redirectURL);
}elseif(isset($_POST['loginSubmit'])){
    
    if(!empty($_POST['email']) && !empty($_POST['password'])){
    	 
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            $sessData['status']['type'] = 'success';
            header("Location:principale.php");
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'E-mail o password errati, riprova.';
			header("Location:index.php");
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Inserisci e-mail e password.';
		header("Location:index.php");
    }
   
    $_SESSION['sessData'] = $sessData;
    
    
}elseif(!empty($_REQUEST['logoutSubmit'])){
    
    unset($_SESSION['sessData']);
    session_destroy();
    
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'Accesso avvenuto con successo.';
    $_SESSION['sessData'] = $sessData;
    
    header("Location:index.php");
}else{
    
    header("Location:index.php");
	
	
	
	
	
	
}