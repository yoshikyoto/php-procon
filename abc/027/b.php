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

// 入力
$sc = new Scanner();
$n = $sc->nextInt();
$a = [];
$sum = 0;
for($i = 0; $i < $n; $i++) {
	$in = $sc->nextInt();
	$sum += $in;
	$a[] = $in;
}

// 割り切れるかどうかの確認
$ans = 0;
if($sum % $n === 0) {
	// 割り切れる
	$target = (int)($sum / $n);
	$cursum = 0;
	$curcnt = 0;
	for($i = 0; $i < $n; $i++) {
		$cursum += $a[$i];
		$curcnt += 1;
		// iとi+1の間に橋をかける必要があるかどうか
		if(($cursum / $curcnt) === $target) {
			// かける必要がない
			$cursum = 0;
			$curcnt = 0;
		} else {
			// かける必要がある
			$ans++;
		}
	}
	out::println($ans);
} else {
	// 割り切れない
	out::println(-1);
}