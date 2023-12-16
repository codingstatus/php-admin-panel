

<?php 
require_once('scripts/AdminProfile.php');
$adminProfile= new AdminProfile($conn);

$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create admin profile  */
if(isset($_POST['create'])) {
 
  $firstName        = $_POST['firstName'];
  $lastName         = $_POST['lastName'];
  $gender           = $_POST['gender'];
  $emailAddress     = $_POST['emailAddress'];
  $mobileNumber     = $_POST['mobileNumber'];
  $pass             = $_POST['pass'];

  $create = $adminProfile->create($firstName, $lastName, $gender, $emailAddress, $mobileNumber, $pass);

  if($create['success']) {
    $msg = "Admin Profile is created successfully";
  }

  if($create['uploadProfileImage']) {
    $profileImageErr = $create['uploadProfileImage'];
    
  }

  if($create['errMsg']) {
   
    $firstNameErr = $create['errMsg']['firstName'];
    $lastNameErr = $create['errMsg']['lastName'];
    $genderErr = $create['errMsg']['gender'];
    $emailAddressErr = $create['errMsg']['emailAddress'];
    $mobileNumberErr = $create['errMsg']['mobileNumber'];
    $passErr = $create['errMsg']['pass'];
  }

}



/* update admin profile  */
if(isset($_POST['update'])) {
 
    $firstName        = $_POST['firstName'];
    $lastName         = $_POST['lastName'];
    $gender           = $_POST['gender'];
    $emailAddress     = $_POST['emailAddress'];
    $mobileNumber     = $_POST['mobileNumber'];
   
  
    $update = $adminProfile->updateById($id, $firstName, $lastName, $gender, $emailAddress, $mobileNumber);
  
    if($update['success']) {
      $msg = "Admin Profile is updated successfully";
    }
  
    if($update['uploadProfileImage']) {
      $profileImageErr = $update['uploadProfileImage'];
      
    }
    
  
    if($update['errMsg']) {
     
      $firstNameErr = $update['errMsg']['firstName'];
      $lastNameErr = $update['errMsg']['lastName'];
      $genderErr = $update['errMsg']['gender'];
      $emailAddressErr = $update['errMsg']['emailAddress'];
      $mobileNumberErr = $update['errMsg']['mobileNumber'];
      $passErr = $update['errMsg']['pass'];
    }
  
  }
  /* edit admin profile */
if($id) {
  $getAdminProfile = $adminProfile->getById($id);
   
}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Admin Profile Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=admin-profile-list" class="btn btn-success">Admin list</a>
    </div>
</div>


<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
      <label>First Name</label>
      <input type="text" class="form-control" name="firstName" value="<?= $getAdminProfile['firstName'] ?? ''; ?>">
       <p class="text-danger"><?= $firstNameErr ?? ''; ?></p>
       
       <label>Last Name</label>
      <input type="text" class="form-control" name="lastName" value="<?= $getAdminProfile['lastName'] ?? ''; ?>">
       <p class="text-danger"><?= $lastNameErr ?? ''; ?></p>
       
       <label>Gender</label>
      <input type="radio"  name="gender" value="male" checked> Male
      <input type="radio"  name="gender" value="female"> Female
       <p class="text-danger"><?= $genderErr ?? ''; ?></p>
       
       <label>Email Address</label>
      <input type="text" class="form-control" name="emailAddress" value="<?= $getAdminProfile['emailAddress'] ?? ''; ?>">
       <p class="text-danger"><?= $emailAddressErr ?? ''; ?></p>

       <label>Mobile Number</label>
      <input type="text" class="form-control" name="mobileNumber" value="<?= $getAdminProfile['mobileNumber'] ?? ''; ?>">
       <p class="text-danger"><?= $mobileNumberErr ?? ''; ?></p>
       
       <?php
       if(!$id) {
       ?>
       <label>Password</label>
       <input type="password" class="form-control" name="pass">
       <p class="text-danger"><?= $passErr ?? ''; ?></p>
       <?php } ?>

       <label >Profile Image</label>
        <input type="file" class="form-control" name="profileImage" >
        <?php 
         if(isset($getAdminProfile['profileImage'])){

        ?>
            <img src="public/images/admin-profile/<?=$getAdminProfile['profileImage']; ?>" width="100px">
        <?php
        }
        ?>
        
        <p class="text-danger"><?=  $profileImageErr ?? ''; ?></p>

    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>