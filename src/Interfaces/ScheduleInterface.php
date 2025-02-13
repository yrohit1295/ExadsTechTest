<?php
namespace App\Interfaces;

interface ScheduleInterface
{
    public function getNextShow(?string $inputDate = null, ?string $title = null): ?array;
}
