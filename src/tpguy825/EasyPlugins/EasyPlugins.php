<?php

declare(strict_types=1);

namespace tpguy825\EasyPlugins;

use pocketmine\plugin\PluginBase;

class EasyPlugins {
    private static array $callbacks = [];

    /**
     * @param PluginBase $pluginbase PluginBase instance (if your plugin extends PluginBase, you can use $this)
     * @param CommandInfo $command Command that runs the callback
     * @param Callable $callback Callback function. Should be compatible with \pocketmine\plugin\PluginBase::onCommand().
     * 
     * @return bool
     */
    public static function newCommand(PluginBase $pluginbase, CommandInfo $command, Callable $callback): bool {
        if(isset(self::$callbacks[$command->command])) {
            throw new CommandAlreadyExistsException("Command " . $command->command . " already exists");
        }

        try {
            self::$callbacks[$command->command] = $callback;
            $pluginbase->getServer()->getCommandMap()->register("easyplugins", new EasyPluginsCommand(self::$callbacks, $pluginbase, $command));
            if(!($pluginbase->getServer()->getCommandMap()->getCommand($command->command) instanceof EasyPluginsCommand)) {
                throw new \Exception("Command " . $command->command . " not found");
            }
            return true;
        } catch (\Exception $e) {
            $pluginbase->getLogger()->error("Failed to register command: " . $e->getMessage());
            return false;
        }
    }
}
