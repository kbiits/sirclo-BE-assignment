<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Berat</title>

    <link rel="stylesheet" href="{{ asset('form.css') }}">
</head>

<body>

    <div class="login-box">
        @if($type == 'create')
            <h2>Tambah Berat Badan</h2>
        @else
            <h2>Edit Berat Badan</h2>
        @endif
        <form
            action="{{ $type == 'create' ? route('berat.store') : route('berat.update', $dataBerat->id) }}"
            method="POST">
            @if($type == 'edit')
                @method('PUT')
            @endif
            @csrf

            @if($msg = session()->get('msg'))
                <div>
                    <span style="font-size: 1rem;" class="error-msg">{{ $msg }}</span>
                </div>
            @endif

            <div>
                <div class="user-box">
                    <input required class="always-focus"
                        value="{{ $type == 'create' ? old('date') : $dataBerat->date }}"
                        type="date" name="date">
                    <label>Tanggal</label>
                </div>

                @error('date')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <div class="user-box">
                    <input required
                        value="{{ $type == 'create' ? old('max_weight') : $dataBerat->max_weight }}"
                        type="number" name="max_weight">
                    <label>Berat Maksimum</label>
                </div>
                @error('max_weight')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <div class="user-box">
                    <input required
                        value="{{ $type == 'create' ? old('min_weight') : $dataBerat->min_weight }}"
                        type="number" name="min_weight">
                    <label>Berat Minimum</label>
                </div>
                @error('min_weight')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <button
                type="submit">{{ $type == 'create' ? 'Tambah' : 'Edit' }}</button>
        </form>
    </div>

</body>

</html>