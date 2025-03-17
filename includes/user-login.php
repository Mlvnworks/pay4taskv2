<?php


if(isset($_POST["login"])){
    $email = filterValue($_POST["email"]);
    $password = filterValue($_POST["password"]);
    $remember = filterValue($_POST["remember"]);
    
    try{


        $submit_response = $user->login($email, $password);



        if($submit_response){
            if($remember === "true"){
                setcookie("uid", $submit_response, time() + (10 * 365 * 24 * 60 * 60), "/");
            }else{
                setcookie("uid", $submit_response, time() + (7 * 24 * 60 * 60), "/");
            }
            

        }else{

            $_SESSION["err"] = [
                "msg" => "Incorrect email or password!",
                "err" => true
            ];
        }

    }catch(Exception $err){

        $_SESSION["err"] = [
            "msg" => "Something went wrong!",
            "err" => true
        ];
    }

   
    header("Location:./");
    exit();
    die();
}