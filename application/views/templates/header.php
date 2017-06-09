<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>PT. MPP International Developments Indonesia &middot; Independent Project and Development Managers.</title>

  <!-- CSS  -->
  <link href="<?=base_url();?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?=base_url();?>assets/css/sweetalert2.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?=base_url();?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?=base_url();?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" >
  <link href="<?=base_url();?>assets/css/icon.css" rel="stylesheet">
  <link href="<?=base_url();?>assets/img/favicon.png" rel="shortcut icon" type="image/x-icon">
</head>
<body>
   <nav class="red darken-2">
    <div class="nav-wrapper">
      <!--<a href="#!" class="brand-logo">PT. MPPID Indonesia</a>-->
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="home">Home</a></li>
        <li><a href="about">About</a></li>
        <li><a class='dropdown-button' href='#' data-activates='dropdown1'>Tools</a></li>
        <li><a href="help">Help</a></li>
        <li><a href="faq">FAQ</a></li>
      </ul>

  <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
    <li><a href="encrypt">Encrypt</a></li>
    <li><a href="decrypt">Decrypt</a></li>
    <li class="divider"></li>
    <li><a href="history">History</a></li>

  </ul>

      <ul class="right hide-on-med-and-down">

      <?php
      if($this->session->userdata('status') == "admin"){
        ?>
		<li><a href="<?=base_url('admin');?>">Admin</a></li>
	<?php	}?>

        <li><a class="modal-trigger" href="#modalSettings">Profile</a></li>
        <li><a href="<?=base_url();?>auth/logout">Logout</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
      <li>
        <h5>
        <a href="#!name"><span class="name">Hallo, <?=br().$namaDepan.$status.br().br();?></span></a>
        <a href="#!">Last Login:<br><?=$lastLogin;?></a>
        </h5>
      </li>
      <li><div class="divider"></div></li>
        <li><a href="home">Home</a></li>
        <li><a href="about">About</a></li>
        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Tools</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="encrypt">Encrypt</a></li>
                <li><a href="decrypt">Decrypt</a></li>
                <li><a href="history">History</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
        <li><a href="help">Help</a></li>
        <li><a href="faq">FAQ</a></li>
        
        <li><div class="divider"></div></li>
        <?php
      if($this->session->userdata('status') == "admin"){
        ?>
		<li><a href="<?=base_url('admin');?>">Admin</a></li>
	<?php	}?>
        <li><a class="modal-trigger" href="#modalSettings">Profile</a></li>
        <li><a href="logout">Logout</a></li>
      </ul>
    </div>
  </nav>

  <!-- Modal Structure for Settings -->
  <div id="modalSettings" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Profile</h4>
      <p>
        <div class="row">
    <form class="col s12" method="post" action="<?=base_url('updateProfile');?>">
    <div class="row">
      <div class="col m6">
      <input name="nip" type="hidden" value="<?=$nip;?>">
          <label for="nip">NIP : </label><?=$nip;?>  <?=$status;?>
        </div>
    </div>
      <div class="row">
        <div class="input-field col m6">
          <input name="first_name" type="text" class="validate" value="<?=$namaDepan;?>">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col m6">
          <input name="last_name" type="text" class="validate" value="<?=$namaBelakang;?>">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col m6">
          <input name="phone" type="tel" class="validate" value="<?=$phone;?>">
          <label for="phone">Phone</label>
        </div>
        <div class="input-field col m6">
          <input name="email" type="email" class="validate" value="<?=$email;?>">
          <label for="email">Email</label>
        </div>
      </div>
    
  </div>
      </p>
    </div>
    <div class="modal-footer">
    <button class="btn waves-effect waves-light" type="submit" name="action">Save
    <i class="material-icons right">save</i>
  </button>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
  </div>
  </form>


    </div>
  </div>