<?php

declare(strict_types=1);


namespace sergittos\hythoria\item\presets;


use pocketmine\form\Form;
use pocketmine\item\Item;
use sergittos\hythoria\item\HythoriaItem;
use sergittos\hythoria\session\Session;

class FormItem extends HythoriaItem {

    private string $form;
    private Item $item;

    public function __construct(string $name, string $form, Item $item) {
        $this->form = $form;
        $this->item = $item;
        parent::__construct($name);
    }

    public function onInteract(Session $session): void {
        $session->getPlayer()->sendForm(new($this->form));
    }

    protected function realItem(): Item {
        return $this->item;
    }

}