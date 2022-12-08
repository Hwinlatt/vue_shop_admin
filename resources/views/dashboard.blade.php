@extends('admin.app')
@section('contact')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Sale</p>
                    <h6 class="mb-0">{{ $today_sale_price }} MMK</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Sale Order</p>
                    <h6 class="mb-0">{{ $today_sale_order }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('member#order') }}?status=pending">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa-solid fa-clipboard-list fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">New Orders</p>
                        <h6 class="mb-0">{{ $p_order }}</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('member#order') }}?status=delivered">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa-solid fa-truck fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-secondary">Delivered Order</p>
                        <h6 class="mb-0">{{ $deli_order }}</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
