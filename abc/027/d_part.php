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

class Out {
    public static function println($str = "") {
        echo $str . PHP_EOL;
    }
}

// 入力
$sc = new Scanner();
$s = $sc->next();
$n = strlen($s); // 命令の長さ

// 部分点狙う
if($n > 1000) exit;

$prev = [];
$prev[0] = 0;
for($i = 0; $i < $n; $i++) {
	$curr = [];
	foreach($prev as $position => $value) {
		$ope = substr($s, $i, 1);
		if($ope === '+') {
			$nextValue = $prev[$position] + $position;
			if(!array_key_exists($position, $curr)) {
				$curr[$position] = $nextValue;
			} else {
				$curr[$position] = max($curr[$position], $nextValue);
			}
		} else if($ope === '-') {
			$nextValue = $prev[$position] - $position;
			if(!array_key_exists($position, $curr)) {
				$curr[$position] = $nextValue;
			} else {
				$curr[$position] = max($curr[$position], $nextValue);
			}
		} else if($ope === 'M') {
			// +1
			if(!array_key_exists($position + 1, $curr)) {
				$curr[$position + 1] = $prev[$position];
			} else {
				$curr[$position + 1] = max($curr[$position + 1], $prev[$position]);
			}
			// -1
			if(!array_key_exists($position - 1, $curr)) {
				$curr[$position - 1] = $prev[$position];
			} else {
				$curr[$position - 1] = max($curr[$posision - 1], $prev[$position]);
			}
		}
	}
	$prev = $curr;
}
Out::println($curr[0]);