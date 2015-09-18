<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" ng-app="korfball-game"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" ng-app="korfball-game"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" ng-app="korfball-game"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" ng-app="korfball-game"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Korfball Game Prototype</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/html5-doctor-reset-stylesheet.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.createjs.com/createjs-2014.12.12.min.js"></script>
        <script type="text/javascript" src="js/vendor/modernizr.min.js"></script>
        <script type="text/javascript" src="js/vendor/angular.js"></script>
        <script type="text/javascript" src="js/vendor/ndgmr.Collision.js"></script>
    </head>
    <body ng-controller="viewController">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <a href="#">Back to main site</a>
            <h1>Korfball Game</h1>

            <!-- quick view switching for testing purpose -->
            <select ng-model="view" ng-options="view for view in views"></select>
        </header>

        <div class="content" ng-switch on="view">
            <intro ng-switch-default></intro>
            
            <countries ng-switch-when="country"></countries>

            <gender ng-switch-when="gender"></gender>

            <game ng-switch-when="game"></game>

            <gameover ng-switch-when="gameover"></gameover>

            <scores ng-switch-when="scores"></scores>

            <howto ng-switch-when="howto"></howto>
        </div>
        
        <script type="text/javascript" src="js/Player.js"></script>
        <script type="text/javascript" src="js/PrllxBackground.js"></script>
        <script type="text/javascript" src="js/Ground.js"></script>
        <script type="text/javascript" src="js/Character.js"></script>
        <script type="text/javascript" src="js/Basket.js"></script>
        <script type="text/javascript" src="js/Ball.js"></script>
        <script type="text/javascript" src="js/Hud.js"></script>
        <script type="text/javascript" src="js/Powerbar.js"></script>
        <script type="text/javascript" src="js/Game.js"></script>
        
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>