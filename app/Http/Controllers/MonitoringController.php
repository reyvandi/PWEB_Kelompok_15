<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MonitoringController extends Controller
{
    public function locations(Request $request)
    {
        try {
            $results = Location::all(['kelurahan_nama', 'kecamatan_nama', 'kota_nama', 'provinsi_nama']); // Pilih kolom yang relevan

            if ($results->isEmpty()) {
                return response()->json(['message' => 'No locations found'], 404);
            }

            return view('monitoring_lahan', ['results' => $results]);
        } catch (\Exception $e) {
            Log::error('Error retrieving locations: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while retrieving locations'], 500);
        }
    }

    public function searchLocation(Request $request)
    {
        try {
            // Check if query parameter is present
            $query = $request->get('query');

            if (!$query) {
                return response()->json([]);
            }

            // Perform search in the database and return the results
            $locations = Location::where('kelurahan_nama', 'LIKE', '%' . $query . '%')
                ->orWhere('kecamatan_nama', 'LIKE', '%' . $query . '%')
                ->orWhere('kota_nama', 'LIKE', '%' . $query . '%')
                ->orWhere('provinsi_nama', 'LIKE', '%' . $query . '%')
                ->get(['kelurahan_nama', 'kecamatan_nama', 'kota_nama', 'provinsi_nama']);

            return response()->json($locations); // Return results as JSON
        } catch (\Exception $e) {
            Log::error('Error during location search: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during the search'], 500);
        }
    }

    // In your MonitoringController or UserController
    public function saveLocation(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated']);
            }

            // Simpan setiap bagian lokasi ke kolom terpisah
            $user->kelurahan = $request->kelurahan;
            $user->kecamatan = $request->kecamatan;
            $user->kota = $request->kota;
            $user->provinsi = $request->provinsi;

            // Atau jika Anda ingin menyimpan sebagai string gabungan
            // $user->lokasi_lahan = implode(', ', [
            //     $request->kelurahan,
            //     $request->kecamatan,
            //     $request->kota,
            //     $request->provinsi
            // ]);

            $user->save();

            return response()->json(['success' => true, 'message' => 'Location saved successfully']);

        } catch (\Exception $e) {
            Log::error('Error saving location: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error saving location']);
        }
    }
}
