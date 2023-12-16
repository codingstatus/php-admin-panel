

<?php 
  require_once('scripts/SiteIdentity.php');
  $siteIdentity= new siteIdentity($conn);
  $content = $siteIdentity->get();


 
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">SiteIdentity List</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=site-identity-form" class="btn btn-success">Add New</a>
    </div>
</div>

<div class="table-responsive-sm">
<table class="table table-hover">
    <thead>
      <tr>
      <th>S.N</th>
        <th>Name</th>
        <th>Favicon</th>
        <th>Logo</th>
        <th colspan="3" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($content)) {
           
        $sn = 1;
       foreach($content as $data){
        ?>
      <tr>
      <td><?= $sn; ?></td>
        <td><?= $data['name']; ?></td>
        <td class="text-center">
          <?php
          if(isset($data['favicon'])) {
        ?>
        <img src="public/images/favicon/<?php echo $data['favicon']; ?>" width="50px">
        <?php } ?>
        </td>
        <td class="text-center">
          <?php
          if(isset($data['logo'])) {
        ?>
        <img src="public/images/logo/<?php echo $data['logo']; ?>" width="200px">
        <?php } ?>
        </td>
        <td class="text-center">
            <a href="dashboard.php?page=site-identity-form&id=<?= $data['id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
            </a>
        </td>
        <td  class="text-center">
            <a href="javascript:void(0)" onclick="confirmSiteIdentityDelete(<?=$data['id']; ?>)" class="text-danger">
              <i class="fa fa-trash-o"></i>
            </a>
        </td>
       
      </tr>
       <?php 
        $sn++; }
        } else {
       ?>
     <tr>
        <td colspan="3">No category Found</td>
       
      </tr>
       <?php } ?>
      
      
    </tbody>
  </table>
</div>

<script src="public/js/ajax/delete-siteidentity.js"></script>