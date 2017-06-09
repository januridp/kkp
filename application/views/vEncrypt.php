<div class="container main-content" style="margin-top:10px;"> <!-- page main content -->
<div class="card">
<div class="container">
  <h2>Encrypt Form</h2>
</div>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" />

<br /><br />

<input type="submit" value="upload" />

</form>
<form class="card-content" action="<?=base_url('encrypt/do_upload');?>" enctype="multipart/form-data">

<div class="file-field input-field">
      <div class="btn">
        <span>Cari</span>
        <input type="file" name="userfile">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>

 <div class="row">
        <div class="input-field col s12 m6">
              <i class="material-icons prefix">lock</i>
              <input id="password" type="password" class="validate" name="password" required>
              <label for="password">Password</label>
            </div>
      </div>

<div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea"></textarea>
          <label for="textarea1">Keterangan</label>
        </div>
      </div>

<p>      
<button class="waves-effect waves-light btn right">Submit</button></p>
</form>
</div>
</div>
