<?php
$user = $this->ion_auth->user()->row();
$gro = $this->ion_auth->get_users_groups()->row();
?>
<div class="page-header">
    <h4 class="page-title"><?= $title ?></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="icon-people"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)">Borrowers</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card card-profile">
            <div class="card-header" style="background-image: url('<?= site_url() ?>/assets/img/blogpost.jpg')">
                <div class="profile-picture">
                    <div class="avatar avatar-xl">
                        <?php if(empty($borrower->avatar)): ?>
                            <img class="avatar-img rounded-circle" alt="preview" src="<?= site_url() ?>assets/img/person.png" />
                        <?php else: ?>
                            <img class="avatar-img rounded-circle" alt="preview" src="<?= preg_match('/data:image/i', $borrower->avatar) ? $borrower->avatar : site_url().'assets/uploads/avatar/'.$user->avatar ?>" />
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="user-profile text-center">
                    <div class="name"><?= $borrower->name ?></div>
                </div>
                <div>
                    Gender: <?= $borrower->gender ?>
                </div>
                <div>
                    Birthdate: <?= date('F d, Y',strtotime($borrower->birthdate)) ?>
                </div>
                <div>
                    Contact No.: <a href="tel:<?= $borrower->number ?>"><?= $borrower->number ?></a>
                </div>
                <div>
                    Occupation: <?= $borrower->occupation ?>
                </div>
                <div>
                    Address: <?= $borrower->address ?>
                </div>
                <?php if(!empty($borrower->spouse_name)):?>
                    <div>
                        Spouse Name: <?= $borrower->spouse_name ?>
                    </div>
                    <div>
                        Spouse Occupation: <?= $borrower->spouse_occupation ?>
                    </div>
                    <div>
                        Spouse Employer Address: <?= $borrower->spouse_em_address ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 clas="card-title">Borrowers Loan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bloanTable" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Loan ID</th>
                                <th>Loan</th>
                                <th>Started</th>
                                <th>Maturity</th>
                                <th>Monthly</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Loan ID</th>
                                <th>Loan</th>
                                <th>Started</th>
                                <th>Maturity</th>
                                <th>Monthly</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if(!empty($loans)): ?>
                                <?php foreach ($loans as $row):?>
                                    <tr>
                                        <td><a href="<?= site_url('loan_details/').$row['id'] ?>">L0<?= $row['id'] ?></a></td>
                                        <td><?= $row['principal'] ?></td>
                                        <td><?= date('m/d/Y', strtotime($row['date_started'])) ?></td>
                                        <td><?= date('m/d/Y', strtotime($row['maturity_date'])) ?></td>
                                        <td>P <?=  number_format($row['monthly'], 2) ?></td>
                                        <td>
                                            <?= $row['status']=='Active' ? '<span class="badge badge-primary badge-pill">Active</span>' : '<span class="badge badge-success badge-pill">Paid</span>' ?>
                                        </td>
                                    </tr>
                                    
                                <?php endforeach;?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 clas="card-title">Transaction History</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="btransTable" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Loan ID</th>
                                <th>Total Amount</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Loan ID</th>
                                <th>Total Amount</th>
                                <th>Username</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if(!empty($transac)): ?>
                                <?php foreach ($transac as $row):?>
                                    <tr>
                                        <td><?= date('m/d/Y', strtotime($row['trans_date'])) ?></td>
                                        <td><a href="<?= site_url('loan_details/').$row['id'] ?>">L0<?= $row['id'] ?></a></td>
                                        <td>P <?= number_format($row['total_amount'], 2) ?></td>
                                        <td><?= $row['username'] ?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('payments/modal') ?>