<?php
if($_SESSION['id'])
    session_destroy();
header("Location: login");