<?php
/**
 *
 */

namespace Mvc5\Model;

use Mvc5\Config\Configuration;

interface Template
    extends Configuration
{
    /**
     * @param string $path
     * @return null|string
     */
    function template($path = null);

    /**
     * @param array|null $config
     * @return array|null
     */
    function vars(array $config = null);
}
