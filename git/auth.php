<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: ' . $_SESSION['redirectUri'] . '#access_token=1/QbIbRMWW&token_type=example&expires_in=4301');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>