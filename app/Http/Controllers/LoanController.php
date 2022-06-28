<?php

namespace App\Http\Controllers;

use App\Helpers\StatusReturn;
use App\Http\Requests\{LoanRequest, LoanStatusRequest};
use App\Services\LoanService;
use Exception;

class LoanController extends Controller
{
    public function __construct(private LoanService $service) {}

    public function create(LoanRequest $request)
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

    public function changeStatus(LoanStatusRequest $request, int $id)
    {
        try {
            return response(
                array_merge(
                    ['data' => $this->service->changeStatus($request->all(), $id)],
                    ['status' => StatusReturn::SUCCESS]
                ),
                StatusReturn::SUCCESS
            );
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }
}
