<div class="card mt-4">
    <div class="card-header">Done Reservations</div>
    <div class="card-body">
        @if(count($done_reservations))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>email</th>
                        <th>created at</th>
                        <th class="text-center">accepted / rejected</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($done_reservations as $done_reservation)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$done_reservation->user->name}} </td>
                            <td> {{$done_reservation->user->email}} </td>
                            <td> {{date('d-m-Y', strtotime($done_reservation->created_at))}} </td>
                            <td class="text-center">
                                @if($done_reservation->status =='accepted')
                                    <span><i class="fa fa-check"> </i> accepted</span>
                                @else
                                    <span><i class="fa fa-close"> </i> rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="">{{ $done_reservations->links() }}</div>
            </div>
        @else
            no done reservations for you
        @endif
    </div>
</div>
