<?php


$client = new Google\Client();
$client->setClientId($google->client_id);
$client->setClientSecret($google->client_secret);
$client->setRedirectUri($google->registration_callback_url);


if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get user profile
    $oauth = new Google\Service\Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    $user_email =  $userInfo->email;
    $user_name =  $userInfo->name;
    $user_picture =  $userInfo->picture;


    try{
        $referral_used = isset($_COOKIE["ref-used"]) ? filterValue($_COOKIE["ref-used"]) : -1;

        $verification_id = $user->addNewPendingAccount($user_email, '', $user_name, $referral_used);
        $verification_id = $verification_id["verification_id"];
        

        $response = $user->newUser($verification_id);

        if($response["error_msg"] == "200"){
            echo "<script>
                document.cookie = 'uid={$response["user_id"]}; path=/; max-age=' + (7 * 24 * 60 * 60);
            </script>";

        }else if($response["error_msg"] == "199 - Email already exists"){
            $_SESSION["err"] = [
                "err" => true,
                "msg" => "Email Already Exists!"
            ];
    
        }

    }catch(Exception $err){
        echo $err->getMessage();

        $_SESSION["err"] = [
            "msg" => "Something went wrong!",
            "err" => true
        ];
    }
} else {
    $_SESSION["err"] = [
      
        "msg" => "Something went wrong!",
        "err" => true
    ];
}



echo "<script> location.href = './'; </script>";
die();

