<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\rank;


class RankManager {

    /** @var Rank[] */
    private array $ranks = [];

    public function __construct() {
        $this->addRank(new Rank(
            "vip", "{GREEN}VIP", "{GREEN}", []
        ));
        $this->addRank(new Rank(
            "vip_plus", "{GREEN}VIP{GOLD}+", "{GREEN}", []
        ));
    }

    /**
     * @return Rank[]
     */
    public function getRanks(): array {
        return $this->ranks;
    }

    public function getRank(string $id): ?Rank {
        return $this->ranks[$id] ?? null;
    }

    public function addRank(Rank $rank): void {
        $this->ranks[$rank->getId()] = $rank;
    }

}