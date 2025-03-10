@extends('backoffice.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-stats">
          <div class="card-stats-title"> Statistik Pemberian Zakat - Februari
            {{-- <div class="dropdown d-inline">
              <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
              <ul class="dropdown-menu dropdown-menu-sm">
                <li class="dropdown-title">Select Month</li>
                <li><a href="#" class="dropdown-item">January</a></li>
                <li><a href="#" class="dropdown-item">February</a></li>
                <li><a href="#" class="dropdown-item">March</a></li>
                <li><a href="#" class="dropdown-item">April</a></li>
                <li><a href="#" class="dropdown-item">May</a></li>
                <li><a href="#" class="dropdown-item">June</a></li>
                <li><a href="#" class="dropdown-item">July</a></li>
                <li><a href="#" class="dropdown-item active">August</a></li>
                <li><a href="#" class="dropdown-item">September</a></li>
                <li><a href="#" class="dropdown-item">October</a></li>
                <li><a href="#" class="dropdown-item">November</a></li>
                <li><a href="#" class="dropdown-item">December</a></li>
              </ul>
            </div> --}}
          </div>
          <div class="card-stats-items">
            <div class="card-stats-item">
              <div class="card-stats-item-count">{{$datas->where('status','pending')->count()}}</div>
              <div class="card-stats-item-label">Menunggu Pembayaran</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">{{$datas->where('status','completed')->count()}}</div>
              <div class="card-stats-item-label">Pembayaran Diterima</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">{{$datas->where('status','proccessing')->count()}}</div>
              <div class="card-stats-item-label">Proses Pembayaran</div>
            </div>
          </div>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Transaksi Pembayaran</h4>
          </div>
          <div class="card-body">
            {{$datas->count()}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-chart">
          <canvas id="balance-chart" height="80"></canvas>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Penerimaan Zakat</h4>
          </div>
          <div class="card-body">
            @include('backoffice.components.customField',[
              'currency' => $datas->where('status','completed')->sum('total_payment')
            ])
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-chart">
          <canvas id="sales-chart" height="80"></canvas>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Yang Masih Di Proses</h4>
          </div>
          <div class="card-body">
            @include('backoffice.components.customField',[
              'currency' => $datas->whereNotIn('status', ['completed', 'expired', 'canceled'])->sum('total_payment')
            ])
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h4>Budget vs Sales</h4>
        </div>
        <div class="card-body">
          <canvas id="myChart" height="158"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card gradient-bottom">
        <div class="card-header">
          <h4>Jenis Pembayaran Zakat Terbanyak</h4>
          <div class="card-header-action dropdown">
            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
              <li class="dropdown-title">Select Period</li>
              <li><a href="#" class="dropdown-item">Today</a></li>
              <li><a href="#" class="dropdown-item">Week</a></li>
              <li><a href="#" class="dropdown-item active">Month</a></li>
              <li><a href="#" class="dropdown-item">This Year</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body" id="top-5-scroll">
          <ul class="list-unstyled list-unstyled-border">
            @foreach ($nomination_donation as $data)
                @php
                    $totalPayment = $data['total'];
                    
                    // Menghindari pembagian dengan nol
                    $pendingPercentage = $totalPayment > 0 ? ($data['payment_pending'] / $totalPayment) * 100 : 0;
                    $processingPercentage = $totalPayment > 0 ? ($data['payment_proccessing'] / $totalPayment) * 100 : 0;
                    $completedPercentage = $totalPayment > 0 ? ($data['payment_completed'] / $totalPayment) * 100 : 0;
                @endphp
        
                <li class="media">
                    <div class="media-body">
                        <div class="float-right">
                            <div class="font-weight-600 text-muted text-small">{{ number_format($totalPayment) }} Total</div>
                        </div>
                        <div class="media-title">{{ $data['name'] }}</div>
                        <div class="mt-1">
                            <div class="budget-price">
                                <div class="budget-price-square bg-primary" data-width="{{ round($pendingPercentage) }}%"></div>
                                <div class="budget-price-label">Pending: {{ number_format($data['payment_pending']) }}</div>
                            </div>
                            <div class="budget-price">
                                <div class="budget-price-square bg-warning" data-width="{{ round($processingPercentage) }}%"></div>
                                <div class="budget-price-label">Processing: {{ number_format($data['payment_proccessing']) }}</div>
                            </div>
                            <div class="budget-price">
                                <div class="budget-price-square bg-success" data-width="{{ round($completedPercentage) }}%"></div>
                                <div class="budget-price-label">Completed: {{ number_format($data['payment_completed']) }}</div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        </div>
        <div class="card-footer pt-3 d-flex justify-content-center">
          <div class="budget-price justify-content-center">
            <div class="budget-price-square bg-primary" data-width="20"></div>
            <div class="budget-price-label">Pending</div>
          </div>
          <div class="budget-price justify-content-center">
            <div class="budget-price-square bg-danger" data-width="20"></div>
            <div class="budget-price-label">Prosesing</div>
          </div>
          <div class="budget-price justify-content-center">
            <div class="budget-price-square bg-success" data-width="20"></div>
            <div class="budget-price-label">Completed</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection