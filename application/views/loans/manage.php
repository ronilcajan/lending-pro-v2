<div class="page-header">
    <h4 class="page-title"><?= $title ?></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-database"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)">Loans</a>
        </li>
    </ul>
    <div class="ml-md-auto py-2 py-md-0">
        <a href="#addLoan" data-toggle="modal" class="btn btn-secondary btn-round text-light" onclick="create_loan()">Create Loans</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="loanTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Loan ID</th>
                                <th>Name</th>
                                <th>Amount Loan</th>
                                <th>Loan Type</th>
                                <th>Date Started</th>
                                <th>Maturity Date</th>
                                <th>Monthly</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Loan ID</th>
                                <th>Name</th>
                                <th>Amount Loan</th>
                                <th>Loan Type</th>
                                <th>Date Started</th>
                                <th>Maturity Date</th>
                                <th>Monthly</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if (!empty($loans)) : ?>
                                <?php foreach ($loans as $row) : ?>
                                    <?php
                                    if ($row['loan_type'] != 'Custom') {
                                        $type_id = $row['loan_type'];
                                        $query = $this->db->query("SELECT * FROM loan_type WHERE id=$type_id");
                                        $type = $query->row();
                                    }
                                    ?>
                                    <tr>
                                        <td><a href="<?= site_url('loan_details/') . $row['id'] ?>">L0<?= $row['id'] ?></a></td>
                                        <td><a href="<?= site_url('borrowers_profile/') . $row['borrowers_id'] ?>"><?= $row['name'] ?></a></td>
                                        <td>P <?= number_format($row['principal'], 2) ?></td>
                                        <td>
                                            <?php if ($row['loan_type'] == 'Custom') : ?>
                                                <a href="#loanType" data-toggle="modal" data-name="<?= $row['loan_type'] ?>" data-terms="<?= $row['terms'] ?>" data-interest="<?= $row['interest'] ?>" data-penalty="<?= $row['penalty'] ?>" onclick="viewloan_type(this)">
                                                    <?= $row['loan_type'] ?>
                                                </a>
                                            <?php else : ?>
                                                <a href="#loanType" data-toggle="modal" data-name="<?= $type->name ?>" data-terms="<?= $type->terms ?>" data-interest="<?= $type->interest ?>" data-penalty="<?= $row['penalty'] ?>" onclick="viewloan_type(this)">
                                                    <?= $type->name ?>
                                                </a>
                                            <?php endif ?>
                                        </td>
                                        <td><?= date('m/d/Y', strtotime($row['date_started'])) ?></td>
                                        <td><?= date('m/d/Y', strtotime($row['maturity_date'])) ?></td>
                                        <td>P <?= number_format($row['monthly'], 2) ?></td>
                                        <td>P <?= number_format($row['total_amount'], 2) ?></td>
                                        <td>
                                            <?= $row['status'] == 'Active' ? '<span class="badge badge-primary badge-pill">Active</span>' : '<span class="badge badge-success badge-pill">Paid</span>' ?>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <?php if ($row['status'] == 'Active') : ?>
                                                    <a type="button" href="#addLoan" data-toggle="modal" class="btn btn-link btn-primary pl-1 pr-1" title="Edit Loan Details" onclick="editLoan(this)" data-id="<?= $row['id'] ?>" data-bid="<?= $row['borrower_id'] ?>" data-cmaker="<?= $row['co_maker'] ?>" data-cmaker1="<?= $row['co_maker2'] ?>" data-ltype="<?= $row['loan_type'] ?>" data-amount="<?= $row['principal'] ?>" data-terms="<?= $row['terms'] ?>" data-inter="<?= $row['interest'] ?>" data-penal="<?= $row['penalty'] ?>" data-dstart="<?= $row['date_started'] ?>" data-mdate="<?= $row['maturity_date'] ?>" data-monthly="<?= $row['monthly'] ?>" data-total="<?= $row['total_amount'] ?>" data-notes="<?= $row['notes'] ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif ?>
                                                <a type="button" href="<?= site_url("loans/authority/" . $row['id']); ?>" data-toggle="tooltip" class="btn btn-link btn-success pl-1 pr-1" data-original-title="Letter of Authority">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>
                                                <a type="button" href="<?= site_url("loans/agreement/" . $row['id']); ?>" data-toggle="tooltip" class="btn btn-link btn-info pl-1 pr-1" data-original-title="Personal Loan Agreement">
                                                    <i class="fas fa-file-contract"></i>
                                                </a>
                                                <a type="button" href="<?= site_url("loans/ledger/" . $row['id']); ?>" data-toggle="tooltip" class="btn btn-link btn-info pl-1 pr-1" data-original-title="Loan Ledger">
                                                    <i class="icon-notebook"></i>
                                                </a>
                                                <a type="button" href="<?= site_url('loan_details/') . $row['id'] ?>" data-toggle="tooltip" class="btn btn-link btn-primary pl-1 pr-1" data-original-title="Payments">
                                                    <i class="icon-wallet"></i>
                                                </a>
                                                <a type="button" href="<?= site_url("loans/delete/" . $row['id']) ?>" data-toggle="tooltip" onclick="return confirm('Are you sure you want to delete this loan?');" class="btn btn-link btn-danger pl-1 pr-1" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('loans/modal') ?>