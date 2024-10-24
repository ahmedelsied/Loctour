<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Finance;

use App\Domain\Finance\Models\RecentlyUsedStock;
use App\Domain\Finance\Models\Stock;
use Illuminate\Support\Facades\DB;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\StockRequest;
use Loctour\API\V1\Resources\StockResource;

class StockController extends APIController
{
    public function index()
    {
        return $this->success(StockResource::paginate(Stock::latest()->paginate(20)),200, [
            'total_sale_price'  =>  (int) Stock::sum(DB::raw('sale_price * quantity')),
            'total_buy_price'  =>  (int) Stock::sum(DB::raw('buy_price * quantity'))
        ]);
    }

    public function store(StockRequest $request)
    {
        $stock = Stock::create($request->validated());
        return $this->success(new StockResource($stock));
    }

    public function update(Stock $stock, StockRequest $request)
    {
        $stock->update($request->validated());
        return $this->success(new StockResource($stock));
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return $this->executed();
    }

    public function recentlyUsed()
    {
        $recentlyUsedStocks = RecentlyUsedStock::with('stock')->latest()->limit(15)->get();
        return $this->success(StockResource::collection($recentlyUsedStocks->pluck('stock')->all()));
    }
}
