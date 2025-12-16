<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - Midtrans</title>

    <script 
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ $clientKey }}">
    </script>
</head>
<body style="font-family: Arial; padding: 50px">

    <h2>Pembayaran Buku</h2>
    <p>ID Transaksi: {{ $purchase->id }}</p>
    <p>Total: Rp {{ number_format($purchase->total,0,',','.') }}</p>

    <button 
        id="pay-button" 
        style="padding:15px 25px; background:#007bff; color:white; border:none; border-radius:8px;">
        Bayar Sekarang
    </button>

    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    window.location.href = "/homepage";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran.");
                },
                onError: function(result){
                    alert("Pembayaran gagal.");
                },
                onClose: function(){
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
                }
            });
        };
    </script>

</body>
</html>
