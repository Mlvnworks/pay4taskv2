<?php

class Google{
    public $client_id = '517396773370-mqmjmp3h204cf24qkj2ag695tqfsrhd3.apps.googleusercontent.com';
    public $client_secret = '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';

    // LOCAL
    // public $registration_callback_url = 'http://localhost/pay4task/?c=user-registration-google-callback';
    // public $login_callback_url = 'http://localhost/pay4task/?c=user-login-google-callback';


    // DEPLOYED
    public $registration_callback_url = 'https://pay4task.app/?c=user-registration-google-callback';
    public $login_callback_url = 'https://pay4task.app/?c=user-login-google-callback';
    
    function generateUrl($callback_url){
        // Google Client configuration
        $client = new Google\Client();
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setRedirectUri($callback_url);
        $client->addScope("email");
        $client->addScope("profile");

        // Generate login URL
        return $client->createAuthUrl();
    }
    
}