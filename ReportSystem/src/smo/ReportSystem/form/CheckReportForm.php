<?php

namespace smo\ReportSystem\form;

use pocketmine\form\Form;
use pocketmine\Player;

use smo\ReportSystem\ConfigManager;

class CheckReportForm implements Form{

    private $id;

    public function __construct(int $id){

         $this->id = $id;
    }

    public function handleResponse(Player $player, $data): void {

       return;
    }

    public function jsonSerialize(){

        $data = ConfigManager::get()->getData($this->id);
        $senderName = $data["報告者"];
        $name = $data["対象者"];
        $reason = $data["理由"];
        $date = $data["時間"];

        $content = "ID {$this->id} のレポート:\n\n報告者: {$senderName} \n対象者: {$name} \n理由: {$reason} \n時間: {$date} \n\n";

        return [
            "type" => "form",
            "title" => "レポート確認",
            "content" => $content,
            "buttons" => [["text" => "終了"]]
        ];
    }
}