<?php

namespace App\Http\Controllers;

use App\Models\Agencystructure;
use App\Models\Biocontrol;
use App\Models\Exittime;
use App\Models\Main;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    public function index()
    {
        return view('admin.home');
    }

}
