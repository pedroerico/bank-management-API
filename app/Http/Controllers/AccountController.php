<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $accountService,
    ) {
    }

    public function consult(Request $request): Response
    {
        try {
            $account = $this->accountService->consult((int)($request->input('id')));
            return response(new AccountResource($account), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Erro ao consultar conta : ' . $e->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}