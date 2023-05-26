<?php

namespace App\Controllers;

use DateTime;

class HomeController
{
    public function index()
    {
        return view('home', [
            'date' => (new DateTime())->format('d/m/Y')
        ]);
    }
}
