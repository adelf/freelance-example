<?php

namespace App\Infrastructure;

interface MultiDispatcher
{
    public function multiDispatch(array $events);
}