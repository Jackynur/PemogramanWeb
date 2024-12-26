<template>
  <div class="form-modal">
    <div class="form-container">
      <h2>{{ isEdit ? "Edit Data Sampah" : "Tambah Data Sampah" }}</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label>Nama Sampah</label>
          <input type="text" v-model="formData.nama" required />
        </div>
        <div class="form-group">
          <label>Berat (kg)</label>
          <input type="number" v-model="formData.berat" step="0.01" required />
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select v-model="formData.kategori_id" required>
            <option value="">Pilih Kategori</option>
            <option
              v-for="kategori in kategoris"
              :key="kategori.id"
              :value="kategori.id">
              {{ kategori.nama_kategori }}
            </option>
          </select>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn-submit">Simpan</button>
          <button type="button" @click="$emit('close')" class="btn-cancel">
            Batal
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "SampahForm",
  props: {
    sampah: {
      type: Object,
      default: () => ({}),
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
    kategoris: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      formData: {
        nama: "",
        berat: "",
        kategori_id: "",
      },
    };
  },
  created() {
    if (this.isEdit && this.sampah) {
      this.formData = {
        nama: this.sampah.nama,
        berat: this.sampah.berat,
        kategori_id: this.sampah.kategori_id,
      };
    }
  },
  methods: {
    async submitForm() {
      try {
        const url = this.isEdit
          ? `http://localhost:8000/api/sampahs/${this.sampah.id}`
          : "http://localhost:8000/api/sampahs";

        const response = await fetch(url, {
          method: this.isEdit ? "PUT" : "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(this.formData),
        });

        const data = await response.json();

        if (response.ok) {
          this.$emit("submitted");
          this.$emit("close");
        } else {
          alert(
            "Gagal menyimpan data: " + (data.message || "Terjadi kesalahan")
          );
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Terjadi kesalahan saat menyimpan data");
      }
    },
  },
};
</script>
