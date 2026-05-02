<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Return paginated customer data for the frontend.
     *
     * This endpoint is used by the Vue/Pinia store to asynchronously load
     * customer records from the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // Validate user input to prevent invalid pagination values.
        $validated = $request->validate([
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        // Default value keeps the response lightweight for web/mobile clients.
        $perPage = $validated['per_page'] ?? 10;

        $customers = DB::table('customers')
            ->select([
                'id',
                'first_name',
                'last_name',
                'email',
                'gender',
                'ip_address',
                'company',
                'city',
                'title',
                'website',
            ])
            ->orderBy('id')
            ->paginate($perPage);

        return response()->json($customers);
    }
}
