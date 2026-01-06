<?php
namespace App\Services;

use App\Models\Store;
use Illuminate\Http\Request;
class StoreService
{
    //
    public function index(Request $request):array   
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        
        return Store::simplePaginate($limit, ['*'], 'page', $page)->toArray();
    }

    public function show($id):array{
        $store = Store::find($id);
        if (!$store) {
            return [
                'message' => 'Store not found',
                'code' => 404
            ];
        }
        return [
            'data' => $store,
            'message' => 'Store found',
            'code' => 200
        ];
    }

    public function create(array $data):array{
        $store = Store::create([
            'store_code' => $data['store_code'],
            'name' => $data['name'],
            'address' => $data['address'] ?? null,
            'city' => $data['city']?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ]);

        if(!$store) {
            return [
                'message' => 'Failed to create store',
                'code' => 500
            ];
        }
        
        return [
            'data' => $store,
            'message' => 'Store created successfully',
            'code' => 201
        ];
    }

    public function update($id, array $data):array{
        $store = Store::find($id);
        if (!$store) {
            return [
                'message' => 'Store not found',
                'code' => 404
            ];
        }
        
        $store->update([
            'store_code' => $data['store_code'],
            'name' => $data['name'],
            'address' => $data['address'] ?? null,
            'city' => $data['city']?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ]);

        if(!$store) {
            return [
                'message' => 'Failed to update store',
                'code' => 500
            ];
        }
        
        return [
            'data' => $store,
            'message' => 'Store updated successfully',
            'code' => 200
        ];
    }
    
    public function delete($id):array{
        $store = Store::find($id);
        if (!$store) {
            return [
                'message' => 'Store not found',
                'code' => 404
            ];
        }
        
        $store->delete();
        
        return [
            'message' => 'Store deleted successfully',
            'code' => 200
        ];
    }
}
