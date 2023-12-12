<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\session;


use sergittos\hythoria\session\Session;
use function implode;
use function in_array;
use function strtolower;

class ChatCommand extends SessionCommand {

    public function __construct() {
        parent::__construct("chat", "Toggles chat channel");
    }

    protected function onCommand(Session $session, array $args): void {
        if(!isset($args[0])) {
            $session->message("{RED}Invalid usage! Correct usage: /chat channel");
            $session->message($this->getChannelsMessage());
            return;
        }

        $channel = strtolower($args[0]);
        if($channel === "channel") {
            $channel = strtolower($args[1] ?? "");
        }

        if(!in_array($channel, $this->getChannels())) {
            $session->message("{RED}Invalid channel! " . $this->getChannelsMessage());
            return;
        }

        if($session->getChannel()->getName() === $channel) {
            $session->message("{RED}You're already in this channel!");
            return;
        }

        // todo
    }

    // TODO: Make enums for channels

    private function getChannelsMessage(): string {
        return "{RED}Valid channels: " . implode(", ", $this->getChannels());
    }

    private function getChannels(): array {
        return ["all", "party"]; // todo: add aliases (party -> p)
    }

}