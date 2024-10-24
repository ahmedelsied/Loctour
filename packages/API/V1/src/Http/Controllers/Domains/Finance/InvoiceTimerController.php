<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Finance;

use App\Domain\Finance\Models\Invoice;
use App\Domain\Finance\Models\InvoiceTimerItem;
use Illuminate\Support\Facades\DB;
use Loctour\API\V1\Actions\OpenTimerAction;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Invoices\OpenInvoiceTimerRequest;
use Loctour\API\V1\Resources\Invoices\InvoiceTimerItemResource;

class InvoiceTimerController extends APIController
{
    public function openTimer(OpenInvoiceTimerRequest $request, Invoice $invoice)
    {
        $timer = app(OpenTimerAction::class, ['validated' => $request->validated(), 'invoice' => $invoice])->execute();
        return $this->success(new InvoiceTimerItemResource($timer));
    }

    public function closeTimer($invoice, InvoiceTimerItem $invoiceTimerItem)
    {
        DB::transaction(function () use ($invoiceTimerItem){
            if($invoiceTimerItem->active){
                $endTime = now();
                $invoiceTimerItem->update([
                    'end_time'  =>  $endTime,
                    'cost'      =>  $invoiceTimerItem->item->calculateCost($invoiceTimerItem->start_time, $endTime, $invoiceTimerItem->timer_type . '_price'),
                    'active'    =>  false
                ]);
                $invoiceTimerItem->item->updateQuietly(['active' => false]);
            }
        });
        return $this->success(new InvoiceTimerItemResource($invoiceTimerItem));
    }

}
