<!DOCTYPE html>
<html lang="en">
<!-- Marc Peral DAW 2 -->

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<?php include_once("src/internal/viewFunctions/header.php"); ?>
	<title>Articles de Pel·lícules</title>
</head>

<body class="bg-dark">

	<?php
	include_once("src/internal/viewFunctions/navbar.php");
	?>

	<div class="contenidor container bg-white rounded p-4">
		<?php
		$displayArticleSelection = checkLogin() ? "" : "d-none";
		$meActive = "";
		$allActive = "";

		if (empty($displayArticleSelection)) {
			if (isset($_GET["art"])) {
				if ($_GET["art"] == "all") {
					$allActive = "active";
				} else {
					$meActive = "active";
				}
			} else {
				$meActive = "active";
			}

			echo "<div class=\"btn-group mx-4 $displayArticleSelection\" role=\"group\" aria-label=\"Basic example\">";
			echo "<a class=\"btn btn-primary $allActive\" href=\"index?p=$page&art=all\">Tots</a>";
			echo "<a class=\"btn btn-primary $meActive\" href=\"index?p=$page&art=me\">Meus</a>";
			echo "</div>";
		}

		?>
		<div class="articles">
			<?php
			include_once('src/internal/viewFunctions/articles.php');
			printArticlesbyUserId($articles);
			?>
		</div>

		<?php
		printPagination($page, 1, $maxPage, 6)
		?>
	</div>
	<?php include_once('src/internal/viewFunctions/body-end.php'); ?>
</body>

</html>