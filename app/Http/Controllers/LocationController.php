<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Mengambil data kecamatan
     */
    public function getDistrict($id)
    {
        return response()->json(District::where('regency_id', $id)->get());
    }

    public function getRegency($id)
    {
        return response()->json(Regency::where('province_id', $id)->get());
    }
}
