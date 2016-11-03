<?php
class Controller {
	private $errors = [];
	private $result;
	private $ajax = false;

	public function index() {
	if(isset($_POST) && !empty($_POST["data"])) {
		$time_start = microtime(false);
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->ajax = true;
		}
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
    		$ip = $_SERVER['REMOTE_ADDR'];
		}
		$data = str_replace(' ', '', $_POST["data"]);
		if(!empty($data)) {
		$data = explode("-", $data);
		$counter = count($data);
		if($counter == 2) {
			$sda = $this->parse_date($data[0]);
			$eda = $this->parse_date($data[1]);
			if($sda === false || $eda === false) {
				if($sda === false) array_push($this->errors, "First date is invalid");
				if($eda === false) array_push($this->errors, "Second date is invalid");
			} else {
				$res = abs(floor((strtotime($sda) - strtotime($eda)) /(60 * 60 * 24)));
				$time_end = microtime();
				$et = round($time_end - $time_start, 5);
				$model = new Model();
				$model->save_log($ip, $sda, $eda, $res, $et);
				$this->result = [
					"success" => true,
					"res" => $res,
					"input" => $sda . '-' . $eda,
					"et" => $et
				];
			}
		} else {
			switch(true) {
				case ($counter < 2):
					array_push($this->errors, "Not enough arguments");
				break;
				case ($counter > 2):
					array_push($this->errors, "To many arguments");
				break;
			}
		}

		} else {
			array_push($this->errors, "Input string does not contain any data");
		}

	}
	if(!empty($this->errors)) {
		$this->result = [
						"success" => false,
						"errors" => $this->errors
		];
	}
	$view = new View($this->result, $this->ajax);
	$view->index();
	}

	private function parse_date($date) {
		$slashed = '/^\d{4}\/\d{2}\/\d{2}$/';
		$dotted = '/^\d{2}\.\d{2}\.\d{4}$/';
		if(preg_match($dotted, $date)) {
			$dt = explode(".", $date);
			$m = intval($dt[0]);
			$d = intval($dt[1]);
			$y = intval($dt[2]);
		} elseif (preg_match($slashed, $date)) {
			$dt = explode("/", $date);
			$m = intval($dt[1]);
			$d = intval($dt[2]);
			$y = intval($dt[0]);
		}
		if(checkdate($m, $d, $y)) {
			return date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));
		}
		return false;				
	}

}
