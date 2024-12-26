<template>
  <div class="form-modal">
    <div class="form-container">
      <h2>{{ isEdit ? "Edit Kategori" : "Tambah Kategori" }}</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" v-model="formData.nama_kategori" required />
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
  name: "KategoriForm",
  props: {
    kategori: {
      type: Object,
      default: () => ({}),
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      formData: {
        nama_kategori: "",
      },
    };
  },
  created() {
    if (this.isEdit && this.kategori) {
      this.formData = {
        nama_kategori: this.kategori.nama_kategori,
      };
    }
  },
  methods: {
    async submitForm() {
      try {
        const url = this.isEdit
          ? `http://localhost:8000/api/kategoris/${this.kategori.id}`
          : "http://localhost:8000/api/kategoris";

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
