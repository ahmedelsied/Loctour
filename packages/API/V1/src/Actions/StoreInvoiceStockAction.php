<?php

namespace Loctour\API\V1\Actions;

use App\Domain\Finance\Models\Invoice;
use App\Domain\Finance\Models\InvoiceStockItem;
use App\Domain\Finance\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoreInvoiceStockAction
{
    private $invoiceStockItem;
    public function __construct(private array $validated,private Stock $stock,private Invoice $invoice) {}

    public function execute() : InvoiceStockItem
    {
        return DB::transaction(function(){
            $this->stock->lockForUpdate();
            $this->isStockItemExistsInInvoice() ? $this->updateInvoiceStockItem() : $this->createInvoiceStockItem();
            $this->invoiceStockItem->lockForUpdate();
            $this->stock->decrementQuiet('quantity', $this->validated['quantity']);
            $this->invoiceStockItem->load('stock');
            return $this->invoiceStockItem;
        });
    }

    private function isStockItemExistsInInvoice(): bool
    {
        $this->invoiceStockItem = $this->invoice->stockItems()->where('stock_id', $this->stock->id)->first();
        return !is_null($this->invoiceStockItem);
    }

    private function updateInvoiceStockItem(): InvoiceStockItem
    {
        $this->invoiceStockItem->update([
            'quantity'  =>  $this->invoiceStockItem->quantity + $this->validated['quantity'],
            'cost'      =>  $this->stock->sale_price * ($this->invoiceStockItem->quantity + $this->validated['quantity'])
        ]);
        return $this->invoiceStockItem;
    }

    private function createInvoiceStockItem(): InvoiceStockItem|Model
    {
        $this->invoiceStockItem = $this->invoice->stockItems()->create([
            'stock_id'  =>  $this->stock->id,
            'quantity'  =>  $this->validated['quantity'],
            'cost'      =>  $this->stock->sale_price * $this->validated['quantity']
        ]);
        return $this->invoiceStockItem;
    }
}
