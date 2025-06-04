<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        $results = [];
        $filepath = storage_path('app/locations.csv');

        // Debug: Log file path
        Log::info('Searching locations with query: ' . $query);
        Log::info('File path: ' . $filepath);

        if (!file_exists($filepath)) {
            Log::error('CSV file not found at: ' . $filepath);
            return response()->json(['error' => 'File lokasi tidak ditemukan'], 404);
        }

        try {
            $file = fopen($filepath, 'r');
            if ($file === false) {
                Log::error('Cannot open file: ' . $filepath);
                return response()->json(['error' => 'Tidak dapat membuka file lokasi'], 500);
            }

            fgetcsv($file);

            // Search through CSV
            while (($row = fgetcsv($file)) !== false) {
                if (stripos($row[6], $query) !== false || // subdis_name (kelurahan)
                    stripos($row[7], $query) !== false || // dis_name (kecamatan)
                    stripos($row[8], $query) !== false || // city_name (kota)
                    stripos($row[9], $query) !== false) { // prov_name (provinsi)
                    $results[] = [
                        'kelurahan' => $row[6],
                        'kecamatan' => $row[7],
                        'kota' => $row[8],
                        'provinsi' => $row[9]
                    ];
                }
            }

            fclose($file);
            return response()->json($results);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
