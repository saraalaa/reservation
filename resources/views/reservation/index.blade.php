@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('reservation.index_reservations',[
                'card_header' => 'Done Reservations',
                'reservations' => $done_reservations,
                'pending' => false
                ])

                @include('reservation.index_reservations',[
                'card_header' => 'Not Done Reservations',
                'reservations' => $pending_reservations,
                'pending' => true
                ])

                <div style="width:75%;">
                    <canvas id="canvas"></canvas>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/reservation.chart.js') }}"></script>
@endpush