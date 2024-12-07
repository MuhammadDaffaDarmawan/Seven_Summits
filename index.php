<?php
include ("conn.php");
include ("helper.php");
include "layout/header.php";
?>
<!-- Jumbotron -->
<div class="bg-primary text-Black py-5" style="background-image: url(assets/img/gallery/background.jpeg); background-size: cover; background-position: center;">
    <div class="container py-5">
        <h1>
            Orca Parfum <br />
            Parfum terbaik di indonesias
        </h1>
        <p>
            Trendy Products, Factory Prices, Excellent Service
        </p>
        <button type="button" class="btn btn-outline-primary">
            <a href="#tentang">Learn more</a>
        </button>
        <button type="button" class="btn btn-primary shadow-0 text-light pt-2 border border-white">
           <a href=""> <span class="pt-1 text-light">Purchase now</span></a>
        </button>
    </div>
</div>


<br>


<br>

<section>
        <div class="row" id="gallery"> 
            <?php
            $query = $conn->prepare("SELECT * FROM produk order by id desc");
            $query->execute();
            while ($data = $query->fetch()) {

                ?>

                <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                    <div class="card w-100 my-2 ">
                        <img src="crud/image/<?php echo $data['gambar'] ?>" class="card-img-top"
                            style="aspect-ratio: 1 / 1" />
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $data['nama_barang'] ?>
                            </h5>
                            <p class="card-text"><?php echo $data['harga'] ?></p>
                            <div class="card-footer d-flex align-items-end  mt-auto">
                                <a href="https://wa.me/<?= $nomor_wa ?>/?text=Hallo%20saya%20mau%20pesan%20Pafum%20<?= $data['nama_barang'] ?>"
                                    class="btn btn-primary shadow-0 me-1">Pesan Sekarang !!</a>
                                <div id="chatContainer"></div>
                                <br>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
</section>

<!-- Repeat similar structure for other items -->

</div>
</div>




<section class="mt-5" style="background-color: #f5f5f5;">
    <div class="container text-dark pt-3">
        <header class="pt-4 pb-3">
            <h3>Why choose us</h3>
        </header>

        <div class="row mb-4">
            <div class="col-lg-4 col-md-6">
                <figure class="d-flex align-items-center mb-4">
                    <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                        <i class="fas fa-camera-retro fa-2x fa-fw text-primary floating"></i>
                    </span>
                    <figcaption class="info">
                        <h6 class="title">Orca Parfum </h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                    </figcaption>
                </figure>
                <!-- itemside // -->
            </div>
            <!-- col // -->
            <div class="col-lg-4 col-md-6">
                <figure class="d-flex align-items-center mb-4">
                    <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                        <i class="fas fa-star fa-2x fa-fw text-primary floating"></i>
                    </span>
                    <figcaption class="info">
                        <h6 class="title">Best quality</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                    </figcaption>
                </figure>
                <!-- itemside // -->
            </div>
            <!-- col // -->
            <div class="col-lg-4 col-md-6">
                <figure class="d-flex align-items-center mb-4">
                    <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                        <i class="fas fa-plane fa-2x fa-fw text-primary floating"></i>
                    </span>
                    <figcaption class="info">
                        <h6 class="title">Worldwide shipping</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                    </figcaption>
                </figure>
                <!-- itemside // -->
            </div>
            <!-- col // -->
            <div class="col-lg-4 col-md-6">
                <figure class="d-flex align-items-center mb-4">
                    <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                        <i class="fas fa-users fa-2x fa-fw text-primary floating"></i>
                    </span>
                    <figcaption class="info">
                        <h6 class="title">Customer satisfaction</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                    </figcaption>
                </figure>
                <!-- itemside // -->
            </div>
            <!-- col // -->
            <div class="col-lg-4 col-md-6">
                <figure class="d-flex align-items-center mb-4">
                    <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                        <i class="fas fa-thumbs-up fa-2x fa-fw text-primary floating"></i>
                    </span>
                    <figcaption class="info">
                        <h6 class="title">Happy customers</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                    </figcaption>
                </figure>
                <!-- itemside // -->
            </div>
            <!-- col // -->
            <div class="col-lg-4 col-md-6">
                <figure class="d-flex align-items-center mb-4">
                    <span class="rounded-circle bg-white p-3 d-flex me-2 mb-2">
                        <i class="fas fa-box fa-2x fa-fw text-primary floating"></i>
                    </span>
                    <figcaption class="info">
                        <h6 class="title">Thousand items</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmor</p>
                    </figcaption>
                </figure>
                <!-- itemside // -->
            </div>
            <!-- col // -->
        </div>
    </div>
    <!-- container end.// -->
</section>
<!-- Feature -->
<br>
<div class="tentang" id="tentang">
    <div class="container">
        <h1 class="text-center">Orca Parfum</h1>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <img src="assets/img/gallery/moonlight parfume price list.jpg" class="img-fluid" alt="Gunung">
            </div>
            <div class="col-12 col-md-6">
                <p class="text-justify">
                Swana Eau De Parfume Orca adalah parfum yang dapat digunakan pada pria dan wanita. Parfum ini mempunyai wangi yang khas dan mampu bertahan hingga 12 jam saat digunakan. Dikemas dengan bentuk yang praktis dan mudah untuk dibawa kemana saja. Selain itu, tidak meningalkan bekas noda pada pakaian.
                </p>
                <p class="text-justify">
                Swana Eau De Parfume Orca is a perfume that can be used by men and women. This perfume has a distinctive fragrance and can last up to 12 hours when used. Packaged in a practical form and easy to carry anywhere. Apart from that, it doesn't leave stains on clothes.
                </p>
            </div>
        </div>
    </div>
</div>
<form id="daftarfrom" action="pendaftaran.php" method="post">
    <div class="container pendaftaran" id="pendaftaran">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="pic">
                    <img src="assets/img/gallery/Jenis Moonlight Parfume.jpg" class="img-fluid" alt="Daftarkan Dirimu">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h1>Pesan Sekarang Juga!</h1>
                <form>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="asal_kota">Asal Kota</label>
                        <select class="form-control" id="kota" name="asal_kota">
                            <option>----- Silakan Pilih Kota -----</option>
                            <option value="Amobn">Ambon</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Banten">Banten</option>
                            <option value="Bekasi">Bekasi</option>
                            <option value="Blitar">Blitar</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Cilacap">Cilacap</option>
                            <option value="Cilegon">Cilegon</option>
                            <option value="Cimahi">Cimahi</option>
                            <option value="Cirebon">Cirebon</option>
                            <option value="Denpasar">Denpasar</option>
                            <option value="Depok">Depok</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Jambi">Jambi</option>
                            <option value="Makassar">Makassar</option>
                            <option value="Malang">Malang</option>
                            <option value="Medan">Medan</option>
                            <option value="Padang">Padang</option>
                            <option value="Palu">Palu</option>
                            <option value="Pekanbaru">Pekanbaru</option>
                            <option value="Pekalongan">Pekalongan</option>
                            <option value="Pontianak">Pontianak</option>
                            <option value="Pekanbaru">Pekanbaru</option>
                            <option value="Sukabumi">Sukabumi</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Serang">Serang</option>
                            <option value="Tangerang">Tangerang</option>
                            <option value="Tasikmalaya">Tasikmalaya</option>
                            <option value="Tegal">Tegal</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Alasan</label>
                        <textarea class="form-control" id="pesan" name="pesan"
                            placeholder="Alasan mengapa anda membeli parfum ini..."
                            style="height:200px;"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="pesan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>

<br>

<?php
include "layout/footer.php";
?>