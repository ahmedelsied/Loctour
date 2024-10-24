<?php

namespace Loctour\API\V1\Actions;

use App\Domain\Finance\Models\Invoice;
use App\Domain\Finance\Models\InvoiceStockItem;
use App\Domain\Finance\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateInvoiceStockAction
{
    private $invoiceStockItem;
    public function __construct(private array $validated,private Stock $stock,private Invoice $invoice) {}

    public function execute() : InvoiceStockItem
    {
        return DB::transaction(function(){
            $this->setInvoiceStockItem();
            $this->stock->lockForUpdate();
            $this->invoiceStockItem->lockForUpdate();
            $this->isProcessAdd() ? $this->addNewQuantity() : $this->returnQuantity();
            $this->invoiceStockItem->load('stock');
            return $this->invoiceStockItem;
        });
    }

    private function setInvoiceStockItem()
    {
        $this->invoiceStockItem = $this->invoice->stockItems()->where('stock_id', $this->stock->id)->first();
    }

    private function isProcessAdd()
    {
        return $this->validated['quantity'] - $this->invoiceStockItem->quantity > 0;
    }

    private function addNewQuantity()
    {
        $newQuantity = $this->validated['quantity'] - $this->invoiceStockItem->quantity;
        if ($newQuantity > $this->stock->quantity){
            throw ValidationException::withMessages(['stock' => 'Quantity is not available in stock']);
        }
        $this->invoiceStockItem->update([
            'quantity'  =>  $this->invoiceStockItem->quantity + $newQuantity,
            'cost'      =>  $this->stock->sale_price * ($this->invoiceStockItem->quantity + $newQuantity)
        ]);
        $this->stock->decrementQuiet('quantity', $newQuantity);
    }

    private function returnQuantity()
    {
        $returnedQuantity = $this->invoiceStockItem->quantity - $this->validated['quantity'];
        if ($this->validated['quantity'] <= 0){
            throw ValidationException::withMessages(['stock' => 'Invalid quantity']);
        }

        $this->invoiceStockItem->update([
            'quantity'  =>  $this->validated['quantity'],
            'cost'      =>  $this->stock->sale_price * $this->validated['quantity']
        ]);
        $this->stock->incrementQuiet('quantity', $returnedQuantity);
    }
}
