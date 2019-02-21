<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-blue-light ">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="#" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels <--></-->
				<span class="logo-mini"><b></b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Penjualan</b>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>

					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">

							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="user-image" alt="User Image">
									<span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">

										<p>
											<?php echo $this->session->userdata('nama');  ?>
											<strong><h5>ROLE : <?php echo $this->session->userdata('role');?></h5></strong>
										</p>
									</li>

									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?=site_url('login/logout')?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>