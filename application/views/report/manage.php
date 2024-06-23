<div class="page-header">
    <h4 class="page-title"><?= $title ?></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="fas fa-exchange-alt"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)">Transactions</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="reportTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Loan No</th>
                                <th>Borrower</th>
                                <th>Loan Amount</th>
                                <th>Loan Balance</th>
                                <th>Status</th>
                                <th>Date Granted</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Loan No</th>
                                <th>Borrower</th>
                                <th>Loan Amount</th>
                                <th>Loan Balance</th>
                                <th>Status</th>
                                <th>Date Granted</th>
                                <th>Due Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if (!empty($reports)) : ?>
                                <?php $no = 0;
                                $query = $this->db->query("SELECT * FROM payment JOIN loan ON payment.loan_id=loan.id WHERE payment.status='Processing' GROUP BY payment.id");
                                $due_date = $query->result();

                                function diffMonth($from, $to)
                                {

                                    $fromYear = date("Y", strtotime($from));
                                    $fromMonth = date("m", strtotime($from));
                                    $toYear = date("Y", strtotime($to));
                                    $toMonth = date("m", strtotime($to));
                                    if ($fromYear == $toYear) {
                                        return ($toMonth - $fromMonth) + 1;
                                    } else {
                                        return (12 - $fromMonth) + 1 + $toMonth;
                                    }
                                }
                                foreach ($reports as $row) :

                                    $id = $row['loan_id'];
                                    $amount = 0;
                                    $total = 0;
                                    $balance = 0;
                                    $bal_query = $this->db->query("SELECT * FROM payment JOIN loan ON loan.id=payment.loan_id WHERE loan.id=$id");
                                    foreach ($bal_query->result() as $bal) {
                                        if (!$bal->amount) {
                                            $principal = 0;
                                        } else {
                                            $principal = $bal->amount - ($bal->p_interest + $bal->p_penalty);
                                        }
                                        $amount += $principal;
                                        $balance = $total - $amount;
                                    }
                                    $date = diffMonth($due_date[$no]->due_date, date('Y-m-d'));
                                ?>
                                    <tr>
                                        <td>L0<?= $id ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= number_format($row['principal'], 2) ?></td>
                                        <td><?= number_format($balance + $row['principal'], 2) ?></td>
                                        <td>
                                            <?php if (strtotime($due_date[$no]->due_date) > strtotime('now')) : ?>
                                                <?= 'Current' ?>
                                            <?php else : ?>
                                                <?= $date == 1 ? 'DL1' : null ?>
                                                <?= $date == 2 ? 'DL2' : null ?>
                                                <?= $date > 2 ? 'DL3' : null ?>
                                            <?php endif ?>

                                        </td>
                                        <td><?= date('m/d/Y', strtotime($row['date_started'])) ?></td>
                                        <td><?= date('m/d/Y', strtotime($row['due_date'])) ?></td>
                                    </tr>
                                <?php $no++;
                                endforeach;
                                ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>