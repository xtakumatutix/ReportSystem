<?php

declare(strict_types=1);

namespace smo\ReportSystem;

use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\Server;

class ConfigManager{

	private $config;
	private $plugin;
	private static $instance = null;

	public function __construct($plugin){

		$this->config = new Config($plugin->getDataFolder() . "Config.yml", Config::YAML,[

			"CanUseID" => 1
		]);
		$this->plugin = $plugin;
		self::$instance = $this;

		date_default_timezone_set("Asia/Tokyo");
	}

	public static function get(): self {

		return self::$instance;
	}

	public function saveConfig(): void {

		if($this->config === null) return;

		$this->config->save();
		$this->plugin->getLogger()->notice("Configをセーブしました");
	}

	public function addReport(Player $sender, string $name, string $reason): void {

		$date = (new \DateTime())->format("Y年n月j日 G時i分s秒");
		$id = $this->config->get("CanUseID");
		$this->config->set("CanUseID", $id + 1);

		$this->config->set($id,[

			"報告者" => $sender->getName(),
			"対象者" => $name,
			"理由" => $reason,
			"時間" => $date
		]);

		$sender->sendMessage("§a[ReportSystem] >> 報告しました。ありがとうございました。");

		foreach(Server::getInstance()->getOnlinePlayers() as $p){
			if($p->isOp()){
				$p->sendMessage("§a[ReportSystem] >> 新たなレポートが届きました。 ID: ".$id);
			}
		}
	}

	public function removeReport(int $id, Player $sender): void {

		if(!$this->config->exists($id)){
			$sender->sendMessage("§c[ReportSystem] >> ID: ".$id." のレポートは存在しません");
			return;
		}

		$this->config->remove($id);
		$sender->sendMessage("§a[ReportSystem] >> ID: ".$id." のレポートを削除しました");
	}

	public function getData(int $id): ?array {

		if(!$this->config->exists($id)){
			return null;
		}

		return $this->config->get($id);
	}

	public function getAll(): array {

		$all = $this->config->getAll();
		unset($all["CanUseID"]);

		return $all;
	}
}