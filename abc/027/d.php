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
$s = $sc->next();
$n = strlen($s);
$array = [];
$state = 0;

for($i = $n - 1; $i >= 0; $i--) {
	$ope = substr($s, $i, 1);
	if($ope === '+') {
		$state++;
	} else if($ope === '-') {
		$state--;
	} else if($ope === 'M') {
		$array[] = $state;
	}
}

sort($array);
$len = count($array);
$half = $len / 2;
$sum = 0;

for($i = 0; $i < $half; $i++) {
	$sum -= $array[$i];
}

for($i = $half; $i < $len; $i++) {
	$sum += $array[$i];
}

out::println($sum);