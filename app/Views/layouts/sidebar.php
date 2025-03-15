<?php
$currentUrl = service('request')->getPath();
$session = session();
$role = $session->get('role');
?>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="dashboard" class="text-nowrap logo-img">
                <img src="<?= base_url('assets/images/logos/dark-logo.svg') ?>" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation admin -->
        <?php if ($role === 'Admin') : ?>
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('dashboard') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Issues</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?= (strpos($currentUrl, 'issue') !== false) ? 'active' : '' ?>" href="<?= base_url('issue') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-list-details"></i>
                            </span>
                            <span class="hide-menu">All Issue</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Users</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?= (strpos($currentUrl, 'users') !== false && strpos($currentUrl, 'users/pending') === false) ? 'active' : '' ?>"
                            href="<?= base_url('users') ?>" aria-expanded="false">
                            <span><i class="ti ti-users"></i></span>
                            <span class="hide-menu">All Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?= (strpos($currentUrl, 'users/pending') !== false) ? 'active' : '' ?>"
                            href="<?= base_url('users/pending') ?>" aria-expanded="false">
                            <span><i class="ti ti-user-exclamation"></i></span>
                            <span class="hide-menu">Pending Users</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- End Sidebar navigation admin-->

        <!-- Sidebar navigation user -->
        <?php if ($role === 'User') : ?>
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <!-- <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url('dashboard') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li> -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Issues</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?= (strpos($currentUrl, 'issue') === 0) ? 'active' : '' ?>" href="<?= base_url('issue') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-list-details"></i>
                            </span>
                            <span class="hide-menu">All Issues</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- End Sidebar navigation admin-->
    </div>
    <!-- End Sidebar scroll-->
</aside>