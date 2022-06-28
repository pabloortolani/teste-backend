<?php

namespace App\Http\Controllers;

use App\Helpers\StatusReturn;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use Exception;

class BookController extends Controller
{
    public function __construct(private BookService $service) {}

    public function store(BookRequest $request)
    {
        try {
            return response(
                array_merge(
                    ['data' => $this->service->create($request->all())],
                    ['status' => StatusReturn::CREATED]
                ),
                StatusReturn::CREATED
            );
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            return response(
                array_merge(
                    ['data' => $this->service->find($id)],
                    ['status' => StatusReturn::SUCCESS]
                ),
                StatusReturn::SUCCESS
            );
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    public function update(BookRequest $request, $id)
    {
        try {
            return response(
                array_merge(
                    ['data' => $this->service->update($request->all(), $id)],
                    ['status' => StatusReturn::SUCCESS]
                ),
                StatusReturn::SUCCESS
            );
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }


    public function destroy($id)
    {
        try {
            return response(
                array_merge(
                    ['data' => $this->service->destroy($id)],
                    ['status' => StatusReturn::SUCCESS]
                ),
                StatusReturn::SUCCESS
            );
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }
}
