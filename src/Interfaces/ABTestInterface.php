<?php

namespace App\Interfaces;

interface ABTestInterface
{
    public function getDesign(): array;

    public function redirectToDesign(): void;
}
