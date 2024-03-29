<?php
/**
 *
 */

namespace Mvc5\Controller;

use Mvc5\Arg;
use Throwable;

trait Action
{
    /**
     * @param $controller
     * @param array $args
     * @return mixed
     */
    protected function action($controller, array $args = [])
    {
        return $this->call($controller, $args);
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws \RuntimeException
     */
    protected abstract function call($config, array $args = [], callable $callback = null);

    /**
     * @param Throwable $exception
     * @param $controller
     * @return mixed
     */
    protected function exception(Throwable $exception, $controller)
    {
        return $this->call(Arg::CONTROLLER_EXCEPTION, [Arg::EXCEPTION => $exception, Arg::CONTROLLER => $controller]);
    }
}
