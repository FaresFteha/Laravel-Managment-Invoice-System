<div class="modal fade" id="delete-modal{{ $items->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">حذف الدفعة
                    </h4>
                </div>
                <div class="p-4 pb-0">
                    <form method="POST" action="{{ route('payment.destroy', 'test') }}">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <input type="hidden" id="id" name="id" value="{{ $items->id }}" />
                        </div>

                        <div class="mb-3">
                            <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $items->invoice->id }}" />
                        </div>

                        <input type="hidden" id="remaining_amount" name="remaining_amount"
                            value="{{ $items->invoice->remaining_amount }}">

                        <input type="hidden" id="payment_amount" name="payment_amount"
                            value="{{ $items->payment_amount }}">

                        <h5 style="color: rgb(233, 0, 0)">هل انت متاكد من هذه العملية؟</h5>
                        <div class="mb-3">
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ $items->invoice->invoice_number }}" readonly />
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
