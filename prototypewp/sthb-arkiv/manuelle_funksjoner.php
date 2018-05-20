<?php
require("mysql.php");

//ERSTATTE HTML ENTITIES MED BOKSTAVER OG TEGN
/*
$hent_dokumenter_sporring = mysql_query("SELECT * FROM dokumenter");
while($hent_dokumenter_array = mysql_fetch_array($hent_dokumenter_sporring)){
	$hent_dokument_id = $hent_dokumenter_array['DokumentID'];
	$hent_dokument_kommentar = html_entity_decode($hent_dokumenter_array['DokumentKommentar']);
	
	$oppdater_dokument = mysql_query("UPDATE dokumenter SET DokumentKommentar = '$hent_dokument_kommentar' WHERE DokumentID = '$hent_dokument_id'");
}
*/