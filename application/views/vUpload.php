<div class="container" style="max-width:600px;">
<div class="card">
<div class="container card-content">
  <h4>Encrypt Form</h4>


<?php echo $error;?>


<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" required/>

<div class="row">
        <div class="input-field col s12">
              <input id="password" type="password" class="validate" name="password" required>
              <label for="password">Password</label>
            </div>
      </div>
<div class="row">
  <div class="input-field col s12">
                <textarea id="keterangan" class="materialize-textarea" name="keterangan" required></textarea>
                <label for="keterangan">Keterangan</label>
              </div>
</div>


<input type="submit" value="Encrypt" class="btn" />

</form>
</div>
</div>
</div>
