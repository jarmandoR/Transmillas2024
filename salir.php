<?php
require("login_autentica.php");
session_destroy();
header("Location: index.php");

?>