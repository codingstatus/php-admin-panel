<div class="left-sidebar bg-dark">
<h3>Admin Panel</h3>
<ul class="nav flex-column collapsible mt-4">

<!--- Dashboard--->
<li class="nav-item">
    <a href="dashboard.php" class="nav-link">
    <i class="fa fa-home"></i> Dashboard
    </a>
</li>

  <!--- Website content--->
  <li class="nav-item toggle">
    <a class="nav-link" href="#"><i class="fa fa-laptop"></i>  Website Content</a>

    <ul class="nav flex-column toggle-list">
        <li class="nav-item">
            <a href="dashboard.php?page=category-list" class="nav-link">
            <i class="fa fa-list"></i> Category
            </a>
        </li>
        <li class="nav-item">
            <a href="dashboard.php?page=content-list" class="nav-link">
            <i class="fa fa-list"></i> Content
            </a>
        </li>
    </ul>
  </li>

<!--- Website Settings--->
<li class="nav-item toggle">
    <a class="nav-link" href="#"><i class="fa fa-cog"></i> Website Settings</a>

    <ul class="nav flex-column toggle-list">
        <li class="nav-item">
            <a href="dashboard.php?page=site-identity-list" class="nav-link">
            <i class="fa fa-vcard-o"></i> Site Identity
        </a>
        </li>
        <li class="nav-item">
            <a href="dashboard.php?page=site-seo-list" class="nav-link">
            <i class="fa fa-search"></i> Site SEO
            </a>
        </li>
        <li class="nav-item">
            <a href="dashboard.php?page=site-menu-list" class="nav-link">
            <i class='fa fa-list-ul'></i> Site Menu
            </a>
        </li>
        <li class="nav-item">
            <a href="dashboard.php?page=site-sub-menu-list" class="nav-link">
            <i class='fa fa-list-alt'></i> Site Sub-menu
            </a>
        </li>
    </ul>
</li>

     <!--- Admins--->
     <li class="nav-item toggle">
    <a class="nav-link" href="#"><i class="fa fa-users"></i> Admins</a>

    <ul class="nav flex-column toggle-list">
        <li class="nav-item">
            <a href="dashboard.php?page=admin-profile-list" class="nav-link">
            <i class="fa fa-address-card-o"></i> Admins Profile
        </a>
        </li>
    </ul>
</li>



</ul>

</div>