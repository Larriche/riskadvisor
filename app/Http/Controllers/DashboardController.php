<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $customers = Consumer::count();
        $submissions = Submission::count();

        return inertia('Dashboard', compact('customers', 'submissions'));
    }
}
