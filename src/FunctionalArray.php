<?php
namespace Kanye\Functional;

/**
 * array wrapped with chainable function
 * Class FunctionalArray
 * @package Kanye\Functional
 */
class FunctionalArray extends FunctionalBase {
    public function each(callable $callback) {
        $r = [];
        foreach ($this->resultData as $key => $value) {
            $r[$key] = $callback($value, $key);
        }
        $this->resultData = $r;
        return $this;
    }

    public function filter(callable $callback) {
        $r = [];
        foreach ($this->resultData as $key => $value) {
            if ($callback($value, $key)) {
                $r[$key] = $value;
            }
        }
        $this->resultData = $r;
        return $this;
    }

    public function all(callable $callback) {
        foreach ($this->resultData as $key => $value) {
            if (!$callback($value, $key)) {
                $this->updateNestedStatus(false);
                break;
            }
        }
        return $this;
    }

    public function any(callable $callback) {
        foreach ($this->resultData as $key => $value) {
            if ($callback($value, $key)) {
                $this->updateNestedStatus(true);
            }
        }
        return $this;
    }

    protected function updateNestedStatus(bool $status)
    {
        $this->lastActionStatus = $status;
        if ($this->lastActionStatus === false) {
            $this->resultData = [];
        }
    }
}