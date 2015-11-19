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

	public function nextInt() {
		return (int)$this->next();
	}

	public function nextDouble() {
		return (double)$this->next();
	}
}

class out {
	public static function println($str) {
		echo $str . PHP_EOL;
	}
}

$sc = new Scanner();
$n = $sc->nextInt();

$ans = 0;

// 各桁についてforループ $i:桁数
// その桁に1が何回登場するかを数える
for($i = 9; $i >= 0; $i--) {
	$mod = pow(10, $i);
	$m = (int)($n / $mod) % 10;    // $i桁目の数字
	$down = ($n % $mod);           // $i桁目より下の数字
	$up = (int)($n / ($mod * 10)); // $i桁目より上の数字
	if($m === 0) {
		// $i桁目が0の場合
		$cnt = $up * $mod;
		$ans += $cnt;
	} else if ($m === 1) {
		// $i桁目が1の場合
		$cnt =  $up * $mod + $down + 1;
		$ans += $cnt;
	} else {
		// それ以外
		$cnt = ($up + 1) * $mod;
		$ans += $cnt;
	}
}

out::println($ans);
