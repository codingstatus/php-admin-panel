<?php
require_once('../../../database.php');
require_once('../siteIdentity.php');

 /* delete category */
 if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $siteIdentity = new siteIdentity($conn);
    $delete = $siteIdentity->deleteById($id);
    echo $delete;
  }

?>