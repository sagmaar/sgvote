<?php
    $plainAdminPassword = '132546';
    $hashedPassword = password_hash($plainAdminPassword, PASSWORD_DEFAULT);
    echo "The Encrypted Admin Password is: " .'<br/>' .$hashedPassword;
?>