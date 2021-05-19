<div class="card mt-4">
    <div class="card-header">{{ $card_header }}</div>
    <div class="card-body">
        @if(count($reservations))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>doctor name</th>
                        <th>doctor speciality</th>
                        <th>user name</th>
                        <th>fees</th>
                        <th>created at</th>
                        @if(!$pending)
                            <th class="text-center">accepted / rejected</th>
                        @endif

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$reservation->profileDoctor->user->name}} </td>
                            <td> {{$reservation->profileDoctor->speciality}} </td>
                            <td> {{$reservation->user->name}} </td>
                            <td> {{$reservation->profileDoctor->fees}} </td>
                            <td> {{date('d-m-Y', strtotime($reservation->created_at))}} </td>
                            @if(!$pending)
                                <td class="text-center">
                                    @if($reservation->status =='accepted')
                                        <span><i class="fa fa-check"> </i> accepted</span>
                                    @else
                                        <span><i class="fa fa-close"> </i> rejected</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="">{{ $reservations->links() }}</div>
            </div>
        @else
            No {{ $card_header }}
        @endif
    </div>
</div>
