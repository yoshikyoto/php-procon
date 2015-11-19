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
$in = [];
for($i = 0; $i < 5; $i++) {
	$in[] = $sc->nextInt();
}

$sums = [];

function dfs($chosen, $sum,  $pointer) {
	if($chosen === 3) {
		global $sums;
		$sums[] = $sum;
		return;
	}
	if($pointer === 5) {
		return;
	}
	// 選ばない
	dfs($chosen, $sum, $pointer + 1);
	// 選ぶ
	global $in;
	dfs($chosen + 1, $sum + $in[$pointer], $pointer + 1);
}

dfs(0, 0, 0);
$unique = array_unique($sums);
rsort($unique);
out::println($unique[2]);
