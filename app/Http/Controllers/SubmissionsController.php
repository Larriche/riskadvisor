<?php

namespace App\Http\Controllers;

use App\Models\InsuranceProduct;
use App\Models\State;
use App\Models\Submission;
use App\Services\SubmissionsService;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSubmissionRequest;

class SubmissionsController extends Controller
{
    public function index()
    {
        return inertia('Admin/Submissions', [
            'submissions' => Submission::with(['consumer', 'products', 'state'])->paginate(20)
        ]);
    }

    public function create()
    {
        return inertia('Consumer/SubmissionForm', [
            'products' => InsuranceProduct::all(),
            'states' => State::all()
        ]);
    }

    public function store(CreateSubmissionRequest $request, SubmissionsService $service)
    {
        $submission = $service->saveQuote($request->all());

        return redirect()->back()->with('success', 'Thank you. We will be in touch soon!');
    }
}
