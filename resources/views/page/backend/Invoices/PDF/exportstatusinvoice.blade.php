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
            <th class="align-middle">الحالة</th>
            <th class="align-middle">تاريخ الحالة بالايام</th>
            <th class="align-middle">تاريخ الحالة</th>
            <th class="align-middle">مغير الحالة</th>
        </tr>
        <tr>
            @forelse ($data as $items)
        <tr>

            <th class="align-middle">{{ $loop->index + 1 }}</th>
            <th class="align-middle">{{ $items->invoices->invoice_number }}<br>
            </th>
            <!-- Start Status value  -->
            @if ($items->value_status == 1)
                <th class="align-middle"><span class="badge bg-warning">تحت
                        المعالجة</span></th>
            @elseif ($items->value_status == 2)
                <th class="align-middle"><span class="badge badge-danger">غير
                        مدفوع</span></th>
            @elseif ($items->value_status == 3)
                <th class="align-middle"><span class="badge badge-success">مدفوع</span>
                </th>
            @elseif ($items->value_status == 4)
                <th class="align-middle"><span class="badge badge-primary">مدفوع
                        جزئياً</span></th>
            @elseif ($items->value_status == 5)
                <th class="align-middle"><span class="badge badge-danger">متاخر</span>
                </th>
            @elseif ($items->value_status == 6)
                <th class="align-middle"><span class="badge bg-dark dark__bg-dark">مرفوض</span></th>
            @elseif ($items->value_status == 7)
                <th class="align-middle"><span class="badge bg-secondary">ألغيت</span>
                </th>
            @elseif ($items->value_status == 8)
                <th class="align-middle"><span class="badge bg-info">قبول</span>
                </th>
            @endif
            <!-- End Status value  -->
            <th class="align-middle">{{ $items->created_at->diffForHumans() }}</th>
            <th class="align-middle">{{ $items->created_at->format('Y-m-d') }}</th>
            <th class="align-middle">{{ $items->created_by }}</th>



        </tr>
    @empty
        @endforelse
    </table>
</body>

</html>
