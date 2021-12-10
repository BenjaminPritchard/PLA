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

<body style="background-color:Turquoise;">

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

</script>


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
	
	function CategoryAsString() {
		switch ($this->Category) {
			case 0:
				$retval = "Participation sports";
				break;
			case 1:
				$retval = "Spectator sports";
				break;
			case 2:
				$retval = "Arts";
				break;
			case 3:
				$retval = "Social Activities";
				break;
			case 4:
				$retval = "Hobbies";
				break;
			default:
				$retval = "<invalid attribute>";
				break;
		}
		return $retval;
	}
	
	function LocationAsString() {
		switch ($this->Location) {
			case 0:
				$retval = "Indoor Activities";
				break;
			case 1:
				$retval = "Outdoor Activities";
				break;
			case 2:
				$retval = "Home Activities";
				break;
			case 3:
				$retval = "Community Activities";
				break;
			default:
				$retval = "<invalid attribute>";
				break;
		}
		return $retval;
	}
	
	function SocialAttributesAsString() {
		switch ($this->SocialAttributes) {
			case 0:
				$retval = "Individual activities";
				break;
			case 1:
				$retval = "Small group activities";
				break;
			case 2:
				$retval = "Large group activities";
				break;
			default:
				$retval = "<invalid attribute>";
				break;
		}
		return $retval;
	}
	
	function PhysicalActivityAsString() {
		switch ($this->PhysicalActivity) {
			case 0:
				$retval = "Minimal physical activity required";
				break;
			case 1:
				$retval = "Moderate physical activity required";
				break;
			case 2:
				$retval = "Maximum physical activity required";
				break;
			default:
				$retval = "<invalid attribute>";
				break;
		}
		return $retval;
	}
	
	function MotorSkillAsString() {
		switch ($this->MotorSkillRequired) {
			case 0:
				$retval = "Good fine motor skills";
				break;
			case 1:
				$retval = "Fair fine motor skills";
				break;
			case 2:
				$retval = "Good gross motor skills";
				break;
			case 3:
				$retval = "Fair gross motor skills";
				break;
			default:
				$retval = "<invalid attribute>";
				break;
		}
		return $retval;
	}
	
	function EquipmentAsString() {
		switch ($this->Equipment) {
			case 0:
				$retval = "Minimal equipment";
				break;
			case 1:
				$retval = "Moderate equipment";
				break;
			case 2:
				$retval = "Maximum equipment";
				break;
			default:
				$retval = "<invalid attribute>";
				break;	
		}
		return $retval;
	}
	
	function CostAsString() {
		switch ($this->Cost) {
			case 0:
				$retval = "Minimal cost";
				break;
			case 1:
				$retval = "Moderate cost";
				break;
			case 2:
				$retval = "Maximum cost";
				break;
			default:
				$retval = "<invalid attribute>";
				break;
		}
		return $retval;
	}
	
}

$myfile = fopen("leisure.ini", "r") or die("Internal Error - Unable to open file!");

$Activities = array();
$count = 0;

function GetValue($str, $key) { 
	$retval = '';
	$pos = strpos($str, $key);
	$retval = substr($str, $pos + strlen($key) + 1);
	return $retval;
}

while(!feof($myfile)) {
	
	// if line contains [Activity
	// then print out the activity number_format
	
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

<table class="tg">
  <tr>
	<td class="tg-hmp3">Index</td>
    <td class="tg-hmp3">Name</td>
    <td class="tg-hmp3">Picture</td>
    <td class="tg-hmp3">Type of Activity</td>
    <td class="tg-hmp3">Location</td>
    <td class="tg-hmp3">Social Attributes</td>
    <td class="tg-hmp3">Physical Activity</td>
	<td class="tg-hmp3">Motor Skill Required</td>
	<td class="tg-hmp3">Equipment Needed</td>
	<td class="tg-hmp3">Cost</td>
  </tr>
  
<?php

function ToLink($str) {
	return '<a href="' . 'pics/' . $str . '">' . $str . '</a>';
}

foreach ($Activities as &$Activity) {
	
	echo '<tr>';

	echo '<td class="tg-0lax">' . $Activity->Number . '</td>';
	echo '<td class="tg-0lax">' . $Activity->Name . '</td>';
	echo '<td class="tg-0lax">' . ToLink($Activity->PicFileName) . '</td>';
	echo '<td class="tg-0lax">' . $Activity->CategoryAsString() . '</td>';
	echo '<td class="tg-0lax">' . $Activity->LocationAsString() . '</td>';
	echo '<td class="tg-0lax">' . $Activity->SocialAttributesAsString() . '</td>';
	echo '<td class="tg-0lax">' . $Activity->PhysicalActivityAsString() . '</td>';	
	echo '<td class="tg-0lax">' . $Activity->MotorSkillAsString() . '</td>';
	echo '<td class="tg-0lax">' . $Activity->EquipmentAsString() . '</td>';
	echo '<td class="tg-0lax">' . $Activity->CostAsString() . '</td>';
	
	echo '</tr>';
	
}

?>

</table>  


</html>