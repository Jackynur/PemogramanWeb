<template>
  <div>
    <div class="Home-container">
      <div class="selamat-datang">
        <h1>SELAMAT DATANG</h1>
        <p>Ubah barang tidak terpakai menjadi uang</p>
        <button class="btn-masuk">Gabung Sekarang</button>
      </div>
      <div class="image-section">
        <img src="../assets/images/image.png" alt="Ilustrasi Recycle" />
      </div>
    </div>

    <div id="profile" class="profile-container">
      <div class="tentang-kami">
        <h1>TENTANG APLIKASI</h1>
        <p>
          Aplikasi ini dibuat untuk membantu masyarakat mengelola sampah secara
          efisien. <br />Dengan menggunakan aplikasi ini, masyarakat dapat
          mengelola sampah dengan mudah dan aman. <br />Aplikasi ini juga dapat
          meningkatkan kualitas hidup masyarakat karena menjadi tempat untuk
          menyalurkan sampah yang tidak terpakai bisa menjadi uang.
        </p>
      </div>
    </div>

    <div id="features" class="feature-container">
      <h2>FEATURES</h2>
      <div class="features">
        <div class="feature" id="shop">
          <router-link to="/shop">
            <img src="../assets/images/shop.png" alt="Shop" />
            <h3>SHOP</h3>
            <p>Temukan berbagai barang daur ulang berkualitas di toko kami.</p>
          </router-link>
        </div>
        <div class="feature">
          <img src="../assets/images/transaksi.png" alt="Transaksi" />
          <h3>TRANSAKSI</h3>
          <p>Proses transaksi mudah dan aman untuk setiap produk daur ulang.</p>
        </div>
        <div class="feature">
          <router-link to="/warehouse" style="text-decoration: none">
            <img src="../assets/images/warehouse.png" alt="Warehouse" />
            <h3 style="text-decoration: none">WAREHOUSE</h3>
            <p>Kelola data sampah dan kategori sampah.</p>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
};
</script>
