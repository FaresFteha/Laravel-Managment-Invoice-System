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
    <h3 style="text-align:center">الفواتير المنشأة</h3>
    <table>
        <tr>
            <th scope="col">#</th>
            <th scope="col">رقم الفاتورة/العميل</th>
            <th scope="col">تاريخ الفاتورة</th>
            <th scope="col">تاريخ الاستحقاق</th>
            <th scope="col">السعر</th>
            <th scope="col">السعر النهائي</th>
            <th scope="col">الحالة</th>
        </tr>
        <tr>
            @foreach ($data as $item)
                <th>{{ $loop->iteration }}</th>
                <th>{{ $item->client->full_name }}<br>{{ $item->invoice_number }}
                </th>
                <th>{{ $item->invoice_date }}
                </th>
                <th>{{ $item->due_date }}</th>
                <th>${{ $item->unit_price }}</th>
                <th>${{ $item->amount }}</th>
                @if ($item->value_status == 1)
                    <th>تحت المعالجة</th>
                @elseif ($item->value_status == 2)
                    <th>غير مدفوع</th>
                @elseif ($item->value_status == 3)
                    <th>مدفوع
                    </th>
                @elseif ($item->value_status == 4)
                    <th>مدفوع
                        جزئياً</th>
                @elseif ($item->value_status == 5)
                    <th>متاخر
                    </th>
                @elseif ($item->value_status == 6)
                    <th>مرفوض</th>
                @elseif ($item->value_status == 7)
                    <th>ألغيت
                    </th>
                @elseif ($item->value_status == 8)
                    <th>قبول
                    </th>
                @endif
                <!-- End Status value  -->
            @endforeach
        </tr>
    </table>
</body>

</html>
