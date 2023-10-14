<?php

namespace Terpz710\JoinDate\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\Plugin;

class JoinDateCommand extends Command implements PluginOwned {

    /** @var Plugin */
    private $plugin;

    public function __construct(Plugin $plugin) {
        parent::__construct("joindate", "Get your first join date");
        $this->plugin = $plugin;
        $this->setPermission("joindate.cmd");
        $this->setAliases(["jd"]);
    }

    public function getOwningPlugin(): Plugin {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if ($sender instanceof Player) {
            $targetPlayer = $this->plugin->getServer()->getPlayerByXuid($sender->getXuid()); // Get the player instance
            if ($targetPlayer instanceof Player) {
                $firstJoinDate = $targetPlayer->getFirstPlayed();
                $formattedDate = date("Y-m-d h:i A", $firstJoinDate);
                $sender->sendMessage("Your join date: " . $formattedDate);
            } else {
                $sender->sendMessage("Player not found or is offline.");
            }
        } else {
            $sender->sendMessage("This command can only be used in-game.");
        }
        return true;
    }
}
