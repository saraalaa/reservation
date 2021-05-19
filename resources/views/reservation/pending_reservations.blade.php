<div class="card">
    <div class="card-header">Pending Reservations</div>
    <div class="card-body">
        @if(count($pending_reservations))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>email</th>
                        <th>created at</th>
                        <th class="text-center">approve</th>
                        <th class="text-center">reject</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pending_reservations as $pending_reservation)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$pending_reservation->user->name}}</td>
                            <td>{{$pending_reservation->user->email}}</td>
                            <td>{{date('d-m-Y', strtotime($pending_reservation->created_at))}}</td>

                            <td class="text-center">
                                <a href="{{url('/doctor-reservations/accept/'.$pending_reservation->id)}}"
                                   class="btn btn-dark btn-xs" ><i class="fa fa-check"> </i> accept</a>
                            </td>
                            <td class="text-center">
                                <a href="{{url('/doctor-reservations/reject/'.$pending_reservation->id)}}"
                                   class="btn btn-danger btn-xs" ><i class="fa fa-close"> </i> reject</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="">{{ $pending_reservations->links() }}</div>
            </div>
        @else
            no pending reservations for you
        @endif
    </div>
</div>
