<header>
	<nav class="main-header navbar navbar-expand-md navbar-light navbar-white border-bottom">
	<div class="container">
		<a href="/" class="navbar-brand">
			<img src="https://cdn.iconscout.com/icon/free/png-256/nintendo-2296041-1912000.png" alt="LOGO" style="width:40px;" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">DVD</span>
		</a>
		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse order-3" id="navbarCollapse">

			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="/" class="nav-link">Home</a>
				</li>
				<?php if ($_SESSION['level'] == 'Admin'){ 
            	?>
				<li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">User Management</a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
						<li><a href="user.php" class="dropdown-item">User</a></li>
						<li><a href="register.php" class="dropdown-item">Registration</a></li>
						<li class="dropdown-divider"></li>
					</ul>
				</li>
				<?php
				}else{ // Jika role-nya operator
				    ?>
				    
				    <?php
				}
				?>
				<li class="nav-item">
					<a href="pinjam.php" class="nav-link">Peminjaman</a>
				</li>
				
				
			</ul>

			
		</div>

		<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><?php echo  $_SESSION['username'] . "</h1>"; ?>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#"><?php echo $_SESSION['level']; ?></a>
				<a class="dropdown-item" href="logout.php">Logout</a>
			</div>
		</li>

		<li class="nav-item">
			<a class="nav-link disabled" href="#"></a>
		</li>
		
	</ul>
</div>
</nav>
</header>
