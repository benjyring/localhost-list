<?php
$title = 'Localhost';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="localhost-list/app.css" />
	<title><?php echo $title; ?></title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<a class="brand" href="http://<?php echo $_SERVER['SERVER_ADDR']; ?>"><?php echo $_SERVER['SERVER_ADDR']; ?></a>
	</nav>

	<div class="wrapper border-bottom position-relative">
		<div class="container">
			<main role="main">
				<div class="jumbotron">
					<div class="col-sm-10 mx-auto">
						<h1 class="display-1">Localhost</h1>
							<hr class="my-4">
							<p class="lead">
								<a class="btn btn-primary btn-lg" href="/phpmyadmin" role="button">phpMyAdmin</a>
							</p>
					</div>
				</div>

				<!-- PHP Info -->
				<div id="accordion">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">PHP Info</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-body">
								<?php echo "<pre>" . phpinfo() . "</pre>"; ?>
							</div>
						</div>
					</div>
				</div>

				<!-- Lists all projects in www directory -->
				<h2>Projects</h2>
				<div id="localhost-list">
					<div class="row">
						<div class="col-sm-10">
							<div class="input-group mb-3">
								<input class="form-control search" placeholder="Search" />
								<div class="input-group-append">
									<span class="btn input-group-text sort" data-sort="name">Sort by name</span>
								</div>
								<div class="input-group-append">
									<span class="btn input-group-text sort" data-sort="modified">Sort by modified</span>
								</div>
							</div>

							<ul class="list list-group">
							<?php
							$folders = glob('./*', GLOB_ONLYDIR);
							foreach ($folders as $f){
								$tmp[basename($f)] = filemtime($f);
							}
							arsort($tmp);
							$folders = array_keys($tmp);
							foreach ($folders as $folder) {
								if ($folder === '.' or $folder === '..') continue;
								if (is_dir($folder) && file_exists('./' . $folder . '/web/app_dev.php')) {
									?>
									<li><span class="label label-info">Symfony</span> <a href="./<?php echo $folder . '/web/app_dev.php'; ?>"><?php echo $folder; ?></a></li>
									<?php
								} else if (is_dir($folder)) {

										if (file_exists($folder . '/theme.json')){
											$CMS = "tao";
											$CMS_name = "TaoCMS";
										} else if (file_exists($folder . '/wp-config.php')){
											$CMS = "wp";
											$CMS_name = "Wordpress";
										} else if (file_exists($folder . '/drush')){
											$CMS = "d8";
											$CMS_name = "Drupal 8";
										} else if (file_exists($folder . '/INSTALL.pgsql.txt')){
											$CMS = "d7";
											$CMS_name = "Drupal 7";
										} else if (file_exists($folder . '/robots.txt.dist')){
											$CMS = "joomla";
											$CMS_name = "Joomla";
										} else if (file_exists($folder . '/connector.php')){
											$CMS = "todaymade";
											$CMS_name = "TodayMade";
										} else if (file_exists($folder . '/typo3')){
											$CMS = "typo3";
											$CMS_name = "Typo3";
										} else if (file_exists($folder . '/app/i18n/Magento')){
											$CMS = "magento";
											$CMS_name = "Magento";
										} else if (file_exists($folder . '/src/PrestaShopBundle')){
											$CMS = "prestashop";
											$CMS_name = "PrestaShop";
										} else {
											$CMS = "none";
											$CMS_name = "No CMS detected";
										}
									?>

									<li class="list-group-item">
										<div class="row">
											<div class="col-sm-3">
												<a class="name" href="./<?php echo $folder; ?>"><?php echo $folder; ?></a>
											</div>
											<div class="col-sm-3">
												<span class="cms <?php echo $CMS; ?>"><?php echo $CMS_name; ?></span>
											</div>
											<div class="col-sm-6">
												<h6 class="float-right modified"><?php echo "last updated: " . date('F d, Y, h:i A', filemtime($folder)); ?></h6>
											</div>
										</div>
									</li>
									<?php
								}
							}
							?>
							</ul>
						</div>

						<div class="col-sm-2">
							<div class="input-group sort-group">
								<div class="form-control">
									<div class="sort-by">
										<label for="d8">Drupal 8</label>
										<input type="checkbox" name="checkbox" id="d8" value="d8">
									</div>
									<div class="sort-by">
										<label for="d7">Drupal 7</label>
										<input type="checkbox" name="checkbox" id="d7" value="d7">
									</div>
									<div class="sort-by">
										<label for="wp">Wordpress</label>
										<input type="checkbox" name="checkbox" id="wp" value="wp">
									</div>
									<div class="sort-by">
										<label for="tao">taoCMS</label>
										<input type="checkbox" name="checkbox" id="tao" value="tao">
									</div>
									<div class="sort-by">
										<label for="todaymade">TodayMade</label>
										<input type="checkbox" name="checkbox" id="todaymade" value="todaymade">
									</div>
									<div class="sort-by">
										<label for="joomla">Joomla</label>
										<input type="checkbox" name="checkbox" id="joomla" value="joomla">
									</div>
									<div class="sort-by">
										<label for="typo3">Typo3</label>
										<input type="checkbox" name="checkbox" id="typo3" value="typo3">
									</div>
									<div class="sort-by">
										<label for="magento">Magento</label>
										<input type="checkbox" name="checkbox" id="magento" value="magento">
									</div>
									<div class="sort-by">
										<label for="prestashop">PrestaShop</label>
										<input type="checkbox" name="checkbox" id="prestashop" value="prestashop">
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</main>
		</div>
	</div>

	<footer class="footer fixed-bottom bg-dark">
		<div class="container d-flex align-items-center">
			<?php echo date("Y"); ?> © Ben Jyring
		</div>
	</footer>

	<!-- SCRIPTS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
	<script>
		var options = {
		valueNames: [ 'name', 'modified' ]
		};

		var hackerList = new List('localhost-list', options);
	</script>
	<script>
		var lgi = $('.list-group-item');
		$(".sort-by input:checkbox").on('change', function() {
			if ($(".sort-by input:checkbox:checked").length){
				lgi.hide();
			} else {
				lgi.show();
			}
			$(".sort-by input:checkbox:checked").each(function() {
				$("." + $(this).val()).parents(lgi).show();
			});
		});
	</script>
</body>
</html>
