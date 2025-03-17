<?php


$client = new Google\Client();
$client->setClientId($google->client_id);
$client->setClientSecret($google->client_secret);
$client->setRedirectUri($google->login_callback_url);


if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get user profile
    $oauth = new Google\Service\Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    $user_email =  $userInfo->email;
 


    try{
        $submit_response = $user->login($user_email, "");

        if($submit_response){
            echo "<script>
                    document.cookie = 'uid={$submit_response}; path=/; max-age=' + (7 * 24 * 60 * 60);
            </script>";

        }else{

            $_SESSION["err"] = [
                "msg" => "Account not found!",
                "err" => true
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

