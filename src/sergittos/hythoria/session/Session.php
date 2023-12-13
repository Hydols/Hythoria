<?php

declare(strict_types=1);


namespace sergittos\hythoria\session;


use pocketmine\network\mcpe\protocol\BossEventPacket;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\types\BossBarColor;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\item\HythoriaItems;
use sergittos\hythoria\rank\Rank;
use sergittos\hythoria\server\Server;
use pocketmine\Server as PMServer;
use sergittos\hythoria\session\channel\Channel;
use sergittos\hythoria\session\channel\PublicChannel;
use sergittos\hythoria\utils\ColorUtils;

class Session {

    private Player $player;
    private Scoreboard $scoreboard;
    private Channel $channel;

    private ?Rank $rank = null;

    public function __construct(Player $player) {
        $this->player = $player;
        $this->scoreboard = new Scoreboard();
        $this->channel = new PublicChannel();

        $this->load();
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getUsername(): string {
        return $this->player->getName();
    }

    public function getXuid(): string {
        return $this->player->getXuid();
    }

    public function getChannel(): Channel {
        return $this->channel;
    }

    public function getRank(): ?Rank {
        return $this->rank;
    }

    public function getRankName(): string {
        if($this->hasRank()) {
            return $this->rank->getName();
        }
        return "{GRAY}Guest";
    }

    public function updateScoreboard(): void {
        $this->scoreboard->show($this);
    }

    public function hasRank(): bool {
        return $this->rank !== null;
    }

    public function setChannel(Channel $channel): void {
        $this->channel = $channel;
    }

    public function setRank(?Rank $rank): void {
        $this->rank = $rank;
        Hythoria::getInstance()->getProvider()->setRank($this, $rank); // I should change this
    }

    public function teleportToLobby(): void {
        $this->player->getEffects()->clear();
        $this->player->setGamemode(GameMode::ADVENTURE());
        $this->player->setHealth($this->player->getMaxHealth());
        $this->player->setNameTag($this->player->getDisplayName());
        $this->player->teleport(PMServer::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());

        $this->giveLobbyItems();
        $this->updateScoreboard();
        $this->showBossBar("{GREEN}RELEASE SALE - UP TO 60% OFF!");
    }

    public function clearInventories(): void {
        $this->player->getCursorInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        $this->player->getEnderInventory()->clearAll();
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
    }

    public function giveLobbyItems(): void {
        $this->clearInventories();

        $inventory = $this->player->getInventory();
        $inventory->setItem(0, HythoriaItems::GAME_MENU()->asItem());
        $inventory->setItem(8, HythoriaItems::LOBBY_SELECTOR()->asItem());
    }

    public function showBossBar(string $title): void {
        $this->hideBossBar();
        $this->sendDataPacket(
            BossEventPacket::show($this->player->getId(), ColorUtils::translate($title), 10, false, 0, BossBarColor::BLUE)
        );
    }

    public function hideBossBar(): void {
        $this->sendDataPacket(BossEventPacket::hide($this->player->getId()));
    }

    public function sendDataPacket(ClientboundPacket $packet): void {
        $this->player->getNetworkSession()->sendDataPacket($packet);
    }

    public function transferTo(Server $server): void {
        $this->player->transfer($server->getId());
    }

    private function load(): void {
        Hythoria::getInstance()->getProvider()->loadSession($this);
    }

    public function message(string $message): void {
        $this->player->sendMessage(ColorUtils::translate($message));
    }

}