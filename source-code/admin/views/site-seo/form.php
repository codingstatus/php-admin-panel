

<?php 
require_once('scripts/SiteSeo.php');
$SiteSeo= new SiteSeo($conn);

$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create category  */
if(isset($_POST['create'])) {
 
  $metaKeyword  = $_POST['metaKeyword'];
  $metaDescription = $_POST['metaDescription'];
 

  $create = $SiteSeo->create($metaKeyword, $metaDescription);

  if($create['success']) {
    $msg = "Site seo is created successfully";
  }

  if($create['errMsg']) {
   
    $metaKeywordErr = $create['errMsg']['metaKeyword'];
    $metaDescriptionErr = $create['errMsg']['metaDescription'];
  }

}

/* create category  */
if(isset($_POST['update'])) {
 
    $metaKeyword  = $_POST['metaKeyword'];
    $metaDescription = $_POST['metaDescription'];
   
  
    $update = $SiteSeo->updateByid($id, $metaKeyword, $metaDescription);
  
    if($update['success']) {
      $msg = "site seo is updated successfully";
    }
  
  
    if($update['errMsg']) {
     
      $metaKeywordErr = $update['errMsg']['metaKeyword'];
      $metaDescriptionErr = $update['errMsg']['metaDescription'];
    }
  
  }

/* edit category */
if($id) {
  $getSiteSeo = $SiteSeo->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Site-Seo Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=site-seo-list" class="btn btn-success">Site SEO List</a>
    </div>
</div>


<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
      <label>Meta Keyword</label>
      <input type="text" class="form-control" name="metaKeyword" value="<?= $getSiteSeo['metaKeyword'] ?? ''; ?>">
       <p class="text-danger"><?= $titleErr ?? ''; ?></p>
       
       <label >Meta Description</label>
       <textarea class="form-control" name="metaDescription" id = "summernote">
          <?= $getSiteSeo['metaDescription'] ?? ''; ?>
       </textarea>
       <p class="text-danger"><p class="text-danger"><?= $descriptionErr ?? ''; ?></p></p>
      
    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>