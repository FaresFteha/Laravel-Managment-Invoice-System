<div class="modal fade" id="delete-modal{{$items->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">حذف فئة
                    </h4>
                </div>
                <div class="p-4 pb-0">
                    <form method="POST" action="{{ route('categories.destroy' , 'test') }}">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <input type="hidden" id="id" name="id" value="{{ $items->id }}"/>
                        </div>
                        <h5 style="color: rgb(233, 0, 0)">هل انت متاكد من هذه العملية؟</h5>
                        <div class="mb-3">
                            <input class="form-control" type="text" id="name" name="name" value="{{ $items->name }}" readonly/>
                        </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                <button class="btn btn-danger" type="submit">حذف</button>
            </div>
        </form>
        </div>
    </div>
</div>
