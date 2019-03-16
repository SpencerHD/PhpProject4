<?php

/* ---------------------------------------------------------------------------
* filename    : logout.php
* author      : Spencer Huebler-Davis, shuebler@svsu.edu
* description : This program logs out a customer
* ---------------------------------------------------------------------------
*/

// start and destroy session to log user out
session_start();
session_destroy();
header("Location: login.php");
?>