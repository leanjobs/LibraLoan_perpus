<!-- Modal -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Print Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (count($peminjaman) > 0)
                    @php
                        $statusSemuaSama = true;
                        $statusPertama = $peminjaman[0]->status;

                        foreach ($peminjaman as $peminjamanItem) {
                            if ($peminjamanItem->status != $statusPertama) {
                                $statusSemuaSama = false;
                                break;
                            }
                        }
                    @endphp
                    <form action="{{ route('transaksi.pdf') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        @method('GET')
                        <input type="hidden"value="{{ $statusSemuaSama ? $statusPertama : 'beragam' }}" name="status">
                        <div class="modal-body container-fluid">
                            <div class="mb-3">
                                <label for="tgl_awal" class="form-label">Start Date</label>
                                <input autocomplete="off" required type="date"
                                    class="form-control @error('tgl_awal') is-invalid @enderror" id="tgl_awal"
                                    name="tgl_awal">
                                @error('tgl_awal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <label for="tgl_akhir" class="form-label">End Date</label>
                                <input autocomplete="off" required type="date"
                                    class="form-control @error('tgl_akhir') is-invalid @enderror" id="tgl_akhir"
                                    name="tgl_akhir">
                                @error('tgl_akhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                @endif
            </div>

        </div>
    </div>
</div>
