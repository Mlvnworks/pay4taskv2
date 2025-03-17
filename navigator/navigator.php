<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="./assets/img/logo.png" type="image/x-icon">
    <title>Pay4Task | Complete Task, Earn Reward</title>

    <!-- Custom Styling -->
    <link rel="stylesheet" href="./styling/style.css">
    <link rel="stylesheet" href="./styling/main-header.css">

     <!-- Components styling -->
      <link rel="stylesheet" href="./styling/sub-header.css">
      <link rel="stylesheet" href="./styling/card.css">
      <link rel="stylesheet" href="./styling/task-item.css">
      <link rel="stylesheet" href="./styling/modal.css">
      <link rel="stylesheet" href="./styling/history-list-item.css">
      <link rel="stylesheet" href="./styling/view-submitted-proof-modal.css">
      <link rel="stylesheet" href="./styling/user-login-modal.css">
      <link rel="stylesheet" href="./styling/user-signup-modal.css">
      <link rel="stylesheet" href="./styling/upgrade-modal.css">

      <!-- Dynamic css -->
     <link rel="stylesheet" href="./styling/<?= $content?>.css">
</head>
<body>
    <!-- Layout Components -->
     
     <?php

        // WHEN THE SYSTEM IS UNDER MAINTENANCE
        if($system->getSystemSettings(1)["value"] === "1"){
            
            require("./pages/maintenance.php");
            
        // WHEN THE SYSTEM IS RUNNING FINE
        }else{
            // SHOW LOGIN/CREATE ACCOUNT WHEN NEEDED
            if(isset($_GET["create-account"])){
                // USER SIGNUP MODAL
                include "./components/user-signup-modal.php";
            }else{
                // USER LOGIN MODAL
                include "./components/user-login-modal.php";
            }


            // CHECK IF CA CLAIM
            if($user->checkLogin() && $user->canClaim($_COOKIE["uid"])){
                 $claim = $user->claimEnergy($_COOKIE["uid"]);
                 if($claim){
                    $_SESSION["err"] = [
                        "err" => false,
                        "msg" => "Daily energy reward added!"
                    ];
                 }else{
                    $_SESSION["err"] = [
                        "err" => true,
                        "msg" => "Failed to add daily energy reward!"
                    ];
                 }

                 

            }
            
            if($content !== "maintenance"){
                include "./components/main-header.php";
            }
        
            // Display Content
            // SHOW ERROR MODAL WHEN THERES AN ERROR
    
            if(isset($_SESSION["err"])){
                require("./components/err-modal.php");
            }

            // SHOW UPGRADE MODAL
            if($user->checkLogin()){
                $user_data = $user->getUserData($_COOKIE["uid"]);

                if($user_data["status"] == 0){
                    require("./components/upgrade-modal.php");

                    if($content == "tasks" && ($user_data["energy"] * 1) <= 0 ){
                        echo '<script>
                            showUpgradeModal();
                        </script>';
                    }
                }

                
            } 
           
            if(file_exists("./pages/$content.php")){
                require("./pages/$content.php");
            }else{
                require("./components/404.php");
            }
        }
          
    ?>
</body>
</html>