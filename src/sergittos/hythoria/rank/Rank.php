<?php
/*
* Copyright (C) Sergittos - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/

declare(strict_types=1);


namespace sergittos\hythoria\rank;


use sergittos\hythoria\utils\ColorUtils;

class Rank {

    private string $id;
    private string $name;
    private string $color;

    /** @var string[] */
    private array $permissions;

    /**
     * @param string[] $permissions
     */
    public function __construct(string $id, string $name, string $color, array $permissions) {
        $this->id = $id;
        $this->name = ColorUtils::translate($name);
        $this->color = ColorUtils::translate($color);
        $this->permissions = $permissions;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getInChatName(): string {
        return $this->color . "[" . $this->name . $this->color . "]";
    }

    public function getColor(): string {
        return $this->color;
    }

    /**
     * @return string[]
     */
    public function getPermissions(): array {
        return $this->permissions;
    }

}