<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
	<a class="navbar-brand" href="/home">Simple CMS</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item <?php echo ($page === 'Home Page') ? 'active' : '' ; ?>">
				<a class="nav-link" href="<?php echo URL; ?>/home">Home <span class="sr-only">(current)</span></a>
			</li>

			<li class="nav-item dropdown <?php echo ($page === 'List Articles') ? 'active' : '' ; ?>">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Articles
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<?php 
						if ($User_Class->getData['role'] >= 2) {
							echo '<a class="dropdown-item" href="'. URL .'/articles/all">List All</a>';
						}
					?>
					<a class="dropdown-item" href="<?php echo URL; ?>/articles/my">List My</a>
					<a class="dropdown-item" href="<?php echo URL; ?>/articles/insert">New Article</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="api/read/articles">Get API</a>
				</div>
			</li>

			<?php
				$active = ($page === "List Users") ? "active" : "";
				if ($User_Class->getData['role'] >= 2) {
					echo '
						<li class="nav-item dropdown '. $active .'">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Users
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="'. URL .'/users">List All</a>
								<a class="dropdown-item disabled" href="#">New User</a>
							</div>
						</li>';
				}
			?>
		</ul>

		<ul class="nav navbar-nav ml-auto">
			<li class="nav-item dropdown <?php echo ($page === 'Profile') ? 'active' : '' ; ?>">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $User_Class->getData['username']; ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?php echo URL; ?>/profile">Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>