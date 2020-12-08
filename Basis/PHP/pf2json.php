<?php
	
// Konfiguration
$token = "DeinToken";
$email = "Testadresse";

$anfang = "token=".$token. "&query=";

//API abfragen	
function apiget ($abfrage) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://DeinServer:8080/4DAction/api_get");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
	            $abfrage);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
	
	return json_decode($server_output, true);
	
	
}

//Suchphrase generieren
function suchPhrase ($phrase) {
	
	$suche = array(" ", "!", "<", "=", ">", "(", ")", '"');
	$ersetze = array("%20", "%21", "%3C", "%3D", "%3E", "%28", "%29", "%22");
	
	return str_replace($suche, $ersetze, $phrase);
		
}

//Funktion Feld trimmen

function trimFeld ($eingabeFeld) {
	return trim ($eingabeFeld, " \t\n\r\0\x0B");
	
}

//Funktion Zeiten lesbar machen

function zeitenUmwandeln ($zeit) {
	$zeitNeu = explode('T', $zeit)[0];
	return $zeitNeu;
}



// Ablauf
$felder = "&fields=TypNr,Strasse,Land,PLZ,Ort,Telefon,email,Kurzbezeichnung";
$tabelle = "&table=Ansprechpartner";
$phrase = 'email='.trimFeld($email).' order by TypNr desc';

$postFelder=$anfang . suchPhrase ($phrase) . $tabelle . $felder;

$jsonObject=apiget ($postFelder);

print_r($jsonObject);

?>