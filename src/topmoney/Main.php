<?php

namespace topmoney;

 use pocketmine\plugin\PluginBase;
 use pocketmine\Player; 
 use pocketmine\Server;
 use pocketmine\event\Listener;
 use pocketmine\event\player\PlayerJoinEvent;
 
 use pocketmine\command\Command;
 use pocketmine\command\CommandSender;
 
 use pocketmine\item\Item;
 use pocketmine\event\block\BlockPlaceEvent;
 
 


class Main extends PluginBase implements Listener {
	
	public $plugin;

	public function onEnable(){
		$this->getLogger()->info("§bTopMoney...");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}

	public function SendTask(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		
		$this->getScheduler()->scheduleDelayedTask(new SendTask($this, $player), 200); //30min.
	}
}