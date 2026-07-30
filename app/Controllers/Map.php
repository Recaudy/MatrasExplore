<?php

namespace App\Controllers;

use App\Models\DestinationModel;

class Map extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url('#map'));
    }
}
