<?php
namespace test;
use Kanye\Functional\FunctionalArray;
use Kanye\Functional\FunctionalBase;
use Kanye\Functional\LazyFunctionalArray;

require '../vendor/autoload.php';

//$a = new FunctionalArray([1,2,3]);
//echo ($a->each(fn($n) => $n)->filter(fn($v, $k) => $v % 2 === 0));

$b = new LazyFunctionalArray([1,2,3]);
var_dump($b->each(fn($n) => $n * 2)->filter(fn($n, $k) => $k === 1)->get());
