<?php

declare(strict_types=1);

namespace smo\ReportSystem\command;

use pocketmine\command\{Command, CommandSender};
use pocketmine\Player;

use smo\ReportSystem\form\ReportForm;

class ReportCommand extends Command{

	public function __construct(){

		parent::__construct("report", "プレイヤーをレポートします", "/report");
		$this->setPermission("report.guest");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){

		if(!$this->testPermission($sender)){
            return false;
        }

        if(!$sender instanceof Player){
        	$sender->sendMessage("§c[ReportSystem] >> ゲーム内で実行してください");
        	return;
        }

        $sender->sendForm(new ReportForm());
	}
}