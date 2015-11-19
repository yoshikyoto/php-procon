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

$sc = new Scanner();
$n = $sc->nextInt();
$m = $sc->nextInt();
$x = $sc->nextInt();
$y = $sc->nextInt();

$a = [];
for($i = 0; $i < $n; $i++) {
	$a[] = $sc->nextInt();
}

$b = [];
for($i = 0; $i < $m; $i++) {
	$b[] = $sc->nextInt();
}

$schedules = [$a, $b];
$pointers = [0, 0];
$lengths = [$n, $m]; // 飛行機の本数
$durations = [$x, $y];
$time = 0; // 今の時間
$airport = 0; // 今どこにいるか
$ans = 0; // 往復回数

while(true) {
	// 乗れる飛行機がなくなったら終了
	$pointer = $pointers[$airport];
	$length = $lengths[$airport];
	if($pointer >= $length) {
		break;
	}
	// 乗れるかどうかのチェック
	$schedule = $schedules[$airport];
	$target = $schedule[$pointer];
	if($target >= $time) {
		// 乗れる場合
		$duration = $durations[$airport]; // かかる時間
		$time = $target + $duration; // 到着時間
		$airport = ($airport + 1) % 2; // 空港を移動
		if($airport === 0) {
			// 往復できた場合
			$ans++;
		}
	} else {
		// 乗れない場合、次の飛行機を探す
		$pointers[$airport]++;
		continue;
	}
}

out::println($ans);
