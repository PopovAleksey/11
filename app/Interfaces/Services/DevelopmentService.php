<?php


namespace App\Interfaces\Services;


use App\Interfaces\Models\User;

interface DevelopmentService
{
    public function getRandomEmail(): string;
}