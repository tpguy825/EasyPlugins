<?php

namespace tpguy825\EasyPlugins;

use Exception;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class EasyPluginsCommand extends Command {
    public function __construct(private array $main, private PluginBase $pluginbase, private CommandInfo $command) {
        parent::__construct($command->command, $command->desc, $command->usage, $command->aliases);
    }

	public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(isset($this->main[$this->command->command])) {
            $this->main[$this->command->command]($sender, $this, $commandLabel, $args);
            return true;
        } else {
            $this->pluginbase->getLogger()->warning("Command " . $this->getName() . " not found in EasyPlugins, but executed using EasyPluginsCommand class");
            return false;
        }
    }
}