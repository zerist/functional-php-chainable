<?php
namespace Kanye\Functional;

use function Functional\false;
use function Functional\true;

/**
 * array wrapped with chainable function
 * Class FunctionalArray
 * @package Kanye\Functional
 */
class FunctionalArray
{
    private array $originArray = [];
    private array $resultArray = [];
    private bool $lastActionStatus = true;

    public function __construct(array $array){
        $this->originArray = $array;
        $this->resultArray = $array;
    }

    public function each(callable $callback) {
        $r = [];
        foreach ($this->resultArray as $value) {
            $r[] = $callback($value);
        }
        $this->resultArray = $r;
        return $this;
    }

    public function filter(callable $callback) {
        $r = [];
        foreach ($this->resultArray as $key => $value) {
            if ($callback($value, $key)) {
                $r[$key] = $value;
            }
        }
        $this->resultArray = $r;
        return $this;
    }

    public function all(callable $callback) {
        foreach ($this->resultArray as $key => $value) {
            if (!$callback($value, $key)) {
                $this->lastActionStatus = false;
            }
        }
        $this->updateNestedStatus();
        return $this;
    }

    public function getOriginData() {
        return $this->originArray;
    }

    public function getResult() {
        return $this->resultArray;
    }

    public function test() {
        echo "hello packagist";
    }

    private function updateNestedStatus()
    {
        if ($this->lastActionStatus === false) {
            $this->resultArray = [];
        }
    }
}