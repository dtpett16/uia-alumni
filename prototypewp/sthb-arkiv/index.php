<?php
/*
OPPLASTING AV ELDRE STUDIEHÅNDBØKER
Forfatter:		Espen Fosse
Copyright:		Universitetet i Agder
E-post:			espen.fosse@online.no
Tlf.:			917 59 332
URL-nøkkel:		?key=nkgrfqa8431
*/

//Feilkoder
//ini_set ("display_errors", "1");
//error_reporting(E_ALL); 

//Godkjenning
$hent_cookie = $_COOKIE['STHB'];
if($hent_cookie != "nkgrfqa8431"){
	$nokkel = $_GET['key'];
	if($nokkel == "nkgrfqa8431"){
		setcookie('STHB','nkgrfqa8431',time()+31536000);
	}
	else{
		print"Kontakt administrator for &aring; f&aring; tilgang.";
		die();
	}
}

//Innlogging i database
require("mysql.php");

//Variabler
$mappe = "pdf/";

$tid_na = mktime();

$feil = 0;
$ok = 0;
$feilmelding[1] = "Filnavnet eksisterer allerede";
$feilmelding[2] = "Avdelingen eksisterer allerede";
$feilmelding[3] = "Du m&aring; velge en institusjon";
$feilmelding[4] = "Du m&aring; angi studie&aring;r";
$feilmelding[5] = "Du m&aring; angi type dokument";
$feilmelding[6] = "Ugyldig fil";
$feilmelding[7] = "Studie&aring;ret du oppgav stemmer ikke overens med institusjonen du valgte";

$bekreftelse[1] = "Dokumentet ble lagret";

