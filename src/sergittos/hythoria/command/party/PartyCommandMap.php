<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\command\party;


use sergittos\hythoria\command\BaseCommandMap;
use sergittos\hythoria\command\party\presets\AcceptCommand;
use sergittos\hythoria\command\party\presets\ListCommand;
use sergittos\hythoria\command\party\presets\DemoteCommand;
use sergittos\hythoria\command\party\presets\DisbandCommand;
use sergittos\hythoria\command\party\presets\InviteCommand;
use sergittos\hythoria\command\party\presets\KickCommand;
use sergittos\hythoria\command\party\presets\KickofflineCommand;
use sergittos\hythoria\command\party\presets\LeaveCommand;
use sergittos\hythoria\command\party\presets\MuteCommand;
use sergittos\hythoria\command\party\presets\PollCommand;
use sergittos\hythoria\command\party\presets\PrivateCommand;
use sergittos\hythoria\command\party\presets\PromoteCommand;
use sergittos\hythoria\command\party\presets\SettingsCommand;
use sergittos\hythoria\command\party\presets\TransferCommand;
use sergittos\hythoria\command\party\presets\WarpCommand;
use function implode;

class PartyCommandMap extends BaseCommandMap {

    public function __construct() {
        parent::__construct("party", "Create parties and play with your friends!", ["p"]);
    }

    public function getHelpMessage(): string {
        $messages = [];
        $messages[] = "{DARK_BLUE}---------------------------------------------------------------------------";
        $messages[] = "{GREEN}Party Commands:";
        foreach($this->commands as $command) {
            $messages[] = "{YELLOW}" . $command->getUsage() . " {GRAY}- {AQUA}" . $command->getDescription();
        }
        $messages[] = "{DARK_BLUE}---------------------------------------------------------------------------";
        return implode("\n", $messages);
    }

    protected function registerDefaultCommands(): void {
        $this->registerCommand(new AcceptCommand());
        $this->registerCommand(new DemoteCommand());
        $this->registerCommand(new DisbandCommand());
        $this->registerCommand(new InviteCommand());
        $this->registerCommand(new KickCommand());
        $this->registerCommand(new KickofflineCommand());
        $this->registerCommand(new LeaveCommand());
        $this->registerCommand(new ListCommand());
        $this->registerCommand(new MuteCommand());
        $this->registerCommand(new PollCommand());
        $this->registerCommand(new PrivateCommand());
        $this->registerCommand(new PromoteCommand());
        $this->registerCommand(new SettingsCommand());
        $this->registerCommand(new TransferCommand());
        $this->registerCommand(new WarpCommand());
    }

}