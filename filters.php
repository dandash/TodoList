<?php

global $router;

// test booleans
$user = true;
$admin = false;

$router->filter("is_user", function () {
  global $user;
  if ($user)
    return true;
  return false;
});


$router->filter("is_admin", function () {
  global $admin;
  if ($admin)
    return true;
  return false;
});

$router->filter("isLoggedIn", function () {
  if ($_SESSION['loggedIn']) {
    header('Location : ./classes/home.php');
  } else {
    echo "not loggedin";
  }
});
