<?php
  include'php/function.php';
  //include'test.php';
  ob_start();
  //error_reporting(0);
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!--
  ##########################################################
  #                                                        #
  #                                                        #
  #                                                        #
  #             MADE BY MIGUEL BALSEMHOF                   #
  #                                                        #
  #                                                        #
  #                                                        #
  #                                                        #
  #                                                        #
  #                                                        #
  #                                                        #
  ##########################################################
  -->

    <!--SEO-->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Camera-installatiebedrijven.nl is een verzamel site voor camera installatie bedrijven in Nederland."/>
  <meta name="keywords" content="camera-installatiebedrijven.nl, camera, camera installatie, installatie bedrijven, camera installatie bedrijven, bedrijven"/>
  <meta name="author" content="World Web Media">
  <meta name="robots" content="index, follow" />
  <meta name="revisit-after" content="3 month" />
  <title>Camera-installatiebedrijven.nl</title>
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

    <!--CSS-->
  <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--jQuery library (served from Google)-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="js/jquery-1.12.1.min.js"></script>

    <!--bxSlider Javascript file-->
  <script src="jquery.bxslider/jquery.bxslider.min.js"></script>

    <!--bxSlider CSS file-->
  <link href="jquery.bxslider/jquery.bxslider.css" rel="stylesheet"/>

    <!---Bootstrap-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!--Recaptcha-->
  <script src='https://www.google.com/recaptcha/api.js'></script>

    <!--Font awesome-->
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  
    <!--Twitter-->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</head>

<body style="background-color:#3967a4;">
  <nav class="navbar navbar-inverse" style="background-color:#013b61;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle trans" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="home"><img class="logo img-responsive" src="img/logo-wit.png"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="home">Home</a></li>
          <li><a href="bedrijven">Bedrijven</a></li>
          <li><a href="offerte">Offerte</a></li>
          <li><a href="nieuws">Nieuws</a></li>
          <li><a href="contact">Contact</a></li>
        </ul>
        <?php
          change_login();
          change_aanmelden();
        ?>     
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><img src="img/facebook.jpg" class="nav-img"></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="http://www.twitter.com/negrosuketa"><img src="img/twitter.jpg" class="nav-img"></a></li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>