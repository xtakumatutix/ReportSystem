<?php

declare(strict_types=1);

namespace smo\ReportSystem;

use pocketmine\plugin\PluginBase;

use smo\ReportSystem\command\CommandManager;

class Main extends PluginBase{

	public function onEnable(): void {

		$this->getLogger()->notice("ReportSystem を読み込みました");
		(new ConfigManager($this));
		(new CommandManager($this));
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}

	public function onDisable(): void {

		ConfigManager::get()->saveConfig();
	}
}
