<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Berat</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('table.css') }}">
</head>

<body>


    @if($type == 'index')
        <a href="{{ route('berat.create') }}" class="btn-create">
            <button class="button-9" role="button">Tambah data berat</button>
        </a>
    @endif

    @if($msg = session()->get('msg'))
        <div>
            <span style="font-size: 1rem; margin: 20px auto;" class="error-msg">{{ $msg }}</span>
        </div>
    @endif

    @php
        if ($type == 'index') {
            $tableMap = ['Tanggal', 'Max', 'Min', 'Perbedaan', 'Aksi'];
        } else {
            $tableMap = ['Tanggal', $dataBerat->date];
            $tableData = [
                'Max' => $dataBerat->max_weight,
                'Min' => $dataBerat->min_weight,
                'Perbedaan' => $dataBerat->max_weight - $dataBerat->min_weight,
            ];
        }
        $totalMax = 0;
        $totalMin = 0;
        $totalDiff = 0;
        // I save this to variable for memoization, so we shouldn't compute it more than 1 times
        $count = $dataBerat->count();
    @endphp

    <table class="styled-table">
        <thead>
            @foreach($tableMap as $header)
                <th>{{ $header }}</th>
            @endforeach
        </thead>
        <tbody>
            @if($type == 'index')
                @foreach($dataBerat as $row)
                @php
                    $maxWeight = $row->max_weight;
                    $minWeight = $row->min_weight;
                    $diff = $maxWeight - $minWeight;
                    $totalMax += $maxWeight;
                    $totalMin += $minWeight;
                    $totalDiff += $diff;
                @endphp
                    <tr onmouseover="setRowClass(event, true)" onmouseout="setRowClass(event, false)">
                        <td>{{ $row->date }}</td>
                        <td>{{ $maxWeight }}</td>
                        <td>{{ $minWeight }}</td>
                        <td>{{ $diff }}</td>
                        <td>
                            <span>
                                <a href="{{ route('berat.show', $row->id) }}">
                                    <button>
                                        Detail
                                    </button>
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('berat.edit', $row->id) }}">
                                    <button>
                                        Edit
                                    </button>
                                </a>
                            </span>
                            <span>
                                <form style="display: inline;"
                                    action="{{ route('berat.delete', $row->id) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">
                                        Delete
                                    </button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
                <tr style="font-weight: bold;">
                    <td>Rata-rata</td>
                    <td>{{ round($totalMax / $count, 2) }}</td>
                    <td>{{ round($totalMin / $count, 2) }}</td>
                    <td>{{ round($totalDiff / $count, 2) }}</td>
                    <td></td>
                </tr>
            @else
                @foreach($tableData as $col => $val)
                    <tr>
                        <td>{{ $col }}</td>
                        <td>{{ $val }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <script>
        function setRowClass(e, isActive) {
            const rowElement = e.target.parentElement;
            if (!rowElement) {
                return;
            }
            if (isActive) {
                rowElement.classList.add('active-row');
            } else {
                rowElement.classList.remove('active-row');
            }
        }
    </script>

</body>

</html>