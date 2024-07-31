<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('Client_Key') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ URL::to('css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-end">
        <div class="collapse navbar-collapse" id="navbarNav" style="margin-left: 20px;">
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item">
                    <span class="nav-link" type="button" data-kat="0">Ecommerce-Konnco</span>
                </li>
            </ul>
        </div>
        <div class="ms-auto" style="margin-right: 5px;">
        </div>
    </nav>
    <div id="layoutSidenav">
        <main class="container">
            <div class="container mt-5">
                <div class="row">
                    <div class="card m-3" style="width: 18rem;">
                        <img src="{{ asset('images/foto_produk/'.$transaksi->produk->foto)}}" class="card-img-top" style="height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $transaksi->produk->nama_produk }}</h5>
                            <p class="card-text">{{ $transaksi->produk->harga }}</p>
                            <p class="card-text">{{ $transaksi->jumlah }}</p>
                            <p class="card-text">{{ $transaksi->total_pembayaran }}</p>
                            <button type="button" class="btn btn-primary" id="pay-button">
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>

                <div id="snap-container"></div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ URL::to('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!-- <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ URL::to('js/datatables-simple-demo.js') }}"></script>
    <script type="text/javascript">
        snapToken = '{{$snapToken}}'
        console.log(snapToken);
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay(snapToken);
            // customer will be redirected after completing payment pop-up
        });
    </script>
</body>

</html>