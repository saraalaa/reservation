<td class="text-center">

    @if(\App\Models\Reservation::hasReservation($doctor->profileDoctor->id))

        <div class="btn btn-dark btn-xs" ><i class="fa fa-check"></i> reserved</div>

    @else

        <a href="{{url($doctor->id.'/reservations/create')}}"
           class="btn btn-dark btn-xs" ><i class="fa fa-handshake-o"></i>
        </a>

    @endif
</td>