<?php

	// MVP esialgne idee: treeningu tulemuste analüüsimine nn. elektrooniline treeningpäevik.
	// Sinna saaksid inimesed endale kasutaja luua ning oma treeningute andmeid sinna sisestada ja neid seal analüüsida (nädala/kuu kokkuvõtted jne).


	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
		$loginEmailError = "";
		$loginPasswordError = "";
	
	// kas epost oli olemas
	if (isset ($_POST["loginEmail"])) {
		
		if (empty ($_POST["loginEmail"])) {
			
			// oli email, kuid see oli tühi
			$loginEmailError = "See väli on kohustuslik!";
			
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
			<input name="loginEmail" type="email"> <?php echo $loginEmailError; ?>
			
			<br><br>
			
			<label>Parool</label><br>
			<input name="loginPassword" type="password"> <?php echo $loginPasswordError; ?>
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
			
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<input name="signupEmail" type="email" placeholder="E-post"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			
			<input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			
			
			<input name="signupYearOfBirth" type="YearOfBirth" placeholder="Sünniaasta"> <?php echo $signupYearOfBirthError; ?>
			
			<br><br>
			
			
			<input name="signupSex" type="Sex" placeholder="Sugu"> <?php echo $signupSexError; ?>
			
			<br><br>
			
			
			<input type="submit" value="Loo kasutaja">
		
		</form>
		
	</body>
	
</html>
