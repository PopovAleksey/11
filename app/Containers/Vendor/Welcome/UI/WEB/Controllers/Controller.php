<?php

namespace App\Containers\Vendor\Welcome\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
	public function sayWelcome()
	{
		return view('vendor@welcome::welcome-page');
	}
}
