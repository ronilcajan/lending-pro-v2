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
                        <div class="row">
                            <div class="col-md-8 col-8"></div>
                            <div class="col-md-4 col-4 text-right">
                                <p>Date: <input value="<?= date('m/d/Y') ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/></p>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <p>
                                I 
                                <input value="<?= $borrower->name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                                hereby authorized 
                                <input value="Mr. <?= $user->first_name.' '.$user->last_name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                                to hold in possession my ATM Payroll Account with details indicated below as collateral to my loan amounting to P
                                <input value="<?= number_format($loans->principal,2) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                                payable for 
                                <input value="<?= $loans->terms ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:50px"/>
                                months with 
                                <input value="<?= $loans->interest ?> (%)" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:100px"/>
                                percent rate fixed every month.
                            </p>
                            <p>
                                This Authorization is irrevocable until my loan obligation as indicated above and stipulated in attached Loan Agreement and Promissory Note has been paid full.
                            </p>
                        </div>
                        <h4><b>ATM DETAILS</b></h4>
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <p>Account Name</p>
                            </div>
                            <div class="col-md-9 col-9">
                                :<input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <p>Account Number</p>
                            </div>
                            <div class="col-md-9 col-9">
                                :<input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <p>Account Type</p>
                            </div>
                            <div class="col-md-9 col-9">
                                :<input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <p>Bank</p>
                            </div>
                            <div class="col-md-9 col-9">
                                :<input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <p>PIN Number</p>
                            </div>
                            <div class="col-md-9 col-9">
                                :<input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print"/>
                            </div>
                        </div>
                        <div class="row mt-5 mb-4">
                            <div class="col-md-4 col-4 text-center">
                                <p>Authorized and Certified Correct by:</p>
                                <p class="mb-0"><input value="<?= $borrower->name ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:100%" /></p>
                                <p><b>BORROWER</b></p>
                            </div>
                        </div>
                        <p>Witness,</p>
                        <div class="row">
                            <div class="col-md-4 col-4 text-center">
                                <p><input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:100%" /></p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-4">
                            <div class="col-md-4 col-4 text-center">
                                <p>Lending's Authorized Representative;</p>
                                <p class="mb-0"><input onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="width:100%" /></p>
                                <p>
                                    <input value="<?= strtoupper($user->first_name.' '.$user->last_name) ?>" onchange="this.setAttribute('value', this.value)" class="fw-bold text-center input_print" style="border-bottom:none;width:100%" />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>