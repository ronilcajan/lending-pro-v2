<?php $user = $this->ion_auth->user()->row(); ?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-9">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="page-pretitle">
                    Loans
                </h6>
                <h4 class="page-title"><?= $title ?></h4>
            </div>
            <div class="col-auto">
                <a href="javascript:void(0)" class="btn btn-primary ml-2" onclick="printDiv('printThis')">
                    Print
                </a>
            </div>
        </div>
        <div class="page-divider"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-invoice" id="printThis">
                    <div class="card-header">
                        <div class="text-center">
                            <h3 class="invoice-title"><?= $title ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="separator-solid"></div>
                        <div class="">
                            <p>This loan agreement is made and will be effective on
                                <input value="<?= date('m/d/Y', strtotime($loans->date_started)) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" />
                            </p>
                            <p>BETWEEN</p>
                            <p>
                                <input value="<?= $borrower->name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" />
                                hereinafter referred to as the "Borrowers" with a street address of
                                <input value="<?= $borrower->address ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:100%" />
                            </p>
                            <p>AND</p>
                            <p>
                                <input value="<?= $user->first_name . ' ' . $user->last_name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" />
                                hereinafter referred to as the "Lender" with a street address of
                                <input value="<?= $user->address ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:100%" />
                            </p>
                        </div>
                        <div class="mt-5">
                            <p class="mb-0"><b>Terms and Conditions:</b></p>
                            <div class="separator-solid mt-1"></div>
                            <p>Promised to Pay:</p>
                            <p>
                                Within
                                <input value="<?= $loans->terms ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:50px" />
                                months from today, Borrowers promises to pay the Lender
                                <input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:380px" />
                            </p>
                            <p>
                                Pesos (P
                                <input value="<?= number_format($loans->principal, 2) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:150px" /> )
                                and interest as well as other charges owed below.
                            </p>
                            <p><b>Details of Loan: Agreed Between Borrowers and Lender:</b></p>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Amount of Loan:</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :P <input value="<?= number_format($loans->principal, 2) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Service Charge:</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :P <input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Old Balance:</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :P <input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p><b>Net Proceeds</b></p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :P <input value="<?= number_format($loans->principal, 2) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Interest rate per month</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    : <input value="<?= $loans->interest ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                    %
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Monthly Amortization</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :P <input value="<?= number_format($loans->monthly, 2) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Term</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    : <input value="<?= $loans->terms ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                    months
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Start of Payment</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :<input value="<?= date('m/d/Y', strtotime($loans->date_started)) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 text-center">
                                    <p>Maturity Date</p>
                                </div>
                                <div class="col-md-8 col-8">
                                    :<input value="<?= date('m/d/Y', strtotime($loans->maturity_date)) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" />
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6 col-6 text-center">
                                    <p><input value="<?= $borrower->name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" /></p>
                                    <p>Borrower</p>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <p><input value="<?= $borrower->co_maker ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" /></p>
                                    <p>Co Maker</p>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6 col-6 text-center">
                                    <p><input value="<?= $user->first_name . ' ' . $user->last_name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:250px" /></p>
                                    <p>Authorize Representative/Lender</p>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>