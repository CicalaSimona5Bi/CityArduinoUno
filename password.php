<?
$indirizzo = $_POST["email"];
// Comando SQL
$strSQL = "SELECT password FROM users WHERE email='$indirizzo'";
$risultato = mysql_query($strSQL);
if (! $risultato) {
echo ("Errore nel comando SELECT");
exit();
}
// Recupera la prima riga
$riga = mysql_fetch_array($risultato);
if (! $riga){
echo ("Il tuo indirizzo e-mail e' inesistente.");
exit();
}
else
{
$pwd = $riga["password"];
$destinatario = $indirizzo;
$soggetto = "Password";
$messaggio = "La tua password e': $pwd";
$intestazione = "From: webmaster@sito.com\n";
mail($destinatario, $soggetto, $messaggio, $intestazione);
echo ("Ti e' stato spedito un messaggio contenente la password");
}

?>

<body>
</html>