//Funksjoner
function tekst_filter($streng){
	$streng = htmlentities($streng, ENT_QUOTES, "ISO-8859-1");
	
	return $streng;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    
<!-- HEAD START -->
<head> 
    <title>Eldre studieh&aring;ndb&oslash;ker</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
    <link rel="stylesheet" type="text/css" href="/css/sthb.css" />
    <script src='sthb_script.js'></script>
    <script language="javascript">
		var arrAvdeling = new Array();
		<?php
		$teller = 0;
		$hent_avdelinger_sporring = mysql_query("SELECT * FROM avdelinger ORDER BY AvdelingNavn");
		while($hent_avdelinger_array = mysql_fetch_array($hent_avdelinger_sporring)){
			$hent_avdeling_id = $hent_avdelinger_array['AvdelingID'];
			$hent_avdeling_navn = $hent_avdelinger_array['AvdelingNavn'];
			$hent_avdeling_institusjon_id = $hent_avdelinger_array['AvdelingInstitusjonID'];
			
			print"
			arrAvdeling['$teller'] = new Array('$hent_avdeling_institusjon_id','$hent_avdeling_id','$hent_avdeling_navn');";
			$teller ++;
		}
		?>
		
    </script>
</head>
<body>
	<br /><br />
    <table class="meny" cellspacing="0">
    	<tr>
        	<td colspan='2'><h1>Database for eldre studieh&aring;ndb&oslash;ker</h1></td>
        </tr>
        <tr>
        	<td><a href="?s=">[Lagrede dokumenter]</a> &nbsp; | &nbsp; <a href="?s=1">[Opplasting]</a></td>
        </tr>
    </table>
    <br /><br /><hr /><br /><br />
	
	<?php
	$s = intval($_GET['s']);
	switch($s){
		case 1:
			if(isset($_POST['submit'])){ //Sjekker om et skjema er sendt
				
				$opplastet_fil = false;
				$opplastet_fil_navn = trim(strip_tags($_POST['file_select']));
				if($opplastet_fil_navn != ""){ //Sjekker om en allerede opplastet fil er valgt
					$opplastet_fil = true;
				}
				
				if ($_FILES["file"]["type"] == "application/pdf" || $opplastet_fil == true){ //Sjekker at filen er en PDF, eller om en eksisterende fil er valgt
					if ($_FILES["file"]["error"] > 0 && $opplastet_fil == false){ //Sjekker om det har oppstått problemer med opplastingen
						echo "Feilkode: " . $_FILES["file"]["error"] . "<br />";
					}
					else{
						
						if($opplastet_fil == true){
							$fil_plassering = "pdf/$opplastet_fil_navn";
							$storrelse_mb = round(filesize($fil_plassering) / 1024 / 1024, 2);
							$fil_navn = $opplastet_fil_navn;
						}
						elseif($opplastet_fil == false){
							$storrelse_mb = round(($_FILES["file"]["size"] / 1024) / 1024, 2);
							$fil_navn = $_FILES["file"]["name"];
						}

						//Filter for norske bokstaver og mellomrom i filnavnet
						$fil_navn = "$fil_navn";
						$fil_navn = str_replace("æ","ae",$fil_navn);
						$fil_navn = str_replace("Æ","Ae",$fil_navn);
						$fil_navn = str_replace("ø","o",$fil_navn);
						$fil_navn = str_replace("Ø","O",$fil_navn);
						$fil_navn = str_replace("å","a",$fil_navn);
						$fil_navn = str_replace("Å","A",$fil_navn);
						$fil_navn = trim(str_replace(" ","_",$fil_navn));
					
						if (file_exists("$mappe" . $fil_navn) && $opplastet_fil == false){//Dersom opplastet fil: Sjekk om filen allerede eksisterer
							$feil = 1;
						}
						elseif($opplastet_fil == true){
							rename("pdf/$opplastet_fil_navn","pdf/$fil_navn");
						}
						
						if(intval($feil) == 0){			
							$institusjon_id = intval($_POST['institusjon']);
							$hent_institusjon_ar_sporring = mysql_query("SELECT InstitusjonArFra, InstitusjonArTil FROM institusjoner WHERE InstitusjonID = '$institusjon_id' LIMIT 1");
							$hent_institusjon_ar_array = mysql_fetch_array($hent_institusjon_ar_sporring);
								$hent_institusjon_ar_fra = $hent_institusjon_ar_array['InstitusjonArFra'];
								$hent_institusjon_ar_til = $hent_institusjon_ar_array['InstitusjonArTil'];
							
							$studiear_fra = intval($_POST['studiear_fra']);
							$studiear_til = intval($_POST['studiear_til']);
							
							$avdeling_select_id = intval($_POST['avdeling_select']);
							$avdeling_tekst = $_POST['avdeling_input'];
							
							$kommentar = ucfirst($_POST['kommentar']);
							$type = $_POST['type'];
							
							//Kontrollere informasjon
							if($institusjon_id == 0){
								$feil = 3;
							}
							elseif($studiear_fra < 1500 || $studiear_til < 1500){
								$feil = 4;
							}
							elseif($studiear_fra < $hent_institusjon_ar_fra || ($hent_institusjon_ar_til > 0 && $studiear_fra > $hent_institusjon_ar_til)){
								$feil = 7;
							}
							elseif(empty($type)){
								$feil = 5;
							}
							else{
								//Kontrollere avdeling
								if(!empty($avdeling_tekst)){
									$sjekk_avdeling_sporring = mysql_query("SELECT AvdelingID FROM avdelinger WHERE AvdelingNavn = '$avdeling_tekst' AND AvdelingInstitusjonID = '$institusjon_id' LIMIT 1");
									$sjekk_avdeling_antall = mysql_num_rows($sjekk_avdeling_sporring);
									
									if($sjekk_avdeling_antall == 0){
										$lagre_avdeling = mysql_query("INSERT INTO avdelinger SET AvdelingNavn = '$avdeling_tekst', AvdelingInstitusjonID = '$institusjon_id'");
										
										$hent_ny_avdeling_sporring = mysql_query("SELECT AvdelingID FROM avdelinger WHERE AvdelingNavn = '$avdeling_tekst' AND AvdelingInstitusjonID = '$institusjon_id' LIMIT 1");
										$hent_ny_avdeling_array = mysql_fetch_array($hent_ny_avdeling_sporring);
											$avdeling_id = $hent_ny_avdeling_array['AvdelingID'];
									}
									else{
										$feil = 2;
									}
								}
								else{
									$avdeling_id = $avdeling_select_id;
								}
								
								if(intval($feil) == 0){
									//Lagrer fil og informasjon
									if($opplastet_fil == false){
										move_uploaded_file($_FILES["file"]["tmp_name"], "$mappe" . $fil_navn);
									}
									
									$lagre_dokument = mysql_query("INSERT INTO dokumenter SET DokumentNavn = '$fil_navn', DokumentInstitusjonID = '$institusjon_id', DokumentAvdelingID = '$avdeling_id', DokumentStudiearFra = '$studiear_fra', DokumentStudiearTil = '$studiear_til', DokumentKommentar = '$kommentar', DokumentType = '$type', DokumentLagret = '$tid_na', DokumentStorrelse = '$storrelse_mb'");
									$ok = 1;
								}
							}
						}
					}
				}
				else{
					$feil = 6;
				}
			}
			else{ //Vises bare dersom skjema ikke er sendt
				?>
				<form action="" method="post" enctype="multipart/form-data" name="sthb">
					<table class="opplasting" cellspacing="0">
						<tr>
							<td colspan="2"><h2>Opplasting av dokument</h2></td>
						</tr>
						<tr>
							<td class="strong">Fil:</td>
							<td>
								<input type="file" name="file" id="file" /> <i><strong>NB!</strong> Filen m&aring; v&aelig;re i PDF-format og ikke st&oslash;rre enn 8 MB.</i>
                                <br /><br />eller velg en allerede opplastet fil<br /><br />
                                <select name="file_select">
                                	<option value="">Velg en allerede opplastet fil</option>
                                    <?php
									//Open images directory
									$dir = opendir("pdf");
									
									//List files in images directory
									while(($file = readdir($dir)) !== false){
										//Sjekk om filen allerede er i bruk
										$sjekk_fil_sporring = mysql_query("SELECT DokumentID FROM dokumenter WHERE DokumentNavn = '$file'");
										$sjekk_fil_antall = mysql_num_rows($sjekk_fil_sporring);
										if($sjekk_fil_antall == 0 && $file != "." && $file != ".."){
											echo "<option value='$file'>$file</option>";
										}
									}
									closedir($dir);
									?>
                                </select>
							</td>
						</tr>
						<tr>
							<td class="strong">Institusjon:</td>
							<td>
								<select name="institusjon" onchange="hent_avdelinger(this.value);">
									<option value="0">Velg institusjon</option>
								<?php
								$hent_institusjoner_sporring = mysql_query("SELECT * FROM institusjoner ORDER BY InstitusjonNavn");
								while($hent_institusjoner_array = mysql_fetch_array($hent_institusjoner_sporring)){
									$hent_institusjon_id = $hent_institusjoner_array['InstitusjonID'];
									$hent_institusjon_navn = $hent_institusjoner_array['InstitusjonNavn'];
									$hent_institusjon_ar_fra = $hent_institusjoner_array['InstitusjonArFra'];
									$hent_institusjon_ar_til = $hent_institusjoner_array['InstitusjonArTil'];
									
									if($hent_institusjon_ar_fra < 1500){
										$hent_institusjon_ar_fra = "";
									}
									if($hent_institusjon_ar_til < 1500){
										$hent_institusjon_ar_til = "";
									}
									
									print"
									<option value='$hent_institusjon_id'>$hent_institusjon_navn ($hent_institusjon_ar_fra-$hent_institusjon_ar_til)</option>";							
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="strong">Studie&aring;r:</td>
							<td>
								<input class="ar" type="text" name="studiear_fra" maxlength="4" onkeyup="studiear(this.value);" /> / <input class="ar" type="text" name="studiear_til" id="studiear_til" maxlength="4" />
							</td>
						</tr>
						<tr>
							<td class="strong">Avdeling:</td>
							<td>
								<select id="avdeling" name="avdeling_select" disabled="">
									<option value="0">Velg eksisterende avdeling</option>
								</select><br /><br />
								eller opprett ny avdeling:<br /><br />
								<input class="avdeling" type="text" name="avdeling_input" maxlength="100" />
							
							</td>
						</tr>
						<tr>
							<td class="strong">Kommentar:</td>
							<td><input class="avdeling" type="text" name="kommentar" maxlength="200" /></td>
						</tr>
						<tr>
							<td class="strong">Type dokument:</td>
							<td>
								<label><input type="radio" name="type" value="Studiehandbok" /> Studieh&aring;ndbok</label><br />
								<label><input type="radio" name="type" value="Studieplan" /> Studieplan</label><br />
                                <label><input type="radio" name="type" value="Fagplan" /> Fagplan</label><br />
                                <label><input type="radio" name="type" value="Annen plan" /> Annen plan</label><br />
								<label><input type="radio" name="type" value="Annet" /> Annet</label><br />
							</td>
						</tr>
						<tr>
							<td class="strong"></td>
							<td><input type="submit" name="submit" value="Last opp" /></td>
						</tr>
					</table>                
				</form>
				<?php
			}
		break;
		case 2:

		break;
		default:
			//Slette
			$slett_id = intval($_GET['slett']);
			if($slett_id > 0){
				$hent_filnavn_sporring = mysql_query("SELECT DokumentNavn FROM dokumenter WHERE DokumentID = '$slett_id' LIMIT 1");
				$hent_filnavn_array = mysql_fetch_array($hent_filnavn_sporring);
					$hent_filnavn = "pdf/";
					$hent_filnavn .= $hent_filnavn_array['DokumentNavn'];
				$slett_fil = unlink($hent_filnavn);
				$slett_dokument = mysql_query("DELETE FROM dokumenter WHERE DokumentID = '$slett_id' LIMIT 1");
			}
			
			//Liste opp lagrede dokumenter
			print"
			<table class='opplasting' cellspacing='0'>
				<tr>
					<td colspan='7'><h2>Lagrede dokumenter</h2></td>
				</tr>
				<tr>
					<td class='strong'>Institusjon</td>
					<td class='strong'>Studie&aring;r</td>
					<td class='strong'>Avdeling</td>
					<td class='strong'>Type</td>
					<td class='strong'>Kommentar</td>
					<td class='strong'>Last ned</td>
					<td></td>
				</tr>";
				$hent_dokumenter_sporring = mysql_query("SELECT * FROM dokumenter JOIN institusjoner ON DokumentInstitusjonID = InstitusjonID LEFT JOIN avdelinger ON DokumentAvdelingID = AvdelingID ORDER BY InstitusjonNavn, AvdelingNavn, DokumentType DESC, DokumentStudiearFra, DokumentKommentar");
				while($hent_dokumenter_array = mysql_fetch_array($hent_dokumenter_sporring)){
					$hent_dokument_id = $hent_dokumenter_array['DokumentID'];
					$hent_dokument_institusjon_navn = $hent_dokumenter_array['InstitusjonNavn'];
					$hent_dokument_studiear_fra = $hent_dokumenter_array['DokumentStudiearFra'];
					$hent_dokument_studiear_til = $hent_dokumenter_array['DokumentStudiearTil'];
					$hent_dokument_avdeling_navn = htmlentities($hent_dokumenter_array['AvdelingNavn']);
					$hent_dokument_type = $hent_dokumenter_array['DokumentType'];
					if($hent_dokument_type == "Studiehandbok"){
						$hent_dokument_type = "Studieh&aring;ndbok";
					}
					
					$hent_dokument_kommentar = htmlentities($hent_dokumenter_array['DokumentKommentar']);
					$hent_dokument_navn = $hent_dokumenter_array['DokumentNavn'];
					$hent_dokument_storrelse = $hent_dokumenter_array['DokumentStorrelse'];
		
					print"
					<tr>
						<td>$hent_dokument_institusjon_navn</td>
						<td>$hent_dokument_studiear_fra/$hent_dokument_studiear_til</td>
						<td>$hent_dokument_avdeling_navn</td>
						<td>$hent_dokument_type</td>
						<td>$hent_dokument_kommentar</td>
						<td><a href='pdf/$hent_dokument_navn' target='_blank'><img class='pdf' src='img/pdf_icon.gif' /></a> ($hent_dokument_storrelse MB)</td>
						<td><span class='slett' onclick='show_confirm_dokument($hent_dokument_id);'>[slett]</span></td>
					</tr>";
					}
				
				print"
			</table>";
	}
	?>
	<div id="status">
    	<?php
        if($feil > 0){
            print"
			<div id='feil'>"; echo $feilmelding[$feil]; print"</div>";
        }
        if($ok > 0){
            print"
			<div id='ok'>"; echo $bekreftelse[$ok]; print"</div>";
        }
        
        ?>
	</div>
</body>
</html>
