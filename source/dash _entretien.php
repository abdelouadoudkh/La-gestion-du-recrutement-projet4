<?php session_start();
include_once 'include/db.php';


if(!isset($_SESSION['monlogin'])) header('location: log.php');

$output="";
$query_dash= "SELECT COUNT(*) AS count FROM `inscription`";

$query_num_candidats_today="select COUNT(*) AS TODAY_candidat from inscription where `date_candidature` = CURRENT_DATE()";
$query_msg= "SELECT COUNT(*) AS countmsg FROM `inscription` where msg!='NULL'";


$query_result2 = mysqli_query($con,$query_msg);
while($row_msg=mysqli_fetch_assoc($query_result2)){
    $output2 = $row_msg['countmsg'];
}


$query_result1 = mysqli_query($con,$query_num_candidats_today);
while($row_num_candidat=mysqli_fetch_assoc($query_result1)){
    $output1 = $row_num_candidat['TODAY_candidat'];
}


$query_result = mysqli_query($con,$query_dash);
while($row_candidat=mysqli_fetch_assoc($query_result)){
    $output = $row_candidat['count'];
}
if(isset($_POST['buttonrenitialiser'])) {
    $queryrenitialiser= "UPDATE inscription SET favori=0";
    $queryrenitialiser1= "UPDATE inscription SET  check_mail=0";
    mysqli_query($con,$queryrenitialiser);
    mysqli_query($con,$queryrenitialiser1);

}





if(isset($_POST['buttonmail'])) {
    require 'phpmailer/PHPMailerAutoload.php';
    $tiitre = $_POST['tittre'];
    $dateformat = date("-D. j F Y  G:i ", strtotime($_POST['date']));






    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'rhmail.v1@gmail.com';   //eamil
    $mail->Password = 'Maskoff007';             //mdp

    $mail->setFrom('rhmail.v1@gmail.com');
    $sql_fav = "SELECT * FROM inscription WHERE favori=1 AND check_mail=0";
    $results_fav = mysqli_query($con,$sql_fav);
    if (mysqli_num_rows($results_fav) > 0) {



        $mail->addReplyTo('rhmail.v1@gmail.com');

        while ($there_isfav=mysqli_fetch_assoc($results_fav)) {

            $sql_set = "UPDATE inscription SET check_mail=1 WHERE mail='".$there_isfav['mail']."'";
            mysqli_query($con,$sql_set);
            $mail->addBCC($there_isfav['mail']);

        }


        $mail->isHTML(true);
        $mail->Subject = 'Invitation '.$tiitre.'  '.$dateformat;
        $mail->Body = '<!doctype html>
<html >
<head>    
<style>
  body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
  text-align: left;
  background-color: palegreen;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: left;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
span{
  margin-top: 20px;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
   
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }

    table td:last-child {
        border-bottom: 0;
  }
}
</style>
</head>
<body>
<table>
  <caption>Vous êtes invité(e) à cet événement.</caption>
  <thead>
    <tr>
      <th scope="col">' .$tiitre.'</th> 
      <th scope="col"></th>
     <th scope="col"></th> 
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="">Date</td>
      <td data-label="">'.$dateformat.'</td>
      <td data-label=""></td>
      <td data-label=""></td>
    </tr>
   
   
    
  </tbody>
  
</table>
<p >Veuillez arriver une demi heure avant l\'heure</p></body></html>';

        if($there_isfav['chack_mail']==0){
            $mail->send();
        }









    }
}





