<?php
require_once('../../../database.php');
require_once('../AdminProfile.php');

 /* delete category */
 if (isset($_POST['adminId'])) {
    $id = $_POST['adminId'];
    $adminProfile = new AdminProfile($conn);
    $delete = $adminProfile->deleteById($id);
    echo $delete;
  }

?>