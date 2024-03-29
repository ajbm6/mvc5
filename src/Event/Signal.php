<?php
/**
 *
 */

namespace Mvc5\Event;

use Mvc5\Arg;
use Mvc5\Signal as Base;

trait Signal
{
    /**
     *
     */
    use Base;
    use Model;

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Arg::EVENT => $this
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
        return $this->signal($callable, $this->args() + $args, $callback);
    }
}
