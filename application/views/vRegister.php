
 <!DOCTYPE html>
  <html>
    <head>
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" href="<?=base_url();?>assets/font-awesome-4.3.0/css/font-awesome.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="msapplication-tap-highlight" content="no">
      <meta name="description" content="">
      <meta name="keywords" content="">
      <meta name="author" content="januridp.com">
      <title>PT. MPP International Developments Indonesia &middot; Independent Project and Development Managers.</title>
      <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicon.png">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

    <body class="red darken-2">

	<div class="container" style="margin-top:50px;">
		<div class="row">
			<div class="col s12 m6 offset-m3">
			
		<div class="card-panel z-depth-5">
		<h4 class="center"><img src="<?=base_url();?>assets/img/logo.png" alt="Logo" class="responsive-img valign profile-image-login" width="100px" height="100px"><br>Please fill your identity</h4>	 
<div class="row">
<center class="red" ><?=$error;?></center>
<center class="yellow" ><?php echo validation_errors(); ?></center>
          <?php echo form_open('Auth/register'); ?>
          <div class="row ">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">person_outline</i>
              <input id="nip" type="text" name="nip" required>
              <label for="nip">NIP</label>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">work</i>
              <input id="job" type="text" name="job" required>
              <label for="job">Job</label>
            </div>
          </div>
          <div class="row ">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">person</i>
              <input id="first" type="text" name="first" required>
              <label for="first">First name</label>
            </div>
            <div class="input-field col s12 m6">
              
              <input id="last" type="text" name="last" required>
              <label for="last">Last name</label>
            </div>
          </div>
          <div class="row ">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">email</i>
              <input id="email" type="email" name="email" required>
              <label for="email">E-Mail</label>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">phone</i>
              <input id="phone" type="tel" name="phone" required>
              <label for="phone">Phone</label>
            </div>
          </div>
          <div class="row">
              <div class="input-field col s12 m12">
              <i class="material-icons prefix">room</i>
                <textarea id="textarea1" class="materialize-textarea" name="address" required></textarea>
                <label for="address">Address</label>
              </div>
          </div>
          <div class="row ">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">lock</i>
              <input id="password" type="password" name="password" required>
              <label for="password">Password</label>
            </div>
            <div class="input-field col s12 m6">
              
              <input id="repassword" type="password" name="repassword" required>
              <label for="repassword">Re-type Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light col s12" type="submit" name="action">Register</button>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6 m6 l6">
              <p class="margin medium-small">Already registered? <a href="login">Login</a></p>
            </div>
          </div>

        </form>
</div><!--row-->
</div><!--card-->
</div><!--col-->
  </div><!--row-->
	</div><!--conatiner-->
    	
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="<?=base_url();?>assets/js/materialize.min.js"></script>
	    
    </body>
  </html>