<?php
$hashedPassword= password_hash("pw112233", PASSWORD_BCRYPT);

if (password_verify("pw112233",$hashedPassword)){
	echo '<br>Password Correct';
} else {
    echo '<br>Password not matched';
}
?>