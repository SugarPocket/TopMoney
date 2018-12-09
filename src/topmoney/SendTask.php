<?php

namespace topmoney;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;
use topmoney\Main;

//effect
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\utils\Config;

use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\inventory\Inventory;
use pocketmine\level\particle\FloatingTextParticle;

class SendTask extends Task {
	public $plugin;
	public $i;
	public $c;
	
    public function __construct(Main $plugin, Player $player) {
        $this->plugin = $plugin; 
		$this->player = $player;
		//$this->c = $this->getConfig();
	//	parent::__construct($plugin);
    }
	
    public function onRun(int $currentTick){
		$player = $this->player;
		$x = $this->plugin->getConfig()->get("x");
		$y = $this->plugin->getConfig()->get("y");
		$z = $this->plugin->getConfig()->get("x");
		
		$unit = $this->plugin->getConfig()->get("unit");
		
		$money = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$money_top = $money->getAllMoney();
		$message = "";
		$message1 = "";
		$topmoney = "     §eTopMoney on server    ";
		$topmoney1 = "     §6TopMoney on server    ";
		if(count($money_top) > 0){
			arsort($money_top);
			$i = 1;
			foreach($money_top as $name => $money){
				$message .= " §b ".$i.". §d".$name."    §f".$money." §a$unit\n";
				$message1 .= " §b ".$i.". §d".$name."    §9".$money." §a$unit\n";
				if($i >= 10){
					break;
					}
					++$i;
				}
			}
			$p = new FloatingTextParticle(new Vector3($x, $y, $z), $message, $topmoney);
		//	$p1 = new FloatingTextParticle(new Vector3($x, $y, $z), $message1, $topmoney1);
			$player->getLevel()->addParticle($p);
		//	$player->getLevel()->addParticle($p1);
	}
}
	
	