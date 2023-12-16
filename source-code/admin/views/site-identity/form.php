

<?php 
require_once('scripts/SiteIdentity.php');
$siteIdentity= new siteIdentity($conn);


$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create category  */
if(isset($_POST['create'])) {
 
  $name = $_POST['name'];
 

  $create = $siteIdentity->create( $name);

  if($create['success']) {
    $msg = "site identity is created successfully";
  }

  if($create['uploadFavicon']) {
    $faviconErr = $create['uploadFavicon'];
    
  }
  
  if($create['uploadLogo']) {
    $logoErr = $create['uploadLogo'];
    
  }

  if($create['errMsg']) {
   
    $nameErr = $create['errMsg']['name'];
    
  }

}

/* create category  */
if(isset($_POST['update'])) {
 
    $name      = $_POST['name'];
    
    $update = $siteIdentity->updateByid($id,$name);
  
    if($update['success']) {
      $msg = "site identity is updated successfully";
    }
  
    if($update['uploadFavicon']) {
      $faviconErr = $update['uploadFavicon'];
      
    }

    if($update['uploadLogo']) {
        $logoErr = $update['uploadLogo'];
        
      }
  
    if($update['errMsg']) {
     
      $titleErr = $update['errMsg']['name'];
    }
  
  }

/* edit category */
if($id) {
  $getContent = $siteIdentity->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">SiteIdentity Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=site-identity-list" class="btn btn-success">Identity List</a>
    </div>
</div>


<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
      <label>Name</label>
      <input type="text" class="form-control" name="name" value="<?= $getContent['name'] ?? ''; ?>">
       <p class="text-danger"><?= $titleErr ?? ''; ?></p>
       <!-- favicon -->
       <label>Favicon</label>
        <input type="file" class="form-control" name="favicon">
        <?php 
        if(isset($getContent['favicon'])){
        ?>
            <img src="public/images/favicon/<?=$getContent['favicon']; ?>" width="100px">
        <?php
        }
        ?>
        <p class="text-danger"><?=  $faviconErr ?? ''; ?></p>
         <!--logo -->
       <label>Logo</label>
        <input type="file" class="form-control" name="logo">
        <?php 
        if(isset($getContent['logo'])){
        ?>
            <img src="public/images/logo/<?=$getContent['logo']; ?>" width="100px">
        <?php
        }
        ?>
        
        <p class="text-danger"><?=  $logoErr ?? ''; ?></p>

    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>