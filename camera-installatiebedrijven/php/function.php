<?php

function login(){
	include'connect.php';

	//start session.
	session_start();

	//kijk of er een post is.
	if(isset($_POST['inloggen'])){
		//stop de posts in variables
		$ww = mysqli_real_escape_string($con,$_POST['ww']);
		$email = mysqli_real_escape_string($con,$_POST['email']);

		//kijk of de velden niet leeg zijn.
		if($ww == "" || $email == ""){
			echo "Een van de velden is niet ingevult probeer het nog eens.";
			header("refresh:4;url=login");
		}
		elseif ($email == "admin@wwm.nl"){

			$sql = "SELECT * FROM admin WHERE email = '".$email."' AND wachtwoord = '".$ww."'";

			/*$stmt = $con->prepare("SELECT * FROM admin WHERE email = ? AND wachtwoord = ?");
			$stmt->bind_param('ss', $email, $ww);
			$stmt->execute();*/

			$result = mysqli_query($con, $sql);
			if ($row = $result->fetch_array(MYSQLI_ASSOC)){
				//zet bedrijfsnaam en id in een session.
				$_SESSION["admin_id"] = $row['id'];

				header('Location:admin');
			}
		}
		else{
			//query om het id, de naam, email en wachtwoord te selecteren waar het ingevulde email en wachtwoord gelijk is aan wat er in de database staat.

			$sql = "SELECT * FROM bedrijf WHERE email = '".$email."' AND wachtwoord = '".$ww."'";
			/*$stmt = $con->prepare("SELECT id, naam, email, wachtwoord FROM bedrijf WHERE email = ? AND wachtwoord =? ");
			//geeft de parameters mee
			$stmt->bind_param('ss',$email, $ww);
			$stmt->execute();*/

			$result = mysqli_query($con, $sql);

			if ($row = $result->fetch_array(MYSQLI_ASSOC)){
				$active = $row['active'];
				if($active == "1"){
					//zet bedrijfsnaam en id in een session.
					$_SESSION["bedrijf_id"] = $row['id'];
					$_SESSION["bedrijf_naam"] = $row['naam'];
					header('Location:home');
				}
				else{
					echo "<script> alert('uw account is nog niet geactiveerd. Zolang u uw account niet heeft geactiveerd is het niet mogelijk om in te loggen')</script>";
					header("refresh:1;url=home");
				}
			}
			else{
				//bij foute inlog gegevens geef een fout melding.
				echo "De gegevens komen niet overeen.",'<br>',"probeer het opnieuw.",'<br>';
				return false;
			}
		}
	}
	mysqli_close($con);
}
function loguit(){

	//maak de sessions leeg, zodat de gebruiker niet meer is ingelogd.
	unset ($_SESSION['bedrijf_id']);
	unset ($_SESSION['bedrijf_naam']);
	unset ($_SESSION['admin_id']);

	session_start();
	session_unset();
	session_destroy();
}
function change_login(){
	//Deze functie zorgt ervoor dat als iemand is ingelogd dat de login in de navigatie veranderd in loguit.
	//check eerst of de sessions leeg zijn zo ja zet in de nav bar login.
	if($_SESSION["bedrijf_id"] =="" && $_SESSION['admin_id'] == ""){
		echo'<ul class="nav navbar-nav navbar-right">
        	<li><a href="login" style="top:5px;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      		</ul>';
	}
	else{
		//anders maak er loguit van.
		echo'<ul class="nav navbar-nav navbar-right">
        	<li><a href="loguit" style="top:5px;"><span class="glyphicon glyphicon-log-in"></span> Loguit</a></li>
      		</ul>';
	}
}
function change_aanmelden(){

	//Deze functie zorgt ervoor dat als iemand is ingelogd dat de aanmelden in de navigatie veranderd in account.
	//check eerst of de sessions leeg zijn zo ja zet in de nav bar aanmelden.
	if($_SESSION["bedrijf_id"]== "" && $_SESSION['admin_id'] == ""){
		echo'<ul class="nav navbar-nav navbar-right">
        <li><a href="aanmelden"><span class="glyphicon glyphicon-user" style="padding-top:6px;"></span> Aanmelden</a></li>
      	</ul>';
	}
	//als er ingelogd word als admin
	elseif($_SESSION['admin_id'] == "1" && $_SESSION["bedrijf_id"] == ""){
		echo'<ul class="nav navbar-nav navbar-right">
        <li><a href="admin"><span class="glyphicon glyphicon-user" style="padding-top:6px;"></span> Admin</a></li>
      	</ul>';
	}
	else{
		//anders maak er acount van.
		echo'<ul class="nav navbar-nav navbar-right">
        <li><a href="account"><span class="glyphicon glyphicon-user" style="padding-top:6px;"></span> Account</a></li>
      	</ul>';
	}
}
function sendmail_bedrijf($naam, $email, $randomString){
	$to      = $email; //email adres van het pas aangemelde bedrijf
	$subject = "Activeer uw account op Camera-installatiebedrijven.nl"; //onderwerp
	$message = 'Beste '.$naam.'.
	'."\r\n".'Bedankt voor het aanmaken van een account op: camera-installatiebedrijven.nl. In deze mail vind u een link om uw account te activeren. 
	'."\r\n".'http://www.camera-installatiebedrijven.nl/verify.php?email='.$email.'&code='.$randomString.'
	'."\r\n".'Met vriendelijke groet,
	'."\r\n".'Camera-installatiebedrijven.nl'; //standaard mail voor activatie mail.
                     
	$headers = 'From:info@camera-installatiebedrijven.nl' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email
}
function sendmail($mail, $onderwerp, $bericht, $name, $mailuser){
	$to 	 = $mail;
	$subject = $onderwerp;
	$message = 'Er is een nieuw bericht van '.$name.'. ('.$mailuser.')'
	."\r\n". $bericht;

	$headers = $mailuser;
	mail($to, $subject, $message, $headers);
}
function aanmelden(){

	include'connect.php';

	if(isset($_POST['aanmelden'])){
		// zet alle inputs in en variable.
		$naam = mysqli_real_escape_string($con,$_POST['naam']);
		$adres = mysqli_real_escape_string($con,$_POST['adres']);
		$plaats = mysqli_real_escape_string($con,$_POST['plaats']);
		$postcode = mysqli_real_escape_string($con,$_POST['postcode']);
		$land = mysqli_real_escape_string($con,$_POST['land']);
		$telefoon = mysqli_real_escape_string($con,$_POST['telefoon']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$website = mysqli_real_escape_string($con,$_POST['website']);
		$wachtwoord = mysqli_real_escape_string($con,$_POST['wachtwoord']);
		$img = $_FILES['logo'] ['name'];
		$image_tmp_name = $_FILES['logo'] ['tmp_name'];
		$beschrijving = mysqli_real_escape_string($con,$_POST['beschrijving']);
		
		//controlleer of de verplichte velden wel ingevuld zijn.
		if($naam == ""||$adres == ""||$plaats == ""||$postcode == ""||$land == ""||$telefoon == ""||$email == ""||$wachtwoord == ""||$beschrijving == ""){
			echo "<p>Niet alle verplichte velden zijn ingevuld.</p>";
		}
		else{

			//query om alle emails te selecteren in de database.
			$sql = "SELECT email FROM bedrijf";
			/*$stmt1 = $con->prepare("SELECT email FROM bedrijf");
			$stmt1->execute();*/

			$check = mysqli_query($con, $sql);
			if ($check_row = $check->fetch_array(MYSQLI_ASSOC)){
				$mail_check = $check_row['email'];
			}	//controleer of het ingevulde email niet al bestaat
				if($email == $mail_check){
					echo "het email adres dat u heeft ingevuld is al in gebruik. probeer een andere";
					header("refresh:4;url=aanmelden");
				}
				else{
					//maak een activatie code.
					$length = "30";
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    			$charactersLength = strlen($characters);
	    			$randomString = '';
	    			for ($i = 0; $i < $length; $i++) {
	        			$randomString .= $characters[rand(0, $charactersLength - 1)];
	    			}

					//verplaats het plaatje naar de img map
					$result = move_uploaded_file($image_tmp_name, "img/logo/");

					//check of het de afbeelding is verplaats naar de map.
					if(!$result){
						echo "Oeps er ging iets mis bij het uploaden.";
					}
					exit;

					//path maken voor het plaatje
					$image = "img/logo/$img";
					//zet voor alle ingevulde websites http://
					$http = "http://$website";


					//insert alles in de database 
					$sql = "INSERT INTO bedrijf (naam, adres, plaats, postcode, land, telefoon, email, code, website, wachtwoord, logo, beschrijving)
						VALUES('$naam','$adres','$plaats','$postcode','$land','$telefoon','$email','$randomString','$http','$wachtwoord','$image','$beschrijving')";

					/*$stmt = $con->prepare("INSERT INTO bedrijf (naam, adres, plaats, postcode, land, telefoon, email, website, wachtwoord, logo, beschrijving) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
					$stmt->bind_param('sssssssssss',$naam, $adres, $plaats, $postcode, $land, $telefoon, $email, $http, $wachtwoord, $image, $beschrijving);
					$stmt->execute();*/

					if (!mysqli_query($con,$sql)) {
						die('Error: '. mysqli_error($con));
					} 
					else{
						//mail opstellen met activatie code voor de gebruiker.
						sendmail_bedrijf($naam, $email, $randomString);

						header("Location: succesvol_aanmelden.php");
					}
				}
		mysqli_close($con);
		}
	}
}
function getCurlData($url){

	//codes voor de recaptcha 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	$curlData = curl_exec($curl);
	curl_close($curl);
	return $curlData;
}
function bedrijf(){
	//met deze functie laten we 4 bedrijven per pagina zien. ook word hier de pagination aan gemaakt.
	include'connect.php';	
		$page = $_GET["page"];
			
		if ($page == "" || $page == "1")
		{
		$page1 = 0;
		}
		else 
		{
			$page1=($page*4)-4;  
		}

		$sql ="SELECT id, naam, logo, telefoon, email, website, beschrijving FROM bedrijf WHERE active = 1 LIMIT $page1,4";
		/*$stmt = $con->prepare("SELECT id, naam, logo, telefoon, email, website, beschrijving FROM bedrijf LIMIT $page1,4");
		$stmt->execute();*/

		$result = mysqli_query($con, $sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo'<div class="col-sm-5">';
				echo'<h4>'.$naam = $row['naam'].'</h4>';
				echo'<a href="bedrijf?id='.$id = $row['id'].'"><img class="img-responsive" src="'.$logo = $row['logo'].'" style="display:initial!important;"/></a>';
				echo'<br>';
				echo'<br>';
				echo'<p>'.$beschrijving = $row['beschrijving'].'</p>';
				echo'<br>';
				echo'</div>';
			}
		} 
		else{
			echo "0 results";
		}
		
		$sql1 =("SELECT * FROM bedrijf WHERE active = 1");
		$result = $con->query($sql1);

		/*$stmt1 = $con->prepare("SELECT * FROM bedrijf");
		$stmt1->execute();

		$result = $stmt1->get_result();*/
		
		$rowcount = $result->num_rows;
		$a = $rowcount/4;  /* AANTAL RESULTATEN PER PAGINA */
		$a = ceil($a);
		
		echo '<ul class="pagination pagination-sm pagi">';
		
		/* PIJLTJE OM PAGINA TERUG TE GAAN ALS ER MEERDERE PAGINA'S ZIJN*/		
			if ($page > 1) {
					echo '<li>';
					echo '<a href="bedrijven?';   /* URL FOR RESULTAAT PAGINA */
					echo 'page=';
					echo $page - 1;
					echo '"style="color:black!important;"><</a>';
					echo '</li>';
				}	
			/* ALLE ANDERE PAGINA'S */
			for ($b=1;$b<=$a;$b++) {
					echo '<li>';					
					echo '<a href="bedrijven?';
					echo 'page=';
					echo $b;
					echo '"';
					
				
				/* CURRENT PAGE CHECKEN (niet vergeten classes aan te maken) */
				
				if ($b==$page){
					echo 'class="currentpage" style="color:black!important;"';
				} 
				
				else {
					echo 'class="page" style="color:black!important;"';
				} 
				
				echo'>';
				echo $b." ";
				echo '</a>';
				
						
				/* CHECK OF ER MEERDERE PAGINA'S ZIJN */
				if ($b > 1) {
					$multiplepages = 'True';
				}		
				
				else {
					$multiplepages = 'False';
				}
				
			$singlepage[$b] = $b;
			
			}
					
			$lastpage = end($singlepage);
			
			/* PIJLTJE NAAR VOLGENDE PAGINA LATEN ZIEN ALS ER MEERDERE PAGINA's ZIJN EN ALS JE NIET OP LAATSTE PAGE ZIT */
			
			if ($page > 1 && $page != $lastpage) {
				echo '<a href="bedrijven?'; 
				echo 'page=';
				echo $page + 1;
				echo '"style="color:black!important;">></a>';
			}		
		
			if ($b = ($page -1) || $multiplepages == 'False') {
					
				}
			
			else { 
				echo '<a href="bedrijven?';
				echo 'page=';
				echo $page + 1;
				echo '"style="color:black!important;">></a>';
				echo '</li>';
			}
				
			echo '</div>';	
			
		$con->close();
}
function admin_bedrijf(){
	include'connect.php';

	//met deze functie laat ik alle bedrijven in een select zien op de admin page.
	$sql="SELECT * FROM bedrijf";

	$result = mysqli_query($con, $sql);

	while($row = $result->fetch_assoc()){
 
    	echo'<option value="'. $row ['id'] . '">'.$row ['naam']. '</option>';
	}
	$con->close(); 
}
function del_bedrijf(){
	include'connect.php';

	if(isset($_POST['verwijder'])){

		//neem het geselecteerde id.
		$id = mysqli_real_escape_string($con, $_POST['select']);

		//verwijder het bedrijf met dat id.
		$sql = "DELETE FROM bedrijf WHERE id = '".$id."'";

		//error
		if (!mysqli_query($con,$sql)) {
			die('Error: '. mysqli_error($con));
		} 
		else{
			echo "<script> alert ('sucessvol verwijderd')</script>";
			header("refresh:1;url=admin");
		}
	}
	$con->close();
}
function index(){

	include'connect.php';
	//selecteer 4 bedrijven voor op de home pagina.

	$sql = "SELECT naam, logo, beschrijving FROM bedrijf WHERE active = 1 LIMIT 2";
	/*$stmt = $con->prepare("SELECT naam, logo, beschrijving FROM bedrijf LIMIT 2");
	$stmt->execute();*/
	$result = mysqli_query($con, $sql);
	// voor elk bedrijf schrijf de naam, logo en beschrijving weg naar het scherm.
	while($row = $result->fetch_assoc()) {
		echo'<div class="col-sm-4">';
		echo'<h4>'.$naam = $row['naam'].'</h4>';
		echo'<img class="img-responsive" src="'.$logo = $row['logo'].'" style="display:initial!important;"/>';
		echo'<p>'.$beschrijving = $row['beschrijving'].'</p>';
		echo'<br>';
		echo'</div>';
	}
	$con->close(); 
}
function account(){
	//deze functie maakt het mogelijk om een account te wijzigen.
	include'connect.php';
	//pakt het id uit de session
	$id = $_SESSION['bedrijf_id'];

	//maak een selecteer query die alles selecteer waar het id gelijk is aan $id.
	$sql = "SELECT * FROM bedrijf WHERE id = '".$id."'";

	/*$stmt = $con->prepare("SELECT * FROM bedrijf WHERE id = ?");
	$stmt->bind_param("i",$id);
	$stmt->execute();*/

	$result = mysqli_query($con, $sql);
	//alle inputs met de gegevens uit de databse.
	if($row = $result->fetch_assoc()){
		echo'<form method="POST" action="#" enctype="multipart/form-data">';
		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="naam" value="'.$naam = $row['naam'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="adres" value="'.$adres = $row['adres'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="plaats" value="'.$plaats = $row['plaats'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="postcode" value="'.$postcode = $row['postcode'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="land" value="'.$land = $row['land'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="telefoon" value="'.$telefoon = $row['telefoon'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="email" value="'.$email = $row['email'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="website" value="'.$website = $row['website'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<input class="form-control" type="text" name="naam" value="'.$naam = $row['naam'].'">';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<div class="well">';
		echo'<p style="color:black!important;">uw huidige beschrijving</p><hr>';
		echo'<p style="color:black!important;">'.$beschrijving = $row['beschrijving'].'</p>';
		echo'</div>';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
		echo'<textarea class="form-control" type="text" name="beschrijving" placeholder="wijzig uw huidige beschrijving hier!"></textarea>';
		echo'<br>';
		echo'</div>';

		echo'<div class="col-sm-4">';
        echo'<input class="btn btn-default" type="submit" name="wijzig" value="wijzig">';
        echo'</div>';

        echo'</form>';
	}
	$con->close();
}
function update(){

	include'connect.php';

	if(isset($_POST['wijzig'])){
		$id = $_SESSION['bedrijf_id'];

		$naam = mysqli_real_escape_string($con,$_POST['naam']);
		$adres = mysqli_real_escape_string($con,$_POST['adres']);
		$plaats = mysqli_real_escape_string($con,$_POST['plaats']);
		$postcode = mysqli_real_escape_string($con,$_POST['postcode']);
		$land = mysqli_real_escape_string($con,$_POST['land']);
		$telefoon = mysqli_real_escape_string($con,$_POST['telefoon']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$website = mysqli_real_escape_string($con,$_POST['website']);
		$beschrijving = mysqli_real_escape_string($con,$_POST['beschrijving']);
		//wanneer beschrijving niet leeg is moet beschrijving ook geupdate worden.
		if($beschrijving !== ""){

			$sql = "UPDATE bedrijf SET naam = '".$naam."', adres = '".$adres."', plaats = '".$plaats."', postcode = '".$postcode."', land = '".$land."',
				telefoon = '".$telefoon."', email = '".$email."', website = '".$website."', beschrijving = '".$beschrijving."' WHERE id = '".$id."'";

			/*$stmt = $con->prepare("UPDATE bedrijf SET naam = ?, adres = ?, plaats = ?, postcode = ?, land = ?, telefoon = ?, email = ?, website = ?, beschrijving = ? where id = ?");
			$stmt->bind_param("sssssssssi",$naam, $adres, $plaats, $postcode, $land, $telefoon, $email, $website, $beschrijving, $id);
			$stmt->execute();*/

			if (!mysqli_query($con,$sql)) {
				die('Error: '. mysqli_error($con));
			} 
			else{
				echo "<script> alert ('sucessvol bewerkt')</script>";
				header("refresh:1;url=home");
			}
		}//wanneer beschrijving leeg is moet er geupdate worden zonder dat beschrijving word geupdate.
		elseif($beschrijving == ""){

			$sql = "UPDATE bedrijf SET naam = '".$naam."', adres = '".$adres."', plaats = '".$plaats."', postcode = '".$postcode."', land = '".$land."',
				telefoon = '".$telefoon."', email = '".$email."', website = '".$website."' WHERE id = '".$id."'";

			/*$stmt1 = $con->prepare("UPDATE bedrijf SET naam = ?, adres = ?, plaats = ?, postcode = ?, land = ?, telefoon = ?, email = ?, website = ? where id = ?");
			$stmt1->bind_param("ssssssssi",$naam, $adres, $plaats, $postcode, $land, $telefoon, $email, $website, $id);
			$stmt1->execute();*/

			if (!mysqli_query($con,$sql)) {
				die('Error: '. mysqli_error($con));
			} 
			else{
				echo "<script> alert ('sucessvol bewerkt')</script>";
				header("refresh:1;url=home");
			}
		}
		else{
			echo"Oeps foutje";
		}
	}
	$con->close();
}
function wachtwoord(){
	//wachtwoord wijzigen functie.
	include'connect.php';
	if(isset($_POST['wachtwoord'])){
		$huidig = mysqli_real_escape_string($con,$_POST['h-ww']);
		$n1 = mysqli_real_escape_string($con,$_POST['ww']);
		$n2 = mysqli_real_escape_string($con,$_POST['2ww']);

		//als nieuw wachtwoord en niet wachtwoord herhalen gelijk zijn.
		if($n1 == $n2){

			$id = $_SESSION['bedrijf_id'];

			//selecteer het wachtwoord van het ingelogde id
			$sql = "SELECT wachtwoord FROM bedrijf WHERE id = '".$id."'";

			/*$stmt = $con->prepare("SELECT wachtwoord FROM bedrijf WHERE id = ?");
			$stmt->bind_param("i",$id);
			$stmt->execute();*/

			$result = mysqli_query($con, $sql);
			if ($row = $result->fetch_array(MYSQLI_ASSOC)){
				$d_ww = $row['wachtwoord'];
			}
			// als het huidige wachtwoord gelijk is aan het wachtwoord wat in de database staat update het wachtwoord met het nieuwe wachtwoord.
			if($huidig == $d_ww){
				$sql = "UPDATE bedrijf SET wachtwoord = '".$n1."' WHERE id = '".$id."'";

				/*$stmt1 = $con->prepare("UPDATE bedrijf SET wachtwoord = ? WHERE id = ?");
				$stmt1->bind_param("si",$n1,$id);
				$stmt1->execute();*/

				echo "<script> alert ('sucessvol bewerkt')</script>";
				header("refresh:1;url=login");
			}
			else{//zo niet error
				echo'uw huidige wachtwoord komt niet overeen. Probeer het nog eens.';
			}
		}
		else{//zo niet error
			echo'De twee nieuwe wachtwoorden komen niet overeen. Probeer het nog eens.';
		}
	}
}
function bedrijfdetail(){
	include'connect.php';

	//pak het id uit de url
	$id = $_GET['id'];

	//query waar je op het id dat je uit de url heb gehaald selecteert.
	$sql = "SELECT * FROM bedrijf WHERE id = '".$id."'";

	/*$stmt = $con->prepare("SELECT * FROM bedrijf WHERE id = ?");
	$stmt->bind_param("i",$id);
	$stmt->execute();*/

	$result = mysqli_query($con, $sql);

	//show alle informatie van dat bedrijf.
	if($row = $result->fetch_assoc()){
		echo '<img class="img-responsive" src="'.$logo = $row['logo'].'" style="display:initial!important;"/>';
		echo '<br>';
		echo '<h4>'.$naam = $row['naam'].'</h4>';
		echo '<hr>';
		echo '<p>Adres:</p><p>'.$adres = $row['adres'].'</p>';
		echo '<hr>';
		echo '<p>Plaats:</p><p>'.$plaats = $row['plaats'].'</p>';
		echo '<hr>';
		echo '<p>Postcode:</p><p>'.$postcode = $row['postcode'].'</p>';
		echo '<hr>';
		echo '<p>land:</p><p>'.$land = $row['land'].'</p>';
		echo '<hr>';
		echo '<p>telefoon:</p><p>'.$telefoon = $row['telefoon'].'</p>';
		echo '<hr>';
		echo '<p>email:</p><p>'.$email = $row['email'].'</p>';
		echo '<hr>';
		echo '<p>website:</p><a href="'.$website = $row['website'].'"><p>'.$website = $row['website'].'</p></a>';
		echo '<hr>';
		echo '<p>beschrijving:</p><p>'.$beschrijving = $row['beschrijving'].'</p>';
		echo '<hr>';
	}
	$con->close();
}
function admin(){

	//check of de persoon die ingelogd is het admin id heeft
	if($_SESSION['admin_id'] == "1"){

  	}
  	else{
  		//als dit niet zo is, is de admin pagina ook niet beschikbaar
    	header('Location:home');
  	}
}
function nieuwsbericht(){
	// deze functie is er om nieuws berichten op te slaan in de database.
	include'connect.php';
	// kijk of er een post is
	if(isset($_POST['verstuur'])){

		$date = date('Y-m-d');

		$title = mysqli_real_escape_string($con, $_POST['title']);
		$bericht = mysqli_real_escape_string($con, $_POST['bericht']);
		$beschrijving = mysqli_real_escape_string($con, $_POST['beschrijving']);
		$img = $_FILES['plaatje'] ['name'];
		$image_tmp_name = $_FILES['plaatje'] ['tmp_name'];

		//controlleer of deze inputs niet leeg zijn
		if($title == "" || $bericht == "" || $beschrijving == ""){
			echo "Niet alle velden zijn ingevuld. probeer het nogmaals.";
		}
		else{

			//verplaats de img.
			move_uploaded_file($image_tmp_name, "img/logo/$img");
			$image = "img/logo/$img";

			//insert de gegevens in de database.
			$sql = "INSERT INTO nieuws (title, beschrijving, nieuws, plaatje, add_date) VALUES ('$title', '$beschrijving', '$bericht', '$image','$date')";

			/*$stmt = $con->prepare("INSERT INTO nieuws (title, nieuws, plaatje) VALUES(?,?,?)");
			$stmt->bind_param('sss',$title ,$bericht ,$image);*/

			if (!mysqli_query($con,$sql)) {
				die('Error: '. mysqli_error($con));
			} 
			else{
				echo "<script> alert ('sucessvol opgeslagen.')</script>";
				header("refresh:1;url=home");
			}
		}
	}
}
function sidenieuws(){
	include'connect.php';

	//selecteer twee nieuws berichten voor de sidebar gesorteerd op datum.
	$sql = "SELECT id, title FROM nieuws ORDER BY add_date desc LIMIT 2";

	/*$stmt = $con->prepare("SELECT id, title FROM nieuws LIMIT 2");
	$stmt->execute();*/

	$result = mysqli_query($con, $sql);

	//het wegschrijven van de gegevens in de sidebar.
	while($row = $result->fetch_assoc()){
		echo'<a href="http://www.camera-installatiebedrijven.nl/nieuws-bericht?id='.$id = $row['id'].'" 
		style="color:black!important;text-decoration:none!important;">'.$title = $row['title'].'</a><br><hr style="border-top: 1px solid #B5A7C6;">';
	}
	$con->close();
}
function allnieuws(){
	include'connect.php';

	//selecteer de 8 nieuwste nieuwsberichten.

	$sql = "SELECT * FROM nieuws ORDER BY add_date desc LIMIT 8";

	/*$stmt = $con->prepare("SELECT * FROM nieuws LIMIT 8");
	$stmt->execute();*/

	$result = mysqli_query($con, $sql);

	//show alle 8 berichten.
	while($row = $result->fetch_assoc()){
		echo '<div class="block">';
		//echo '<img class="img-responsive nieuws-img" src="'.$plaatje = $row['plaatje'].'" style="display:initial!important; float:left; height:60px;">';
		echo '<a style="text-decoration:none!important;" href="http://www.camera-installatiebedrijven.nl/nieuws-bericht?id='.$id = $row['id'].'"><h3>'.$title = $row['title'].'</h3></a>';
		echo '<p style="font-weight:bold!important;">'.$beschrijving = $row['beschrijving'].'</p>'; 
		echo '<br><br><hr></div>';
	}
}
function nieuwsdetail(){
	include'connect.php';

	$id = $_GET['id'];
	//selecteer een nieuwsbericht met het meegekregen id.
	$sql = "SELECT title, nieuws, beschrijving FROM nieuws WHERE id = '".$id."'";

	/*$stmt = $con->prepare("SELECT title, nieuws FROM nieuws WHERE id = ?");
	$stmt->bind_param('i',$id);
	$stmt->execute();*/

	$result = mysqli_query($con, $sql);

	//laat alle details zien van dit nieuwsbericht.
	if($row = $result->fetch_assoc()){
		echo'<h2>'.$title = $row['title'].'</h2>';
		echo'<hr>';
		echo'<h4 style="font-weight:bold!important;">'.$beschrijving = $row['beschrijving'].'</h4>';
		echo'<br>';
		echo'<p>'.$bericht = $row['nieuws'].'</p>';
	}
}
function contact(){
	if(isset($_POST['verstuur'])){
		//voor het versturen van de email moet eerst de recaptcha ingevuld zijn
		$recaptcha=$_POST['g-recaptcha-response'];
		if(!empty($recaptcha))
		{
			//gegevens recaptcha
			getCurlData();
			$google_url="https://www.google.com/recaptcha/api/siteverify";
			$secret='6LceaRgTAAAAAL98ZI1nCEW-LnN0ad_lj6Ilvx5C';
			$ip=$_SERVER['REMOTE_ADDR'];
			$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
			$res=getCurlData($url);
			$res= json_decode($res, true);
			//reCaptcha success check 
			if($res['success'])
			{
				//variabelen aanmaken voor het versturen van een email
				$name = $_POST['naam'];
				$mailuser = $_POST['email'];
				$bericht = $_POST['bericht'];
				$onderwerp = $_POST['onderwerp'];
				$mail = "kwaiboy1996@hotmail.com";
				sendmail($mail, $onderwerp, $bericht, $name, $mailuser);

				header('Location:succesvol_bericht.php');
			}
			else
			{
				//error handling
				echo '<SCRIPT LANGUAGE="JavaScript">
							window.alert("Je hebt de reCAPTCHA niet ingevuld!");
					  </SCRIPT>';
			}
		}
		else
		{
			//error handling
			echo '<SCRIPT LANGUAGE="JavaScript">
						window.alert("Je hebt de reCAPTCHA niet ingevuld!");
				  </SCRIPT>';
		}
	}
}
function offerte(){
	if(isset($_POST['aanvraag'])){
		//voor het versturen van de email moet eerst de recaptcha ingevuld zijn
		$recaptcha=$_POST['g-recaptcha-response'];
		if(!empty($recaptcha))
		{
			//gegevens recaptcha
			getCurlData();
			$google_url="https://www.google.com/recaptcha/api/siteverify";
			$secret='6LceaRgTAAAAAL98ZI1nCEW-LnN0ad_lj6Ilvx5C';
			$ip=$_SERVER['REMOTE_ADDR'];
			$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
			$res=getCurlData($url);
			$res= json_decode($res, true);
			//reCaptcha success check 
			if($res['success'])
			{
				//variabelen aanmaken voor het versturen van een email
				$name = $_POST['naam'];
				$mailuser = $_POST['email'];
				$bericht = $_POST['bericht'];
				$onderwerp = 'Offerte aanvraag';
				$mail = "kwaiboy1996@hotmail.com";
				sendmail($mail, $onderwerp, $bericht, $name, $mailuser);

				header('Location:succesvol_bericht.php');
			}
			else
			{
				//error handling
				echo '<SCRIPT LANGUAGE="JavaScript">
							window.alert("Je hebt de reCAPTCHA niet ingevuld!");
					  </SCRIPT>';
			}
		}
		else
		{
			//error handling
			echo '<SCRIPT LANGUAGE="JavaScript">
						window.alert("Je hebt de reCAPTCHA niet ingevuld!");
				  </SCRIPT>';
		}
	}
}
function active(){
	include'connect.php';
	//haal de variables uit de url.
	$code = $_GET['code'];
	$mail = $_GET['email'];

	//selecteer de code uit de database met die email
	$sql = "SELECT code FROM bedrijf WHERE email = '".$mail."'";

	$check = mysqli_query($con, $sql);

	if ($row = $check->fetch_array(MYSQLI_ASSOC)){
		$db_code = $row['code'];
	}

	//kijk of de twee codes het zelfde zijn en activeer het account.
	if ($code == $db_code){
		$active = "1";
		$sql = "UPDATE bedrijf SET active = '".$active."' WHERE email = '".$mail."'";

		if (!mysqli_query($con,$sql)){
			die('Error: '. mysqli_error($con));
		} 
		else{
			echo "<script> alert ('uw account is succesvol geactiveerd')</script>";
			header("refresh:1;url=login");
		}
	}
	//error
	else{
		echo "<script> alert ('Fout!')</script>";
		header("refresh:1;url=home");
	}
	$con->close();
}

?>
