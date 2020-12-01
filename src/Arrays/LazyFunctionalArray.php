<?php
namespace Kanye\Functional\Arrays;

//todo 大循环协程优化
//todo memorize

class LazyFunctionalArray extends FunctionalBase {
    protected string $initialFunctionName = 'initial';

    protected function updateNestedStatus(bool $status)
    {
        $this->lastActionStatus = $status;
        if ($this->lastActionStatus === false) {
            $this->resultData = [];
        }
    }

    public function each(callable $callback) {
        $this->callbacks[] = function () use ($callback) {
            $r = [];
            foreach ($this->resultData as $key => $value) {
                $r[$key] = $callback($value, $key);
            }
            $this->resultData = $r;
        };
        return $this;
    }

    public function filter($callback) {
        $this->callbacks[] = function () use ($callback) {
            $r = [];
            foreach ($this->resultData as $key => $value) {
                if ($callback($value, $key)) {
                    $r[$key] = $value;
                }
            }
            $this->resultData = $r;
        };
        return $this;
    }

    public function get() {
        $this->runCallbacks();
        return $this->resultData;
    }

    public function __toString()
    {
        return json_encode($this->get());
    }

    protected function initial() {
        //todo 初始化启动，清理
    }

    protected function runCallbacks() {
        array_reduce($this->callbacks, function ($initial, $callback) {
            $callback();
            return $this;
        }, $this->initialFunctionName);
    }
}