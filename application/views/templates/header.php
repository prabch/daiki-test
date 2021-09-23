<?php 
  defined('BASEPATH') OR exit('No direct script access allowed'); 

  //get CodeIgniter instance so we can check authorization status later
  $CI =& get_instance();

  //fetch authorization status
  $auth = $CI->auth_model->current_auth();

  /*title variable prefixed to APP_NAME constant (defined in config/constants.php)
  if not title variable is provided, we only use the APP_NAME*/
  $_title = APP_NAME;
  if (isset($title)) $_title = $title . ' | ' . APP_NAME;

  /*all error & message flashdata is combined into a single notifications array to be shown as toasts*/
  if (!isset($notifications)) {
    $notifications = [];
  } elseif (!is_array($notifications)) {
     $notifications = [$notifications];
  }
  $notifications[] = $CI->session->flashdata('error');
  $notifications[] = $CI->session->flashdata('message');

  //manually unsetting flashdata due to overcome a CI bug (https://github.com/bcit-ci/CodeIgniter/pull/6013)
  $CI->session->unset_userdata(['error', 'message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $_title; ?></title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
    });
  </script>
</head>
<body>
  <script type="text/javascript" src="/js/materialize.min.js"></script>
  <header>
    <nav class="top-nav blue">
      <div class="container">
          <div class="nav-wrapper">
            
            <?php if($auth->logged_in):?>
              <ul class="right hide-on-med-and-down">
                <li><a href="#"><?php echo $auth->name; ?></a></li>
                <li><a href="/signin?logout=true"><i class="material-icons left">power_settings_new</i>Sign Out</a></li>
              </ul>
            <?php endif; ?>
            
            <a href="/" class="brand-logo center baseurl"><?php echo APP_NAME; ?></a>

            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <ul id="nav-mobile" class="left hide-on-med-and-down">
              <?php if($auth->logged_in):?>
                <li><a href="/courses"><i class="material-icons left">book</i>Courses</a></li>
                <?php if($auth->user_level == 'admin'):?>
                  <li><a href="/lecturers"><i class="material-icons left">people</i>Lecturers</a></li>
                <?php endif; ?>
              <?php else: ?>
                <li><a href="/signin"><i class="material-icons left">person</i>Sign In</a></li>
                <li><a href="/signup"><i class="material-icons left">person_add</i>Sign Up</a></li>
              <?php endif; ?>
            </ul>

          </div>
      </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
      <?php if($auth->logged_in):?>
        <li><a href="/courses"><i class="material-icons left">book</i>Courses</a></li>
        <?php if($auth->user_level == 'admin'):?>
          <li><a href="/lecturers"><i class="material-icons left">people</i>Lecturers</a></li>
        <?php endif; ?>
        <div class="divider"></div>
        <li><a href="/signin?logout=true"><i class="material-icons left">power_settings_new</i>Sign Out</a></li>
      <?php else: ?>
        <li><a href="/signin"><i class="material-icons left">person</i>Sign In</a></li>
        <li><a href="/signup"><i class="material-icons left">person_add</i>Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </header>
  <?php if($notifications):?>
    <script type="text/javascript">
      <?php foreach ($notifications as $ens) {
        if ($ens) echo "M.toast({html: '" . $ens . "'});";
      }
      ?>
    </script>
  <?php endif; ?>
  <main>