<?php
/**
 *
 */

namespace Mvc5\Plugin\Config;

use Mvc5\Arg;

trait Hydrator
{
    /**
     *
     */
    use Plugin;

    /**
     * @param string $name
     * @param array $calls
     * @param null|string $param
     */
    public function __construct($name, array $calls, $param = Arg::ITEM)
    {
        $this->config = [
            Arg::CALLS => $calls,
            Arg::NAME  => $name,
            Arg::PARAM => $param
        ];
    }
}
