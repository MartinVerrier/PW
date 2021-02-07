<html>

	<head>
		<title>Parser - <?php echo $_POST["page"] ?></title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<!-- <link rel="stylesheet" href="index.css" /> -->
	</head>


	<body>
		

		<?php
			$content = file_get_contents($_POST["page"]);
			$dom = new DOMDocument("1.0", "UTF-8");
			$dom->loadHTML($content);

			$elements = $dom->getElementsByTagName("h2");
			foreach ($elements as $title) {
				echo "<p>" . $title->textContent . "</p>";
			}
		?>

	</body>

</html>