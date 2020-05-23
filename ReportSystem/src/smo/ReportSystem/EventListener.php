<?php

declare(strict_types=1);

namespace smo\ReportSystem;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use smo\ReportSystem\ConfigManager;

class EventListener implements Listener{

	public function onJoin(PlayerJoinEvent $event): void {

		$player = $event->getPlayer();
		$count = count(ConfigManager::get()->getAll());

		if($player->isOp()){
			$player->sendMessage("§a[ReportSystem] >> ".$count." 件の未読のレポートがあります");
		}
	}
}