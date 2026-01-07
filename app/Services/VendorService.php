<?php

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VendorService
{
    public function index(Request $request):array{
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $vendors = Vendor::query();

        if($request->has('search')){
            $vendors = $vendors->where('name', 'like', '%' . $request->search . '%');
        }

        $vendors = $vendors->simplePaginate($limit, ['*'], 'page', $page)->toArray();

        if(!$vendors){
            return [
                'code' => 404,
                'message' => "Vendor not has data"
            ];
        }

        return [
            'data' => $vendors,
            'code' => 200
        ];
    }   

    public function show($id):array{
        $vendor = Vendor::find($id);
        
        if(!$vendor){
            return [
                'code' => 404,
                'message' => "Vendor not found"
            ];
        }

        return [
            'data' => $vendor,
            'code' => 200
        ];
    }
    
    public function create(array $data):array{
        $vendor = Vendor::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'to_vendor' => $data['to_vendor'],
            'contact_person' => $data['contact_person']
        ]);

        if(!$vendor){
            return [
                'code' => 500,
                'message' => "Failed to create vendor"
            ];
        }

        return [
            'data' => $vendor,
            'code' => 201,
            'message' => 'Vendor created successfully'
        ];
    }

    public function update($id, array $data):array{
        $vendor = Vendor::find($id);
        
        if(!$vendor){
            return [
                'code' => 404,
                'message' => "Vendor not found"
            ];
        }

        $vendor->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'to_vendor' => $data['to_vendor'],
            'contact_person' => $data['contact_person']
        ]);

        if(!$vendor){
            return [
                'code' => 500,
                'message' => "Failed to update vendor"
            ];
        }

        return [
            'data' => $vendor,
            'code' => 200,
            'message' => 'Vendor Updated Successfully'
        ];
    }

    public function delete($id):array{
        $vendor = Vendor::find($id);
        
        if(!$vendor){
            return [
                'code' => 404,
                'message' => "Vendor not found"
            ];
        }

        $vendor->delete();

        return [
            'code' => 200,
            'message' => 'Vendor deleted successfully'
        ];
    }
}
