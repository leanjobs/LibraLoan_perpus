<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="">
        @php
            $hasKerusakan = $peminjaman->contains('status', 2);
        @endphp
        <h3 class="text-center">Laporan Transaksi Peminjaman</h3>
        @if ($status == 1)
            <p class="text-center mb-0">Status : waiting</p>
        @elseif($status == 2)
            <p class="text-center mb-0">Status : sedang dipinjam</p>
        @elseif($status == 3)
            <p class="text-center mb-0">Status : selesai dipinjam</p>
        @elseif($status == 4)
            <p class="text-center mb-0">Status : denda</p>
        @elseif($status == 5)
            <p class="text-center mb-0">Status : tolak</p>
        @else
            <p class="text-center mb-0">Status : semua</p>
        @endif

        <p class="text-center mb-0">Start Date : {{ $tgl_awal }}</p>
        <p class="text-center">End Date : {{ $tgl_akhir }}</p>

        <table class="table" style="border: solid 2px black">
            <thead class="table-light" style="padding: 5px">
                <tr>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        No</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        kode pinjam</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        Judul</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        peminjam id</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        tanggal pinjam</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        tenggat</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        tanggal pengembalian</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        denda</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        Status</th>
                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7"
                        style="border: solid 2px black">
                        Kondisi</th>

                </tr>

            </thead>
            <tbody>
                @foreach ($peminjaman as $item)
                    <tr style="border: solid 2px black">
                        <td style="border: solid 2px black">
                            <p class="text-xs text-secondary mb-0 ps-3">{{ $loop->iteration }}</p>
                        </td>

                        <td style="border: solid 2px black">
                            <p class="text-xs text-secondary mb-0 ps-3">{{ $item->kode_pinjam }}</p>
                        </td>
                        <td style="border: solid 2px black">
                            @foreach ($item->detail_peminjaman as $buku)
                                @if ($buku->buku)
                                    <p class="text-xs text-secondary mb-0 lis-3">
                                        {{ $buku->buku->judul }}
                                    </p>
                                @endif
                            @endforeach


                        </td>
                        <td style="border: solid 2px black">
                            <p class="text-xs text-secondary mb-0 ps-3">{{ $item->user->name }}
                            </p>
                        </td>
                        <td style="border: solid 2px black">
                            <p class="text-xs text-secondary mb-0 ps-3">{{ $item->tanggal_pinjam }}
                            </p>
                        </td>
                        <td style="border: solid 2px black">
                            <p class="text-xs text-secondary mb-0 ps-3">
                                {{ $item->tanggal_kembali }}
                            </p>
                        </td>


                        <td style="border: solid 2px black">
                            @if ($item->tanggal_pengembalian > $item->tanggal_kembali)
                                <p class="text-xs text-danger mb-0 ps-3">
                                    {{ $item->tanggal_pengembalian }}
                                </p>
                            @else
                                <p class="text-xs text-secondary mb-0 ps-3">
                                    {{ $item->tanggal_pengembalian }}
                                </p>
                            @endif
                        </td>
                        <td style="border: solid 2px black">
                            <p class="text-xs text-secondary mb-0 ps-3">Rp.
                                {{ $item->denda >= 0 ? number_format($item->denda) : '-' }}</p>
                        </td>
                        <td style="border: solid 2px black">
                            @if ($item->status == 1)
                                <p>belum dipinjam</p>
                            @elseif ($item->status == 2)
                                <p>sedang dipinjam</p>
                            @elseif ($item->status == 3)
                                <p>selesai dipinjam</p>
                            @elseif ($item->status == 5)
                                <p>ditolak</p>
                            @else
                                <p>denda</p>
                            @endif
                        </td>


                        <td class="d-flex" style="border: 0">
                            @if ($item->status == 4)
                                <p class="text-xs text-secondary">{{ $item->kondisi }}
                                </p>
                            @else
                                <p class="text-xs text-secondary">normal
                                </p>
                            @endif

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
