

<?php
session_start();

if(!$_SESSION["a"]){
    $a = rand(1,50);
    $b = rand(1,50);
     $_SESSION["a"] = $a;
    $_SESSION["b"] = $b;  
}

$email = '';
$message = '';
$name ='';
$result ='';
$error ='';

if(isset($_POST['submit'])){
      // echo '<h1>Submit Clicked !!!! '.$_POST['submit'].'</h1>';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $check = intval($_POST['secCheck']);
    
        if(!$_POST['name']){ $error .= 'Please enter your name! <br>'; }
        if(!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ $error .= 'Please enter your email! <br>'; }
        if(!$_POST['message']){ $error .= 'Please enter a message! <br>'; }
        if($check !== ($_SESSION["a"] + $_SESSION["b"])){ $error .= 'Wrong AntiSpam value <br>'; }  
 

if($error == ''){
    $from = '';
    $to =   ''; // email that you want to receive the email to. YOUR ADDRESS
    $subject = 'Message from contact form';
    $body = "From: $name ($email) \n Message \n $message";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$from.'>' . "\r\n";  
    if(mail($to,$subject,$body,$headers)){
     $result = '<div class="alert alert-success">Mail Sent</div>';  
        }else{
               $result = '<div class="alert alert-success">Mail wasn\'t sent</div>';    
        }
    $email = '';
    $message = '';
    $name ='';
    
    // Send email
} else {
    $result = '<div class="alert alert-danger">Error Found:<br>'.$error.'</div>';
}
    }
?>
  