<?php
$title = 'Welcome';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title><?php echo $title; ?></title>

	<style>
		#accordion {
			margin-top: 60px;
		}
		.btn.sort.asc,
		.btn.sort.desc {
			background-color: #ddd;
		}
		.btn.sort:after {
			content: " ";
		}
		.btn.sort.asc:after {
			content: "up";
		}
		.btn.sort.desc {
			content: "up";
		}
		.jumbotron h1 {
			text-transform: capitalize;
		}
		.wrapper {
			background-color: #fff;
			margin-bottom: 100vh;
			padding-bottom: 30px;
			z-index: 1031;
		}
		footer {
			background: #e9ecef;
			z-index: 1;
		}
		footer .container {
			height: 100vh;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<a class="brand" href="http://<?php echo $_SERVER['SERVER_ADDR']; ?>"><?php echo $_SERVER['SERVER_ADDR']; ?></a>
	</nav>

	<div class="wrapper border-bottom position-relative">
		<div class="container">
			<main role="main">
				<div class="jumbotron">
					<div class="col-sm-8 mx-auto">
						<h1><?php echo $_SERVER['SERVER_NAME']; ?></h1>
					</div>
				</div>

				<!-- Lists all projects in www directory -->
				<h2>Projects</h2>
				<div id="localhost-list">
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
							?>
							<li class="list-group-item">
								<a class="name" href="./<?php echo $folder; ?>"><?php echo $folder; ?></a>
								<h6 class="modified"><?php echo filemtime($folder); ?></h6>
							</li>
							<?php
						}
					}
					?>
					</ul>
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
			</main>
		</div>
	</div>

	<footer class="footer fixed-bottom">
	<div class="container d-flex align-items-center">
		<?php echo date("Y"); ?> © Ben Jyring
	</div>
</footer>

	<!-- SCRIPTS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
	<script>
		var options = {
		valueNames: [ 'name', 'modified' ]
		};

		var hackerList = new List('localhost-list', options);
		localhost-list
	</script>
</body>
</html>
