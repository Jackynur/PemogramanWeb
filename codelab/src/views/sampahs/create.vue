<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../api/index.js';

const router = useRouter();
const kategoris = ref([]);

const sampah = ref({
    nama: '',
    berat: '',
    kategori_id: ''
});

const validation = ref([]);

// Ambil data kategori untuk dropdown
async function fetchKategoris() {
    try {
        const response = await api.get('/kategoris');
        kategoris.value = response.data.data;
    } catch (error) {
        console.error('Error:', error);
    }
}

// Submit form
async function store() {
    try {
        await api.post('/sampahs', sampah.value);
        router.push({ name: 'sampahs.index' });
    } catch (error) {
        validation.value = error.response.data;
    }
}

onMounted(() => {
    fetchKategoris();
});
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Tambah Sampah</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="mb-3">
                                <label class="form-label">Nama Sampah</label>
                                <input type="text" class="form-control" v-model="sampah.nama" placeholder="Masukkan Nama Sampah">
                                <div v-if="validation.nama" class="text-danger">{{ validation.nama[0] }}</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Berat (kg)</label>
                                <input type="number" step="0.01" class="form-control" v-model="sampah.berat" placeholder="Masukkan Berat">
                                <div v-if="validation.berat" class="text-danger">{{ validation.berat[0] }}</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" v-model="sampah.kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    <option v-for="kategori in kategoris" :key="kategori.id" :value="kategori.id">
                                        {{ kategori.nama_kategori }}
                                    </option>
                                </select>
                                <div v-if="validation.kategori_id" class="text-danger">{{ validation.kategori_id[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'sampahs.index' }" class="btn btn-secondary ms-2">KEMBALI</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>