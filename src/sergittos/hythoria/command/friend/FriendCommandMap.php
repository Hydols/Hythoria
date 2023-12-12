<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\friend;


use pocketmine\permission\DefaultPermissions;
use sergittos\hythoria\command\BaseCommandMap;
use sergittos\hythoria\command\friend\presets\AcceptCommand;
use sergittos\hythoria\command\friend\presets\AddCommand;
use sergittos\hythoria\command\friend\presets\BestCommand;
use sergittos\hythoria\command\friend\presets\DenyCommand;
use sergittos\hythoria\command\friend\presets\ListCommand;
use sergittos\hythoria\command\friend\presets\NickNameCommand;
use sergittos\hythoria\command\friend\presets\NotificationsCommand;
use sergittos\hythoria\command\friend\presets\RemoveAllCommand;
use sergittos\hythoria\command\friend\presets\RemoveCommand;
use sergittos\hythoria\command\friend\presets\RequestsCommand;
use sergittos\hythoria\command\friend\presets\ToggleCommand;
use function implode;

class FriendCommandMap extends BaseCommandMap {

    public function __construct() {
        parent::__construct("friend", "Friends main command", ["f", "friends"]);
    }

    public function getHelpMessage(): string {
        $messages = [];
        $messages[] = "{DARK_BLUE}---------------------------------------------------------------------------";
        $messages[] = "{GREEN}Friend Commands:";
        foreach($this->commands as $command) {
            $messages[] = "{YELLOW}" . $command->getUsage() . " {GRAY}- {AQUA}" . $command->getDescription();
        }
        $messages[] = "{DARK_BLUE}---------------------------------------------------------------------------";
        return implode("\n", $messages);
    }

    protected function registerDefaultCommands(): void {
        $this->registerCommand(new AcceptCommand());
        $this->registerCommand(new AddCommand());
        $this->registerCommand(new BestCommand());
        $this->registerCommand(new DenyCommand());
        $this->registerCommand(new ListCommand());
        $this->registerCommand(new NickNameCommand());
        $this->registerCommand(new NotificationsCommand());
        $this->registerCommand(new RemoveAllCommand());
        $this->registerCommand(new RemoveCommand());
        $this->registerCommand(new RequestsCommand());
        $this->registerCommand(new ToggleCommand());
    }

}