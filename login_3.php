<?php

	// võtab ja kopeerib faili sisu
	require ("../../config.php");
	
	// MVP esialgne idee: treeningu tulemuste analüüsimine nn. elektrooniline treeningpäevik.
	// Sinna saaksid inimesed endale kasutaja luua ning oma treeningute andmeid sinna sisestada ja neid seal analüüsida (nädala/kuu kokkuvõtted jne).


	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);  // var_dump näitab muutuja andme tüüpi ja väärtust ehk mis seal sisse on trükitud
	
		// MUUTUJAD
		$loginEmailError = "";
		$loginPasswordError = "";
		$signupEmail = "";
	
	// kas epost oli olemas
	if (isset ($_POST["loginEmail"])) {  // kontrollib, kas keegi vajutas Logi sisse nuppu
		
		if (empty ($_POST["loginEmail"])) {  // kontrollib, kui jäetakse tühi lahter
			
			// oli email, kuid see oli tühi
			$loginEmailError = "See väli on kohustuslik!";
		
		} else {	
			// email on õige, salvestan väärtuse muutujas
			$signupEmail = $_POST["signupEmail"];
			
		}
	}
	
	
	if (isset ($_POST["loginPassword"])) {
		
		if (empty ($_POST["loginPassword"])) {
			
			// oli password, kuid see oli tühi
			$loginPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8 tähemärki peab parool olema
			
			if (strlen($_POST["loginPassword"]) < 8 ) {
				
				$loginPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}
			
		}
		
	}
	
	
	
	
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupYearOfBirthError = "";
	$signupSexError = "";
	
	// kas epost oli olemas
	if (isset ($_POST["signupEmail"])) {
		
		if (empty ($_POST["signupEmail"])) {
			
			// oli email, kuid see oli tühi
			$signupEmailError = "See väli on kohustuslik!";
			
		}
		
	}
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			// oli password, kuid see oli tühi
			$signupPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8 tähemärki peab parool olema
			
			if (strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}
			
		}
		
	}
	
	
	
	
	
		if (isset ($_POST["signupYearOfBirth"])) {
		
		if (empty ($_POST["signupYearOfBirth"])) {
			
			// oli sünniaasta, kuid see oli tühi
			$signupYearOfBirthError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et sünniaasta on ja see ei olnud tühi
			// VÄHEMALT 4 tähemärki peab sünniaasta pikk olema
			
			if (strlen($_POST["signupYearOfBirth"]) < 4 ) {
				
				$signupYearOfBirthError = "Sünniaasta peab olema vähemalt 4 tähemärkki pikk";
				
			}
			
		}
		
	}
	
	
	
		if (isset ($_POST["signupSex"])) {
		
		if (empty ($_POST["signupSex"])) {
			
			// oli sugu, kuid see oli tühi
			$signupSexError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et sugu on ja see ei olnud tühi
			// VÄHEMALT 4 tähemärki peab sünniaasta pikk olema
			
			if (strlen($_POST["signupSex"]) < 4 ) {
				
				$signupSexError = "Sugu peab olema vähemalt 4 tähemärkki pikk";
				
			}
			
		}
		
	}
	
	
	$gender = "male";
	// KUI Tühi
	// $gender = "";
	
	if ( isset ( $_POST["gender"] ) ) {
		if ( empty ( $_POST["gender"] ) ) {
			$genderError = "See väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
	}
	
	
	
	
	// Kus tean et ühtegi viga ei olnud ja saan kasutaja andmed salvestada
	if ( isset($_POST["signupPassword"]) &&
		 isset($_POST["signupEmail"]) &&
		 empty($signupEmailError) && 
		 empty($signupPasswordError)
		) {
		
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "parool ".$_POST["signupPassword"]."<br>";
		echo "räsi ".$password."<br>";
		
		//echo $serverPassword;
		
		
		$database = "if16_Marliis";  //mysql kasutaja
		
		//ühendus
		$mysqli = new mysqli($serverHost,$serverUsername,$serverPassword,$database);
		
		//käsk
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		echo $mysqli->error //selle rea trükin siis, kui mul on siin viga, siis ta näitab selle rea abil, mille kohta täpselt see käib, ta võib näidata ka, et alles real 198 on viga, siis ikka kirjutan siia käsu juurde järgmisele reale 
		
		//asendan küsimärgid väärtustega
		//jutumärkidesse iga muutuja kohta üks täht, mis tüüpi muutuja on
		// s - string
		// i - integer
		// d - double/float ehk komakohaga arv
		$stmt->bind_param("ss", $signupEmail, $password);  //ss tuleb sellest, et VALUES (?, ?) mõlemad küsimärgid on stringid
		
		if($stmt->execute()) {
		
			echo "salvestamine õnnestus";
		} else {
		echo "ERROR ".$stmt->error;
		}
		
	}
		

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email" > <?php echo $loginEmailError; ?>
			
			<br><br>
			
			<label>Parool</label><br>
			<input name="loginPassword" type="password"> <?php echo $loginPasswordError; ?>
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
			
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			 <?php if($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> Mees<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="male" > Mees<br>
			 <?php } ?>
			 
			 <?php if($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> Naine<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="female" > Naine<br>
			 <?php } ?>
			 
			 <?php if($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked> Muu<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="other" > Muu<br>
			 <?php } ?>
			 
			
			<input type="submit" value="Loo kasutaja">
			
			
		</form>
		
	</body>
	
</html>
