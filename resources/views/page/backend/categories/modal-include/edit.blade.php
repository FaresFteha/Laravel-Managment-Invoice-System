<div class="modal fade" id="edit-modal{{ $items->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">تعديل فئة
                    </h4>
                </div>
                <div class="p-4 pb-0">
                    <form method="POST" action="{{ route('categories.update', 'test') }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <input type="hidden" name="id" id="id" value="{{ $items->id }}" />
                        </div>

                        <div class="row mb-3">
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ old('icone', $items->name) }}" placeholder="name" />
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                <button class="btn btn-primary" type="submit">تحديث البيانات</button>
            </div>
            </form>
        </div>
    </div>
</div>
