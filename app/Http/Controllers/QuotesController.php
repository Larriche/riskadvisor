<?php

namespace App\Http\Controllers;

use App\Models\InsuranceProduct;
use App\Models\State;
use App\Services\QuotesService;

use Illuminate\Http\Request;
use App\Http\Requests\CreateQuoteRequest;

class QuotesController extends Controller
{
    public function create()
    {
        return inertia('Consumer/QuoteForm', [
            'products' => InsuranceProduct::all(),
            'states' => State::all()
        ]);
    }

    public function store(CreateQuoteRequest $request, QuotesService $service)
    {
        $submission = $service->saveQuote   ($request->all());

        return redirect()->back()->with('success', 'Thank you. We will be in touch soon!');
    }
}
