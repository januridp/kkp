 <div class="container main-content" style="margin-top:10px;"> <!-- page main content -->
 <ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3"><a class="active"  href="#test-swipe-1">Activate Users</a></li>
    <li class="tab col s3"><a href="#test-swipe-2">Users List</a></li>
  </ul>
  <div id="test-swipe-1" class="col s12">
    <form action="activateUser" method="post" onsubmit="return confirm('Do you really want to activate this user?');">
   <table class="responsive-table">
        <thead>
          <tr>
              <th>NIP</th>
              <th>Nama</th>
              <th>Job</th>
              <th>Created</th>
              <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?=$users;?>
        </tbody>
      </table> 
 </form>
  </div>
  <div id="test-swipe-2" class="col s12">
    <table class="responsive-table striped">
        <thead>
          <tr>
              <th>NIP</th>
              <th>Nama</th>
              <th>Job</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Access</th>
              <th>Last Login</th>
              <th>IP</th>
          </tr>
        </thead>
        <tbody>
          <?=$usersList;?>
        </tbody>
      </table> 
  </div>
 

 
            
 </div>