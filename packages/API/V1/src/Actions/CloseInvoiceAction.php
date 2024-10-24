<?php

namespace Loctour\API\V1\Actions;

use App\Domain\Finance\Enums\DiscountTypeEnum;
use App\Domain\Finance\Enums\InvoiceStatusEnum;
use App\Domain\Finance\Models\Invoice;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CloseInvoiceAction
{
    private $total = 0;
    private $paid = 0;
    private int|float $discount;

    public function __construct(private array $validated, private Invoice $invoice) {}

    public function execute() : Invoice
    {
        return DB::transaction(function (){
            $this->invoice->lockForUpdate();
            $this->closeOpenTimers();
            $this->setTotal();
            $this->setDiscount();
            $this->setPaid();
            $this->updateEnterntainmentObjectsActive();
            $this->updateInvoice();

            return $this->invoice;
        });

    }

    private function closeOpenTimers()
    {
        $invoiceTimers = $this->invoice->timerItems;
        $invoiceOpenTimerItems = $invoiceTimers->where('active',true);
        $invoiceOpenTimerItems->each(function($timerItem){
            $timerItem->update([
                'end_time'  =>  now(),
                'cost'      =>  $timerItem->item->calculateCost($timerItem->start_time, now(), $timerItem->timer_type . '_price'),
                'active'    =>  false
            ]);
        });
    }

    private function setTotal()
    {
        $this->total = $this->invoice->stockItems->sum('cost') + $this->invoice->timerItems->sum('cost');
    }
    private function setDiscount()
    {
        $this->discount = match (data_get($this->validated,'discount_type')) {
            DiscountTypeEnum::percentage()->value   =>  round(($this->total * $this->validated['discount_value'] / 100),2),
            DiscountTypeEnum::fixed()->value        =>  round( $this->validated['discount_value'],2),
            default => 0
        };
        if($this->discount < 0) throw ValidationException::withMessages(['discount_value' => __('Discount value can not be more than total amount')]);
    }

    public function setPaid()
    {
        $this->paid = !Arr::has($this->validated, 'discount_type') ? $this->total : round(($this->total-$this->discount),2);
    }
    private function updateEnterntainmentObjectsActive()
    {
        $mapModelToIds = [];
        $this->invoice->timerItems->pluck('item')->each(function($item) use(&$mapModelToIds){
            $mapModelToIds[$item::class][] = $item->id;
        });
        foreach($mapModelToIds as $model => $ids)
        {
            $model::whereIn('id', $ids)->update(['active' => false]);
        }
    }

    private function updateInvoice()
    {
        $this->invoice->update([
            'status'            =>  InvoiceStatusEnum::paid()->value,
            'subtotal'          =>  $this->total,
            'discount_value'    =>  data_get($this->validated,'discount_value', "0.00"),
            'discount_type'     =>  data_get($this->validated,'discount_type'),
            'total'             =>  $this->total,
            'paid'              =>  $this->paid,
            'closed_by'         =>  auth()->id(),
            'due_date'          =>  now()
        ]);
    }

}
