<template>
  <div>
    <nav class="nav-container">
      <div class="logo">
        <img src="@/assets/images/ABS.png" alt="logo" />
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
    </nav>

    <header>
      <h1>Data Warehouse</h1>
    </header>

    <main>
      <div class="controls">
        <button
          @click="activeTab = 'sampah'"
          :class="{ active: activeTab === 'sampah' }">
          Data Sampah
        </button>
        <button
          @click="activeTab = 'kategori'"
          :class="{ active: activeTab === 'kategori' }">
          Kategori Sampah
        </button>
      </div>

      <!-- Data Sampah Table -->
      <section v-if="activeTab === 'sampah'">
        <div class="controls">
          <button @click="showAddSampahForm" class="btn-add">
            Tambah Data Sampah
          </button>
          <input
            type="text"
            v-model="searchQuery"
            placeholder="Cari sampah..."
            @keyup.enter="searchSampah" />
          <button @click="searchSampah" class="btn-search">Cari</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Sampah</th>
              <th>Berat (kg)</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="sampah in dataSampah" :key="sampah.id">
              <td>{{ sampah.id }}</td>
              <td>{{ sampah.nama }}</td>
              <td>{{ sampah.berat }}</td>
              <td>{{ sampah.kategori?.nama_kategori }}</td>
              <td>
                <button @click="editSampah(sampah)" class="edit">Edit</button>
                <button @click="deleteSampah(sampah.id)" class="delete">
                  Hapus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Kategori Sampah Table -->
      <section v-if="activeTab === 'kategori'">
        <div class="controls">
          <button @click="showAddKategoriForm" class="btn-add">
            Tambah Kategori
          </button>
          <input
            type="text"
            v-model="searchKategoriQuery"
            placeholder="Cari kategori..."
            @keyup.enter="searchKategori" />
          <button @click="searchKategori" class="btn-search">Cari</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="kategori in dataKategori" :key="kategori.id">
              <td>{{ kategori.id }}</td>
              <td>{{ kategori.nama_kategori }}</td>
              <td>
                <button @click="editKategori(kategori)" class="edit">
                  Edit
                </button>
                <button @click="deleteKategori(kategori.id)" class="delete">
                  Hapus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Form Modals -->
      <SampahForm
        v-if="showSampahForm"
        :sampah="selectedSampah"
        :is-edit="!!selectedSampah"
        :kategoris="dataKategori"
        @submitted="handleSampahSubmitted"
        @close="showSampahForm = false" />

      <KategoriForm
        v-if="showKategoriForm"
        :kategori="selectedKategori"
        :is-edit="!!selectedKategori"
        @submitted="handleKategoriSubmitted"
        @close="showKategoriForm = false" />
    </main>

    <!-- Footer -->
    <footer class="footer">
      <!-- Footer content -->
    </footer>
  </div>
</template>

<script>
import SampahForm from "@/components/SampahForm.vue";
import KategoriForm from "@/components/KategoriForm.vue";
import "@/assets/css/warehouse.css";

export default {
  name: "Warehouse",
  components: {
    SampahForm,
    KategoriForm,
  },
  data() {
    return {
      activeTab: "sampah",
      dataSampah: [],
      dataKategori: [],
      searchQuery: "",
      searchKategoriQuery: "",
      showSampahForm: false,
      showKategoriForm: false,
      selectedSampah: null,
      selectedKategori: null,
    };
  },
  methods: {
    async fetchSampah() {
      try {
        const response = await fetch("http://localhost:8000/api/sampahs");
        const data = await response.json();
        this.dataSampah = data; // Sesuaikan dengan response API
      } catch (error) {
        console.error("Error:", error);
      }
    },
    async fetchKategori() {
      try {
        const response = await fetch("http://localhost:8000/api/kategoris");
        const data = await response.json();
        this.dataKategori = data.data; // Sesuaikan dengan response API
      } catch (error) {
        console.error("Error:", error);
      }
    },
    async searchSampah() {
      try {
        const response = await fetch(
          `http://localhost:8000/api/sampahs?search=${this.searchQuery}`
        );
        const data = await response.json();
        this.dataSampah = data;
      } catch (error) {
        console.error("Error:", error);
      }
    },

    async searchKategori() {
      try {
        const response = await fetch(
          `http://localhost:8000/api/kategoris?search=${this.searchKategoriQuery}`
        );
        const data = await response.json();
        if (data.data) {
          this.dataKategori = data.data;
        }
      } catch (error) {
        console.error("Error:", error);
      }
    },
    async showAddSampahForm() {
      this.selectedSampah = null;
      this.showSampahForm = true;
    },
    async showAddKategoriForm() {
      this.selectedKategori = null;
      this.showKategoriForm = true;
    },
    async editSampah(sampah) {
      this.selectedSampah = sampah;
      this.showSampahForm = true;
    },
    async editKategori(kategori) {
      this.selectedKategori = kategori;
      this.showKategoriForm = true;
    },
    async deleteSampah(id) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        try {
          const response = await fetch(
            `http://localhost:8000/api/sampahs/${id}`,
            {
              method: "DELETE",
            }
          );
          if (response.ok) {
            await this.fetchSampah();
          }
        } catch (error) {
          console.error("Error:", error);
        }
      }
    },
    async deleteKategori(id) {
      if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
        try {
          const response = await fetch(
            `http://localhost:8000/api/kategoris/${id}`,
            {
              method: "DELETE",
            }
          );
          if (response.ok) {
            await this.fetchKategori();
          }
        } catch (error) {
          console.error("Error:", error);
        }
      }
    },
    handleSampahSubmitted() {
      this.showSampahForm = false;
      this.fetchSampah();
    },
    handleKategoriSubmitted() {
      this.showKategoriForm = false;
      this.fetchKategori();
    },
  },
  mounted() {
    this.fetchSampah();
    this.fetchKategori();
  },
};
</script>

<style>
/* Gunakan style yang sudah ada */
</style>
