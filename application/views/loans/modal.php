<!-- Modal -->
<div class="modal fade" id="addLoan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHead">Create Loan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="create_loan_form" action="<?= site_url('loans/create_loan') ?>">
                    <div class="form-group">
                        <label>Select Borrowers</label>
                        <select class="form-control borrowers" name="borrowers_id" style="width:100%;" required>
                            <optgroup label="Borrower's Name">
                                <?php foreach($borrowers as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Co-Maker Name</label>
                                <input type="text" class="form-control" name="cname" id="cmaker" required placeholder="Enter name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Co-Maker Name</label>
                                <input type="text" class="form-control" name="cname1" id="cmaker1" placeholder="Enter name">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label>Loan Details</label>
                    <div class="form-group">
                        <label>Loan Types</label>
                        <select class="form-control" name="loan_type" id="loan_type" required onchange="getLoanTypes(this)">
                            <option>Custom</option>
                            <?php foreach($loan_type as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Principal Amount</label>
                                <input type="number" class="form-control" name="principal" required placeholder="Enter amount" min="1" id="principal">
                            </div>
                            <div class="form-group">
                                <label>Monthly Interest(%)</label>
                                <input type="number" class="form-control" name="interest" placeholder="Enter interest" required min="1" id="interest">
                            </div>
                            <div class="form-group">
                                <label>Date to Start</label>
                                <input type="date" class="form-control" name="date_started" id="date_started" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Terms(mo)</label>
                                <select class="form-control" name="terms" id="terms" required>
                                    <?php for($i=1; $i<=12; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?> Month/s</option>
                                    <?php endfor ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Penalty(%)</label>
                                <input type="number" class="form-control" name="penalty" id="penalty" placeholder="Enter penalty" required min="0">
                            </div>
                            <div class="form-group">
                                <label>Maturity Date</label>
                                <input type="date" class="form-control" id="maturity_date" name="maturity_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monthly Amortization</label>
                                <input type="text" class="form-control text-right" name="monthly" id="monthly" style="pointer-events: none;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Amount Loan</label>
                                <input type="text" class="form-control text-right" name="total" id="total_amount" style="pointer-events: none;">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label>Notes(Optional)</label>
                        <textarea class="form-control" name="notes" id="notes"></textarea>
                    </div>
                   
            </div>
            <div class="modal-footer">
                <input type="hidden" name="loan_id" id="loan_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="loanType" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Loan Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Loan Name</label>
                    <input type="text" class="form-control" required id="tname" style="pointer-events: none;">
                </div>
                <div class="form-group">
                    <label>Monthly Interest</label>
                    <input type="text" class="form-control" required id="tinterest" style="pointer-events: none;">
                </div>
                <div class="form-group">
                    <label>Terms(mo)</label>
                    <input type="text" class="form-control" required id="tterms" style="pointer-events: none;">
                </div>
                <div class="form-group">
                    <label>Penalty</label>
                    <input type="text" class="form-control" required id="tpenalty" style="pointer-events: none;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addLoantype" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Loan Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('loans/create_loan_type') ?>" id="create_loan_type_form">
                    <div class="form-group">
                        <label>Loan Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Interest</label>
                        <input type="number" class="form-control" name="interest" required>
                    </div>
                    <div class="form-group">
                        <label>Terms(mo)</label>
                        <select class="form-control" name="terms">
                            <?php for($i=1; $i<=12; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> Month/s</option>
                            <?php endfor ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editLoantype" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Loan Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('loans/update_loan_type') ?>" id="edit_loan_type_form">
                    <div class="form-group">
                        <label>Loan Name</label>
                        <input type="text" class="form-control" name="name" required id="loan_type_name">
                    </div>
                    <div class="form-group">
                        <label>Interest</label>
                        <input type="number" class="form-control" name="interest" required id="loan_type_int">
                    </div>
                    <div class="form-group">
                        <label>Terms(mo)</label>
                        <select class="form-control" name="terms" id="loan_type_terms">
                            <?php for($i=1; $i<=12; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> Month/s</option>
                            <?php endfor ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="loan_type_id" id="loan_type_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>