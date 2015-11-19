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
$player = [0 => 'Takahashi', 1 => 'Aoki'];

// このターン数になった時の位置で勝敗が決まる
$border_turn = (int)log($n, 2) + 1;
// $border_turn % 2 === 1 の場合、$border_turn は高橋くん
// この時高橋君は下に行きたがることになるので
$takahashi = $border_turn % 2;
$aoki = 1 - $takahashi;
$direction = [0 => $takahashi, 1 => $aoki];

// これを元に探索
function dfs($x, $turn) {
	global $n;
	if($n < $x) {
		return $turn;
	}
	global $direction;
	return dfs(2 * $x + $direction[$turn], 1 - $turn);
}

out::println($player[dfs(1, 0)]);