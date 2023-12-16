
<?php
  require_once('scripts/ContentManager.php');

  $contentManager= new ContentManager($conn);

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  
    $getContent = $contentManager->getFromMultipleTables($id);
    
      
  }

?>

<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">View Content</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=content-list" class="btn btn-success">Content List</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h1><?= isset($getContent['title']) ? $getContent['title'] : ''; ?></h1>
        <p><b>Category: </b><?= isset($getContent['categoryName']) ? $getContent['categoryName'] : ''; ?></p>
        <?php
        if(isset($getContent['thumbnail'])) {
        ?>
        <img src="public/images/thumbnail/<?php echo $getContent['thumbnail']; ?>" width="200px">
        <?php } ?>
        <div class="content">
        <?= isset($getContent['description']) ? $getContent['description'] : ''; ?>
        </div>
    </div>
</div>