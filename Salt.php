<?php
// Custom password encryption function
function salt($password)
{
    $pwd = $password;  // input password ko variable me rakho
    $hash_format = "$2y$10$";  // Blowfish hashing format
    $salt = md5("Techware house chiniot"); // starting salt

    // 5 baar loop me password ko aur encrypt karo
    for ($j = 1; $j <= 5; $j++) {
        $salt = md5($salt);  // salt ko dobara md5 karo
        $formated_salt = $hash_format . $salt; // proper format me lagao
        $pwd = crypt($pwd, $formated_salt); // crypt() function se hash banao
    }
    return $pwd; // final encrypted password return karo
}
?>
