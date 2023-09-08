<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Transactions\RequestTransactionDTO;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Resources\AccountResource;
use App\Services\TransactionService;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
    ) {
    }

    public function create(CreateTransactionRequest $request): Response
    {
        try {
            $transaction = $this->transactionService->create(RequestTransactionDTO::makeFromRequest($request));
            return response(new AccountResource($transaction->account), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Erro ao criar transação: ' . $e->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
