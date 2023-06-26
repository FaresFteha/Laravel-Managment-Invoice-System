<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>الفواتير</title>
    <style>
        body {
            font-family: 'almarai', sans-serif;
            direction: rtl;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h3 style="text-align:center">المدفوعات</h3>
    <table>
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">رقم الفاتورة</th>
            <th class="align-middle">المبلغ الاساسي</th>
            <th class="align-middle">المبلغ المدفوع</th>
            <th class="align-middle">المبلغ بعد الدفع</th>
            <th class="align-middle">نوع الدفع</th>
            <th class="align-middle">حالة الدفع</th>
            <th class="align-middle"> تاريخ الدفع</th>
            <th class="align-middle">المسؤول عن الدفع</th>
        </tr>
        <tr>
            @forelse ($payments as $items)
        <tr>
            <th class="align-middle">{{ $loop->index + 1 }}</th>
            <th class="align-middle">{{ $items->invoice->invoice_number }}</th>
            <th class="align-middle">${{ $items->amount }}</th>
            <th class="align-middle">${{ $items->payment_amount }}</span< /th>
            <th class="align-middle">${{ $items->payment_total }}</th>
            <th class="align-middle">{{ $items->payment_mode }}</th>
            <th class="align-middle">{{ $items->status }}</th>
            <th class="align-middle">{{ $items->payment_date }}</th>
            <th class="align-middle">{{ $items->created_by }}</th>
        @empty
        <tr>
            <td class="alert-danger text-center" colspan="8">لا يوجد بيانات في هذا
                الجدول
            </td>
        </tr>
        @endforelse
        </tr>
    </table>
</body>

</html>
