<?php
require_once('../../../database.php');
require_once('../CategoryManager.php');

 /* delete category */
 if (isset($_POST['categoryId'])) {
    $id = $_POST['categoryId'];
    $categoryManager = new CategoryManager($conn);
    $delete = $categoryManager->deleteById($id);
    echo $delete;
  }

?>