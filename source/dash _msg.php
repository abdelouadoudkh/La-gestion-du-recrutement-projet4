<?php include_once 'include/db.php';
session_start();
if(!isset($_SESSION['monlogin'])) header('location: log.php');



?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css\dash.css">
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
          <a href="dashbord.php" >
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
              <a href="#" class="active">
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


      <div class="sales-boxes">


          <table>
              <caption>Candidats</caption>
              <thead>
              <tr>
                  <th scope="col">Nom complet</th>
                  <th scope="col">message</th>

                  <th scope="col" >action</th>
              </tr>
              </thead>
              <tbody>

               <?php

              $sql_msg = "SELECT nom,prenom,msg  FROM `inscription` WHERE msg!='NULL'";
              $res_msg=mysqli_query($con,$sql_msg);
              while($row_table=mysqli_fetch_assoc($res_msg)) {
                /*  id='divShowHide' */

              echo " 
              <tr id='btnShowHide' style=''>
                  <td  scope='row' data-label='Nom Complet' style=' cursor:context-menu;padding: 15px;'>".$row_table['nom'].'  '.$row_table['prenom'].
                      "</td><td data-label='Email' style='cursor:context-menu; padding: 15px;'>".$row_table['msg'].
                      "</td><td  style='cursor: pointer'  data-label='cv'>".'Action'."</td></tr>";
              }
      ?>
              </tbody>
          </table>
      </div>

        <div class="center">
            <div class="pagination">



            </div>
        </div>



  </section>

  <script>
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
