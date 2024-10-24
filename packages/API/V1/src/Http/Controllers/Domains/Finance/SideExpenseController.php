<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Finance;

use App\Domain\Finance\Models\SideExpense;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\SideExpenseRequest;
use Loctour\API\V1\Resources\SideExpenseResource;

class SideExpenseController extends APIController
{
    public function index()
    {
        return $this->success(SideExpenseResource::paginate(SideExpense::paginate(20)),200,[
            'total' =>  (int) SideExpense::sum('price')
        ]);
    }

    public function store(SideExpenseRequest $request)
    {
        $sideExpense = SideExpense::create($request->validated());
        return $this->success(new SideExpenseResource($sideExpense));
    }

    public function destroy(SideExpense $sideExpense)
    {
        $sideExpense->delete();
        return $this->executed();
    }
}
