<template>
  <div id="app">
    <div class="nav-container">
      <div class="logo">
        <img src="./assets/images/ABS.png" alt="logo" />
      </div>
      <nav>
        <ul>
          <li><router-link to="/" class="inactive">Home</router-link></li>
          <li>
            <router-link to="/profile" class="inactive">Profile</router-link>
          </li>
          <li>
            <router-link to="/features" class="inactive">Features</router-link>
          </li>
          <li><a href="#footer" class="inactive">Hubungi Kami</a></li>
        </ul>
      </nav>
      <div class="nav-button">
        <a href="#" class="btn-cari">Cari</a>
      </div>
    </div>

    <router-view></router-view>

    <div id="footer" class="footer">
      <div class="footer-content">
        <div class="footer-column">
          <h3>Layanan Kami</h3>
          <ul>
            <li><a href="#">Bantuan</a></li>
            <li><a href="#">Notifikasi</a></li>
            <li><a href="#">Kontak Kami</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Ikuti kami</h3>
          <div class="sosial-logo">
            <a href="https://www.facebook.com" target="_blank"
              ><i class="fab fa-facebook"></i
            ></a>
            <a href="https://instagram.com" target="_blank"
              ><i class="fab fa-instagram"></i
            ></a>
            <a href="https://twitter.com" target="_blank"
              ><i class="fab fa-twitter"></i
            ></a>
          </div>
        </div>
        <div class="footer-column">
          <h3>Cari</h3>
          <div class="search-box">
            <img src="./assets/images/search.png" alt="Search" />
            <input type="text" placeholder="Cari..." />
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>
          PT. ABS, Jl. MANGGA , MALANG 65165 | Telepon: (021) 123-4567 | Email:
          abs@xyz.com
        </p>
        <div>© 2024 ABS. All Rights Reserved</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
@import "./assets/css/main.css";
</style>
