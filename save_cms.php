<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$classes = $_POST["class_values"];
$names = $_POST["name_values"];
$file_paths = $_POST["file_path_values"];
$class_array = explode(",", $classes);
$name_array = explode(",", $names);
$file_path_array = explode(",", $file_paths);

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
EOT;

$filename = "cms_array.php";
$cms_array = fopen($filename, "w") or die("Unable to open file!");

fwrite($cms_array, $content);
fclose($cms_array);

header("Location: /");
