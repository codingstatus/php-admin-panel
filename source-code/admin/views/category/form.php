

<?php 
require_once('scripts/CategoryManager.php');
$categoryManager= new CategoryManager($conn);

$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create category  */
if(isset($_POST['create'])) {
  
  $categoryName = $_POST['categoryName'];
  $create = $categoryManager->create($categoryName);

  if($create['success']) {
    $msg = "Category is saved successfully";
  }

  if($create['errMsg']) {
    $errMsg = $create['errMsg'];
  }
  
}

/* update category */
if(isset($_POST['update'])) {
  
  $id = $_GET['id'];
  $categoryName = $_POST['categoryName'];

  $update = $categoryManager->updateById($id, $categoryName);

  if($update['success']) {
    $msg = "Category is updated successfully";
  }

  if($update['errMsg']) {
    $errMsg = $update['errMsg'];
  }
}

/* edit category */
if($id) {

  $getCategory = $categoryManager->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Category Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=category-list" class="btn btn-success">Category List</a>
    </div>
</div>


<form method="post"   >
    <div class="mb-3 mt-3">
      <label for="email">Name</label>
      <input type="text" class="form-control" name="categoryName" value="<?= $getCategory['categoryName'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>