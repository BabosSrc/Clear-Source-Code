<?php

namespace MulkiAqi192\Clear;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class main extends PluginBase implements Listener {

	public function onEnable(){

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "clear":
			 if($sender->hasPermission("clear.use")){
			 	if($sender instanceof Player){
			 		$this->clear($sender);
			 	} else {
			 		$sender->sendMessage("§cConsole c=have inventory? bery epic");
			 	}
			 } else {
			 	$sender->sendMessage("§cYou dont have permission to use clear command");
			 }
		}
	return true;
	}

	public function clear($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}

			if($data[1] == true){
				$player->getInventory()->clearAll();
				$player->sendMessage("§bYour inventory has been cleared!");
			}
			if($data[2] == true){
				$player->getArmorInventory()->clearAll();
				$player->sendMessage("§bYour armors has been cleared!");
			}
			if($data[3] == true){
				$player->getArmorInventory()->clearAll();
				$player->sendMessage("§bYour effects has been cleared!");
			}
		});
		$form->setTitle("§bClear §6Menu");
		$form->addLabel("§9>> §aChose a button below!");
		$form->addToggle("§bClear Inventory", false);
		$form->addToggle("§cClear Armour", false);
		$form->addToggle("§aClear Effects", false);
		$form->sendToPlayer($player);
		return $player;
	}

}