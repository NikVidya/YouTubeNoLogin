<!-- This page converts a standard YouTube URL into the youtube.com/v/... format, viewable without needing to log in. -->
<html>
<head>
</head>
<body>
	<h1>Watch videos without logging in</h1>
	<form action="index.php" method="get">
		<input type="text" id="URLinput" name="url" placeholder="Paste URL Here"><br>
		<input type="submit" id="submitbtn" value="Get Converted URL" />
	</form>

	<?php
		require_once "ytparse.php";
		$input = $_GET['url'];
		$errors = array();

		// checks if the string entered is a URL
		if (filter_var($input, FILTER_VALIDATE_URL) === FALSE) {
			$errors["badURL"] = "Invalid URL. Please enter a valid web address.";
		}
		
		// checks if the string entered is a youtube URL and returns the youtube video id

		$outputURL = "https://www.youtube.com/v/" . parse_yturl($input);
		if ($outputURL == "https://www.youtube.com/v/") {
			$errors["badYTURL"] = "Invalid YouTube URL. Please enter a valid YouTube URL.";
		}

		// prints the list of errors. If there are no errors, outputs the converted url (as an html <a> link)
		if (!empty($errors) && $input != "") {
			echo "There were some errors" . '<br>';
			foreach($errors as $key => $value) {
				echo $value . '<br>';
			}

		} else if ($input != "") {
			echo '<p>';
			echo 'Your url is: ';
			echo '<a href=' . $outputURL . '>' . $outputURL . '</a>';
			echo '</p>';
		}

	?>
</body>
</html>
