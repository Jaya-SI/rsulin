<?php

namespace App\Http\Controllers\Api\TEKNISI;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function listKeluhan()
    {
        $keluhan = Keluhan::where('done', '0')->get();

        return response()->json([
            'success' => true,
            'message' => 'List data keluhan',
            'data' => $keluhan,
        ]);
    }
}
