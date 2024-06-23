
<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('templates/header'); ?>
</head>
<body>
	<div id="loading-container" class="preloader">
        <div id="loading-screen">
            <div class="loader loader-lg"></div>
        </div>
    </div>
	<div class="wrapper">
		<?php $this->load->view('templates/topbar'); ?>

		<?php $this->load->view('templates/sidebar'); ?>

		<div class="main-panel">
			
			<div class="container">
				<div class="page-inner">
					<?php if(!empty($message) || !empty($this->session->flashdata('message'))): ?>
						<div class="alert alert-<?= $this->session->flashdata('success'); ?>" role="alert">
							<?php 
								if(!empty($message)){
									echo $message;
								}elseif(!empty($this->session->flashdata('message'))){
									echo $this->session->flashdata('message');
								}else{
									null;
								}
							?>
						</div>
					<?php endif ?>

					<?= $content ?>

				</div>
			</div>

			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link text-muted" href="javascript:void(0)">
								© Loan Application System
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2021, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https:ronilcajan.ml" target="_blank">R Labs, Inc.</a>
					</div>				
				</div>
			</footer>
		</div>
	</div>
	<?php $this->load->view('modal'); ?>
	<?php $this->load->view('templates/footer'); ?>
</body>
</html>