<?php
  require_once('scripts/AdminAccess.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/dashboard.css">
  <link rel="stylesheet" href="public/css/common.css">
  <link rel="stylesheet" href="public/css/navbar.css">
  <link rel="stylesheet" href="public/css/sidebar.css">
</head>
<body>
<style>
 

  </style>



<div class="container-fluid">
 <div class="row">
    <div class="col-sm-3 sidebar-col">
   
     <!-----left sidebar---->
     <?php 
       require_once('views/common/left-sidebar.php');
     ?>
     <!-----left sidebar ---->
   </div>
   <div class="col-sm-9 dashboard-col">
    <!--navbar -->
    <?php 
    require_once('views/common/navbar.php');
    ?>
    <!-- navbar -->
     <!-----dashboard---->
     <div class="dashboard-content">
     <?php
      require_once('../database.php');
      

      if(isset($_GET['page'])) {
        $page = $_GET['page'];
        switch($page) {

           /* Category Navigation */
          case 'category-list':
              require_once 'views/category/table.php';
          break;

          case 'category-form':
            require_once 'views/category/form.php';
          break;
          
          /* Content nvigation*/
          case 'content-list':
            require_once 'views/content/table.php';
          break;
          case 'content-form':
            require_once 'views/content/form.php';
          break;
          case 'content-view':
            require_once 'views/content/view.php';
          break;

          /* Admin Profile*/
          case 'admin-profile-list':
            require_once 'views/admin-profile/table.php';
          break;
          case 'admin-profile-form':
            require_once 'views/admin-profile/form.php';
          break;

            /* site Menu Navigation */
          case 'site-menu-list':
            require_once 'views/site-menu/table.php';
          break;

          case 'site-menu-form':
            require_once 'views/site-menu/form.php';
          break;

            /* site sub Menu Navigation */
          case 'site-sub-menu-list':
            require_once 'views/site-sub-menu/table.php';
          break;

          case 'site-sub-menu-form':
            require_once 'views/site-sub-menu/form.php';
          break;

            /* site SEO Navigation */
          case 'site-seo-list':
            require_once 'views/site-seo/table.php';
          break;
 
          case 'site-seo-form':
            require_once 'views/site-seo/form.php';
          break;

           /* site identity Navigation */
          case 'site-identity-list':
            require_once 'views/site-identity/table.php';
          break;
   
          case 'site-identity-form':
            require_once 'views/site-identity/form.php';
          break;

          /* Logged In Admin */
          case 'profile':
            require_once 'views/admin-profile/profile.php';
          break;

          default:
             echo "<h1 class='text-center mt-4'>404 No Page found</h1>";
        } 

      } else {
            require_once('views/dashboard/intro.php');
            require_once('views/dashboard/support.php');
      }
    ?>
     </div>
     <!-----dashboard ---->
   </div>

 </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/sidebar-list.js"></script>


</body>
</html>


