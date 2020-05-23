<?php

namespace smo\ReportSystem\form;

use pocketmine\form\Form;
use pocketmine\Player;

use smo\ReportSystem\ConfigManager;

class ReportForm implements Form{

    public function handleResponse(Player $player, $data): void {

        if ($data === null) {
            return;
        }

        if($data[0] === "" or $data[1] === "") return;

        ConfigManager::get()->addReport($player, $data[0], $data[1]);
    }

    public function jsonSerialize(){

        return [
            "type" => "custom_form",
            "title" => "レポート",
            "content" => [
                [
                    "type" => "input",
                    "text" => "レポートするプレイヤーの名前",
                    "placeholder" => "ここに記入",
                    "default" => ""
                ],

                [
                    "type" => "input",
                    "text" => "レポート理由",
                    "placeholder" => "ここに記入",
                    "default" => ""
                ]
            ]
        ];
    }
}