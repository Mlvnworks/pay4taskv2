<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Global Styling -->
     <link rel="stylesheet" href="./styling/style.css">

     <!-- Components styling -->
    <link rel="stylesheet" href="./styling/label-search.css">
    <link rel="stylesheet" href="./styling/table-container.css">
    <link rel="stylesheet" href="./styling/data-layout.css">
    <link rel="stylesheet" href="./styling/thumbnail.css">
    <link rel="stylesheet" href="./styling/new-task-modal.css">
    <link rel="stylesheet" href="./styling/submitted-proof-modal.css">
    <link rel="stylesheet" href="./styling/err-alert.css">
    <link rel="stylesheet" href="./styling/view-receipt-modal.css">
    
     <!-- Dynamic page styling -->
    <link rel="stylesheet" href="./styling/<?php echo $content?>.css">

    <!-- TOOLS JS -->
     <script src="../tools/toCurrencySign.js"></script>
     <script src="../tools/toCountFormat.js"></script>
    <script src="../tools/formatTimestamp.js"></script>
    
    <title>Pay4task | Admin Control | <?= $content ?></title>
</head>
<body>
    <!-- Header -->
    <!-- Header -->
    <?php include "./components/header.html"?>
    
    <!-- Display Content -->
    <?php
        require("./components/err-alert.php");

        if(file_exists("./pages/$content.php")){
            require("./pages/$content.php");
        }else{
            require("./components/404.php");
        }  
    ?>
</body>
</html>