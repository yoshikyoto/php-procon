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
$n = $sc->nextInt(); // 単語の数
$a = $sc->nextInt() - 1; // 調べようとしている単語（0-indexedに変換）
$k = $sc->nextInt(); // ステップ数
$b = []; // 辞書
for($i = 0; $i < $n; $i++) {
	$b[] = $sc->nextInt() - 1;
}

function dfs(
	$k, // 残りステップ数
	$curr, // 今何を調べようとしているか
	$dict, // 辞書
	$depth // 配列
) {
	$next = $dict[$curr];
	if($k === 0) return $curr;
	if(isset($depth[$curr])) {
		// ループしてきた
		// mod をとる
		$roop_length = $depth[$curr] - $k - 1;
		$k = $k % $roop_length;
		
	}
	if($k === 0) return $curr;
	$depth[$curr] = $k;
	return dfs($k - 1, $next, $dict, $depth);
}

out::println(dfs($k, $a, $b, []) + 1);
