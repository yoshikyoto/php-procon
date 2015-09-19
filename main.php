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
$n = $sc->nextInt();
$ans = 0;

for($i = 9; $i >= 0; $i--) {
    $mod = pow(10, $i);
    $m = (int)($n / $mod) % 10;
    $down = ($n % $mod);
    $up = (int)($n / ($mod * 10));
    if($m === 0) {
        $cnt = $up * $mod;
        $ans += $cnt;
    } else if ($m === 1) {
        $cnt =  $up * $mod + $down + 1;
        $ans += $cnt;
    } else {
        $cnt = ($up + 1) * $mod;
        $ans += $cnt;
    }
}

out::println($ans);
