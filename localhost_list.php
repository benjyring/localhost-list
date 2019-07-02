<!DOCTYPE html>
<html class="<?php echo $color_theme; ?>" data-color="<?php echo $color_theme; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="/localhost-list/img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/localhost-list/img/favicon/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/localhost-list/img/favicon/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/localhost-list/img/favicon/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/localhost-list/img/favicon/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/localhost-list/img/favicon/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="/localhost-list/img/favicon/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/localhost-list/img/favicon/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="/localhost-list/img/favicon/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/localhost-list/img/favicon/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="/localhost-list/img/favicon/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="/localhost-list/img/favicon/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="/localhost-list/img/favicon/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="/localhost-list/img/favicon/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="/localhost-list/img/favicon/favicon-128.png" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="/localhost-list/img/favicon/mstile-144x144.png" />
	<meta name="msapplication-square70x70logo" content="/localhost-list/img/favicon/mstile-70x70.png" />
	<meta name="msapplication-square150x150logo" content="/localhost-list/img/favicon/mstile-150x150.png" />
	<meta name="msapplication-wide310x150logo" content="/localhost-list/img/favicon/mstile-310x150.png" />
	<meta name="msapplication-square310x310logo" content="/localhost-list/img/favicon/mstile-310x310.png" />
	<!-- End Favicons -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="localhost-list/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" />
	<link rel="stylesheet" href="localhost-list/app.css" />
	<link rel="stylesheet" href="localhost-list/usercolor.css" />
	<title><?php echo $title; ?></title>
</head>

