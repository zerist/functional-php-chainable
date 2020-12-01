<?php
namespace Kanye\Functional;

abstract class FunctionalBase {
    protected iterable $originData;    //原始数据
    protected array $callbacks = [];    //调用栈
    protected bool $lastActionStatus = false;   //上一次状态函数结果状态
    protected iterable $resultData;     //操作的结果数据

    public function __construct(iterable $originData) {
        $this->originData = $originData;
        $this->resultData = $originData;
    }

    public function get() {
        return $this->resultData;
    }

    public function getOriginData() {
        return $this->originData;
    }

    abstract protected function updateNestedStatus(bool $status);

    public function __toString() {
        return json_encode($this->resultData);
    }

    public function test() {
        echo "hello packagist";
    }
}
