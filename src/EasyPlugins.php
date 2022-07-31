<?php

declare(strict_types=1);

namespace tpguy825\EasyPlugins;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class EasyPlugins extends PluginBase {
    private static array $callbacks;

    /**
     * @return void
     */
    public function onEnable(): void {
        $this->getLogger()->info("EasyPlugins enabled!");
        $this->plugin = $this;
    }   

    /**
     * @param CommandInfo $command Command that runs the callback
     * @param Callable $callback Callback function. Should be compatible with \pocketmine\plugin\PluginBase::onCommand().
     * 
     * @return bool
     */
    public static function newCommand(CommandInfo $command, Callable $callback): bool {
        try {
            PluginBase::getServer()->getCommandMap()->register(EasyPlugins::getName(), new Command($command->command, $command->desc, $command->usage, $command->aliases));
            EasyPlugins::$callbacks[$command->command] = $callback;
            return true;
        } catch (\Exception $e) {
            PluginBase::getLogger()->error("Failed to register command: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * 
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (isset($this->callbacks[$command->getName()])) {
            $callback = $this->callbacks[$command->getName()];
            $callback($sender, $command, $label, $args);
            return true;
        }
        return false;
    }
}
