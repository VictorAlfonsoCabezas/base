<?php

namespace App\Http\Controllers\Suscription;

use App\Http\Controllers\Controller;
use App\Models\Suscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscriptionController extends Controller
{
    public function index()
    {
        if (Auth::user()->company->principal) {
            $suscription = Suscription::all();
        } else {
            $suscription = Suscription::where('company_id', Auth::user()->company_id)->get();
        }
        return view('suscription/index')
            ->with('suscription', $suscription);
    }
}
