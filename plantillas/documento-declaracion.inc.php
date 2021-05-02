<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <!--Custom Css-->
  <link rel="stylesheet" href="./styles/mainStyles.css">

  <?php
    if(!isset($titulo) || empty($titulo)){
      $titulo = 'Blog de JavaDevOne ';
    }
      echo "<title>$titulo</title>";

    
  ?>

  <style>

    body {
      padding-top: 3.5rem;
    }
  </style>
</head>

<body>