<html>

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:white;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;color:black;background-color:#e8edff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#669;color:Black;background-color:#b9c9fe;}
.tg .tg-hmp3{background-color:Turquoise; text-align:left;vertical-align:top}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-mb3i{background-color:#D2E4FC;text-align:right;vertical-align:top}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-0lax{background-color:Turquoise; text-align:left;vertical-align:top}

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

</style>

</head>

<body onload="PopulateFields()" style="background-color:Turquoise;">

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
	
	var LeisureActivities = <?php echo json_encode($Activities); ?>;
	
	var CategoryTallies = JSON.parse(sessionStorage.getItem("CategoryTallies"));
	var LocationTallies = JSON.parse(sessionStorage.getItem("LocationTallies"));
	var SocialTallies = JSON.parse(sessionStorage.getItem("SocialTallies"));
	var PhysicalTallies = JSON.parse(sessionStorage.getItem("PhysicalTallies"));
	var MotorSkillTallies = JSON.parse(sessionStorage.getItem("MotorSkillTallies"));
	var EquipmentTallies = JSON.parse(sessionStorage.getItem("EquipmentTallies"));
	var CostTallies = JSON.parse(sessionStorage.getItem("CostTallies"));
	
	var LeftHits = parseInt(sessionStorage.getItem("LeftHits"));
	var RightHits = parseInt(sessionStorage.getItem("RightHits"));
	
	// get results from session storage (put there by mainpage)
	var ChosenActivities = JSON.parse(sessionStorage.getItem("ChosenActivities"));
	
	function CategoryAsString(category) {
		switch (category) {
			case "0":
				retval = "Participation sports";
				break;
			case "1":
				retval = "Spectator sports";
				break;
			case "2":
				retval = "Arts";
				break;
			case "3":
				retval = "Social Activities";
				break;
			case "4":
				retval = "Hobbies";
				break;
			default:
				retval = "invalid attribute";
				break;
		}
		return retval;
	}
	
	function LocationAsString(location) {
		switch (location) {
			case "0":
				retval = "Indoor Activities";
				break;
			case "1":
				retval = "Outdoor Activities";
				break;
			case "2":
				retval = "Home Activities";
				break;
			case "3":
				retval = "Community Activities";
				break;
			default:
				retval = "invalid attribute";
				break;
		}
		return retval;
	}
	
	function SocialAttributesAsString(SocialAttribute) {
		switch (SocialAttribute) {
			case "0":
				retval = "Individual activities";
				break;
			case "1":
				retval = "Small group activities";
				break;
			case "2":
				retval = "Large group activities";
				break;
			default:
				retval = "invalid attribute";
				break;
		}
		return retval;
	}
	
	function PhysicalActivityAsString(PhysicalActivity) {
		switch (PhysicalActivity) {
			case "0":
				retval = "Minimal physical activity required";
				break;
			case "1":
				retval = "Moderate physical activity required";
				break;
			case "2":
				retval = "Maximum physical activity required";
				break;
			default:
				retval = "invalid attribute";
				break;
		}
		return retval;
	}
	
	function MotorSkillAsString(MotorSkillRequired) {
		switch (MotorSkillRequired) {
			case "0":
				retval = "Good fine motor skills";
				break;
			case "1":
				retval = "Fair fine motor skills";
				break;
			case "2":
				retval = "Good gross motor skills";
				break;
			case "3":
				retval = "Fair gross motor skills";
				break;
			default:
				retval = "invalid attribute";
				break;
		}
		return retval;
	}
	
	function EquipmentAsString(Equipment) {
		switch (Equipment) {
			case "0":
				retval = "Minimal equipment";
				break;
			case "1":
				retval = "Moderate equipment";
				break;
			case "2":
				retval = "Maximum equipment";
				break;
			default:
				retval = "invalid attribute";
				break;	
		}
		return retval;
	}
	
	function CostAsString(Cost) {
		switch (Cost) {
			case "0":
				retval = "Minimal cost";
				break;
			case "1":
				retval = "Moderate cost";
				break;
			case "2":
				retval = "Maximum cost";
				break;
			default:
				retval = "invalid attribute";
				break;
		}
		return retval;
	}
	
	function PopulateTable1() {
		var table = document.getElementById("ChosenActivities");
		
		var i;
		for (i = 0; i <= 72; i++) { 
			if (ChosenActivities[i] != 0) {
				var row = table.insertRow(table.rows.length);
		
				var cell1 = row.insertCell(0);
				cell1.className  = "tg-hmp3";
				
				var cell2 = row.insertCell(1);
				cell2.className  = "tg-hmp3";
				
				var cell3 = row.insertCell(2);
				cell3.className  = "tg-hmp3";
				
				var cell4 = row.insertCell(3);
				cell4.className  = "tg-hmp3";
								
				var cell5 = row.insertCell(4);
				cell5.className  = "tg-hmp3";
				
				var cell6 = row.insertCell(5);
				cell6.className  = "tg-hmp3";
				
				var cell7 = row.insertCell(6);
				cell7.className  = "tg-hmp3";
				
				var cell8 = row.insertCell(7);
				cell8.className  = "tg-hmp3";
				
				var cell9 = row.insertCell(8);
				cell9.className  = "tg-hmp3";
				
				cell1.innerHTML = LeisureActivities[i].Name;
				cell2.innerHTML = ChosenActivities[i];
				
				cell3.innerHTML = CategoryAsString(LeisureActivities[i].Category);
				cell4.innerHTML = LocationAsString(LeisureActivities[i].Location);
				cell5.innerHTML = SocialAttributesAsString(LeisureActivities[i].SocialAttributes);
				cell6.innerHTML = PhysicalActivityAsString(LeisureActivities[i].PhysicalActivity);
				cell7.innerHTML = MotorSkillAsString(LeisureActivities[i].MotorSkillRequired);
				cell8.innerHTML = EquipmentAsString(LeisureActivities[i].Equipment);
				cell9.innerHTML = CostAsString(LeisureActivities[i].Cost);
				
				
			}
		}
	}
		
	function PopulateTable2() {
		
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
	
	function PopulateFields() {
		
		if (window.sessionStorage.getItem("ClientName") == null) {
			
			document.getElementById('ClientName').innerText = 'n/a'; 
			document.getElementById('FacilitatorName').innerText = 'n/a'; 
			document.getElementById('AssessmentDate').innerText = 'n/a'; 
			document.getElementById('LeftVsRight').innerText = 'n/a';

		} else {
			
			document.getElementById('ClientName').innerText = JSON.parse(window.sessionStorage.getItem("ClientName"));
			document.getElementById('FacilitatorName').innerText = JSON.parse(window.sessionStorage.getItem("FacilitatorName"));
			document.getElementById('AssessmentDate').innerText = JSON.parse(window.sessionStorage.getItem("TestingDate"));
			
			document.getElementById('LeftVsRight').innerText = LeftHits + " / " + RightHits;
			
		}
		
		if (CategoryTallies == null) {
			
			return;
		};
		
		PopulateTable1();
		PopulateTable2();
		
		var i;
		var total = 0;
		for (i = 0; i <= 72; i++) { 
			if (ChosenActivities[i] != 0) total += 1;
		}
		
		document.getElementById('TotalActivities').innerText = total;
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

<div class="navbar">
  <div class="dropdown">
    <button class="dropbtn" onclick="myFunction()">Assessment
      <i class="fa fa-caret-down"></i>
    </button>
        <div class="dropdown-content" id="myDropdown">
      <a href="pla.php?options=resume">Resume Current Assessment</a>
    </div>
  </div> 
  <a href="results.php">Results</a>
  <a href="matrix.php">Attribute Matrix</a> 
  <a href="https://pdfs.semanticscholar.org/6f00/dce8ca38b1ab63fbce5b87387e6e0ce7453a.pdf" target="_blank">About</a>
</div>

<br>

<H1>Assessment Results</H1>

<br>

<table 

<table class="tg">
  <tr> 
    <td class="tg-0lax">Client Name</td>
	<td id="ClientName" class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-0lax">Facilitator Name</td>
	<td id="FacilitatorName" class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-0lax">Assessment Date</td>
	<td id="AssessmentDate" class="tg-0lax"></td>
  </tr>
  <tr>
    <td class="tg-0lax">Total Activities Selected</td>
	<td id="TotalActivities" class="tg-0lax">0</td>
  </tr>
  
  <tr>
    <td class="tg-0lax"># Left Hits / # Right Hits</td>
	<td id="LeftVsRight" class="tg-0lax">0 / 0</td>
  </tr>
  
</table>

<br>



<H1>Attribute Breakdown</H1>

<table id="AttributeBreakDown1" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Category of Activity</th>
	</tr>
	<tr>
		<td class="tg-hmp3">Participation sports</td>
		<td id="result1" class="tg-0lax">0</td>
	</tr>
	
	<tr>
		<td class="tg-hmp3">Spectator sports</td>
		<td id="result2" class="tg-0lax">0</td>
	<tr>
	
	<tr>
		<td class="tg-hmp3">Arts</td>
		<td id="result3" class="tg-0lax">0</td>
	</tr>
	
	<tr>
		<td class="tg-hmp3">Social Activities</td>
		<td id="result4" class="tg-0lax">0</td>
	</tr>
	
	<tr>
		<td class="tg-hmp3">Hobbies</td>
		<td id="result5" class="tg-0lax">0</td>
	</tr>
</table>

<br>

<table id="AttributeBreakDown5" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Motor Skill Required</th>
	</tr>
	<tr>
		<td class="tg-hmp3">Good fine motor skills</td>
		<td id="result16" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Fair fine motor skills</td>
		<td id="result17" class="tg-0lax">0</td>
	</tr>
		<td class="tg-hmp3">Good gross motor skills</td>
		<td id="result18" class="tg-0lax">0</td>
	<tr>
		<td class="tg-hmp3">Fair gross motor skills</td>
		<td id="result19" class="tg-0lax">0</td>
	</tr>
</table>

<br>

<table id="AttributeBreakDown2" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Location</th>
	</tr>
	<tr>
		<td class="tg-hmp3">Indoor activities</td>
		<td id="result6" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Outdoor activities</td>
		<td id="result7" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Home activities</td>
		<td id="result8" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Community activities</td>	
		<td id="result9" class="tg-0lax">0</td>
	</tr>
</table>

<br>

<table id="AttributeBreakDown6" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Equipment</th>
	</tr>
	<tr>		
		<td class="tg-hmp3">Minimal equipment</td>
		<td id="result20" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Moderate equipment</td>
		<td id="result21" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Maximum equipment</td>
		<td id="result22" class="tg-0lax">0</td>
	</tr>
</table>

<br>

<table id="AttributeBreakDown3" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Social Attributes</th>
	</tr>
	<tr>		
		<td class="tg-hmp3">Individual activities</td>
		<td id="result10" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Small group activities</td>
		<td id="result11" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Large group activities</td>
		<td id="result12" class="tg-0lax">0</td>
	<tr/>
</table>

<br>

<table id="AttributeBreakDown7" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Cost</th>
	</tr>
	<tr>				
		<td class="tg-hmp3">Minimal cost</td>
		<td id="result23" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Moderate cost</td>
		<td id="result24" class="tg-0lax">0</td>
	</tr>
		<td class="tg-hmp3">Maximum cost</td>
		<td id="result25" class="tg-0lax">0</td>
	</tr>
</table>

<br>

<table id="AttributeBreakDown4" class="tg">
	<tr>
		<th class="tg-hmp3" colspan="2">Physical Activity</th>
	</tr>
	<tr>				
		<td class="tg-hmp3">Minimal physical activity</td>
		<td id="result13" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Moderate physical activity</td>
		<td id="result14" class="tg-0lax">0</td>
	</tr>
	<tr>
		<td class="tg-hmp3">Maximum physical activity</td>
		<td id="result15" class="tg-0lax">0</td>
	</tr>
</table>

<br>
	


<H1>List of All Leisure Activities Chosen</H1>

<table id="ChosenActivities" class="tg">
  <tr>
    <td class="tg-hmp3">Name</td>
	<td class="tg-hmp3">Times Selected</td>
    <td class="tg-hmp3">Type of Activity</td>
    <td class="tg-hmp3">Location</td>
    <td class="tg-hmp3">Social Attributes</td>
    <td class="tg-hmp3">Physical Activity</td>
	<td class="tg-hmp3">Motor Skill Required</td>
	<td class="tg-hmp3">Equipment Needed</td>
	<td class="tg-hmp3">Cost</td>
  </tr>
    
</table>

<br>

</body>
</html>