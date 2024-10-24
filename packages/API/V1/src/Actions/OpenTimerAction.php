<?php

namespace Loctour\API\V1\Actions;

use App\Domain\Finance\Models\Invoice;
use App\Domain\Finance\Models\InvoiceTimerItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OpenTimerAction
{
    private $entertainmentObject;
    public function __construct(private array $validated, private Invoice $invoice) {}

    public function execute() : InvoiceTimerItem
    {
        return DB::transaction(function(){
            $this->entertainmentObject = ($this->validated['item_type'])::lockForUpdate()->find($this->validated['item_id']);
            $timer = $this->isTimerSpecified() ?
                    $this->createTimerWithEndTime($this->invoice)
                    : $this->createOpenTimer($this->invoice);

            $this->entertainmentObject->updateQuietly(['active' => true]);
            $timer->load(['item']);
            return $timer;
        });

    }

    private function isTimerSpecified()
    {
        return \Arr::has($this->validated, 'end_time');
    }

    private function createTimerWithEndTime(): Model
    {
        $startTime = now();
        return $this->invoice->timerItems()->create([
                    'start_time' => $startTime,
                    'end_time' => $this->validated['end_time'],
                    'cost' => $this->calculateCost($startTime),
                    'active'    =>  true
                ] + $this->validated);
    }

    private function createOpenTimer(): Model
    {
        return $this->invoice->timerItems()->create([
                'start_time'    =>  now(),
                'active'        =>  true,
                'cost'          =>  0
            ] + $this->validated);
    }

    private function calculateCost($startTime)
    {
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->validated['end_time']);
        return $this->entertainmentObject->calculateCost($startTime, $endTime, $this->validated['timer_type'] . '_price');
    }
}
