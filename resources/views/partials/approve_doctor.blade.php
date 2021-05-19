<td class="text-center">
    @if($doctor->profileDoctor->is_approved)
        <a href="doctors/{{$doctor->id}}/reject" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> reject</a>
    @else
        <a href="doctors/{{$doctor->id}}/approve" class="btn btn-xs btn-dark"><i class="fa fa-check"></i> approve</a>
    @endif
</td>