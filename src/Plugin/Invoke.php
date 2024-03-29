<?php
/**
 *
 */

namespace Mvc5\Plugin;

class Invoke
    implements Gem\Invoke
{
    /**
     *
     */
    use Config\Args;
    use Config\Config;

    /**
     * @param string|array $config
     * @param array $args
     */
    public function __construct($config, array $args = [])
    {
        $this->args   = $args;
        $this->config = $config;
    }
}
