<?php
/**
 *
 */

namespace Mvc5;

use ReflectionFunction;
use ReflectionMethod;
use RuntimeException;

trait Signal
{
    /**
     * @param callable|object $config
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function signal(callable $config, array $args = [], callable $callback = null)
    {
        if ($args && !is_string(key($args))) {
            return call_user_func_array($config, $args);
        }

        $function = null;
        $matched  = [];
        $method   = '__invoke';
        $params   = [];

        if (is_string($config)) {
            $static = explode('::', $config);
            if (isset($static[1])) {
                list($config, $method) = $static;
            } else {
                $params   = (new ReflectionFunction($config))->getParameters();
                $function = $config;
            }
        }

        is_array($config) && list($config, $method) = $config;

        !$function && $params = (new ReflectionMethod($config, $method))->getParameters();

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if (Arg::ARGS === $param->name) {
                $matched[] = $param->isVariadic() ? new Plugin\SignalArgs($args) : $args;
                continue;
            }

            if ($param->isOptional()) {
                $param->isDefaultValueAvailable() &&
                    $matched[] = $param->getDefaultValue();
                continue;
            }

            if ($callback && null !== $match = $callback($param->name)) {
                $matched[] = $match;
                continue;
            }

            if ($callback && $hint = $param->getClass()) {
                $matched[] = $callback($hint->name);
                continue;
            }

            throw new RuntimeException(
                'Missing required parameter $' . $param->name
                . ' for ' . ($function ?? (is_string($config) ? $config : get_class($config)))
            );
        }

        return call_user_func_array($function ?? [$config, $method], $params ? $matched : $args);
    }
}
