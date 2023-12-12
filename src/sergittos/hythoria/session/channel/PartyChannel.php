<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\session\channel;


use sergittos\hythoria\party\Party;

class PartyChannel extends Channel {

    private Party $party;

    public function __construct(Party $party) {
        $this->party = $party;
    }

    public function getName(): string {
        return "party";
    }

    public function getRecipients(): array {
        return $this->party->getOnlinePlayers();
    }

}