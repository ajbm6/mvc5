<?php
/**
 *
 */

namespace Mvc5\Route;

use Mvc5\Arg;
use Mvc5\Event\Event;
use Mvc5\Event\Signal;

class Match
    implements Event
{
    /**
     *
     */
    use Signal;

    /**
     *
     */
    const EVENT = Arg::ROUTE_MATCH;

    /**
     * @var Definition
     */
    protected $definition;

    /**
     * @var Route
     */
    protected $route;

    /***
     * @param Definition $definition
     * @param Route $route
     */
    public function __construct(Definition $definition, Route $route)
    {
        $this->definition = $definition;
        $this->route      = $route;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Arg::EVENT      => $this,
            Arg::DEFINITION => $this->definition,
            Arg::ROUTE      => $this->route
        ];
    }

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        $result = $this->signal($callable, $this->args() + $args, $callback);

        !$result && $this->stop();

        $result instanceof Route && $this->route = $result;

        return $result;
    }
}
