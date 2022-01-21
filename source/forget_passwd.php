<?php include_once 'include/db.php';



$msg ='';

$msg_verify='';
if(isset($_POST['submit3']))
{

    $email=$_POST['forget_mdp'];
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }



     $query="SELECT * FROM login WHERE email='$email'";
     $query1="SELECT mdp FROM login WHERE email='$email'";


     $result=mysqli_query($con,$query);
     $result1=mysqli_query($con,$query1);
     $row = mysqli_fetch_assoc($result1);



$count=mysqli_num_rows($result);


if( $count=="")
{
    $msg = "email incorrect";
    header("Refresh:50; url=forget_passwd.php");


}else if( $count>0 ) {


    require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'rhmail.v1@gmail.com';
    $mail->Password = 'Maskoff007';

    $mail->setFrom('rhmail.v1@gmail.com');
    $mail->addAddress($email);
    $mail->addReplyTo('rhmail.v1@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'php mailer subject';
    $mail->Body = 'Votre ancien mot de passe est'.' : '.$row['mdp'];
    $msg_verify='Veuillez vérifier votre boite email';
    $mail->send();

    header("Refresh:5; url=log.php");
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Login</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style >


    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');



    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }

    h1 {
        font-weight: bold;
        margin-top: 15px ;
    }
    .small1{
        font-size: 31px;
    }



    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 15px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    button {
        border-radius: 20px;
        border: 1px solid #ec8349;
        background-color: #ec8349;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }

    button:active {
        transform: scale(0.95);
    }

    button:focus {
        outline: none;
    }

    button.ghost {
        background-color: transparent;
        border-color: #FFFFFF;
    }

    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 50px;

        text-align: center;
    }

    .base_l{
        padding-right: 150px;
    }
    input {
        background-color: #eee;
        border-color: #D2E2F9;
        padding: 12px 15px;
        margin: 8px 0;
        width: 90%;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25),
        0 10px 10px rgba(0,0,0,0.22);
        position: relative;
        overflow: hidden;
        width: 500px;
        max-width: 100%;
        min-height: 300px; /*HI*/
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
        left: 0;
        width: 100%;
        z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }

    .sign-up-container {
        left: 0;
        width: 100%;
        opacity: 0;
        z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
        /*transform: translateX(100%);*/
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }

    @keyframes show {
        0%, 49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%, 100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .container.right-panel-active .overlay-container{
        transform: translateX(-100%);
    }

    .container.right-panel-active .overlay {
        transform: translateX(50%);
    }

    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
        transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
        transform: translateX(0);
    }

    .overlay-right {
        right: 0;
        transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
        transform: translateX(20%);
    }

h1{
    padding-top: 30px;
}
.spac_ing{
    margin-bottom: 20px;
}
</style>

</head>
<body>

<div class="container" id="container">




    <div class="form-container sign-in-container">
        <form  action="forget_passwd.php" method="POST" style="height: 200px;">
            <h1 style="color:#4169e1; "> Mot de passe oublié</h1>
            <span style="color: red">      <?php echo $msg; ?> </span>
            <span style="color: red">      <?php echo $msg_verify; ?> </span>
            <input type="text" placeholder="Email"   name="forget_mdp" class="spac_ing">

            <button id="submitt3" name="submit3">Rechercher</button>


        </form>
    </div>


</div>



</body>
</html>

