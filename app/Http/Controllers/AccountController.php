<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Accounts\CreateAccountDTO;
use App\Exceptions\AccountException;
use App\Http\Requests\CreateAccountRequest;
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
        $account = $this->accountService->consult((int)($request->input('id')));
        return response(new AccountResource($account), Response::HTTP_OK);
    }

    public function store(CreateAccountRequest $request): Response
    {
        $account = $this->accountService->create(CreateAccountDTO::makeFromRequest($request));
        return response(new AccountResource($account), Response::HTTP_CREATED);
    }
}
