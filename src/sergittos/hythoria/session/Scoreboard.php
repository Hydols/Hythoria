<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\session;


use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use sergittos\hythoria\Hythoria;
use sergittos\hythoria\utils\ColorUtils;
use function count;

class Scoreboard {

    public function show(Session $session): void {
        if($session->getPlayer()->isConnected()) {
            $this->hide($session);

            $packet = new SetDisplayObjectivePacket();
            $packet->displaySlot = SetDisplayObjectivePacket::DISPLAY_SLOT_SIDEBAR;
            $packet->objectiveName = $session->getUsername();
            $packet->displayName = ColorUtils::translate("{YELLOW}{BOLD}HYTHORIA");
            $packet->criteriaName = "dummy";
            $packet->sortOrder = SetDisplayObjectivePacket::SORT_ORDER_DESCENDING;
            $session->sendDataPacket($packet);

            foreach($this->getLines($session) as $score => $line) {
                $this->addLine($score, " " . $line, $session);
            }
            $this->addLine(2, "      ", $session);
            $this->addLine(1, " {YELLOW}play.hythoria.net", $session);
        }
    }

    private function addLine(int $score, string $text, Session $session): void {
        $entry = new ScorePacketEntry();
        $entry->objectiveName = $session->getUsername();
        $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
        $entry->customName = ColorUtils::translate($text);
        $entry->score = $score;
        $entry->scoreboardId = $score;
        $packet = new SetScorePacket();
        $packet->type = SetScorePacket::TYPE_CHANGE;
        $packet->entries[] = $entry;
        $session->sendDataPacket($packet);
    }

    private function hide(Session $session): void {
        if($session->getPlayer()->isConnected()) {
            $packet = new RemoveObjectivePacket();
            $packet->objectiveName = $session->getUsername();
            $session->sendDataPacket($packet);
        }
    }

    private function getLines(Session $session): array { // TODO
        return [
            9 => "{GRAY}" . date("m/d/y"),
            8 => " ",
            7 => "Rank: " . $session->getRankName(),
            6 => "Hythoria Level: {DARK_AQUA}1",
            5 => "  ",
            4 => "Lobby: {GREEN}1",
            3 => "Players: {GREEN}" . Hythoria::getInstance()->getServerManager()->getOnlinePlayers()
        ];
    }

}