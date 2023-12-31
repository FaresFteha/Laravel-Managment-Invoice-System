    <div class="modal fade" id="payment-modal{{ $items->id }}" data-bs-keyboard="false" data-bs-backdrop="static"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-6" role="document">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="bg-light rounded-top-lg py-3 ps-4 pe-6">
                        <h4 class="mb-1" id="staticBackdropLabel">دفع الفاتوة</h4>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('payment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $items->id }}">
                            <input type="hidden" id="client_id" name="client_id" value="{{ $items->client->id }}">
                            <input type="hidden" id="remaining_amount" name="remaining_amount" value="{{ $items->remaining_amount }}">
                            <div class="row">
                                @php
                                $Invoice = App\Models\Invoice::where('id', $items->id)
                                    ->latest()
                                    ->first();
                            @endphp
                                <div class="col">
                                    <label for="amount">المبلغ الاجمالي:</label>
                                    <input class="form-control" type="text" placeholder="المبلغ الاجمالي"
                                        id="amount" name="amount"
                                        value="{{ $Invoice->amount }}" readonly />
                                </div>
                                @php
                                    $Payment = App\Models\Payment::where('invoice_id', $items->id)
                                        ->latest()
                                        ->first();
                                @endphp
                                <div class="col">
                                    <label for="payment_total">المبلغ بعد الدفع:</label>
                                    <input class="form-control" type="text" id="payment_total" name="payment_total"
                                        placeholder="اجمالي الدفعات" readonly
                                        value="{{ $Payment->payment_total ?? 0 }}" />
                                </div>

                                <div class="col">
                                    <label for="payment_amount">المبلغ:</label>
                                    <input class="form-control" type="text" placeholder="المبلغ" id="payment_amount"
                                        name="payment_amount" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="payment_date">تاريخ الدفع:</label>
                                    <input class="form-control datetimepicker" id="datepicker" type="text"
                                        data-options='{"disableMobile":true}' name="payment_date"
                                        value="{{ now()->format('Y-m-d') }}" readonly />
                                </div>

                                <div class="col">
                                    <label for="payment_mode">طريقة الدفع:</label>
                                    <input class="form-control" type="text" id="payment_mode" name="payment_mode"
                                        placeholder="طريقة الدفع" value="كاش" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="status">الحالة</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="غير مدفوعة">غير مدفوعة</option>
                                        <option value="مدفوع">مدفوع</option>
                                        <option value="مدفوع جزئياً">مدفوع جزئياً</option>
                                        <option value="متأخر">متأخر</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                                <button class="btn btn-primary" type="submit">دفع</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
