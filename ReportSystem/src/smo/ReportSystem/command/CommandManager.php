<?php

declare(strict_types=1);

namespace smo\ReportSystem\command;

class CommandManager{

	public function __construct($plugin){

		$plugin->getServer()->getCommandMap()->register("report", new ReportCommand());
		$plugin->getServer()->getCommandMap()->register("reportlist", new ReportlistCommand());
	}
}