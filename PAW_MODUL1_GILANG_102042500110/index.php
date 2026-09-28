<?php
// ==============================
// DATA PRODUK (disimpan dalam array PHP)
// ==============================
$produk = [
    [
        "nama"     => "Laptop Nova 14",
        "kategori" => "Laptop",
        "harga"    => 8750000,
        "stok"     => 5,
    ],
    [
        "nama"     => "Smartphone Zenith X",
        "kategori" => "Smartphone",
        "harga"    => 4299000,
        "stok"     => 12,
    ],
    [
        "nama"     => "Headphone Wireless Beat",
        "kategori" => "Audio",
        "harga"    => 549000,
        "stok"     => 0,
    ],
    [
        "nama"     => "Smartwatch Pulse 2",
        "kategori" => "Wearable",
        "harga"    => 1250000,
        "stok"     => 8,
    ],
    [
        "nama"     => "Keyboard Mekanikal RGB",
        "kategori" => "Aksesoris",
        "harga"    => 675000,
        "stok"     => 20,
    ],
    [
        "nama"     => "Mouse Gaming Swift",
        "kategori" => "Aksesoris",
        "harga"    => 320000,
        "stok"     => 0,
    ],
    [
        "nama"     => "Power Bank 20.000 mAh",
        "kategori" => "Aksesoris",
        "harga"    => 285000,
        "stok"     => 30,
    ],
    [
        "nama"     => "Speaker Bluetooth Boom",
        "kategori" => "Audio",
        "harga"    => 459000,
        "stok"     => 3,
    ],
];

// Jumlah seluruh produk dihitung otomatis dari array
$totalProduk = count($produk);

// Fungsi format Rupiah
function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Pengaturan promo
$batasDiskon   = 1000000; // harga minimal untuk mendapat diskon
$persenDiskon  = 10;      // besar diskon (%)

// Fungsi menghitung harga setelah diskon
function hitungHargaDiskon($harga, $persen)
{
    return $harga - ($harga * $persen / 100);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store - Katalog Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container nav-inner">
            <a href="#beranda" class="logo">Cia Store</a>
            <nav class="nav-menu">
                <a href="#beranda">Home</a>
                <a href="#katalog">Products</a>
                <a href="#kontak">About</a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="container" id="beranda">
        <div class="hero">
            <p class="eyebrow">CIA STORE</p>
            <h1>Simple Tech Store.</h1>
            <p class="hero-text">Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
            <a href="#katalog" class="btn btn-light">Lihat Produk</a>
        </div>
    </section>

    <!-- INFORMASI JUMLAH PRODUK -->
    <section class="info">
        <div class="container">
            <div class="info-box">
                Total produk tersedia di katalog:
                <strong><?= $totalProduk; ?> produk</strong>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK -->
    <main class="container" id="katalog">
        <h2 class="section-title">Katalog Produk</h2>

        <div class="grid">
            <?php foreach ($produk as $item) : ?>
                <?php
                    // Percabangan untuk menentukan status berdasarkan stok
                    if ($item["stok"] > 0) {
                        $status      = "Tersedia";
                        $kelasStatus = "tersedia";
                    } else {
                        $status      = "Stok Habis";
                        $kelasStatus = "habis";
                    }
                ?>
                <?php
                    // Percabangan diskon berdasarkn hargaa
                    if ($item["harga"] >= $batasDiskon) {
                        $dapatDiskon = true;
                        $hargaAkhir  = hitungHargaDiskon($item["harga"], $persenDiskon);
                    } else {
                        $dapatDiskon = false;
                        $hargaAkhir  = $item["harga"];
                    }
                ?>
                <article class="card">
                    <p class="card-label">
                        <span class="kategori"><?= htmlspecialchars($item["kategori"]); ?></span>
                        <?php if ($dapatDiskon) : ?>
                            <span class="diskon">DISKON <?= $persenDiskon; ?>%</span>
                        <?php endif; ?>
                    </p>
                    <h3><?= htmlspecialchars($item["nama"]); ?></h3>

                    <div class="harga-wrap">
                        <?php if ($dapatDiskon) : ?>
                            <p class="harga-normal"><?= formatRupiah($item["harga"]); ?></p>
                        <?php endif; ?>
                        <p class="harga"><?= formatRupiah($hargaAkhir); ?></p>
                    </div>

                    <div class="card-bottom">
                        <span class="stok">Stok: <?= $item["stok"]; ?></span>
                        <span class="status <?= $kelasStatus; ?>"><?= $status; ?></span>
                    </div>

                    <?php if ($item["stok"] > 0) : ?>
                        <button class="btn btn-primary">Beli Sekarang</button>
                    <?php else : ?>
                        <button class="btn btn-disabled" disabled>Tidak Tersedia</button>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer" id="kontak">
        <div class="container">
            <p>&copy; <?= date("Y"); ?> Cia Store. Semua hak dilindungi.</p>
            <p>Email: suryagilangpermana1@gmail.com | Telp: 0857-7509-9362</p>
        </div>
    </footer>

</body>
</html>