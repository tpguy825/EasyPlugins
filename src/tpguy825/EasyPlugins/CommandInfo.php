<?php

namespace tpguy825\EasyPlugins;

use pocketmine\lang\Translatable;

class CommandInfo {
    /**
     * @var string $desc Description of the command
     */
    public string $desc;
    /**
     * @var string $usage Usage of the command
     */
    public string $usage;
    /**
    * @var string $command Command name
    */
    public string $command;
    /**
     * @var string[] $aliases Aliases of the command
    */
    public array $aliases;
    
    /**
     * @param string $pluginname Name of your plugin
     * @param string $command Command name
     * @param string $desc Description of the command
     * @param string $usage How to use the command (e.g. "/command <arg1> <arg2>")
     * @param string[] $aliases Aliases of the command
     */
    public function __construct(string $command, string|Translatable $desc, string|Translatable $usage, array $aliases = []) {
        $this->command = $command;
        $this->desc = $desc;
        $this->usage = $usage;
        $this->aliases = $aliases;
    }
}