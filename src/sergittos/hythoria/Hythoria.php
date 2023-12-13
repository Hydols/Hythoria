<?php

declare(strict_types=1);


namespace sergittos\hythoria;


use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use sergittos\hythoria\command\console\RankCommand;
use sergittos\hythoria\command\friend\FriendCommandMap;
use sergittos\hythoria\command\party\PartyCommandMap;
use sergittos\hythoria\command\session\ChatCommand;
use sergittos\hythoria\item\HythoriaItems;
use sergittos\hythoria\listener\ChatListener;
use sergittos\hythoria\listener\ItemListener;
use sergittos\hythoria\listener\SessionListener;
use sergittos\hythoria\packet\PacketFactory;
use sergittos\hythoria\provider\MysqlProvider;
use sergittos\hythoria\rank\RankManager;
use sergittos\hythoria\server\Server;
use sergittos\hythoria\server\ServerManager;

class Hythoria extends PluginBase {
	use SingletonTrait;

    private MysqlProvider $provider;
	private ServerManager $server_manager;
	private RankManager $rank_manager;

	protected function onLoad(): void {
		self::setInstance($this);
        $this->saveResource("server.json");
	}

	protected function onEnable(): void {
        PacketFactory::init();

        $this->provider = new MysqlProvider();
		$this->server_manager = new ServerManager();
        $this->server_manager->submitInitialPackets();
		$this->rank_manager = new RankManager();

        $this->registerListener(new ChatListener());
        $this->registerListener(new ItemListener());
        $this->registerListener(new SessionListener());

        $this->getServer()->getCommandMap()->register("hythoria", new ChatCommand());
        $this->getServer()->getCommandMap()->register("hythoria", new RankCommand());
        $this->getServer()->getCommandMap()->register("hythoria", new FriendCommandMap());
        $this->getServer()->getCommandMap()->register("hythoria", new PartyCommandMap());
	}

    protected function onDisable(): void {
        $this->server_manager->getCurrentServer()->disconnect();
        $this->server_manager->sendUpdatePacket("all");
    }

    private function registerListener(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }

    public function getProvider(): MysqlProvider {
        return $this->provider;
    }

	public function getServerManager(): ServerManager {
		return $this->server_manager;
	}

	public function getRankManager(): RankManager {
		return $this->rank_manager;
	}

}