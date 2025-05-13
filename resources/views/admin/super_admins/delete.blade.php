<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">الغاء</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h2 class="swal2-title" id="swal2-title" style="display: flex;">  هل انت متاكد من الالغاء </h2>
        <div class="modal-footer" >
            <form  action="{{ route('admin.super_admins.destroy' , $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-primary" data-dismiss="modal">لا</button>
                <button type="submit" class="btn btn-danger">نعم</button>
            </form>
        </div>
    </div>
    </div>
</div>
