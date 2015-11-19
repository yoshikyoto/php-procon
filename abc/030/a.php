<?php

class Scanner {
	private $arr = [];
	private $count = 0;
	private $pointer = 0;

	public function next() {
		if($this->pointer >= $this->count) {
			$str = trim(fgets(STDIN));
			$this->arr = explode(' ', $str);
			$this->count = count($this->arr);
			$this->pointer = 0;
		}
		$result = $this->arr[$this->pointer];
		$this->pointer++;
		return $result;
	}

	public function hasNext() {
		return $this->pointer < $this->count;
	}

	public function nextInt() {
		return (int)$this->next();
	}

	public function nextDouble() {
		return (double)$this->next();
	}
}

class out {
	public static function println($str = "") {
		echo $str . PHP_EOL;
	}
}

class CountMap {
	private $map = [];

	public function get($key) {
		if(array_key_exists($key, $this->map)) {
			return $this->map[$key];
		} else {
			return 0;
		}
	}

	public function getMap() {
		return $this->map;
	}

	public function add($key) {
		if(array_key_exists($key, $this->map)) {
			$this->map[$key]++;
		} else {
			$this->map[$key] = 1;
		}
	}
}

$sc = new Scanner();
$a = $sc->nextInt();
$b = $sc->nextInt();
$c = $sc->nextInt();
$d = $sc->nextInt();

$takahashi = $b / $a;
$aoki = $d / $c;

if($takahashi > $aoki) {
	out::println('TAKAHASHI');
} else if($takahashi < $aoki) {
	out::println('AOKI');
} else {
	out::println('DRAW');
}
