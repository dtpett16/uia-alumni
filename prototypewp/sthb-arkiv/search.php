<?php
//Databasepålogging
require("mysql.php");

//Feilkoder
//ini_set ("display_errors", "1");
//error_reporting(E_ALL); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    
<!-- HEAD START -->
<head> 
    <title>S&oslash;k etter eldre studieh&aring;ndb&oslash;ker - UiA</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
    <link rel="stylesheet" type="text/css" href="/css/sthb.css" />
    
    <script src='sthb_script.js'></script>
</head>
<body class="sok_bakgrunn">
	<?php
	$sok = false;
	$sok_tomt = true;
	$sok_feil_institusjon = false;
	$sok_feil_studiear = false;
	
	if(isset($_POST['sok'])){
		$sok = true;
		$post_institusjon_id = intval($_POST['institusjon']);
		$post_studiear = intval($_POST['studiear']);
		//$post_avdeling_id = intval($_POST['avdeling']);
		$post_type = $_POST['type'];
		
		//Kontroll
		if(empty($post_institusjon_id) && empty($post_studiear)/* && empty($post_avdeling_id)*/ && empty($post_type)){
			$sok_tomt = false;
		}
		/*
		if($post_institusjon_id > 0 && $post_avdeling_id > 0){
			$sjekk_avdeling_sporring = mysql_query("SELECT AvdelingID FROM avdelinger WHERE AvdelingID = '$post_avdeling_id' AND AvdelingInstitusjonID = '$post_institusjon_id' LIMIT 1");
			$sjekk_avdeling_antall = mysql_num_rows($sjekk_avdeling_sporring);
			if($sjekk_avdeling_antall == 0){
				$sok_feil_institusjon = true;
			}
		}
		*/
		if($post_institusjon_id > 0 && $post_studiear > 0){
			$sjekk_studiear_sporring = mysql_query("SELECT InstitusjonArFra, InstitusjonArTil FROM institusjoner WHERE InstitusjonID = '$post_institusjon_id' LIMIT 1");
			$sjekk_studiear_array = mysql_fetch_array($sjekk_studiear_sporring);
				$sjekk_studiear_fra = $sjekk_studiear_array['InstitusjonArFra'];
				$sjekk_studiear_til = $sjekk_studiear_array['InstitusjonArTil'];
			
			if($post_studiear < $sjekk_studiear_fra || ($sjekk_studiear_til > 0 && $post_studiear > $sjekk_studiear_til)){
				$sok_feil_studiear = true;
			}
		}
		
		//Spørring
		$sporring_teller = 1;
		$sporring = "SELECT * FROM dokumenter INNER JOIN institusjoner ON DokumentInstitusjonID = InstitusjonID LEFT OUTER JOIN avdelinger ON DokumentAvdelingID = AvdelingID WHERE ";
		if(!empty($post_institusjon_id)){
			if($sporring_teller > 1){
				$sporring .= "AND ";
			}
			$sporring .= "DokumentInstitusjonID = '$post_institusjon_id' ";
			$sporring_teller ++;
		}
		if(!empty($post_studiear)){
			if($sporring_teller > 1){
				$sporring .= "AND ";
			}
			$sporring .= "(DokumentStudiearFra = '$post_studiear' OR DokumentStudiearTil = '$post_studiear') ";
			$sporring_teller ++;
		}
		/*
		if(!empty($post_avdeling_id)){
			if($sporring_teller > 1){
				$sporring .= "AND ";
			}
			$sporring .= "DokumentAvdelingID = '$post_avdeling_id' ";
			$sporring_teller ++;
		}
		*/
		if(!empty($post_type)){
			if($sporring_teller > 1){
				$sporring .= "AND ";
			}
			$sporring .= "DokumentType = '$post_type' ";
			$sporring_teller ++;
		}
		
		$sporring .= "ORDER BY InstitusjonNavn, DokumentStudiearFra DESC, AvdelingNavn, DokumentType DESC, DokumentKommentar";
	}
	?>
    <form action="" method="post">
    <table cellspacing="0" class="sok">
    	<tr>
        	<td>
            	<select name="institusjon" id="institusjon" class="sok<?php if(empty($post_institusjon_id)){print" svak";} ?>" onchange="skift_farge_institusjon(this.value);">
                	<option class="svak" value="0">Velg institusjon</option>
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
						<option value='$hent_institusjon_id'"; if($hent_institusjon_id == $post_institusjon_id){print" selected='selected'";} print">$hent_institusjon_navn ($hent_institusjon_ar_fra-$hent_institusjon_ar_til)</option>";							
					}
					?>
                </select>
            </td>
        </tr>
    	<tr>
        	<td>
            	<select name="studiear" id="studiear" class="<?php if(empty($post_studiear)){print" svak";} ?>" onchange="skift_farge_studiear(this.value);">
                    <option value="0" class="svak">Velg &aring;r</option>
                    <?php
					$hent_fyrste_ar_sporring = mysql_query("SELECT DokumentStudiearFra FROM dokumenter ORDER BY DokumentStudiearFra LIMIT 1");
					$hent_fyrste_ar_array = mysql_fetch_array($hent_fyrste_ar_sporring);
						$hent_fyrste_ar = $hent_fyrste_ar_array['DokumentStudiearFra'];
					
					$hent_siste_ar_sporring = mysql_query("SELECT DokumentStudiearTil FROM dokumenter ORDER BY DokumentStudiearTil DESC LIMIT 1");
					$hent_siste_ar_array = mysql_fetch_array($hent_siste_ar_sporring);
						$hent_siste_ar = $hent_siste_ar_array['DokumentStudiearTil'];
					
					$teller = $hent_siste_ar;
					while($teller >= $hent_fyrste_ar){
						print"
						<option value='$teller''"; if($teller == $post_studiear){print" selected='selected'";} print">$teller</option>";
						$teller --;
					}
					?> 
                </select>
            </td>
        </tr>
		<?php /*
        <tr>
        	<td>
            	<select name="avdeling" id="avdeling" class="sok<?php if(empty($post_avdeling_id)){print" svak";} ?>" onchange="skift_farge_avdeling(this.value);">
                    <option value="0" class="svak">Velg avdeling</option>
                     <?php 
                    $hent_avdelinger_sporring = mysql_query("SELECT * FROM avdelinger INNER JOIN institusjoner ON AvdelingInstitusjonID = InstitusjonID ORDER BY AvdelingNavn");
                    while($hent_avdelinger_array = mysql_fetch_array($hent_avdelinger_sporring)){
                        $hent_avdeling_id = $hent_avdelinger_array['AvdelingID'];
                        $hent_avdeling_navn = $hent_avdelinger_array['AvdelingNavn'];
                        $hent_institusjon_forkortelse = $hent_avdelinger_array['InstitusjonForkortelse'];
                        
                        print"
                        <option value='$hent_avdeling_id'"; if($hent_avdeling_id == $post_avdeling_id){print" selected='selected'";} print">$hent_avdeling_navn ($hent_institusjon_forkortelse)</option>";							
                    }
                    ?>
                </select>
            </td>
        </tr>*/
        ?>
    	<tr>
        	<td>
            	<select name="type" id="type" class="sok<?php if(empty($post_type)){print" svak";} ?>" onchange="skift_farge_type(this.value);">
                	<option value="0" class="svak">Velg dokumenttype</option>
                    <option value="Studiehandbok"<?php if($post_type == "Studiehandbok"){print" selected='selected'";} ?>>Studieh&aring;ndbok</option>
                    <option value="Studieplan"<?php if($post_type == "Studieplan"){print" selected='selected'";} ?>>Studieplan</option>
                    <option value="Fagplan"<?php if($post_type == "Fagplan"){print" selected='selected'";} ?>>Fagplan</option>
                    <option value="Annen plan"<?php if($post_type == "Annen plan"){print" selected='selected'";} ?>>Annen plan</option>
                    <option value="Annet"<?php if($post_type == "Annet"){print" selected='selected'";} ?>>Annet</option>
                </select>
            </td>
        </tr>
        <tr>
        	<td class="luft"><input type="submit" name="sok" value="S&oslash;k" /> &nbsp; <input type="submit" name="nullstill" value="Nullstill s&oslash;k" /></td>
        </tr>
    </table>
    </form>
    <br />
    <?php
	if(isset($_POST['sok']) && $sok == true){
		$sporring = mysql_query($sporring);
		$sporring_antall = mysql_num_rows($sporring);
		if($sok_tomt == false){
			print"<span class='melding'>Du m&aring; &aring; angi minst ett s&oslash;kekriterium.</span>";
		}
		elseif($sok_feil_studiear == true){
			print"<span class='melding'>Du s&oslash;kte p&aring; et studie&aring;r som ligger utenfor den valgte institusjonen.</span>";
		}
		elseif($sok_feil_institusjon == true){
			print"<span class='melding'>Du s&oslash;kte p&aring; en avdeling som ikke tilh&oslash;rer den valgte institusjonen.</span>";
		}
		elseif($sporring_antall == 0){
			print"<span class='melding'>S&oslash;ket gav ingen treff.</span>";
		}
		else{
			print"
			<table class='sok'>";
			/*
				<tr>
					<td class='strong'>Institusjon</td>
					<td class='strong'>Studie&aring;r</td>
					<td class='strong'>Avdeling</td>
					<td class='strong'>Type</td>
					<td class='strong'>Kommentar</td>
					<td class='strong'>Last ned</td>
					<td></td>
				</tr>
				";*/
			while($sok_array = mysql_fetch_array($sporring)){
	
				$sok_hent_institusjon_navn = $sok_array['InstitusjonNavn'];
				$sok_hent_avdeling_navn = $sok_array['AvdelingNavn'];
				$sok_hent_dokument_navn = $sok_array['DokumentNavn'];
				$sok_hent_dokument_studiear_fra = $sok_array['DokumentStudiearFra'];
				$sok_hent_dokument_studiear_til = $sok_array['DokumentStudiearTil'];
				$sok_hent_dokument_type = $sok_array['DokumentType'];
				if($sok_hent_dokument_type == "Studiehandbok"){
					$sok_hent_dokument_type = "Studieh&aring;ndbok";
				}
				$sok_hent_dokument_kommentar = $sok_array['DokumentKommentar'];
				$sok_hent_dokument_storrelse = $sok_array['DokumentStorrelse'];
				
				print"
				<tr class='bakgrunn_1'>
					<td class='luft strong bredde_1'>Institusjon:</td>
					<td class='luft luft_topp bredde_2'>$sok_hent_institusjon_navn</td>
				</tr>
				<tr class='bakgrunn_2'>
					<td class='luft strong'>Studie&aring;r:</td>
					<td class='luft'>$sok_hent_dokument_studiear_fra / $sok_hent_dokument_studiear_til</td>
				</tr>
				<tr class='bakgrunn_1'>
					<td class='luft strong'>Avdeling:</td>
					<td class='luft'>$sok_hent_avdeling_navn</td>
				</tr>
				<tr class='bakgrunn_2'>
					<td class='luft strong'>Type:</td>
					<td class='luft'>$sok_hent_dokument_type</td>
				</tr>
				<tr class='bakgrunn_1'>
					<td class='luft strong'>Kommentar:</td>
					<td class='luft'>$sok_hent_dokument_kommentar</td>
				</tr>
				<tr class='bakgrunn_2'>
					<td class='luft strong border_bottom'>Last ned:</td>
					<td class='luft border_bottom'><a class='sok' href='pdf/$sok_hent_dokument_navn' target='_blank'><img class='pdf' src='img/pdf_icon.gif' /> ($sok_hent_dokument_storrelse MB)</a></td>
				</tr>";
			}
			print"
			</table>";
		}
	}
	?>

</body>
</html>