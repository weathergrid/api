<?php
namespace App\Helpers;

class Log {
	public static function start() {
		echo "<pre>";
	}

	public static function echo($str) {
		echo $str."<br>";
	}
	public static function end() {
		echo "</pre>";
	}
}