<?php

namespace App\Http\Controllers\Procedures;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedures;
use Illuminate\Support\Facades\Auth;

class ProceduresController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $procedures = Procedures::where('status', true)->get();
        } else {
            $procedures = Procedures::where('company_id', Auth::user()->company_id)->where('status', true)->get();
        }
        return view('procedures/index')
            ->with('procedures', $procedures);
    }
}
