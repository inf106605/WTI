<?php

session_start();

// zniszczenie sesji
session_destroy();

echo '<script>setTimeout("window.location.href=\"index.php\";", 0);</script>'; 

?>