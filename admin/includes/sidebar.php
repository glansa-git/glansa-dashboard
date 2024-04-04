<?php
include("../config/db_config.php");
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= $mainlink ?>admin/dashboard">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <!-- <li class="nav-item nav-category">UI Elements</li>   -->
        <li class="nav-item">
            <!-- <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">UI Elements</span>
                <span class="menu-title">Site Pages</span>
                <i class="menu-arrow"></i>
            </a> -->
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <!-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> -->
                    <li class="nav-item"> <a class="nav-link" href="<?= $mainlink ?>admin/home">Home</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="<?= $mainlink ?>admin/about">User</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?= $mainlink ?>admin/contact">Department</a>
                    </li>
                    
                </ul>
            </div>
        </li>
        <!-- <li class="nav-item nav-category">Forms and Datas</li> -->
        
</nav>
<div class="main-panel">