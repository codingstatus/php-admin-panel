
<?php 
require_once('scripts/SiteSubMenu.php');
$sitesubmenu= new SiteSubMenu($conn);

require_once('scripts/SiteMenu.php');
$siteMenu= new SiteMenu($conn);
$siteMenu = $siteMenu->get() ;

$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create category  */
if(isset($_POST['create'])) {

    $sitesubmenuName = $_POST['sitesubmenuName'];
    $sitemenuId = $_POST['sitemenuId'];
  $create = $sitesubmenu->create($sitesubmenuName, $sitemenuId);

  if($create['success']) {
    $msg = "site-sub menu is saved successfully";
  }

  if($create['errMsg']) {
    $errMsg = $create['errMsg'];
  }
  
}

/* update category */
if(isset($_POST['update'])) {
  
  $id = $_GET['id'];
  $sitesubmenuName = $_POST['sitesubmenuName'];
  $sitemenuId = $_POST['sitemenuId'];

  $update = $sitesubmenu->updateById($id, $sitesubmenuName,$sitemenuId);

  if($update['success']) {
    $msg = "site sub menu is updated successfully";
  }

  if($update['errMsg']) {
    $errMsg = $update['errMsg'];
  }
}

/* edit category */
if($id) {

  $getCategory = $sitesubmenu->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Site sub menu Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=site-sub-menu-list" class="btn btn-success">Site sub Menu List</a>
    </div>
</div>


<form method="post"   >
    <div class="mb-3 mt-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="sitesubmenuName" value="<?= $getCategory['sitesubmenuName'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>
    <!--  -->
    <label for="sitemenuId">Site Menu</label>
        <select class="form-control" name="sitemenuId">
            <?php
            foreach ($siteMenu as $menu) {
                $menuId = $menu['id'];
                $menuName = $menu['sitemenuName'];
     
                // Check if this category is selected (for updating content)
                $selected = isset($getCategory['sitemenuId']) && $getCategory['sitemenuId'] == $menuId ? 'selected' : '';
               
                ?>
                <option value="<?= $menuId; ?>" <?= $selected; ?>> <?= $menuName; ?></option>
            <?php    
              }
            ?>
        </select>
        <p class="text-danger"><?= $sitemenuIdErr ?? ''; ?></p>

    <!--  -->

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>