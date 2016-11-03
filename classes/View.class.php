<?php
class View {
	protected $data;
	protected $ajax;

	public function __construct($data=null, $ajax=false) {
		$this->data = $data;
		$this->ajax = $ajax;
	}
	public function index() {
		if($this->ajax) {
			header('Content-type:application/json;charset=utf-8');
			echo json_encode($this->data);
			exit(0);
		}
		$this->header();
		echo "<div id=\"container\">
		<form method=\"post\">
		<div id=\"left\"><textarea rows=\"3\" cols=\"50\" name=\"data\"></textarea></div>
		<div id=\"right\">
		<button type=\"submit\">POST</button>
		<button id=\"ajax\" type=\"submit\">AJAX</button>
		</div>
		</form>
		<div>
		<div id=\"messages\">";
		if($this->data) {
			if($this->data["success"] == true) {
				echo "<p class=\"success\">Result: Success</p>";
				echo "<p class=\"success\">Input: " . $this->data["input"] . "</p>";
				echo "<p class=\"success\">Days between dates: " . $this->data["res"] . "</p>";
				echo "<p class=\"success\">Elapsed time: " . $this->data["et"] . " sec</p>";
			}
			else {
				echo "<p class=\"error\">Result: Failure</p>";
				echo "<p class=\"error\">Error list below:</p>";
				foreach($this->data["errors"] as $key => $error) {
					echo "<p class=\"error\">" . ($key + 1) . ' ' . $error . "</p>";
				}
			}
		}
		echo "</div>";
		$this->footer();
	}
	private function header() {
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" 
  				\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
				<html xmlns=\"http://www.w3.org/1999/xhtml\">
 				<head>
  				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  				<title>sample app</title>
  				<style type=\"text/css\">
   					body {
    					font: 10pt Arial, Helvetica, sans-serif;
    					background: #fffffc;
   					}
   					#container {
   					width: 100%;
   					margin: 10px auto;
   				}
   				#left {
   				width: 430px;
   				float: left;
   			}
   			#right {
   			float: left;
   		}
   		button {
   			display: block;
   			width: 60px;
   			margin: 2px;
   		}
   		#messages {
   		border: 1px solid black;
   		width: 492px;
   		min-height: 40px;
   		clear: both; float: left; display: block; position: relative;
   		text-align: center;
   	}
   	.success {
   		color: green;
   	}
   	.error {
   		color: red;
   	}
  				</style>
  				<script src=\"./js/jquery.min.js\"></script>
  				<script src=\"./js/script.js\"></script>
 				</head>
 				<body>";
	}
	private function footer() {
		echo "</body>
				</html>";
	}
}