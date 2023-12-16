
<?php 
require_once('scripts/SiteMenu.php');
$sitemenu= new SiteMenu($conn);

$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create category  */
if(isset($_POST['create'])) {
  
    $sitemenuName = $_POST['sitemenuName'];
  $create = $sitemenu->create($sitemenuName);

  if($create['success']) {
    $msg = "sitemenu is saved successfully";
  }

  if($create['errMsg']) {
    $errMsg = $create['errMsg'];
  }
  
}

/* update category */
if(isset($_POST['update'])) {
  
  $id = $_GET['id'];
  $sitemenuName = $_POST['sitemenuName'];

  $update = $sitemenu->updateById($id, $sitemenuName);

  if($update['success']) {
    $msg = "site menu is updated successfully";
  }

  if($update['errMsg']) {
    $errMsg = $update['errMsg'];
  }
}

/* edit category */
if($id) {

  $getCategory = $sitemenu->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Site menu Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=site-menu-list" class="btn btn-success">Site Menu List</a>
    </div>
</div>


<form method="post"   >
    <div class="mb-3 mt-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="sitemenuName" value="<?= $getCategory['sitemenuName'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>