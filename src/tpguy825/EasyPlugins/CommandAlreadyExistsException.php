<?php

namespace tpguy825\EasyPlugins;

use Exception;
use Throwable;

/** 
 * This class is for if you try to define a command that has already been defined using EasyPlugins.
 */

class CommandAlreadyExistsException extends Exception {
    /**
     * @param string $message
     * @param int $code
     * @param ?Throwable $previous
     */
    public function __construct($message, $code = 0, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}