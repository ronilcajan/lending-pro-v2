<?php
$user = $this->ion_auth->user()->row();
?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        
        <a href="<?= site_url() ?>" class="logo">
            <img src="<?= site_url() ?>/assets/img/logo.png" alt="navbar brand" class="navbar-brand">
            <span class="text-light ml-2 fw-bold" style="font-size:20px">
              Loan App
            </span>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                       <i class="icon-settings"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                    <?php if(empty($user->avatar)): ?>
                                        <img src="<?= site_url() ?>assets/img/person.png" alt="image profile" class="avatar-img rounded">
                                    <?php else: ?>
                                        <img src="<?=  preg_match('/data:image/i', $user->avatar) ? $user->avatar : site_url() ?>assets/uploads/avatar/<?= $user->avatar ?>" alt="image profile" class="avatar-img rounded">
                                    <?php endif ?>
                                        
                                    </div>
                                    <div class="u-text">
                                        <h4><?= $user->first_name.' '.$user->last_name ?></h4>
                                        <p class="text-muted"><?= $user->email ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('auth/user_profile/').$user->id ?>">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>