<body class="<?php echo $highlight; ?>">
	<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
		<a class="brand mr-auto" href="http://<?php echo $_SERVER['SERVER_ADDR']; ?>"><?php echo $_SERVER['SERVER_ADDR']; ?></a>
		<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#options">Options</button>
	</nav>

	<div class="wrapper border-bottom position-relative">
		<div class="container">
			<main role="main">
				<div class="jumbotron">
					<div class="col-sm-10 mx-auto">
						<h1 class="display-1 text-color">Localhost</h1>
							<hr class="my-4">
							<p class="lead">
								<a href="/phpmyadmin"><button class="btn btn-primary btn-lg">phpMyAdmin</button></a>
								<button class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#phpinfo" aria-expanded="false" aria-controls="phpinfo">PHP Info</button>
							</p>
							<div id="phpinfo" class="collapse">
								<?php echo "<pre>" . phpinfo() . "</pre>"; ?>
							</div>
					</div>
				</div>

				<!-- Lists all projects in www directory -->
				<h2 class="text-color">Projects</h2>
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
								} else if (is_dir($folder)){

										foreach ($cms_array as $key => $val){
											if (file_exists($folder . $val['file_path'])){
												$CMS = $key;
												break;
											} else {
												$CMS = "none";
											}
										}

										// if (file_exists($folder . '/.git')){
										// 	$repo = "git";
										// }
									?>

									<li class="list-group-item">
										<div class="row">
											<div class="col-sm-3">
												<a class="name" href="./<?php echo $folder; ?>"><?php echo $folder; ?></a>
											</div>
											<div class="col-sm-3">
												<span class="cms <?php echo $CMS; ?>"></span>
												<!-- <span class="repo <?php //echo $repo; ?>"><?php //echo $repo; ?></span> -->
											</div>
											<div class="col-sm-6">
												<h6 class="small float-right modified"><?php echo "last updated: " . date('F d, Y, h:i A', filemtime($folder)); ?></h6>
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

									<?php foreach ($cms_array as $key => $val) : ?>
										<div class="sort-by">
											<label for="<?php echo $key; ?>">
												<?php echo $val['name']; ?>
											</label>
											<input type="checkbox" name="checkbox" id="<?php echo $key; ?>" value="<?php echo $key; ?>">
										</div>
									<?php endforeach; ?>

									<div class="sort-by">
										<label for="none">No CMS</label>
										<input type="checkbox" name="checkbox" id="none" value="none">
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</main>
		</div>
	</div>

	<footer class="footer fixed-bottom">
		<div class="container d-flex align-items-center">
			<div class="misc">
				<div class="misc-author">
					<img src="http://1.gravatar.com/avatar/5b1a645cfd15dec47f22877a112acbde?size=80" id="ben-pic" class="rounded pull-left mr-4 mb-3">
					<h4>Hi! I'm Ben Jyring, the author of <a href="https://github.com/benjyring/localhost-list">localhost-list.</a></h4>
					<p>I hope you like this using this tool. I’ve put a lot of hours into it! Feel free to follow me on LinkedIn and GitHub for updates, and if you like my work, please consider donating to support future development of open-source tools!</p>

					<div class="follow-button github mr-2">
						<a href="https://github.com/benjyring/">
							<span id="icon-bg"><i class="fa fa-github"></i></span>
							<span id="icon-label-bg">Follow @benjyring</span>
						</a>
					</div>

					<div class="follow-button linkedin mr-2">
						<a href="https://www.linkedin.com/pub/ben-jyring/85/27a/b20?trk=pub-pbmap">
							<span id="icon-bg"><i class="fa fa-linkedin"></i></span>
							<span id="icon-label-bg">Follow Ben Jyring</span>
						</a>
					</div>

					<div class="follow-button donate">
						<a href="https://benjaminjyring.com/stripe.html">
							<span id="icon-bg"><i class="fa fa-credit-card"></i></span>
							<span id="icon-label-bg">Donate $10</span>
						</a>
					</div>

				</div>
			</div>
		</div>
	</footer>

	<!-- Modal -->
	<div class="modal fade" id="options" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Options</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
					<p>Enter additional CMSs by including a filepath to search for, relative to the root of each.</p>
					<p>Follow progress at <a href="https://www.github.com/benjyring/localhost-list">localhost-list</a>!</p>
					<table id="table_add_cms" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Class</th>
								<th scope="col">File Path</th>
							</tr>
						</thead>
						<tbody>
							<?php $index = 1; ?>
							<?php foreach ($cms_array as $key => $val) : ?>
							<tr>
								<th scope="row"><?php echo $index; ?></th>
								<td><?php echo $val['name']; ?></td>
								<td><?php echo $key; ?></td>
								<td><?php echo $val['file_path']; ?></td>
							</tr>
							<?php $index++ ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<div class="row mb-5">
						<div class="col">
							<div id="addNewCMS">+</div>
						</div>
					</div>
					<div class="row my-3">
						<div class="col-12 mb-3">
							<button id="light-theme" class="btn color-scheme"></button>
							<button id="dark-theme" class="btn color-scheme"></button>
							<button id="color-selector" class="btn color-scheme"></button>
							<div id="cp" data-color="<?php echo $highlight; ?>"></div>
						</div>
					</div>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button id="save" type="button" class="btn btn-primary">Save Options</button>
					<form class="d-none" id="save-cms-form" method="post" action="/localhost-list/save_options.php">
							<input id="save-cms-form-submit" type="submit" class="btn btn-primary" value="Save CMSs"/>
					</form>
				</div>
				<div class="modal-footer">
					<div class="row">
						<p class="col-12"><a class="pull-right" href="#" data-toggle="collapse" data-target="#howDoesThisWork" aria-expanded="false" aria-controls="howDoesThisWork">How does this work?</a></p>
						<p id="howDoesThisWork" class="collapse col-12 border-top py-3">Add or delete CMSs as needed, and when finished, click <strong>Save CMSs.</strong> The file <code>options.php</code> will be updated in <strong>/localhost-list,</strong> and your CMS list will be updated!</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- SCRIPTS -->
	<script src="/localhost-list/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="/localhost-list/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/localhost-list/node_modules/list.js/dist/list.min.js"></script>
	<script src="/localhost-list/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script>
		$(function () {
			$('#cp').colorpicker({
				format: 'hex',
				inline: true,
				container: true,
				template: '<div class="colorpicker">' +
				'<div class="colorpicker-saturation"><i class="colorpicker-guide"></i></div>' +
				'<div class="colorpicker-hue"><i class="colorpicker-guide"></i></div>' +
				'<div class="colorpicker-bar">' +
				'   <div class="input-group">' +
				'       <input class="form-control input-block color-io" />' +
				'   </div>' +
				'</div>' +
				'</div>'
			})
			.on('colorpickerCreate', function (e) {
				// initialize the input on colorpicker creation
				var io = e.colorpicker.element.find('.color-io');

				io.val(e.color.string());

				io.on('change keyup', function () {
					e.colorpicker.setValue(io.val());
				});
			})
			.on('colorpickerChange', function (e) {
				var io = e.colorpicker.element.find('.color-io');

				if (e.value === io.val() || !e.color || !e.color.isValid()) {
					// do not replace the input value if the color is invalid or equals
					return;
				}

				io.val(e.color.string());
			});
		});
	</script>
	<script src="localhost-list/app.js"></script>
</body>
</html>
