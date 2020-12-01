<?php

namespace Kanye\Functional\Functions;

class FunctionalFunction {
    public static function partial(callable $fn, ...$args) {
        return function (...$otherArgs) use ($fn, $args) {
            return $fn(...$args, ...$otherArgs);
        };
    }

    public static function partialRight(callable $fn, ...$args) {
        return function (...$otherArgs) use ($fn, $args) {
            return $fn(...$otherArgs, ...$args);
        };
    }

    public static function compose(...$fns) {
        return function (...$args) use ($fns) {
            foreach (array_reverse($fns) as $fn) {
                $args = [$fn(...$args)];
            }
            return $args[0];
        };
    }
}
