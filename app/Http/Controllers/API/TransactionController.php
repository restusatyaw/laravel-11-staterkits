<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    private $transactionService;

    function __construct(TransactionService $transactionService) {
        $this->transactionService = $transactionService;
    }

    function store(Request $request) {
        try {
            $formdata = $request->all();
            $formdata['user_id'] = auth()->user()->id;
            $data = $this->transactionService->create($formdata);
            return $this->responseJson(200, true, 'Pembayaran berhasil dibuat!', $data);
        } catch (\Throwable $th) {
            return $this->responseJson(500, false, 'Gagal Melakukan Pembayaran !', null);
        }
    }
    function updatePaymentStatus(Request $request, $id) {
        try {
            $formdata = $request->all();
            $formdata['status'] = 'proccessing';
            $data = $this->transactionService->update($id, $formdata);
            return $this->responseJson(200, true, 'Pembayaran berhasil diupload, mohon tunggu konfirmasi dari admin!', $data);
        } catch (\Throwable $th) {
            return $this->responseJson(500, false, 'Gagal konfirmasi pembayaran !', null);
        }
    }
}
