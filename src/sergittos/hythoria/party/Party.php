<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\party;


class Party {

    private Member $leader;

    /** @var Member[] */
    private array $members = [];

    public function __construct(Member $leader) {
        
    }

    public function getLeader(): Member {
        return $this->leader;
    }

    /**
     * @return Member[]
     */
    public function getMembers(): array {
        return $this->members;
    }


}