<?php
session_start();
HTTP/1.1 302 Found
     Location: http://example.com/rd#access_token=2YotnFZFEjr1zCsicMWpAA&state=xyz&token_type=example&expires_in=3600
if (isset($_SESSION['userId'])) {
    header('Location: ' . $_SESSION['redirectUri'] . '#access_token=1/QbIbRMWW&token_type=example&expires_in=4301');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>