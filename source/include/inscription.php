<?php include_once 'db.php';

if(isset($_POST['Lastnext'])){


    $i_nom = empty($_POST['inscri_nom']) ? 'NULL' : trim(addslashes($_POST['inscri_nom']));
    $i_prenom = empty($_POST['inscri_prenom']) ? 'NULL' : trim(addslashes($_POST['inscri_prenom']));
    $i_genre = trim($_POST['inscri_genre']);
    $i_dte = trim($_POST['inscri_dte']);
    $i_ville = trim(addslashes($_POST['inscri_ville']));
    $i_codep = trim($_POST['inscri_codep']);
    $i_tel1 = empty($_POST['inscri_tel1']) ? 'NULL' : $_POST['inscri_tel1'];
    $i_tel2 = trim($_POST['inscri_tel2']);
    $i_mail1 = empty($_POST['inscri_mail1']) ? 'NULL' : trim(addslashes($_POST['inscri_mail1']));

    $i_adresse = trim(addslashes($_POST['inscri_adrs']));

    $img_file = $_FILES["inpFiles"]["name"];
    $i_msg = empty($_POST['message']) ? 'NULL' : addslashes($_POST['message']);




/*to select the id from DB   start */

        $sql = "SELECT MAX(id_candidat) as id FROM inscription";

        $result = mysqli_query($con, $sql);

        mysqli_num_rows($result);

        $row = mysqli_fetch_assoc($result) ;
        $id= $row["id"];
        $id++;
/*end */

    /*img to binary :)   start*/

    $filename= basename($_FILES["inpFiles"]["name"]);
    $filetype= pathinfo($filename, PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($filetype, $allowTypes)){
        $image = $_FILES["inpFiles"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));


        $sql2 = "INSERT INTO  inscription(id_candidat,nom,prenom,sexe,dte,ville,cdp,tel1,tel2,mail,adresse,cv,favori,msg,date_candidature,check_mail) values ('$id','$i_nom','$i_prenom','$i_genre','$i_dte',
                                  '$i_ville','$i_codep','$i_tel1','$i_tel2',
                                   '$i_mail1','$i_adresse','$imgContent','0','$i_msg',NOW(),'0')";
        mysqli_query($con,$sql2);
    }


    /*end */






}




    mysqli_close($con);

echo '
<h1 style="font-size:3vw; text-align:center;padding-top: 120px;">Votre candidature a été enregistrée avec succès </h1>

<p style="font-size:2vw;text-align:center"">un message de retour vous sera envoyé via l'."'".' adresse e-mail fournie.</p>';
?>