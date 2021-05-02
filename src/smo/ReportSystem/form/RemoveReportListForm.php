<?php

namespace smo\ReportSystem\form;

use pocketmine\form\Form;
use pocketmine\Player;

use smo\ReportSystem\ConfigManager;

class RemoveReportListForm implements Form{

    private $button;
    private $list;

    private $isEmpty = false;

    public function __construct(){

        if(count(ConfigManager::get()->getAll()) === 0){
            $this->isEmpty = true;
            return;
        }

        foreach(ConfigManager::get()->getAll() as $id => $data){
            $this->button[] = ["text" => "ID: ". (string) $id];
            $this->list[] = $id;
        }
    }

    public function handleResponse(Player $player, $data): void {

        if($this->isEmpty) return;

        if ($data === null) {
            return;
        }

        ConfigManager::get()->removeReport((int) $this->list[$data], $player);

    }

    public function jsonSerialize(){

        if($this->isEmpty){
            return [
            "type" => "form",
            "title" => "レポート削除 一覧",
            "content" => "レポートがありません",
            "buttons" => []
            ];
        }

        return [
            "type" => "form",
            "title" => "レポート削除 一覧",
            "content" => "",
            "buttons" => $this->button
        ];
    }
}