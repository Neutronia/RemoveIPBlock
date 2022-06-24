<?php

declare(strict_types=1);

namespace alvin0319\RemoveIPBlock;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;

final class Loader extends PluginBase{

	protected function onEnable() : void{
		if($this->getConfig()->get("host-ip", "0.0.0.0") === "0.0.0.0"){
			$this->getLogger()->notice("Please set the host-ip in config.yml");
			return;
		}
		$ip = $this->getConfig()->get("host-ip");
		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() use ($ip) : void{
			$this->getServer()->getNetwork()->unblockAddress($ip);
		}), 20 * 60);
	}
}