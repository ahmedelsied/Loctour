<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Entertainments;

use App\Domain\Entertainments\Models\Board;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\BoardRequest;
use Loctour\API\V1\Resources\BoardResource;

class BoardController extends APIController
{
    public function index()
    {
        return $this->success(BoardResource::paginate(Board::latest()->paginate(30)));
    }

    public function store(BoardRequest $request)
    {
        $board = Board::create($request->validated() + ['status' => true, 'active' => false]);
        return $this->success(new BoardResource($board));
    }

    public function update(Board $board, BoardRequest $request)
    {
        $board->update($request->validated());
        return $this->success(new BoardResource($board));
    }

    public function destroy(Board $board)
    {
        $board->delete();
        return $this->executed();
    }
}
