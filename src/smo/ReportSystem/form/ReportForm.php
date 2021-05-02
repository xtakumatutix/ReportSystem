<?php

namespace smo\ReportSystem\form;

use pocketmine\form\Form;
use pocketmine\Player;

use smo\ReportSystem\ConfigManager;

use bbo51dog\pmdiscord\Sender;
use bbo51dog\pmdiscord\element\Embed;
use bbo51dog\pmdiscord\element\Embeds;


class ReportForm implements Form{

    public function handleResponse(Player $player, $data): void {

        if ($data === null) {
            return;
        }

        if($data[0] === "" or $data[1] === "") return;

        ConfigManager::get()->addReport($player, $data[0], $data[1]);

        $webhookurl = ConfigManager::get()->getWebhookURL();

        $embed = (new Embed())
            ->setAuthorName("Report!!!!")
            ->setAuthorIcon('https://user-images.githubusercontent.com/47268002/116804908-ae544a80-ab5d-11eb-9bd6-14e796cdec4f.png')
            ->setTitle($data[0])
            ->setDesc($data[1])
            ->setColor('16711680')
            ->addField("報告者", $player->getName());
        $embeds = new Embeds();
        $embeds->add($embed);
        $webhook = Sender::create($webhookurl)
            ->add($embeds);
        Sender::send($webhook);

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