?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/dashv2.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="sidebar" id="sidebar1">
    <div class="logo-details">
        <center class="profile">
            <i><img id="myimg" src="image\adm.jpg" alt="" class="hidelogo"></i>
        </center>
        <!--  <span class="logo_name">CodingLab</span>-->
    </div>
    <ul class="nav-links">
        <li>
            <a href="dashbord.php" class="active">
                <i class='bx bx-grid-alt' ></i>
                <span class="links_name">Dashboard</span>
            </a>
        </li>

        <!--
        <li>
          <a href="#">
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li> -->
        <li>
            <a href="dash%20_entretien.php">
                <i class='bx bx-list-ul' ></i>
                <span class="links_name"> Planification</span>
            </a>
        </li>
        <li>
            <a href="dash%20_msg.php">
                <i class='bx bx-message' ></i>
                <span class="links_name">Messages</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2' ></i>
                <span class="links_name">Formation</span>
            </a>
        </li>

        <!-- <li>
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Stock</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Total </span>
          </a>
        </li>-->

        <li>
            <a href="#">
                <i class='bx bx-user' ></i>
                <span class="links_name">Team</span>
            </a>
        </li>

        <li>
            <a href="#">
                <i class='bx bx-heart' ></i>
                <span class="links_name">Favrorites</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog' ></i>
                <span class="links_name">Setting</span>
            </a>
        </li>

    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="sidebar-button" onclick="myFunc()">
            <i class='bx bx-menu sidebarBtn' ></i>
            <!--  <span class="dashboard">Dashboard</span>-->
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <i class='bx bx-search' ></i>
        </div>


        <div class="profile-details add" >

      <span style="padding-right:20px;color:#2697FF">
      <?php
      echo "Bonjour <b>".$_SESSION['monlogin']."</b> !<br>";
      ?>


      </span>
            <a href="logout.php">
                <i class='fa fa-sign-out' ></i>
            </a>
        </div>



    </nav>

    <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">N° Candidats</div>
                    <div class="number">
                        <?php echo $output; ?>
                    </div>
                    <div class="indicator">
                        <!-- <i class='bx bx-up-arrow-alt'></i> -->
                        <!-- <span class="text">Up from yesterday</span> -->
                    </div>
                </div>
                <i class='bx bxs-show cart  '></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Aujourd'hui</div>
                    <div class="number">
                        <?php echo $output1; ?>
                    </div>
                    <div class="indicator">
                        <!-- <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from yesterday</span> -->
                    </div>
                </div>
                <i class='bx bx-plus-medical cart two' ></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Message</div>
                    <div class="number">
                        <?php echo $output2; ?>
                    </div>
                    <div class="indicator">
                        <!-- <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from yesterday</span> -->
                    </div>
                </div>
                <i class='bx bx-rotate-right cart three' ></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Entretien</div>
                    <div class="number">0</div>
                    <div class="indicator">
                        <!-- <i class='bx bx-down-arrow-alt down'></i>
                        <span class="text">Down From Today</span> -->
                    </div>
                </div>
                <i class='bx bx-calendar-event cart four' ></i>
            </div>
        </div>

        <div class="sales-boxes">
            <div class="recent-sales box">





                <table>
                    <form method="post" action="dash%20_entretien.php" enctype="multipart/form-data">
                    <div class="button">
                        <button type="submit"   name="buttonrenitialiser">Réinitialiser</button>
                    </div>
                    </form>
                    <caption>Candidats</caption>
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: left; padding-left: 20px">Nom complet</th>
                        <th scope="col" style="text-align: left; padding-left: 20px"> Email</th>

                    </tr>
                    </thead>
                    <tbody>



                   <?php

                   $sql_favorite = "SELECT nom,prenom,mail,id_candidat  FROM `inscription` WHERE favori='1'";
                   $res_fav=mysqli_query($con,$sql_favorite);
                   while($row_fav=mysqli_fetch_assoc($res_fav)) {

                       $id=$row_fav['id_candidat'];
                       echo "
                   <tr id='btnShowHide' style=''>
                  <td  scope='row' data-label='Nom Complet' style=' cursor:context-menu;text-align: left'>".
                           '<a style="text-decoration:none; padding-right:10px" href="" class="delete" id="del_'.$id.'" > <i class="fa fa-user-times"></i></a>'.
                           $row_fav['nom'].'  '.$row_fav['prenom'].
                           "</td><td data-label='Email' style='cursor:context-menu;text-align: left '>".$row_fav['mail'].
                           "</td></tr>";
                   }

                   ?>
                  <!--
                  <tr>
                       <td scope="row" data-label="Account">0672080945</td>
                       <td data-label="Due Date">03/01/2016</td>
                       <td data-label="Amount">$1,181</td>
                       <td data-label="Period">02/01/2016 - 02/29/2016</td>
                   </tr>
                 -->





                    </tbody>
                </table>


            </div>
            <div class="top-sales box">


                <div class="login-box">
                    <h2>Create event</h2>


                    <form method="post" action="dash%20_entretien.php" enctype="multipart/form-data">
                        <div class="user-box">

                            <input type="text" name="tittre" >
                            <label>Tittre</label>

                        </div>
                        <div class="user-box">
                            <input type="datetime-local" name="date" >
                            <label style="padding-bottom: 10px">date & Time</label>
                        </div>


                        <div class="button">
                            <button type="submit"   name="buttonmail">Envoyer</button>
                        </div>
                    </form>
                </div>









            </div>
        </div>




</section>

<script>



    $(document).ready(function (){

        $(".delete").click(function(){
            var el = this;
            var id = this.id;
            var splited = id.split('_');

            var deleteid=splited[1];


            $.ajax({
                url: 'update.php',
                type: 'POST',
                data: {id_fav: deleteid}

            });

        });

    });







    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
            sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
        }else
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }

    /*hide img*/
    function myFunc() {
        var x = document.getElementById("myimg");
        if (x.style.display === "none") {
            x.style.display = "inline";
        } else {
            x.style.display = "none";
        }
    }



    function col1()
    {
        sidebar = document.querySelector(".sidebar");
        sidebar.style.background="green";
    }

    function myFunctionsee() {
        moreText  = document.querySelector("more");
        moreText.style.display = "inline";

    }




    $(document).ready(function(){
        $("#btnShowHide").click(function(){
            $("#divShowHide").toggle("slow");
        });
    });




</script>

</body>
</html>