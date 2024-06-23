<div class="page-header">
    <h4 class="page-title"><?= $title ?></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="icon-equalizer"></i>
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
        <a href="#addLoantype" data-toggle="modal" class="btn btn-secondary btn-round text-light">Create Loan Type</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Loan Type Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Interest(%)</th>
                                <th>Terms(mo)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Interest(%)</th>
                                <th>Terms(mo)</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if(!empty($loan_type)): ?>
                                <?php foreach ($loan_type as $row):?>
                                    <tr>
                                        <td><?= ucwords($row['name']) ?></td>
                                        <td><?= ucwords($row['interest']) ?> %</td>
                                        <td><?= ucwords($row['terms']) ?> Months</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a type="button" href="#editLoantype" data-toggle="modal" class="btn btn-link btn-primary pl-1 pr-1" title="Edit Loan Type" onclick="editLoantype(this)"
                                                    data-id="<?= $row['id'] ?>" data-typename="<?= $row['name'] ?>" data-interest="<?= $row['interest'] ?>" data-terms="<?= $row['terms'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a type="button" href="<?= site_url("loans/delete_loan_type/".$row['id']) ;?>" data-toggle="tooltip" 
                                                    onclick="return confirm('Are you sure you want to delete this loan type?');" 
                                                    class="btn btn-link btn-danger pl-1 pr-1" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
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

<?php $this->load->view('loans/modal') ?>