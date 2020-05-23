<?php

declare(strict_types=1);

namespace smo\ReportSystem\command;

use pocketmine\command\{Command, CommandSender};
use pocketmine\Player;

use smo\ReportSystem\form\ReportlistForm;

class ReportlistCommand extends Command{

	public function __construct(){

		parent::__construct("reportlist", "レポートを確認します", "/reportlist");
		$this->setPermission("reportlist.op");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){

		if(!$this->testPermission($sender)){
            return false;
        }

        if(!$sender instanceof Player){
        	$sender->sendMessage("§c[ReportSystem] >> ゲーム内で実行してください");
        	return;
        }

        $sender->sendForm(new ReportlistForm());
	}
}