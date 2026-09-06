<?php

namespace App\Http\Controllers\BotIntention;

use App\Http\Controllers\Controller;
use App\Models\BotIntention;
use Illuminate\Http\Request;

class BotIntentionController extends Controller
{
    public function index()
    {
        $botIntention = BotIntention::all();
        return view('intention/index')
            ->with('botIntention', $botIntention);
    }
}
