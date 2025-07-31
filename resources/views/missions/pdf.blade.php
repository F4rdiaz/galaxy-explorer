<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Misi Antariksa</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #eee; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>📄 Data Misi Antariksa</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Misi</th>
                <th>Tahun Peluncuran</th>
                <th>Tahun Kembali</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Astronot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($missions as $mission)
            <tr>
                <td>{{ $mission->nama_misi }}</td>
                <td>{{ $mission->tahun_peluncuran }}</td>
                <td>{{ $mission->tahun_kembali ?? '-' }}</td>
                <td>{{ $mission->tujuan }}</td>
                <td>{{ ucfirst($mission->status) }}</td>
                <td>
                     @foreach ($mission->astronot as $astronot)
                        {{ $astronot }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
