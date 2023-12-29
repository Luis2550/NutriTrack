<?php
session_start();
session_destroy();

header("location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion");
?>