<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran - {{ $book->title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 16px; }
    .modal-content { border-radius: 16px; }
  </style>
</head>
<body class="bg-light">

  <div class="container py-5">
    <div class="card shadow-lg p-4">
      <h3 class="mb-4 text-center">💳 Konfirmasi Pembayaran</h3>

      <div class="mb-3">
        <p><strong>Judul Buku:</strong> {{ $book->title }}</p>
        <p><strong>Jumlah:</strong> {{ $qty }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($book->harga * $qty, 0, ',', '.') }}</p>
        <p><strong>Alamat:</strong> {{ $address }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ ucfirst($payment_method) }}</p>
      </div>

      <form id="payForm" action="{{ route('purchase.pay', $book->id_buku) }}" method="POST">
        @csrf
        <input type="hidden" name="qty" value="{{ $qty }}">
        <input type="hidden" name="address" value="{{ $address }}">
        <input type="hidden" name="payment_method" value="{{ $payment_method }}">

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success btn-lg">Bayar Sekarang</button>
          <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Batalkan</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Pembayaran Berhasil -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header bg-success text-white border-0">
          <h5 class="modal-title w-100" id="successModalLabel">Pembayaran Berhasil 🎉</h5>
        </div>
        <div class="modal-body py-4">
          <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
          <p class="mt-3 fs-5">Terima kasih telah melakukan pembayaran.<br>
          Transaksi Anda telah berhasil.</p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <a href="/homepage" class="btn btn-primary px-4">Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <script>
    const payForm = document.getElementById('payForm');
    payForm.addEventListener('submit', async function (e) {
      e.preventDefault(); // hentikan reload halaman

      // Kirim data form ke server (POST)
      const formData = new FormData(payForm);
      const response = await fetch(payForm.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      });

      if (response.ok) {
        // Tampilkan modal sukses
        const modal = new bootstrap.Modal(document.getElementById('successModal'));
        modal.show();
      } else {
        alert('Terjadi kesalahan saat memproses pembayaran.');
      }
    });
  </script>

</body>
</html>
