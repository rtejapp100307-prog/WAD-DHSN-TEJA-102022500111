

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Data Kurir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="mainHeader">
    <h1>Pengelolaan Data Kurir</h1>
</header>

<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
             <a href="{{ route('kurir.create') }}" class="btn-tambah">
        + Tambah Data
    </a>
    
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Kurir</th>
                    <th>Nama Kurir</th>
                    <th>No. HP</th>
                    <th>Jasa Pengiriman</th>
                    <th>Jenis Layanan</th>
                    <th>Edit/Hapus Data</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kurirs as $kurir)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kurir->id_kurir }}</td>
                        <td>{{ $kurir->nama_kurir }}</td>
                        <td>{{ $kurir->no_hp }}</td>
                        <td>{{ $kurir->jasa_pengiriman }}</td>
                        <td>
                            @if ($kurir->jenis_layanan == 'Express')
                                <span class="badge bg-danger">Express</span>
                            @else
                                <span class="badge bg-info text-dark">Reguler</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('kurir.edit', $kurir->id_kurir) }}"
                               class="btn-edit">Edit</a>

                            <form action="{{ route('kurir.destroy', $kurir->id_kurir) }}"
                                  method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data kurir ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data kurir.
                        </td>
                    </tr>
                @endforelse

                <br>

       

            </tbody>
        </table>
    </div>
</div>

</body>
</html>
