<?php
session_start();
session_destroy();
header('Location: /SiteAllaire/index.html');
exit;
?>