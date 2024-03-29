<?php
/**
 *
 */

namespace Mvc5\Route\Config;

use Mvc5\Arg;
use Mvc5\Config\Config;

trait Route
{
    /**
     *
     */
    use Config;

    /**
     * @return array|callable|null|object|string
     */
    public function controller()
    {
        return $this[Arg::CONTROLLER];
    }

    /**
     * @return string|string[]
     */
    public function hostname()
    {
        return $this[Arg::HOSTNAME];
    }

    /**
     * @return int
     */
    public function length()
    {
        return $this[Arg::LENGTH] ?? 0;
    }

    /**
     * @return bool
     */
    public function matched()
    {
        return $this[Arg::MATCHED] ?? false;
    }

    /**
     * @return string|string[]
     */
    public function method()
    {
        return $this[Arg::METHOD];
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this[Arg::NAME];
    }

    /**
     * @return array
     */
    public function params()
    {
        return $this[Arg::PARAMS] ?? [];
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this[Arg::PATH];
    }

    /**
     * @return string|string[]
     */
    public function scheme()
    {
        return $this[Arg::SCHEME];
    }
}
