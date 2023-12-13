<?php

declare(strict_types=1);


namespace sergittos\hythoria\party;


use sergittos\hythoria\server\Server;

class Member {

    private string $xuid;
    private string $username;

    private Server $server;

    public function __construct(string $xuid, string $username, Server $server) {
        $this->xuid = $xuid;
        $this->username = $username;
        $this->server = $server;
    }

    public function getXuid(): string {
        return $this->xuid;
    }

    public function getUsername(): string {
        return $this->username;
    }

    /*
     * Returns the current server the member is connected on
     */
    public function getServer(): Server {
        return $this->server;
    }

}