<?php

namespace Terpz710\JoinDate;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use Terpz710\JoinDate\Command\JoinDateCommand;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("joindate", new JoinDateCommand($this));
    }
}
