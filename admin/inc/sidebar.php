<!----Sidebar starts---->
<div class="sidebar-container">
    <div class="sidebar-header">
        <div class="header-logo">
            <img src=<?php echo ADMIN_IMAGE_URL."fav.png"?> class="pl-4">
        </div>
        <div class="header-search">
            <button class="button-menu">
                <span class="fas fa-bars" style="color:white;font-size:20px"></span>
            </button>
        </div>
    </div>
    <div class="main">
        <div class="sidebar">
            <ul>
                <li><a href="<?php echo ADMIN_URL."dashboard/" ?>" class="active"><i class="lni lni-home"></i><span>Dashboard</span></a></li>
                <li><a href="<?php echo ADMIN_URL."category/" ?>"><i class="lni lni-text-format"></i><span>Category</span></a></li>
                <li><a href="<?php echo ADMIN_URL."product/" ?>"><i class="lni lni-bar-chart"></i><span>Products</span></a></li>
                <li><a href="<?php echo ADMIN_URL."users/" ?>"><i class="lni lni-grid"></i><span>Users</span></a></li>
                <li><a href="<?php echo ADMIN_URL."settings/" ?>"><i class="lni lni-grid"></i><span>Settings</span></a></li>
                <li><a href="<?php echo ADMIN_URL."orders/index.php" ?>"><i class="lni lni-bullhorn"></i><span>Orders</span></a></li>
                <li><a href="<?php echo ADMIN_URL."help-and-support/" ?>"><i class="lni lni-support"></i><span>Help &amp; Support</span></a></li>
                <li><a href="<?php echo ADMIN_URL."inc/logout.php" ?>"><i class="lni lni-support"></i><span>Logout</span></a></li>
            </ul>
        </div>