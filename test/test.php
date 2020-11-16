<?php
namespace test;
use Kanye\Functional\FunctionalArray;

require '../vendor/autoload.php';

$a = new FunctionalArray([1,2,3]);
var_dump($a->each(fn($n) => $n)->filter(fn($v, $k) => $k % 2 === 0)->getResult());