@extends('backoffice.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Donasi</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Kode</th>
                            <td>{{ $data->code }}</td>
                            <th>Metode Pembayaran</th>
                            <td>{{ ucfirst(str_replace('_', ' ', $data->payment_method)) }}</td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran</th>
                            <td>Rp {{ number_format($data->total_payment, 2, ',', '.') }}</td>
                            <th>Status</th>
                            <td>{{ ucfirst($data->status) }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembayaran</th>
                            <td>{{ $data->payment_date->format('d-m-Y H:i') }}</td>
                            <th>Bukti Pembayaran</th>
                            <td>
                                @if($data->receipt_payment)
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#receiptModal">Lihat Bukti</button>
                                @else
                                    <span class="text-muted">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@push('style')
<style>
    .table th {
        width: 25%;
    }
</style>
@endpush

@push('script')
<!-- Modal untuk bukti pembayaran -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset($data->receipt_payment) }}" alt="Bukti Pembayaran" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endpush
