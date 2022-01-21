<?php session_start(); include_once 'include/db.php';

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
          <a href="#" class="active">
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

        <!--here--             -->
     <div class="search-box">
        <input type="text" placeholder="Search..." id="search" name="search">
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
          <i class='bx bx-message cart three' ></i>
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





          <table>
              <caption>Candidats</caption>
              <thead>
              <tr>
                  <th scope="col" style="text-align: left; padding-left: 50px">Nom complet</th>
                  <th scope="col" style="text-align: left; padding-left: 50px">Email</th>
                  <th scope="col">tel</th>
                  <th scope="col" >cv</th>
              </tr>
              </thead>
              <tbody>



              <?php
              $results_per_page=5;


              /*    id='btnShowHide'   id='divShowHide'

   */
              $number_f_page = ceil($output/$results_per_page);
              if(!isset($_GET['page'])){
                  $page=1;
              }else{
                  $page=$_GET['page'];
              }

              $this_page_first_result=($page-1)*$results_per_page;

              $sql_tab = "SELECT *  FROM `inscription` WHERE   nom!='NULL' AND prenom!='NULL'  AND mail!='NULL'  AND tel1!='NULL'  LIMIT ".$this_page_first_result.','.$results_per_page;
             $res=mysqli_query($con,$sql_tab);

              if (mysqli_num_rows($res) > 0){
              while($row_table=mysqli_fetch_array($res)) {

                  $id=$row_table['id_candidat'];
                  $img=base64_encode($row_table['cv']);


                  echo '<tr  id="candidats" style="cursor: pointer">';
                  echo "<td  scope='row'  data-label='Nom Complet' style='cursor: pointer; padding: 15px;text-align: left;'>".

                      '<a style="text-decoration:none; padding-right:10px" href="" class="delete" id="del_'.$id.'" > <i class="fa fa-star-o "></i></a>'.

                      $row_table['nom'].'  '.$row_table['prenom']."</td>";

                  echo "<td data-label='Email' style='padding: 15px;text-align: left;'>".$row_table['mail']."</td>";
                  echo "<td data-label='Telephone'>".$row_table['tel1']."</td>";
                  echo "<td    data-label='cv'>".'<img class="cvteque" alt="sorry" src="data:image/jpg;base64,'.$img.'">'."</td></tr>";





              }}

              ?>


              </tbody>
          </table>



        <div class="center">
            <div class="pagination">

                <?php



                 if($page>1){
                     echo '  <a class="actie" href="dashbord.php?page='.($page-1).'">Previous</a>';
                 }


                for($i=1;$i<=$number_f_page;$i++){
                    echo '  <a class="actie" href="dashbord.php?page='.$i.'">'.$i.'</a>';

                }


                if($i>=$page){
                    echo '  <a  href="dashbord.php?page=' . ($page + 1) . '">Next</a>';
                }



                ?>

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
                    data: {id: deleteid}

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

/*search bar*/

    $(document).ready(function(){
        $('#search').keyup(function(){
            search_table($(this).val());
        });
        function search_table(value){
            $('#candidats tr').each(function(){
                var found = 'false';
                $(this).each(function(){
                    if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                        found = 'true';
                    }
                });
                if (found == 'true') {
                    $(this).show();
                } else {
                    $(this).hide();
                }

        });
    }
    });








 </script>

</body>
</html>
