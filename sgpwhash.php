<?php
    // $plainPassword = 'your_password_here'; // The plain text password you want to hash
    // $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    // echo "Hashed Password: " . $hashedPassword;
?>

<?php
    $plainPassword = '132546';
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT); 
    echo "Encrypted Password is:" .$hashedPassword;
?>