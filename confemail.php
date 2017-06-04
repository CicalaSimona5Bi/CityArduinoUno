<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<?php
    if(isset('Submit')) {
        $email=$_POST('email');
        
        $query="SELECT email FROM users WHERE email='$email' ";
        sql=mysql_query($query) or die(mysql_error());
        $conta = mysql_num_rows($sql);
        // se il confronto genera una corrispondenza..
        if ($conta == 1) {
            //inserisci il codice per inviare l'email
        }
    }
?>