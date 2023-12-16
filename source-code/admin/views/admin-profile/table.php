

<?php 

  require_once('scripts/AdminProfile.php');

  $adminProfile= new AdminProfile($conn);
  $adminprofiles = $adminProfile->get();


 
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Admin Profile List</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=admin-profile-form" class="btn btn-success">Add New</a>
    </div>
</div>

<div class="table-responsive-sm">
<table class="table table-hover">
    <thead>
      <tr>
      <th>S.N</th>
        <th>Profile Image</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email Address</th>
        <th>Mobile Number</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($adminprofiles)) {
           
        $sn = 1;
       foreach($adminprofiles as $data){
        ?>
      <tr>
      <td><?= $sn; ?></td>
        <td><img src="public/images/admin-profile/<?= $data['profileImage']; ?>" width="100px"></td>
        <td>
          <?= $data['firstName'] . " " . $data['lastName']; ?> <br>
        
        </td>
        <td>  <?= $data['gender']; ?></td>
        <td><?= $data['emailAddress']; ?></td>
        <td><?= $data['mobileNumber']; ?></td>
        <td class="text-center">
            <a href="dashboard.php?page=admin-profile-form&id=<?= $data['id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
            </a>
        </td>

        <td  class="text-center">
            <a href="javascript:void(0)" onclick="confirmAdminProfileDelete(<?=$data['id']; ?>)" class="text-danger">
              <i class="fa fa-trash-o"></i>
            </a>
        </td>
       
      </tr>
       <?php 
        $sn++; }
        } else {
       ?>
     <tr>
        <td colspan="3">No category Found</td>
       
      </tr>
       <?php } ?>
      
      
    </tbody>
  </table>
</div>

<script src="public/js/ajax/delete-admin-profile.js"></script>