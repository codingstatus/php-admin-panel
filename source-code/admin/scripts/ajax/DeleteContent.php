<?php
require_once('../../../database.php');
require_once('../ContentManager.php');

 /* delete category */
 if (isset($_POST['contentId'])) {
    $id = $_POST['contentId'];
    $contentManager = new ContentManager($conn);
    $delete = $contentManager->deleteById($id);
    echo $delete;
  }

?>