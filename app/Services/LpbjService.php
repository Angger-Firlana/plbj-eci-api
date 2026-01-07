<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Lpbj;

class LpbjService
{
    public function show($id):array{
        $lpbj = Lpbj::with('lpbj_items', 'department', 'user')->find($id);
        if(!$lpbj){
            return [
                'data' => null,
                'message' => 'LPBJ not found',
                'code' => 404,
            ];
        }
        return [
            'data' => $lpbj,
            'message' => 'LPBJ found',
            'code' => 200,
        ];
    }
    public function store(array $data): array
    {
        $lpbj = Lpbj::create([
            'title' => $data['title'],
            'request_by' => $data['request_by'],
            'lpbj_number' => $data['lpbj_number'],
            'department_id' => $data['department_id'],
            'request_date' => $data['request_date'],
            'store_id' => $data['store_id']
        ]);

        $this->storeItems($data['items'], $lpbj);

        if(!$lpbj){
            return [
                'data' => null,
                'message' => 'Failed to create LPBJ',
                'code' => 400,
            ];
        }

        return [
            'data' => $lpbj,
            'message' => 'LPBJ created successfully',
            'code' => 201
        ];
    }

    public function storeItems(array $items, Lpbj $lpbj): void
    {
        foreach ($items as $item) {
            $photoPath = null;
            if (isset($item['item_photo']) && $item['item_photo']) {
                $photoPath = $item['item_photo']->store('item_photos', 'public');
            }
            
            $detail_lpbj = $lpbj->lpbj_items()->create([
                'name' => $item['name'],
                'media' => $item['media'] ?? null,
                'article' => $item['article'] ?? null,
                'store_id' => $item['store_id'] ?? null,
                'general_ledger' => $item['general_ledger'] ?? null,
                'quantity' => $item['quantity'] ?? null,
                'cost_center' => $item['cost_center'] ?? null,
                'order' => $item['order'] ?? null,
                'information' => $item['information'] ?? null,
                'item_photo' => $photoPath
            ]);

            if(isset($item['detail_item'])){
                foreach($item['detail_item'] as $detail){
                    $detail_lpbj->detailItems()->create([
                        'detail' => $detail['detail']
                    ]);
                }
            }
        }
    }

    public function storeItem(Request $request, Lpbj $lpbj): void
    {
        $photoPath = $request['item_photo']->store('item_photos', 'public');
        $detail_lpbj = $lpbj->items()->create([
            'name' => $request->name,
            'media' => $request->media,
            'article' => $request->article,
            'store_id' => $request->store_id,
            'general_ledger' => $request->general_ledger,
            'quantity' => $request->quantity,
            'cost_center' => $request->cost_center,
            'order' => $request->order,
            'information' => $request->information,
            'item_photo' => $photoPath
        ]);
        
        if(isset($request['detail_item'])){
            foreach($request['detail_item'] as $detail){
                $detail_lpbj->detailItems()->create([
                    'detail' => $detail['detail']
                ]);
            }
        }
    }

    public function update(array $data, $id): array
    {
        $lpbj = Lpbj::findOrFail($id);
        
        $lpbj->update([
            'title' => $data['title'],
            'request_by' => $data['request_by'],
            'lpbj_number' => $data['lpbj_number'],
            'department_id' => $data['department_id'],
            'request_date' => $data['request_date'],
            'store_id' => $data['store_id']
        ]);

        $this->updateItems($data['items'], $lpbj);

        return [
            'data' => $lpbj,
            'message' => 'LPBJ updated successfully',
            'code' => 200
        ];
    }

    public function updateItem(array $data, $id): void
    {
        $lpbj = Lpbj::findOrFail($id);
        $photoPath = null;
        if(isset($data['item_photo']) && $data['item_photo']) {
            $photoPath = $data['item_photo']->store('item_photos', 'public');
        }

        if(isset($data['detail_item'])){
            foreach($data['detail_item'] as $detail){
                if(isset($detail['detail_id'])) {
                    $lpbj->detailItems()->where('id', $detail['detail_id'])->update([
                        'detail' => $detail['detail']
                    ]);
                } else {
                    $lpbj->detailItems()->create([
                        'detail' => $detail['detail']
                    ]);
                }
            }
        }
        
        // Update the item with the new data
        $lpbj->update([
            'name' => $data['name'],
            'media' => $data['media'] ?? null,
            'article' => $data['article'] ?? null,
            'store_id' => $data['store_id'] ?? null,
            'general_ledger' => $data['general_ledger'] ?? null,
            'quantity' => $data['quantity'] ?? null,
            'cost_center' => $data['cost_center'] ?? null,
            'order' => $data['order'] ?? null,
            'information' => $data['information'] ?? null,
            'item_photo' => $photoPath
        ]);
    }

    public function updateItems(array $items, Lpbj $lpbj): void
    {
        foreach ($items as $item) {
            $updateData = [
                'name' => $item['name'],
                'media' => $item['media'] ?? null,
                'article' => $item['article'] ?? null,
                'store_id' => $item['store_id'] ?? null,
                'general_ledger' => $item['general_ledger'] ?? null,
                'quantity' => $item['quantity'] ?? null,
                'cost_center' => $item['cost_center'] ?? null,
                'order' => $item['order'] ?? null,
                'information' => $item['information'] ?? null,
            ];

            if(isset($item['detail_item'])){
                foreach($item['detail_item'] as $detail){
                    if(isset($detail['detail_id'])) {
                        $lpbj->detailItems()->where('id', $detail['detail_id'])->update([
                            'detail' => $detail['detail']
                        ]);
                    } else {
                        $lpbj->detailItems()->create([
                            'detail' => $detail['detail']
                        ]);
                    }
                }
            }
            
            if (isset($item['item_photo']) && $item['item_photo']) {
                $updateData['item_photo'] = $item['item_photo']->store('item_photos', 'public');
            }
            
            if (isset($item['id'])) {
                $lpbj->lpbj_items()->where('id', $item['id'])->update($updateData);
            } else {
                $lpbj->lpbj_items()->create($updateData);
            }
        }
    }

    public function destroy($id): void
    {
        $lpbj = Lpbj::findOrFail($id);
        $lpbj->delete();
    }
}