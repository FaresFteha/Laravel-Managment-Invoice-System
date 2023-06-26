<div class="modal fade" id="change-status-modal{{ $items->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">تعديل حالة الفاتورة
                    </h4>
                </div>
                <div class="p-4 pb-0">
                    <form action="{{ route('invoicesstatus.store') }}" method="POST" class="row">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $items->id }}">
                        <div class="col-md-6">
                            <label class="form-label" for="status">الحالة</label>
                            <select class="form-select js-choice" id="status" name="status"
                                class="@error('status') is-invalid @enderror" value="{{ old('status') }}">
                                <option value="{{ $items->status }}" selected disabled>{{ $items->status }}</option>
                                <option value="تحت المعالجة">تحت المعالجة</option>
                                <option value="قبول">قبول</option>
                                <option value="مرفوض">مرفوض</option>
                                <option value="ألغيت">ألغيت</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                            <button class="btn btn-danger" type="submit">حذف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
