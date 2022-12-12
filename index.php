<?php

    
//	// Connexion à la base de données

try {
    $db = new PDO('mysql:host=mysql-securiday2023.alwaysdata.net;dbname=securiday2023_participants;charset=utf8', '289142', 'Securidayedition2023!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    $civiliteError = $firstnameError  = $nameError  = $mailError = $situationError = $etablissementError = $participer = $conferences = $challenges = $firstname  = $name  = $mail = $situation = $etablissement= "";

    if(!empty($_POST))
    {
        $conferences        = checkInput($_POST['conferences']);
		$challenges         = checkInput($_POST['challenges']);
        $firstname     	  	= checkInput($_POST['firstname']);
        $name            	= checkInput($_POST['name']);
        $mail         		= checkInput($_POST['mail']);
        $situation          = checkInput($_POST['situation']);
        $etablissement      = checkInput($_POST['etablissement']);
        $isSuccess          = true;
   
		
		
		
        
        if(empty($conferences) AND empty($challenges) )
        {
            $civiliteError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
       
	   
        if(empty($name))
        {
            $nameError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($mail))
        {
            $mailError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($situation))
        {
            $situationError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
		
		 if(empty($etablissement))
        {
            $etablissementError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
       
	   
switch (true) {
		case ( !empty( $conferences) AND empty( $challenges)):
        $participer="Conférences";
        break;
    	case ( empty( $conferences) AND !empty( $challenges)):
        $participer="Challenges";
        break;		
		case ( !empty( $conferences) AND !empty( $challenges)):
        $participer="Conférences et challenges";
        break;
}


switch ($situation) {
    	case "1":
        $situation="Professionnel(le)";
        break;
    	case "2":
        $situation="Etudiant(e)";
        break;
		
		case "3":
       $situation="Universitaire";
        break;
}
        
        if($isSuccess)
        {
            
            $statement = $db->prepare("INSERT INTO participants (participer,prenom,nom,mail,situation,etablissement,date) VALUES(?, ?, ?, ?, ?, ?,?)");
            $statement->execute(array($participer,$firstname,$name,$mail,$situation, $etablissement, $date));
			echo "<h3 color = #FF0001> <b>Votre inscription a bien été enregistrée.</b> </h3>";  
            
        }
        
    }


    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Securiday</title>
<link rel="stylesheet" type="text/css" href="design/css/default.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://fr.allfont.net/allfont.css?fonts=crete-round" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



<script type="text/javascript">

function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}

	function affichage1() {

						
    alert("Votre inscription a été bien enregistrée");
    
}

</script>





</head>

<body data-spy="scroll" data-target=".navbar" data-offset="60">

<header>
<div class="wrapper">
<h1><img src="securiday/edition23.png"></h1>
<nav>
<ul>
<li><a href="Securiday.jpg">Affiche</a></li>
<li><a href="#conferences">Conférences</a></li>
<li><a href="#challenges">Challenges</a></li>
<li><a href="#inscription">Inscription</a></li>
<li><a href="#sponsors">Sponsors</a></li>
</ul>
</nav>
</div>
</header>


<section id="main-image" style="background-image: url(securiday/sec.jpg);">
<div class="wrapper">


</div>


</section>

<section id="conferences">
<div class="wrapper">
<center>
<h3> Conférences</h3>
</br>
<h1>  Le 24/01/2023  </h1>
</br>
<h2>  De 09h à 12h </h2>
</center>
</br>
</br>
</div>
</section>


<section id="challenges">
<center>
<h3> Challenges</h3>
</br>

<h1>  Le 24/01/2023 </h1>
</br>
<h2>  De 14h à 18h </h2>

</center>
</br>
</br>
</div>
</section>



<section id="inscription">

<div class="blue-divider"> </div>

<div class="heading">
<h3>Inscription</h3>
</div>

<div class="container">

<div class="row">



    <div class="col-lg-10 col-lg-offset-1">
                    <form id="contact-form" method="POST" action="" role="form" enctype="multipart/form-data">
                        <div class="row">
                      
                           
                            <center><div>
                            <label> Souhaitez-vous participer aux : <span class="blue">*</span> </label></br></br>
                            <input type="checkbox" name="conferences" value="conferences" id="conferences">
                              <label for="conferences">Conférences</label>
                            <input type="checkbox" name="challenges" value="challenges" id="challenges">
                              <label for="challenges">Challenges</label>  
                              </br>
                            <span class="help-inline"><?php echo $civiliteError; ?></span>                        
                          </div>
                          </br>
                          </center>    
                                              
						
                                                  
                            <div class="col-md-6">
                                <label for="firstname">Prénom </label>
                                <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Votre prénom">
                                <span class="help-inline"></span>
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Nom <span class="blue">*</span></label>
                                <input id="name" type="text" name="name" class="form-control" placeholder="Votre nom">
                                <span class="help-inline"><?php echo $nameError; ?></span>
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="mail">Email <span class="blue">*</span></label>
                                <input id="mail" type="text" name="mail" class="form-control" placeholder="Votre adresse courriel">
                                <span class="help-inline"><?php echo $mailError; ?></span>
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-6">
                                <label for="situation">Votre situation</label><span class="blue">*</span>
                                <select id="situation" name="situation" class="form-control" placeholder="Votre situation">
								<option value="">-- Situation--</option>
                                <option value="1">Professionnel(le)</option>
								<option value="2">Etudiant(e) </option>
								<option value="3">Universitaire </option>  
								</select>
                                <?php echo $situationError; ?></span>
                                
                                
                                
                                <span class="help-inline"></span>

                                <p class="comments"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="etablissement">Votre établissement <span class="blue">*</span></label>
                                <textarea id="etablissement" name="etablissement" class="form-control" placeholder="Votre établissement" rows="4"></textarea>
                                <span class="help-inline"><?php echo $etablissementError; ?></span>
                                <p class="comments"></p>
                            </div>
                            <div class="col-md-12">
                                <p class="blue"><strong>* Ces information sont nécessaires!</strong></p>
                            </div>
                            <div class="col-md-12">
                         
                         
                          <input type="submit" class="buttoncontact" value="Valider" onclick="myFunction()">
                         
                         
			 
                          </div>
                          
           
                             
                             
                            </div>    
                        </div>
                    </form>
                    
                    
   
  
                    
                </div>


</div>
</div>
</section>


<section id="sponsors">
<div class="container">
<center>
<h3> Sponsors</h3>
</br>
</br>

<div class="row">

<center>
<div id="moncarousel" class="carousel slide" data-ride="carousel" style= "width:600px;">

<ol class="carousel-indicators">
<li data-target="#moncarousel" data-slide-to="0" class="active"></li>
<li data-target="#moncarousel" data-slide-to="1"></li>
<li data-target="#moncarousel" data-slide-to="2"></li>
<li data-target="#moncarousel" data-slide-to="3"></li>

</ol>

<div class="carousel-inner" role="listbox">



<div class="item active">
<img src="capgemini.png">
</div>




<div class="item">
<img src="lyon2.png">
</div>


<div class="item">
<img src="icom re.jpg">
</div>


<div class="item">
<img src="dis.jpg">
</div>


</div>



<a href="#moncarousel" class="left carousel-control" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
</a>

<a href="#moncarousel" class="right carousel-control" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
</a>

</div>

</div>

</center>
</div>
</section>



<section id="contact">
<div class="wrapper">
<h3>Retrouvez-nous</h3>
<center>



<form action="https://www.facebook.com/SecuriDay2023">

<button class="fa fa-facebook"> </button> 
<a href="mailto:securiday2023@gmail.com" class="fa fa-google"></a> 
</form>
</center>

</div>
</section>




<footer>
<div class="wrapper">
<h1>SECURIDAY</h1>
<div class="copy"> COPYRIGHT © 2023 SECURIDAY </div>

</div>
</footer>

</body>
</html>

