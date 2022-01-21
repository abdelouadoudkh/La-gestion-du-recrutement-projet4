<?php  include_once 'include/inscrire.php';


$msg="";

$f2_nom =  isset($_POST['s_nom']) ? $_POST['s_nom'] : NULL;
$f2_passwd = isset($_POST['s_passwd']) ? $_POST['s_passwd'] : NULL;


$query="SELECT * FROM login WHERE nom='$f2_nom' and mdp='$f2_passwd'";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);


if( isset($_POST['submitt2']) && ($count==""))
{
   $msg = "Nom ou mot de passe incorrect";



}else if(isset($_POST['submitt2']) && $count>0 ) {
    session_start();
    $_SESSION['monlogin'] = $f2_nom;
header('Location:dashbord.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Login</title>
  <link rel="stylesheet" href="css/style_login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





</head>
<body>

  <div class="container" id="container">
  	<div class="form-container sign-up-container">
  		<form action="include/inscrire.php" method="POST">
  			<h1 class="small1" style="color: #4169e1">Créer un compte</h1><br>


                <input type="text" placeholder="Nom" name="nom"  id="nam" >
            <span id="span1" style="color: red; "></span>


            <input type="mail" placeholder="Email" name="mail" id="email">
            <span id="span2" style="color: red ;  "></span>
  			<input type="password" placeholder="Mot de passe" name="mdp1" id="passwd1" id="myInput1">
            <span id="span3" style="color: red ; "></span>
        <input type="password" placeholder="Confirmé mot de passe" name="mdp2"  id="passwd2" >
            <span class="base_l"> <input type="checkbox"  style="width: 30px"  onclick="Fction1()"> Afficher le mot de passe </span>
            <span id="span4" style="color: red ; padding-bottom: 5px"></span>
			<button  name="inscrire" id="submit1">S'inscrire</button>
			<a ><span style="color: black">déjà inscrit ?</span> <span id="signIn" style="color:#4169e1; cursor:pointer;"> s'identifier </span> </a>

  		</form>
  	</div>



  	<div class="form-container sign-in-container">
  		<form  action="log.php" method="POST">
  			<h1 style="color:#4169e1; "> S'identifier</h1>

            <span style="color:red"> <?php echo "$msg"; ?></span>
  			<input type="text" placeholder="Nom"  id="nom1" name="s_nom">
            <span id="span5" style="color: red ; "></span>

            <input type="password" placeholder="Mot de passe"  id="myInput" name="s_passwd">
            <span id="span6" style="color: red ; "></span>
             <span class="base_l"> <input type="checkbox"  style="width: 30px"  onclick="Fction()"> Afficher le mot de passe </span>

                <a href="forget_passwd.php" style="color:#4169e1; cursor:pointer;"  data-target="#myModal">Mot de passe oublié?</a>

  			<button id="submit2" name="submitt2">S'identifier</button>
			<a ><span style="color: black">Pas encore membre ?</span>  <sapn id="signUp" style="color:#4169e1; cursor:pointer;"> s'inscrire maintenant!  </sapn></a>

  		</form>
  	</div>


<!--
  	<div class="overlay-container">
  		<div class="overlay">
  			<div class="overlay-panel overlay-left">
  				<h1>Content de te revoir!</h1>
  				<p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles</p>
  				<button class="ghost" id="signIn">Sign In</button>
  			</div>


  			<div class="overlay-panel overlay-right">



  			</div>
  		</div>
  	</div>-->
  </div>

<script>

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');

    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });


    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });



    $(document).ready(function(){
        $("#submit1").click(function(){
            var nam = $("#nam").val();
            var mail = $("#email").val();
            var passwd1 = $("#passwd1").val();
            var passwd2 = $("#passwd2").val();

            if(nam.length== ""   )
            {
                $("#span1").text("Entrez votre nom");
                $("#nam").focus();
                return false;

            }
            else if(mail.length== ""){
                $("#span2").text("Entrez votre email");
            $("#email").focus();
            return false;

            }
            else if(passwd1.length== ""){
                $("#span3").text("Entrez votre  mot de passe");
                $("#passwd1").focus();
                return false;

            }
            else if(passwd2.length== ""){

                $("#span4").text("Confirmer votre mot de passe");
                $("#passwd2").focus();
                return false;
            }
            else if(passwd1 !== passwd2){

                $("#span4").text("le mot de passe de confirmation ne correspond pas");
                $("#passwd2").focus();
                return false;
            }


        });
    });


    $(document).ready(function(){
        $("#submit2").click(function(){

            var nom1 = $("#nom1").val();
            var m_dp = $("#myInput").val();

            if(nom1.length== "")
            {
                $("#span5").text("Entrez votre nom");
                $("#nom1").focus();
                return false;

            }

            else if(m_dp.length== ""){

                $("#span6").text("Entrez votre mot de passe");
                $("#myInput").focus();
                return false;
            }


        });
    });







    function Fction() {
        var x = document.getElementById("myInput");

        if (x.type === "password" ) {
            x.type = "text";

        } else {
            x.type = "password";

        }


    }
    function Fction1() {

        var x1 = document.getElementById("passwd1");
        var x2 = document.getElementById("passwd2");
        if (x1.type === "password") {
            x1.type = "text";

        } else {
            x1.type = "password";

        }
        if (x2.type === "password") {
            x2.type = "text";

        } else {
            x2.type = "password";

        }

    }

</script>


</body>
</html>

