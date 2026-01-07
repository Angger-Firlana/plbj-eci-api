<?php

namespace App\Services;

use App\Models\PurchasedOrder;
use App\Models\PurchasedOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasedOrderService
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index(Request $request): array
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $purchasedOrders = PurchasedOrder::query();

        // Add search/filter logic here if needed, similar to QuotationService

        return $purchasedOrders->simplePaginate($limit, ['*'], 'page', $page)->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id): array
    {
        $purchasedOrder = PurchasedOrder::with(['purchased_order_details', 'quotation', 'vendor', 'approvals'])->find($id);

        if (!$purchasedOrder) {
            return [
                'data' => null,
                'message' => 'Purchased Order not found',
                'code' => 404,
            ];
        }

        return [
            'data' => $purchasedOrder,
            'message' => 'Purchased Order found',
            'code' => 200,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return array
     */
    public function store(array $data): array
    {
        DB::beginTransaction();
        try {
            $purchasedOrder = PurchasedOrder::create([
                'quotation_id' => $data['quotation_id'] ?? null,
                'vendor_id' => $data['vendor_id'],
                'purchased_order_number' => $data['purchased_order_number'],
                'purchased_order_date' => $data['purchased_order_date'],
                'delivery_date' => $data['delivery_date'],
                'status' => $data['status'] ?? 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            if (isset($data['purchased_order_details'])) {
                $purchasedOrder->purchased_order_details()->createMany($data['purchased_order_details']);
            }

            if (isset($data['approvals'])) {
                $purchasedOrder->approvals()->createMany($data['approvals']);
            }

            DB::commit();
            return [
                'data' => $purchasedOrder,
                'message' => 'Purchased Order created successfully',
                'code' => 201,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'data' => null,
                'message' => 'Failed to create Purchased Order: ' . $e->getMessage(),
                'code' => 500,
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  array  $data
     * @return array
     */
    public function update($id, array $data): array
    {
        DB::beginTransaction();
        try {
            $purchasedOrder = PurchasedOrder::find($id);

            if (!$purchasedOrder) {
                return [
                    'data' => null,
                    'message' => 'Purchased Order not found',
                    'code' => 404,
                ];
            }

            $purchasedOrder->update([
                'quotation_id' => $data['quotation_id'] ?? $purchasedOrder->quotation_id,
                'vendor_id' => $data['vendor_id'] ?? $purchasedOrder->vendor_id,
                'purchased_order_number' => $data['purchased_order_number'] ?? $purchasedOrder->purchased_order_number,
                'purchased_order_date' => $data['purchased_order_date'] ?? $purchasedOrder->purchased_order_date,
                'delivery_date' => $data['delivery_date'] ?? $purchasedOrder->delivery_date,
                'status' => $data['status'] ?? $purchasedOrder->status,
                'notes' => $data['notes'] ?? $purchasedOrder->notes,
            ]);

            if (isset($data['purchased_order_details'])) {
                // Assuming full replacement for simplicity; more complex logic might be needed for partial updates
                $purchasedOrder->purchased_order_details()->delete();
                $purchasedOrder->purchased_order_details()->createMany($data['purchased_order_details']);
            }

            if (isset($data['approvals'])) {
                // Assuming full replacement for simplicity
                $purchasedOrder->approvals()->delete();
                $purchasedOrder->approvals()->createMany($data['approvals']);
            }

            DB::commit();
            return [
                'data' => $purchasedOrder,
                'message' => 'Purchased Order updated successfully',
                'code' => 200,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'data' => null,
                'message' => 'Failed to update Purchased Order: ' . $e->getMessage(),
                'code' => 500,
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function delete($id): array
    {
        DB::beginTransaction();
        try {
            $purchasedOrder = PurchasedOrder::find($id);

            if (!$purchasedOrder) {
                return [
                    'data' => null,
                    'message' => 'Purchased Order not found',
                    'code' => 404,
                ];
            }

            $purchasedOrder->purchased_order_details()->delete(); // Delete related details
            $purchasedOrder->approvals()->delete(); // Delete related approvals
            $purchasedOrder->delete();

            DB::commit();
            return [
                'data' => null,
                'message' => 'Purchased Order deleted successfully',
                'code' => 200,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'data' => null,
                'message' => 'Failed to delete Purchased Order: ' . $e->getMessage(),
                'code' => 500,
            ];
        }
    }
}