<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'invoice_number' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required',
            'currency' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'amount_commission' => 'required',
            'discount' => 'required',
            'tax_id' => 'required',
            'value_vat' => 'required',
            'amount' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'client_id' => 'اسم العميل',
            'invoice_number' => 'رقم الفاتورة',
            'invoice_date' => 'تاريخ الفاتورة',
            'due_date' => 'تاريخ الاستحقاق',
            'status' => 'الحالة',
            'currency' => 'العملة',
            'product_id' => 'اسم المنتج',
            'quantity' => 'الكمية',
            'unit_price' => 'سعر ',
            'amount_commission' => 'مبلغ العمولة',
            'discount' => 'الخصم',
            'tax_id' => 'قيمة الضربية',
            'value_vat' => 'مبلغ العمولة',
            'amount' => 'المبلغ',
            'photo' => 'صورة العميل',
        ];
    }
}