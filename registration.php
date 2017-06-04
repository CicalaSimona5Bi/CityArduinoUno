<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<div class="container">
    <h1>Crea un nuovo account</h1>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <form action="userAccount.php" method="post">
            <h1><input type="text" name="first_name" placeholder="NOME" required=""><br></h1>
            <h1><input type="text" name="last_name" placeholder="COGNOME" required=""><br></h1>
            <h1><input type="email" name="email" placeholder="EMAIL" required=""><br></h1>
            <h1><input type="text" name="phone" placeholder="NUMERO DI TELEFONO" required=""><br></h1>
            <h1><input type="password" name="password" placeholder="PASSWORD" required=""><br></h1>
            <h1><input type="password" name="confirm_password" placeholder="CONFERMA PASSWORD" required=""><br></h1>
            <div class="send-button">
                <h1><input type="submit" name="signupSubmit" value="CREA ACCOUNT"></h1>
				
				
				<h3><a href="userAccount.php?logoutSubmit=1" class="logout">Hai sbagliato? Torna alla pagina principale.</a></h3>
            </div>
        </form>
    </div>
</div>

<style>
body {
	 background-image: url(registra.jpg);
	 background-repeat: no-repeat;
	 background-size: 70%;
	}

h1 {
    color: black;
    text-align: center;
}
h3 {
    color: black;
    text-align: center;
}


</style>

</body>