<?php

// src/controllers/logout.php


session_start();
$_SESSION = array();
header('Location: login.php');
exit;
