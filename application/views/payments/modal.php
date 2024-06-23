<!-- Modal -->
<div class="modal fade" id="addLoan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Loan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="create_loan_form" action="<?= site_url('loans/create_loan') ?>">
                    <div class="form-group">
                        <label>Select Borrowers</label>
                        <select class="form-control borrowers" name="borrowers_id" style="width:100%; pointer-events: none;" required>
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
                                <input type="text" class="form-control" name="cname" id="cmaker" required placeholder="Enter name" style="pointer-events: none;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Co-Maker Name</label>
                                <input type="text" class="form-control" name="cname1" id="cmaker1" placeholder="Enter name" style="pointer-events: none;">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label>Loan Details</label>
                    <div class="form-group">
                        <label>Loan Types</label>
                        <select class="form-control" name="loan_type" id="loan_type" required onchange="getLoanTypes(this)" style="pointer-events: none;">
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
                                <input type="number" class="form-control" name="principal" required placeholder="Enter amount" min="1" id="principal" style="pointer-events: none;">
                            </div>
                            <div class="form-group">
                                <label>Interest(%)</label>
                                <input type="number" class="form-control" name="interest" placeholder="Enter interest" required min="1" id="interest" style="pointer-events: none;">
                            </div>
                            <div class="form-group">
                                <label>Date to Start</label>
                                <input type="date" class="form-control" name="date_started" id="date_started" value="<?= date('Y-m-d') ?>" required style="pointer-events: none;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Terms(mo)</label>
                                <select class="form-control" name="terms" id="terms" required style="pointer-events: none;">
                                    <?php for($i=1; $i<=12; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?> Month/s</option>
                                    <?php endfor ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Penalty(%)</label>
                                <input type="number" class="form-control" name="penalty" id="penalty" placeholder="Enter penalty" required min="0" style="pointer-events: none;">
                            </div>
                            <div class="form-group">
                                <label>Maturity Date</label>
                                <input type="date" class="form-control" id="maturity_date" name="maturity_date" style="pointer-events: none;">
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
                        <textarea class="form-control" name="notes" id="notes" style="pointer-events: none;"></textarea>
                    </div>
                   
            </div>
            <div class="modal-footer">
                <input type="hidden" name="loan_id" id="loan_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay Loan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="pay_loan_form" action="<?= site_url('payments/save_payment') ?>">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label>Amount to Pay</label>
                        <input type="number" min="1" step="0.01" id="amount" class="form-control" name="amount">
                    </div>
                    <div class="form-group">
                        <label>Notes(Optional)</label>
                        <input type="text" class="form-control" name="notes" value="Monthly Payment">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="pment_id" name="pment_id">
                <input type="hidden" id="p_terms" name="terms">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-info" name="skip" value="Skip" id="skip">
                <input type="submit" class="btn btn-primary" name="skip" value="Pay Now">
            </div>
            </form>
        </div>
    </div>
</div>