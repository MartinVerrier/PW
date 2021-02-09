<?php

	// Question 2
	function question_2($dom) {
		echo "Question 2 :\n\n";

		$elements = $dom->getElementsByTagName("h2");

		foreach ($elements as $title) {
			echo $title->textContent . "\n";
		}

		echo "\n\n\n";
	}


	// Question 3
	function question_3($dom) {
		echo "Question 3 :\n\n";

		$h2_elements = $dom->getElementsByTagName("h2");
		$h3_elements = $dom->getElementsByTagName("h3");

		$elements = [];

		for ($i = 0, $h2_i = 0, $h3_i = 0; $i <= max(
			$h2_elements->item($h2_elements->length - 1)->getLineNo(),
			$h3_elements->item($h3_elements->length - 1)->getLineNo()
		); $i++) {
			if ($h2_elements->item($h2_i) != NULL && $i == $h2_elements->item($h2_i)->getLineNo()) {
				$elements[] = "h2 -> " . $h2_elements->item($h2_i++)->textContent;
			}

			if ($h3_elements->item($h3_i) != NULL && $i == $h3_elements->item($h3_i)->getLineNo()) {
				$elements[] = "h3 -> " . $h3_elements->item($h3_i++)->textContent;
			}
		}

		foreach ($elements as $element) {
			echo $element . "\n";
		}

		echo "\n\n\n";
	}


	// Question 4
	function question_4($content) {
		echo "Question 4 :\n\n";

		preg_match_all('/<h2>(.+)<\\/h2>/', $content, $matches);
		foreach ($matches[1] as $match) {
			echo $match . "\n";
		}

		echo "\n\n\n";
	}
	


	$content = file_get_contents($argv[1]);
	$dom = new DOMDocument("1.0", "UTF-8");
	$dom->loadHTML($content);

	question_2($dom);
	question_3($dom);
	question_4($content);

?>