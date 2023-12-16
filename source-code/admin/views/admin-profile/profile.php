<?php
require_once('scripts/Profile.php');
$profile= new Profile($conn);
$profileData = $profile->getProfile();

?>
<div class="row">
    <div class="col-sm-3">

    <div class="profile-picture">
        <img src="public/images/admin-profile/<?= $profileData['profileImage']; ?>" width="200px">
     </div>
    
    </div>
    <div class="col-sm-9">
        <br>
    <h3><?php echo $profileData['firstName'] . " ". $profileData['firstName'];  ?> </h3>
    <p><?= $profileData['gender']; ?></p>
    <p><?= $profileData['emailAddress']; ?></p>
    <p><?= $profileData['mobileNumber']; ?></p>

    </div>
</div>

