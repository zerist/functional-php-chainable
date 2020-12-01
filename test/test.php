<?php
namespace test;

use Kanye\Functional\Arrays\LazyFunctionalArray;
use Kanye\Functional\Functions\FunctionalFunction;
use function Functional\partial_left;

require '../vendor/autoload.php';

//$a = new FunctionalArray([1,2,3]);
//echo ($a->each(fn($n) => $n)->filter(fn($v, $k) => $v % 2 === 0));

//$b = new LazyFunctionalArray([1,2,3]);
//var_dump($b->each(fn($n) => $n * 2)->filter(fn($n, $k) => $k === 1)->get());

//$add10 = FunctionalFunction::partial(fn($a, $b) => $a + $b, 10);
//echo $add10(20);

$first = function ( $array) {
    return $array[1];
};

$reverse = function ( $array) {
    return array_reverse($array);
};

$last = FunctionalFunction::compose($first, $reverse);
var_dump($last([1,2,3,4,5]));