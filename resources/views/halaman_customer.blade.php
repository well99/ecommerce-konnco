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
    <link href="css/styles.css" rel="stylesheet" />
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
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item">
                    <a href="/login" class="nav-link" type="button">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <main class="container">
            <div class="container mt-5">
                <div class="row" id="listcard">
                </div>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form onsubmit="return formsubmit(event)">
                    <div class="modal-body">
                        <input type="hidden" id="idProduk">
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="nama">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="harga">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="number" readonly class="form-control" id="stok">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="jumlah" min="1" onchange="gantijumlah(this.value)">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="total" class="col-sm-2 col-form-label">Total</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="total" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama_customer" class="col-sm-2 col-form-label">Nama Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_customer" required placeholder="Masukkan Nama Anda">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat Customer</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Anda" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="sumbit" class="btn btn-primary">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="snapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="snap-container"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!-- <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        (function() {
            initialize();
        })()

        async function initialize() {
            url = 'http://127.0.0.1:8000/api/api_index'
            data = await getData(url)
            console.log(data);
            datacard = tampilanCard(data)
            document.getElementById("listcard").innerHTML = datacard
        }

        function getData(url, form = '') {
            if (form == '') {
                return fetch(url)
                    .then(response => response.json())
                    .then(result => result)
                    .catch(error => error);
            }
            return fetch(url, form)
                .then(response => response.json())
                .then(result => result)
                .catch(error => error);
        }

        function tampilanCard(data) {
            let card = ''
            asset = 'http://127.0.0.1:8000'
            data.data.map((d, i) => {
                if (d.stok < 1) {
                    btnBeli = `
                            <button type="button" disabled class="btn btn-primary" onclick="showModal(${d.id})">
                                Beli
                            </button>`;
                } else {
                    btnBeli = `
                            <button type="button" class="btn btn-primary" onclick="showModal(${d.id})">
                                Beli
                            </button>`;
                }
                card += `
                        <div class="card m-3" idcard=${d.id}  style="width: 20rem;">
                        <img src="${asset + '/images/foto_produk/' +  d.foto}" class="card-img-top" style="height: 250px;">
                        <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <p class="card-text">Nama Produk :</p>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="card-title">${d.nama_produk}</h5>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <p class="card-text">Harga :</p>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="card-title">${d.harga}</h5>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <p class="card-text">Stok :</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="card-text">${d.stok}</p>
                            </div>
                        </div>
                            ${btnBeli}
                        </div>
                    </div>
                    `
            })
            return card
        }

        async function showModal(idProduk) {
            // document.getElementById("jumlah").value = 0
            // document.getElementById("harga").value = 0
            // document.getElementById("total").value = 0
            await fetch('http://127.0.0.1:8000/api/produk_by_id/' + idProduk)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("nama").value = data.produk.nama_produk;
                    document.getElementById("stok").value = data.produk.stok;
                    document.getElementById("harga").value = data.produk.harga;
                    document.getElementById("idProduk").value = data.produk.id;
                });

            $('#exampleModal').modal('show');
        }

        function gantijumlah(a) {
            stok = document.getElementById("stok").value
            harga = document.getElementById("harga").value
            if (parseInt(a) >= parseInt(stok)) {
                document.getElementById("jumlah").disabled = true;
            }
            document.getElementById("total").value = harga * a
        }

        async function formsubmit(e) {
            e.preventDefault();

            idProduk = document.getElementById("idProduk").value
            jumlah = document.getElementById("jumlah").value
            totalHarga = document.getElementById("total").value
            namaCustomer = document.getElementById("nama_customer").value
            alamat = document.getElementById("alamat").value

            const frdt = new FormData();
            frdt.append("id_produk", idProduk);
            frdt.append("jumlah", jumlah);
            frdt.append("total", totalHarga);
            frdt.append("nama_customer", namaCustomer);
            frdt.append("alamat", alamat);
            requestOptions = {
                method: "POST",
                body: frdt,
                redirect: "follow"
            };
            url = 'http://127.0.0.1:8000/api/add_transaksi'
            data = await getData(url, requestOptions)
            console.log(data);
            if (data.pesan == 'create') {
                $('#exampleModal').modal('hide');
                // window.location.href = 'http://127.0.0.1:8000/detail_pembayaran/' + data.id_transaksi
                window.snap.pay(data.tokensnap, {
                    onSuccess: async function(result) {
                        /* You may add your own implementation here */
                        // alert("payment success!");
                        await fetch('http://127.0.0.1:8000/api/callback/' + data.id_transaksi)
                            .then(response => response.json())
                            .then(res => {
                                if (res.pesan == 'Berhasil') {
                                    location.reload();
                                }
                            })
                        console.log(result);
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            }
        }
    </script>
</body>

</html>