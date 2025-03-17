<?php

function emailEncrypt($email) {
    $emailParts = explode('@', $email);
    $domain = array_pop($emailParts);
    $name = implode('@', $emailParts);
    $hiddenName = substr($name, 0, 2) . str_repeat('*', strlen($name) - 2);
    return $hiddenName . '@' . $domain;
}

