<?php

declare(strict_types=1);

class DM_Checkout_Page extends Page
{
    public function __construct()
    {
        $this->initialize('checkout');
    }

    public static function init()
    {
        new self();
    }

    protected function setPageName(string $page_name): self
    {
        $this->pageName = $page_name;
        return $this;
    }
}