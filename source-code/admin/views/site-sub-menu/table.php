

<?php 

  require_once('scripts/SiteSubMenu.php');

  $sitsubemenu= new SiteSubMenu($conn);
  $sitesubmenu = $sitsubemenu->get();

 
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Site Sub Menu List</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=site-sub-menu-form" class="btn btn-success">Add New</a>
    </div>
</div>

<div class="table-responsive-sm">
<table class="table table-hover">
    <thead>
      <tr>
      <th>S.N</th>
        <th>Site sub Menu Name</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($sitsubemenu)) {
           
        $sn = 1;
       foreach($sitesubmenu as $data){
        ?>
      <tr>
      <td><?= $sn; ?></td>
        <td><?= $data['sitesubmenuName']; ?></td>
        <td class="text-center">
            <a href="dashboard.php?page=site-sub-menu-form&id=<?= $data['id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
            </a>
        </td>
        <td  class="text-center">
            <a href="javascript:void(0)" onclick="confirmSiteSubMenu(<?=$data['id']; ?>)" class="text-danger">
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

<script src="public/js/ajax/delete-site-sub-menu.js"></script>