<?php

namespace smo\ReportSystem\form;

use pocketmine\form\Form;
use pocketmine\Player;

use smo\ReportSystem\ConfigManager;

class ReportlistForm implements Form{

    public function handleResponse(Player $player, $data): void {

        if ($data === null) {
            return;
        }

        switch ($data) {
        	case 0:

        	$player->sendForm(new CheckReportListForm());

        	break;

        	case 1:

        	$player->sendForm(new RemoveReportListForm());

        	break;
        }
    }

    public function jsonSerialize(){

        return [
            "type" => "form",
            "title" => "レポート確認",
            "content" => "",
            "buttons" => [
                ["text" => "レポート確認"],
                ["text" => "レポート削除"]
            ]
        ];
    }
}