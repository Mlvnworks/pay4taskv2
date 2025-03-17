<?php


if(isset($_FILES["request-activation"])){
    $receipt = $_FILES["request-activation"];
    $user_id = $_COOKIE["uid"];

    try{
        // CHECK FILE VALIDITY
        // CHECK FILE VALIDITY
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        $max_size = 5 * 1024 * 1024; // 5MB in bytes

        if (!in_array($receipt['type'], $allowed_types)) {
            throw new Exception('Invalid file type. Only JPEG, PNG, and GIF are allowed.');
        }

        if ($receipt['size'] > $max_size) {
            throw new Exception('File size exceeds the 5MB limit.');
        }

        // UPLOAD FILE TO GOOGLE DRIVE
        $uploaded_file_id =  uploadToGoogleDrive($receipt);

        if($uploaded_file_id){
            // CALL USER CLASS 
            $response = $user->submitActivationRequest($uploaded_file_id, $user_id);

            if($response["error_msg"] == "200"){
                $_SESSION["err"] = [
                    "msg" => "Activation successfully sent!",
                    "err" => false
                ];
            }else{
                echo $response["error_msg"];
                deleteFileFromDrive($uploaded_file_id);
                $_SESSION["err"] = [
                    "msg" => "Something went wrong!",
                    "err" => true
                ];
            }
        }else{
            echo "Failed to upload file";
            deleteFileFromDrive($uploaded_file_id);
            $_SESSION["err"] = [
                "msg" => "Something went wrong!",
                "err" => true
            ];
        }
    }catch(Exception $err){
        echo $err -> getMessage();

        $_SESSION["err"] = [
            "msg" => "Something went wrong!",
            "err" => true
        ];
    }
    header("Location:". $_SERVER["HTTP_REFERER"]);
    exit();
    die();
}