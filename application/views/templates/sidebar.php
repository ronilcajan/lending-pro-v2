<?php $current_page = $this->uri->segment(1); ?>
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item <?= $current_page == 'dashboard' ? 'active' : null ?>">
                    <a href="<?= site_url('dashboard') ?>">
                        <i class="icon-grid"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">MENU</h4>
                </li>
                <li class="nav-item <?= $current_page == 'borrowers' || $current_page == 'borrowers_profile' ? 'active' : null ?>">
                    <a href="<?= site_url('borrowers') ?>">
                        <i class="icon-people"></i>
                        <p>Borrowers</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'loans' || $current_page == 'loan_details' ? 'active' : null ?>">
                    <a href="<?= site_url('loans') ?>">
                        <i class="flaticon-database"></i>
                        <p>Loans</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'transactions' ? 'active' : null ?>">
                    <a href="<?= site_url('transactions') ?>">
                        <i class="fas fa-exchange-alt"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'reports' ? 'active' : null ?>">
                    <a href="<?= site_url('reports') ?>">
                        <i class="far fa-chart-bar"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'loan_type' ? 'active' : null ?>">
                    <a href="<?= site_url('loan_type') ?>">
                        <i class="icon-equalizer"></i>
                        <p>Loans Types</p>
                    </a>
                </li>
                <?php if ($this->ion_auth->is_admin()) : ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">System</h4>
                    </li>
                    <li class="nav-item <?= $current_page == 'users' ? 'active' : null ?>">
                        <a data-toggle="collapse" href="#settings">
                            <i class="icon-settings"></i>
                            <p>Settings</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse <?= $current_page == 'users' ? 'show' : null ?>" id="settings">
                            <ul class="nav nav-collapse">
                                <li class="<?= $current_page == 'users' ? 'active' : null ?>">
                                    <a href="<?= site_url('users') ?>">
                                        <span class="sub-item">Users</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#restore" data-toggle="modal">
                                        <span class="sub-item">Restore</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= site_url('settings/backup') ?>">
                                        <span class="sub-item">Backup</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->