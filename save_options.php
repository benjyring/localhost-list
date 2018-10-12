<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$classes = $_POST["class_values"];
$names = $_POST["name_values"];
$file_paths = $_POST["file_path_values"];
$class_array = explode(",", $classes);
$name_array = explode(",", $names);
$file_path_array = explode(",", $file_paths);
$theme = $_POST["color_scheme"];
$highlight_color = $_POST["highlight_color"];

$content = <<<EOT
<?php
\$cms_array = array(
EOT;
foreach ($class_array as $key => $value):
$content.=<<<EOT

	'$value' => array(
		'name' => '{$name_array[$key]}',
		'file_path' => '{$file_path_array[$key]}',
	),
EOT;
endforeach;
$content.=<<<EOT

);
\$color_theme = '$theme';
\$highlight = '$highlight_color';
EOT;

$filename = "options.php";
$cms_array = fopen($filename, "w") or die("Unable to open file!");

fwrite($cms_array, $content);
fclose($cms_array);

$usercolor_css = <<<EOT
.cms, .sort-by label, .modified, .repo, .jumbotron h1, h4 a, nav a, a:link.name, a:visited.name, h4 a:active, h4 a:focus, h4 a:hover, nav a:active, nav a:focus, nav a:hover, a:link, a:link:active, a:link:focus, a:link:hover, a:visited:active, a:visited:focus, a:visited:hover, a:link.name:active, a:link.name:focus, a:link.name:hover, a:visited.name:active, a:visited.name:focus, a:visited.name:hover, footer .container {
	color: $highlight_color !important;
}

#addNewCMS, .btn-primary {
	color: $highlight_color !important;
}
EOT;

$usercolor_filename = "usercolor.css";
$usercolor_file = fopen($usercolor_filename, "w") or die("Unable to open file!");

fwrite($usercolor_file, $usercolor_css);
fclose($usercolor_file);

header("Location: /");
