<?php

if($content !== "new-admin-access"){
    $system->checkAccess($_SERVER["HTTP_USER_AGENT"]."".$_SERVER["REMOTE_ADDR"]);
}
