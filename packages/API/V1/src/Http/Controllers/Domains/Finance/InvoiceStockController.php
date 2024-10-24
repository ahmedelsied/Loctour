<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Finance;

use App\Domain\Finance\Models\Invoice;
use App\Domain\Finance\Models\InvoiceStockItem;
use App\Domain\Finance\Models\RecentlyUsedStock;
use App\Domain\Finance\Models\Stock;
use Illuminate\Support\Facades\DB;
use Loctour\API\V1\Actions\StoreInvoiceStockAction;
use Loctour\API\V1\Actions\UpdateInvoiceStockAction;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Invoices\OrderProductRequest;
use Loctour\API\V1\Resources\Invoices\InvoiceStockItemResource;
use Loctour\API\V1\Resources\StockResource;

class InvoiceStockController extends APIController
{
    public function store(OrderProductRequest $request, Invoice $invoice, Stock $stock)
    {
        $stockItem = app(StoreInvoiceStockAction::class, [
            'validated' =>  $request->validated(),
            'stock'     =>  $stock,
            'invoice'   =>  $invoice
        ])->execute();
        return $this->success(new InvoiceStockItemResource($stockItem));
    }

    public function update(OrderProductRequest $request, Invoice $invoice, Stock $stock)
    {
        $stockItem = app(UpdateInvoiceStockAction::class, [
            'validated' =>  $request->validated(),
            'stock'     =>  $stock,
            'invoice'   =>  $invoice
        ])->execute();
        return $this->success(new InvoiceStockItemResource($stockItem));
    }

    public function destroy(Invoice $invoice, InvoiceStockItem $invoiceStockItem)
    {
        DB::transaction(function() use ($invoiceStockItem){
            $invoiceStockItem->load('stock');
            $invoiceStockItem->stock->lockForUpdate();
            $invoiceStockItem->stock->increment('quantity', $invoiceStockItem->quantity);
            $invoiceStockItem->delete();
        });
        return $this->executed();
    }

}
