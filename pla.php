<html>

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
.tg .tg-hmp3{background-color:#D2E4FC;text-align:left;vertical-align:top}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-mb3i{background-color:#D2E4FC;text-align:right;vertical-align:top}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-0lax{text-align:left;vertical-align:top}

img:hover {
    opacity: 0.5;
    filter: alpha(opacity=75); /* For IE8 and earlier */
}

.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    cursor: pointer;
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}

input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button.begin {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div.newAssessment {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

</style>

</head>

<body onload="DoneLoading()" style="background-color:Turquoise;">

<?php

class LeisureActivity {
	
	var $Number;
	var $Name;
	var $PicFileName;
	var $Category;
	var $Location;
	var $SocialAttributes;
	var $PhysicalActivity;
	var $MotorSkillRequired;
	var $Equipment;
	var $Cost;
	
}

$myfile = fopen("leisure.ini", "r") or die("Internal Error - Unable to open data file!");

$Activities = array();
$count = 0;

function GetValue($str, $key) { 
	$retval = '';
	$pos = strpos($str, $key);
	$retval = substr($str, $pos + strlen($key) + 1);
	return trim($retval);
}

while(!feof($myfile)) {
		
	$ActivityNum = 0;
	$tmpline = fgets($myfile);
	
	if (strpos($tmpline, '[Activity') !== false) {
		//$tmppos = strpos($tmpline, '[Activity');
		
		$tmpline = fgets($myfile);
				
		if (strpos($tmpline, 'Active=True') !== false) {
			$Activity =  new LeisureActivity();
			
			$Activity->Number = $count;
			$Activity->Name = GetValue(fgets($myfile), "Name");
			$Activity->PicFileName = GetValue(fgets($myfile), "PicFileName");
			$Activity->Category = GetValue(fgets($myfile), "Catagory");								// spelling error in original .INI file
			$Activity->Location = GetValue(fgets($myfile), "Location");
			$Activity->SocialAttributes = GetValue(fgets($myfile), "SocialAttributes");
			$Activity->PhysicalActivity = GetValue(fgets($myfile), "PhysicalActivity");
			$Activity->MotorSkillRequired = GetValue(fgets($myfile), "MotorSkillRequired");
			$Activity->Equipment = GetValue(fgets($myfile), "Equipment");
			$Activity->Cost = GetValue(fgets($myfile), "Cost");
			
			$Activities[$count] = $Activity;
			$count = $count + 1;
						
		}
		
	}
}
	
fclose($myfile);
?>  

<script>

	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(e) {
	  if (!e.target.matches('.dropbtn')) {
		var myDropdown = document.getElementById("myDropdown");
		  if (myDropdown.classList.contains('show')) {
			myDropdown.classList.remove('show');
		  }
	  }
	}

	function ScatterTallies() {
		
		document.getElementById('result1').innerText = CategoryTallies[0];
		document.getElementById('result2').innerText = CategoryTallies[1];
		document.getElementById('result3').innerText = CategoryTallies[2];
		document.getElementById('result4').innerText = CategoryTallies[3];
		document.getElementById('result5').innerText = CategoryTallies[4];
		
		document.getElementById('result6').innerText = LocationTallies[0];
		document.getElementById('result7').innerText = LocationTallies[1];
		document.getElementById('result8').innerText = LocationTallies[2];
		document.getElementById('result9').innerText = LocationTallies[3];
		
		document.getElementById('result10').innerText = SocialTallies[0];
		document.getElementById('result11').innerText = SocialTallies[1];
		document.getElementById('result12').innerText = SocialTallies[2];
		
		document.getElementById('result13').innerText = PhysicalTallies[0];
		document.getElementById('result14').innerText = PhysicalTallies[1];
		document.getElementById('result15').innerText = PhysicalTallies[2];

		document.getElementById('result16').innerText = MotorSkillTallies[0];
		document.getElementById('result17').innerText = MotorSkillTallies[1];
		document.getElementById('result18').innerText = MotorSkillTallies[2];
		document.getElementById('result19').innerText = MotorSkillTallies[3];
		
		document.getElementById('result20').innerText = EquipmentTallies[0];
		document.getElementById('result21').innerText = EquipmentTallies[1];
		document.getElementById('result22').innerText = EquipmentTallies[2];
		
		document.getElementById('result23').innerText = CostTallies[0];
		document.getElementById('result24').innerText = CostTallies[1];
		document.getElementById('result25').innerText = CostTallies[2];
	}

	function UpdateStats(WhichPic) {

		var PictureIndex;
		
		if (WhichPic == 1) {
			PictureIndex = Picture1Index;
			LeftHits += 1;
		} else {
			PictureIndex = Picture2Index;
			RightHits += 1;
		}
		
		CategoryTallies[LeisureActivities[PictureIndex].Category] += 1;
		LocationTallies[LeisureActivities[PictureIndex].Location] += 1;
		SocialTallies[LeisureActivities[PictureIndex].SocialAttributes] += 1;
		PhysicalTallies[LeisureActivities[PictureIndex].PhysicalActivity] += 1;
		MotorSkillTallies[LeisureActivities[PictureIndex].MotorSkillRequired] += 1;
		EquipmentTallies[LeisureActivities[PictureIndex].Equipment] += 1;
		CostTallies[LeisureActivities[PictureIndex].Cost] += 1;
		
		window.sessionStorage.setItem("CategoryTallies", JSON.stringify(CategoryTallies));
		window.sessionStorage.setItem("LocationTallies", JSON.stringify(LocationTallies));
		window.sessionStorage.setItem("SocialTallies", JSON.stringify(SocialTallies));
		window.sessionStorage.setItem("PhysicalTallies", JSON.stringify(PhysicalTallies));
		window.sessionStorage.setItem("MotorSkillTallies", JSON.stringify(MotorSkillTallies));
		window.sessionStorage.setItem("EquipmentTallies", JSON.stringify(EquipmentTallies));
		window.sessionStorage.setItem("CostTallies", JSON.stringify(CostTallies));
		
		// keep track of how many times the user selected the activity
		ChosenActivities[LeisureActivities[PictureIndex].Number] += 1;
		window.sessionStorage.setItem("ChosenActivities", JSON.stringify(ChosenActivities));
		
		window.sessionStorage.setItem("LeftHits", LeftHits);
		window.sessionStorage.setItem("RightHits", RightHits);

		// give them two new cards
		RandomCards();
	}

	function TestIt(WhichPic) {
		
		var PictureIndex;
		if (WhichPic == 1) PictureIndex = Picture1Index; else PictureIndex = Picture2Index;
		
		alert(LeisureActivities[PictureIndex].Name);
	}
	
	function RandomCards() {
		
		theIndex1 = Math.floor((Math.random()*LeisureActivities.length));		
		theIndex2 = Math.floor((Math.random()*LeisureActivities.length));
		
		// make sure not to have any duplicates...
		while (theIndex2 == theIndex1) {
			theIndex2 = Math.floor((Math.random()*22));
		}
		
		Picture1Index = theIndex1;
		Picture2Index = theIndex2;
		
		document.getElementById('label1').innerText = LeisureActivities[Picture1Index].Name;
		document.getElementById('pic1').src = 'pics/' + LeisureActivities[Picture1Index].PicFileName;
		
		document.getElementById('label2').innerText = LeisureActivities[Picture2Index].Name;
		document.getElementById('pic2').src = 'pics/' + LeisureActivities[Picture2Index].PicFileName;

	}
	
	var LeisureActivities = <?php echo json_encode($Activities); ?>;
	
	var ClientName;
	var FacilitatorName;
	var TestingDate;
	
	var CategoryTallies;
	var LocationTallies;
	var SocialTallies;
	var PhysicalTallies;
	var MotorSkillTallies;
	var EquipmentTallies;
	var CostTallies;
	
	var ChosenActivities = [];	
	
	var LeftHits;
	var RightHits;
	var ShouldRestart;
	
	function download(filename, text) {
	  var element = document.createElement('a');
	  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
	  element.setAttribute('download', filename);

	  element.style.display = 'none';
	  document.body.appendChild(element);

	  element.click();

	  document.body.removeChild(element);
	}
	
	function DoneLoading() { 
	
		document.getElementById('myFile').addEventListener('change', readSingleFile, false); 
	
		ShouldRestart = (window.location.search.indexOf('resume')== -1);
		ShouldRestart = ShouldRestart || (window.sessionStorage.getItem("ClientName") == null);
	
		if (ShouldRestart) {
		
			// start with no activities selected...
			sessionStorage.clear();
			
			ChosenActivities = [];
		
			var i;
			for (i = 0; i <= 72; i++) { 
				ChosenActivities[i] = 0;
			}
			
			CategoryTallies = [0,0,0,0,0];
			LocationTallies = [0,0,0,0];
			SocialTallies = [0,0,0,0,0];
			PhysicalTallies = [0,0,0];
			MotorSkillTallies = [0,0,0,0];
			EquipmentTallies = [0,0,0];
			CostTallies = [0,0,0];
			
			LeftHits = 0;
			RightHits = 0;
			
			window.sessionStorage.setItem("CategoryTallies", JSON.stringify(CategoryTallies));
			window.sessionStorage.setItem("LocationTallies", JSON.stringify(LocationTallies));
			window.sessionStorage.setItem("SocialTallies", JSON.stringify(SocialTallies));
			window.sessionStorage.setItem("PhysicalTallies", JSON.stringify(PhysicalTallies));
			window.sessionStorage.setItem("MotorSkillTallies", JSON.stringify(MotorSkillTallies));
			window.sessionStorage.setItem("EquipmentTallies", JSON.stringify(EquipmentTallies));
			window.sessionStorage.setItem("CostTallies", JSON.stringify(CostTallies));
			window.sessionStorage.setItem("ChosenActivities", JSON.stringify(ChosenActivities));
							
			document.getElementById("newAssessment").style.display = "block";
			document.getElementById("pictures").style.display = "none";
			document.getElementById("ShowSavedAssessments").style.display = "none";

			
		} else {
			
			CategoryTallies = JSON.parse(sessionStorage.getItem("CategoryTallies"));
			LocationTallies = JSON.parse(sessionStorage.getItem("LocationTallies"));
			SocialTallies = JSON.parse(sessionStorage.getItem("SocialTallies"));
			PhysicalTallies = JSON.parse(sessionStorage.getItem("PhysicalTallies"));
			MotorSkillTallies = JSON.parse(sessionStorage.getItem("MotorSkillTallies"));
			EquipmentTallies = JSON.parse(sessionStorage.getItem("EquipmentTallies"));
			CostTallies = JSON.parse(sessionStorage.getItem("CostTallies"));
			ChosenActivities = JSON.parse(sessionStorage.getItem("ChosenActivities"));
			
			LeftHits = parseInt(sessionStorage.getItem("LeftHits"));
			RightHits = parseInt(sessionStorage.getItem("RightHits"));
		
			document.getElementById("newAssessment").style.display = "none";
			document.getElementById("pictures").style.display = "block";
				
		}
	}
	
	function doSave() {
		
		var FileName = "";
		FileName = prompt("Please enter name to save this assessment to:");
		
		var Str = "";
		
		Str +="client=" + JSON.stringify(ClientName);
		Str +="&facilitator=" + JSON.stringify(FacilitatorName);
		Str +="&date=" + JSON.stringify(TestingDate);
		Str +="&CategoryTallies=" + JSON.stringify(CategoryTallies);
		Str +="&LocationTallies=" + JSON.stringify(LocationTallies);
		Str +="&SocialTallies=" + JSON.stringify(SocialTallies);
		Str +="&PhysicalTallies=" + JSON.stringify(PhysicalTallies);
		Str +="&MotorSkillTallies=" + JSON.stringify(MotorSkillTallies);
		Str +="&EquipmentTallies=" + JSON.stringify(EquipmentTallies);
		Str +="&CostTallies=" + JSON.stringify(CostTallies);
		Str +="&ChosenActivities=" + JSON.stringify(ChosenActivities);
		Str +="&LeftHits=" + JSON.stringify(LeftHits);
		Str +="&RightHits=" + JSON.stringify(RightHits);
		Str +="&";
				
		if (FileName != "") 
			download(FileName + '.lass', Str);
				
	}
	
	function GetValue(input, key) {
		var retval;
		var x;
		var y;
		var z;
		
		x = input.substring(input.indexOf(key));
		y = x.substring(0, x.indexOf("&"));
		z = y.substring(y.indexOf("=")+1);
	
		return z;
	}
	
	function readSingleFile(evt) {
    //Retrieve the first (and only!) File from the FileList object
    var f = evt.target.files[0]; 

    if (f) {
      var r = new FileReader();
      r.onload = function(e) { 
	      var contents = e.target.result;
        /*
		alert( "Got the file.n" 
              +"name: " + f.name + "n"
              +"type: " + f.type + "n"
              +"size: " + f.size + " bytesn"
              + "starts with: " + contents.substr(1, contents.indexOf("n"))
		 );  */
			ClientName = JSON.parse(GetValue(contents, "client"));
			FacilitatorName = JSON.parse(GetValue(contents, "facilitator"));
			TestingDate = JSON.parse(GetValue(contents, "date"));
			CategoryTallies = JSON.parse(GetValue(contents, "CategoryTallies"));
			LocationTallies = JSON.parse(GetValue(contents, "LocationTallies"));
			SocialTallies = JSON.parse(GetValue(contents, "SocialTallies"));
			PhysicalTallies = JSON.parse(GetValue(contents, "PhysicalTallies"));
			MotorSkillTallies = JSON.parse(GetValue(contents, "MotorSkillTallies"));
			EquipmentTallies = JSON.parse(GetValue(contents, "EquipmentTallies"));
			CostTallies = JSON.parse(GetValue(contents, "CostTallies"));
			ChosenActivities = JSON.parse(GetValue(contents, "ChosenActivities"));
			LeftHits = JSON.parse(GetValue(contents, "LeftHits"));
			RightHits = JSON.parse(GetValue(contents, "RightHits"));
			
			window.sessionStorage.setItem("ClientName", JSON.stringify(ClientName));
			window.sessionStorage.setItem("FacilitatorName", JSON.stringify(FacilitatorName));
			window.sessionStorage.setItem("TestingDate", JSON.stringify(TestingDate));
			window.sessionStorage.setItem("CategoryTallies", JSON.stringify(CategoryTallies));
			window.sessionStorage.setItem("LocationTallies", JSON.stringify(LocationTallies));
			window.sessionStorage.setItem("SocialTallies", JSON.stringify(SocialTallies));
			window.sessionStorage.setItem("PhysicalTallies", JSON.stringify(PhysicalTallies));
			window.sessionStorage.setItem("MotorSkillTallies", JSON.stringify(MotorSkillTallies));
			window.sessionStorage.setItem("EquipmentTallies", JSON.stringify(EquipmentTallies));
			window.sessionStorage.setItem("CostTallies", JSON.stringify(CostTallies));
			window.sessionStorage.setItem("ChosenActivities", JSON.stringify(ChosenActivities));
			window.sessionStorage.setItem("LeftHits", LeftHits);
			window.sessionStorage.setItem("RightHits", RightHits);

			alert('Data Loaded Successfully');
			
			// pick up where we left off
			window.location.assign('pla.php?options=resume');
		
			//
			
      }
      r.readAsText(f);
    } else { 
      //alert("Failed to load file");
    }
  }
	
	function doLoad() {
		document.getElementById("myFile").click();
	}
	
	function LoadSavedAssessment() { 
		var x = document.getElementById("myFile");
		
	}
	
	function BeginNewAssessment() {
		
		// grab the data off the form
		
		ClientName = document.getElementById("client").value;
		FacilitatorName = document.getElementById("facilitator").value;
		
		if ( (ClientName.trim() == "") || (FacilitatorName.trim() == "") ) {
			alert('Please enter both client and facilitator name');
			return
		}
	
		var today = new Date();
		TestingDate = today.toLocaleDateString("en-US");
		
		// start with no activities selected...
		sessionStorage.clear();
		
		window.sessionStorage.setItem("ClientName", JSON.stringify(ClientName));
		window.sessionStorage.setItem("FacilitatorName", JSON.stringify(FacilitatorName));
		window.sessionStorage.setItem("TestingDate", JSON.stringify(TestingDate));
		window.sessionStorage.setItem("LeftHits", 0);
		window.sessionStorage.setItem("RightHits", 0);
		window.sessionStorage.setItem("CategoryTallies", JSON.stringify(CategoryTallies));
		window.sessionStorage.setItem("LocationTallies", JSON.stringify(LocationTallies));
		window.sessionStorage.setItem("SocialTallies", JSON.stringify(SocialTallies));
		window.sessionStorage.setItem("PhysicalTallies", JSON.stringify(PhysicalTallies));
		window.sessionStorage.setItem("MotorSkillTallies", JSON.stringify(MotorSkillTallies));
		window.sessionStorage.setItem("EquipmentTallies", JSON.stringify(EquipmentTallies));
		window.sessionStorage.setItem("CostTallies", JSON.stringify(CostTallies));
		window.sessionStorage.setItem("ChosenActivities", JSON.stringify(ChosenActivities));
	
		// and show the pictures	
		
		document.getElementById("ShowSavedAssessments").style.display = "none";
		document.getElementById("newAssessment").style.display = "none";
		document.getElementById("pictures").style.display = "block";
		
	}
	
<?php 


	$rand_keys = array_rand($Activities, 2);
	$Activity1 = $Activities[$rand_keys[0]];
	$Activity2 = $Activities[$rand_keys[1]];
	
	echo 'var Picture1Index = ' . $rand_keys[0] . ';';
	echo 'var Picture2Index = ' . $rand_keys[1] . ';';
	
?>

</script>

<H1>
Preferences for Leisure Attributes (PLA) Assessment
</H1>

<div style="display:none">
<input accept=".lass" type="file" id="myFile">
</div>

<div class="navbar">
  <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Assessment
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="myDropdown">
	  <a href="pla.php">Begin New Assessment</a>
	  <a href="javascript:doSave();">Save</a>
	  <a href="javascript:doLoad();">Load</a>
    </div>
  </div> 
  <a href="results.php">Results</a>
  <a href="matrix.php">Attribute Matrix</a>
  <a href="https://pdfs.semanticscholar.org/6f00/dce8ca38b1ab63fbce5b87387e6e0ce7453a.pdf" target="_blank">About</a>  
</div>

<br>

<div style="display:none" id="pictures" >

<center>



<table class="">
    
<?php 
		
	echo '<tr>';
	echo '<td>';
	echo '<img onclick="UpdateStats(1);" id="pic1" src="pics/' . $Activity1->PicFileName . '"/>';
	echo '</td>';
	echo '<td>';
	echo '<img  onclick="UpdateStats(2);" id="pic2" src="pics/' . $Activity2->PicFileName . '"/>';
	echo '</td>';
	echo '</tr>';
	
	
	echo '<tr>';
	echo '<td>';
	echo '&nbsp';
	echo '</td>';
	echo '<td>';
	echo '&nbsp';
	echo '</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td id="label1" style="font-weight: bold; text-align:center" >';
	echo $Activity1->Name;
	echo '</td>';
	
	echo '<td id="label2" style="font-weight: bold; text-align:center" >';
	echo $Activity2->Name;
	echo '</td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td colspan="2" id="label3" style="font-weight: bold; text-align:center" >';
	echo '<button onclick="RandomCards();" class="begin" type="button">Neither</button>';
	echo '</td>';
	echo '</tr>';

  
?>
  
 </table>
 
<br>

</center>

</div>

<div style="display:none" id ="newAssessment" class="newAssessment">
	<h2>New Assessment</h2>
	<label for="fname">Client Name</label>
    <input type="text" id="client" name="Client Name" >

    <label for="lname">Facilitator Name</label>
    <input type="text" id="facilitator" name="Facilitator Name" >
	<p>
	<button onclick="BeginNewAssessment()" class="begin" type="button">Begin</button>
</div>

<div style="display:none" id="ShowSavedAssessments">

  <table class="tg" id='items_table' border=1>
    <tr>
		<th>Index</th>
		<th>Client</th>
		<th>Facilitator</th>
		<th>Date</th>
		<th></th>
	</tr>
  </table>
	
</div>
  
</body>
</html>