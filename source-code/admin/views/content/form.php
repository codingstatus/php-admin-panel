

<?php 
require_once('scripts/ContentManager.php');
$contentManager= new ContentManager($conn);

require_once('scripts/CategoryManager.php');

$categoryManager= new CategoryManager($conn);
$categories = $categoryManager->get() ;



$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create category  */
if(isset($_POST['create'])) {
 
  $categoryId  = $_POST['categoryId'];
  $title       = $_POST['title'];
  $description = $_POST['description'];
 

  $create = $contentManager->create($categoryId, $title, $description);

  if($create['success']) {
    $msg = "Content is created successfully";
  }

  if($create['uploadThumbnail']) {
    $thumbnailErr = $create['uploadThumbnail'];
    
  }

  if($create['errMsg']) {
   
    $titleErr = $create['errMsg']['title'];
    $categoryIdErr = $create['errMsg']['categoryId'];
    $descriptionErr = $create['errMsg']['description'];
  }

}

/* create category  */
if(isset($_POST['update'])) {
 
    $categoryId  = $_POST['categoryId'];
    $title       = $_POST['title'];
    $description = $_POST['description'];
   
  
    $update = $contentManager->updateByid($id, $categoryId, $title, $description);
  
    if($update['success']) {
      $msg = "Content is updated successfully";
    }
  
    if($update['uploadThumbnail']) {
      $thumbnailErr = $update['uploadThumbnail'];
      
    }
  
    if($update['errMsg']) {
     
      $titleErr = $update['errMsg']['title'];
      $categoryIdErr = $update['errMsg']['categoryId'];
      $descriptionErr = $update['errMsg']['description'];
    }
  
  }

/* edit category */
if($id) {
  $getContent = $contentManager->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Content Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=content-list" class="btn btn-success">Category List</a>
    </div>
</div>


<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
      <label>Title</label>
      <input type="text" class="form-control" name="title" value="<?= $getContent['title'] ?? ''; ?>">
       <p class="text-danger"><?= $titleErr ?? ''; ?></p>
       
       <label >Description</label>
       <textarea class="form-control" name="description" id = "summernote">
          <?= $getContent['description'] ?? ''; ?>
       </textarea>
       <p class="text-danger"><p class="text-danger"><?= $descriptionErr ?? ''; ?></p></p>
      
       <select class="form-control" name="categoryId">
       <option value="">Select Category</option>

    <?php
    // Loop through the categories obtained from the category manager
      foreach ($categories as $category) {
        $categoryId = $category['id'];
        $categoryName = $category['categoryName']; // Use 'categoryName' instead of 'name'

        // Check if this category is selected (for updating content)
        $selected = isset($getContent['categoryId']) && $getContent['categoryId'] == $categoryId ? 'selected' : '';

        echo "<option value='$categoryId' $selected>$categoryName</option>";
      }
     ?>
       </select>
       <p class="text-danger"><p class="text-danger"><?= $categoryIdErr ?? ''; ?></p></p>

       <label >Thumbnail</label>
        <input type="file" class="form-control" name="thumbnail">
        <?php 
        if(isset($getContent['thumbnail'])){
        ?>
            <img src="public/images/thumbnail/<?=$getContent['thumbnail']; ?>" width="100px">
        <?php
        }
        ?>
        
        <p class="text-danger"><?=  $thumbnailErr ?? ''; ?></p>

    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>