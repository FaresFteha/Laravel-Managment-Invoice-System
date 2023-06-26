<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">اضافة ضريبة جديدة
                    </h4>
                </div>
                <div class="p-4 pb-0">
                    <form method="POST" action="{{ route('taxes.store') }}">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ old('name') }}" placeholder="اسم الضربية" />
                        </div>
                        <div class="row mb-3">
                            <input class="form-control" id="value" name="value" type="number"
                                value="{{ old('value') }}" placeholder="قيمة الضربية" />
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">الاغلاق</button>
                <button class="btn btn-primary" type="submit">اضافة</button>
            </div>
            </form>
        </div>
    </div>
</div>
