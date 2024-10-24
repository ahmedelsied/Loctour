<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Finance;

use App\Domain\Finance\Models\Invoice;
use App\Domain\Finance\Models\RecentlyUsedStock;
use Loctour\API\V1\Actions\CloseInvoiceAction;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\Invoices\CloseInvoiceRequest;
use Loctour\API\V1\Http\Requests\Invoices\FilterInvoiceRequest;
use Loctour\API\V1\Http\Requests\Invoices\InvoiceRequest;
use Loctour\API\V1\Repositories\InvoiceFilterRepository;
use Loctour\API\V1\Resources\Invoices\InvoiceResource;
use Loctour\API\V1\Resources\StockResource;

class InvoiceController extends APIController
{
    public function index(FilterInvoiceRequest $request)
    {
        $recentlyUsedStocks = RecentlyUsedStock::lastUsed()
                                               ->get()
                                               ->pluck('stock')
                                               ->all();

        $filtered = app(InvoiceFilterRepository::class, [
            'builder' => Invoice::latest(),
            'validated' => $request->validated()
        ])->execute();
        return $this->success(InvoiceResource::paginate($filtered->invoices->paginate()), 200, [
            'recently_used_stocks' => StockResource::collection($recentlyUsedStocks),
            'revenue' => $filtered->revenue,
        ]);
    }

    public function store(InvoiceRequest $request)
    {
        $tenantName = \Str::of(tenant()->name)->slug('-')->upper();
        $invoice = Invoice::create($request->validated() + [
                'created_by' => auth()->id(),
                'ref' => $tenantName.'-INV-'.time().rand(1000, 9999)
            ]);
        return $this->success(new InvoiceResource($invoice->fresh()));
    }

    public function show(Invoice $invoice)
    {
        return $this->success(new InvoiceResource($invoice));
    }

    public function destroy(Invoice $invoice)
    {
        if($invoice->stockItems()->exists() || $invoice->timerItems()->exists()){
            return $this->error(__('Action cannot proceed: invoice contains stocks or timers.'), 422);
        }
        $invoice->delete();
        return $this->executed();
    }

    public function close(CloseInvoiceRequest $request, Invoice $invoice)
    {
        $invoice = app(CloseInvoiceAction::class, [
            'validated' => $request->validated(),
            'invoice'   => $invoice
        ])->execute();
        return $this->success(new InvoiceResource($invoice));
    }
}
