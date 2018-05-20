function hent_avdelinger(InstitusjonID) { 
	var selObjAvdeling = document.forms["sthb"].elements["avdeling"];
	var optionAvdeling = document.createElement("option");
	
	var counterAvdeling = 0; 
	// ta bort alle institusjoner
	while (document.sthb.avdeling.length > 1) { 
		document.sthb.avdeling.remove(document.sthb.avdeling.length-1); 
	} 
	// legg til de avdelinger som tilhører institusjonen
	var counterOppforinger = 0;
	for (counterAvdeling = 0; counterAvdeling < arrAvdeling.length; counterAvdeling++) { 
		if (arrAvdeling[counterAvdeling][0] == InstitusjonID) { 
			var myOptionAvdeling = optionAvdeling.cloneNode(false);
			myOptionAvdeling.value = arrAvdeling[counterAvdeling][1];
			myOptionAvdeling.appendChild(document.createTextNode(arrAvdeling[counterAvdeling][2]));
			selObjAvdeling.appendChild(myOptionAvdeling);
			counterOppforinger++;
		} 
	}
	if (InstitusjonID == 0 || counterOppforinger == 0){
		document.getElementById('avdeling').disabled=true;
	}
	else{
		document.getElementById('avdeling').disabled=false;
	}
}

function studiear(ar_fra){
	if(ar_fra > 1500){
		var ar_til = parseInt(ar_fra) + 1;
		document.getElementById('studiear_til').value = ar_til;
	}
	else{
		document.getElementById('studiear_til').value = "";
	}
}

function show_confirm_dokument(dokument_id){
	var r=confirm("Bekreft sletting av dokument.");
	if (r==true)
	  {window.location = "?slett="+dokument_id;}
	else
	  {window.location = "?";}
}

function skift_farge_institusjon(verdi){
	if(verdi > 0){
		document.getElementById('institusjon').style.color = '#000';
	}
	else{
		document.getElementById('institusjon').style.color = '#666';
	}
}
function skift_farge_studiear(verdi){
	if(verdi > 0){
		document.getElementById('studiear').style.color = '#000';
	}
	else{
		document.getElementById('studiear').style.color = '#666';
	}
}
function skift_farge_avdeling(verdi){
	if(verdi > 0){
		document.getElementById('avdeling').style.color = '#000';
	}
	else{
		document.getElementById('avdeling').style.color = '#666';
	}
}
function skift_farge_type(verdi){
	if(verdi != 0){
		document.getElementById('type').style.color = '#000';
	}
	else{
		document.getElementById('type').style.color = '#666';
	}
}