
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
		<h4 class="center"><img src="<?=base_url();?>assets/img/logo.png" alt="Logo" class="responsive-img valign profile-image-login" width="100px" height="100px"><br>Please identify yourself</h4>	 
<div class="row">
<center class="red"><?=$error;?></center>
<center class="yellow" ><?=validation_errors(); ?></center>
          <?php echo form_open('Auth/login'); ?>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="material-icons prefix">person_outline</i>
              <input id="nip" type="text" name="nip" onkeypress="return validasiAngka(event)">
              <label for="nip">NIP</label>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="password" type="password" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light col s12" type="submit" name="action">Login</button>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6 m6 l6">
              <p class="margin medium-small">Belum punya akun? Silakan <a href="<?=base_url('register');?>">Daftar</a></p>
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
      <script>
     
        function validasiAngka(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57)){
                    return false;
                }else{
                    return true;
                }
            }
      </script>
	    
    </body>
  </html>