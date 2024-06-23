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
    <div class="ml-md-auto py-2 py-md-0">
        <a href="#addBorrowers" data-toggle="modal" class="btn btn-secondary btn-round text-light">Add Borrowers</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="borrowersTable" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Contact Number</th>
                                <th>Occupation</th>
                                <th>Employer's Address</th>
                                <th>Permanent Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Contact Number</th>
                                <th>Occupation</th>
                                <th>Employer's Address</th>
                                <th>Permanent Address</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if(!empty($borrowers)): ?>
                                <?php foreach ($borrowers as $row):?>
                                    <tr>
                                        <td>
                                            <a href="<?= site_url('borrowers_profile/').$row['id'] ?>">
                                                <?php if(empty($row['avatar'])): ?>
                                                    <div class="avatar avatar-xs">
                                                        <img  class="avatar-img rounded-circle" alt="user" src="<?= site_url() ?>assets/img/person.png" />
                                                    </div>
                                                <?php else: ?>
                                                    <div class="avatar avatar-xs">
                                                        <img class="avatar-img rounded-circle" alt="user" src="<?= preg_match('/data:image/i', $row['avatar']) ? $row['avatar'] : site_url().'assets/uploads/borrowers/'.$row['avatar'] ?>" />
                                                    </div>
                                                <?php endif ?>
                                                <?= ucwords($row['name']) ?>
                                            </a>
                                        </td>
                                        <td><?= $row['gender'] ?></td>
                                        <td><?= date('m/d/Y',strtotime($row['birthdate'])) ?></td>
                                        <td><a href="tel:<?= $row['number'] ?>"><?= $row['number'] ?></a></td>
                                        <td><?= $row['occupation'] ?></td>
                                        <td><?= $row['employer_address'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a type="button" href="#editBorrowers" data-toggle="modal" class="btn btn-link btn-primary pl-1 pr-1" title="Edit Borrowers" onclick="editBorrowers(this)"
                                                    data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>" data-gender="<?= $row['gender'] ?>" data-bdate="<?= $row['birthdate'] ?>"
                                                    data-num="<?= $row['number'] ?>" data-occu="<?= $row['occupation'] ?>" data-em_address="<?= $row['employer_address'] ?>" data-spouse="<?= $row['spouse_name'] ?>"
                                                    data-spouse_occ="<?= $row['spouse_occupation'] ?>" data-spouse_em_add="<?= $row['spouse_em_address'] ?>" data-address="<?= $row['address'] ?>" data-avatar="<?= $row['avatar'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a type="button" href="<?= site_url("borrowers/delete/".$row['id']) ;?>" data-toggle="tooltip" 
                                                    onclick="return confirm('Are you sure you want to delete this borrower?');" 
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

<?php $this->load->view('borrowers/modal') ?>