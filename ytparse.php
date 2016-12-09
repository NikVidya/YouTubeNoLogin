<?php
	/**
	 * Check if input string is a valid YouTube URL
	 * and try to extract the YouTube Video ID from it.
	 * @return mixed   Returns YouTube Video ID, or (boolean) FALSE.
	 * credit to Stephan Schmitz (eyecatchup) for this function https://github.com/eyecatchup
	 */
	function parse_yturl($urlIn) {
		$pattern = '#^(?:https?://)?';    # Optional Url scheme. Either http or https
		$pattern .= '(?:www\.)?';         # Optional www subdomain
		$pattern .= '(?:';		  # Hosts group:
		$pattern .=   'youtu\.be/';	  #   Either youtu.be, 
		$pattern .=   '|youtube\.com';    #   or youtube.com 
		$pattern .=   '(?:';		  #   Paths group: 
		$pattern .=     '/embed/';	  #     Either /embed/, 
		$pattern .=	'|/v/';		  #	or /v/,
		$pattern .=     '|/watch\?v=';	  #     or /watch?v=, 
		$pattern .=     '|/watch\?.+&v='; #     or /watch?other_param&v= 
		$pattern .=   ')';		  #   End paths group. 
		$pattern .= ')';		  # End hosts group.
		$pattern .= '([\w-]{11})'; 	  # 11 characters (Length of Youtube video ids).
		$pattern .= '(?:.+)?$#x';	  # Optional other ending URL parameters.
		preg_match($pattern, $urlIn, $matches);
		return (isset($matches[1])) ? $matches[1] : FALSE;
	} 


?>
