<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import api from '../../api/index.js';

const router = useRouter();
const route = useRoute();
const kategoris = ref([]);

const sampah = ref({
    nama: '',
    berat: '',
    kategori_id: ''
});

async function fetchKategoris() {
    try {
        const response = await api.get('/kategoris');
        // Sesuaikan dengan struktur response dari API kategori
        kategoris.value = response.data.data || response.data;
        console.log('Data kategoris:', kategoris.value);
    } catch (error) {
        console.error('Error mengambil kategori:', error);
    }
}

async function fetchSampah() {
    try {
        const response = await api.get(`/sampahs/${route.params.id}`);
        sampah.value = response.data;
        console.log('Data sampah:', sampah.value);
    } catch (error) {
        console.error('Error mengambil sampah:', error);
    }
}

async function handleUpdate() {
    try {
        const formData = {
            nama: sampah.value.nama,
            berat: sampah.value.berat,
            kategori_id: sampah.value.kategori_id
        };
        await api.put(`/sampahs/${route.params.id}`, formData);
        router.push('/sampahs');
    } catch (error) {
        console.error('Error:', error);
    }
}

function handleKembali() {
    router.push('/sampahs');
}

onMounted(async () => {
    // Pastikan kategori diload dulu sebelum sampah
    await fetchKategoris();
    await fetchSampah();
});
</script>

<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4>Edit Data Sampah</h4>

                <form @submit.prevent="handleUpdate">
                    <div class="mb-3">
                        <label class="form-label">Nama Sampah</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            v-model="sampah.nama"
                            placeholder="Masukkan Nama Sampah"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Berat (kg)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            class="form-control" 
                            v-model="sampah.berat"
                            placeholder="Masukkan Berat"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" v-model="sampah.kategori_id">
                            <option value="" disabled>Pilih Kategori</option>
                            <option 
                                v-for="kategori in kategoris" 
                                :key="kategori.id" 
                                :value="kategori.id"
                            >
                                {{ kategori.nama_kategori }}
                            </option>
                        </select>
                        <!-- Debug info -->
                        <small class="text-muted" v-if="kategoris.length === 0">Loading kategori...</small>
                    </div>

                    <!-- Debug info -->
                    <div v-if="false" class="mb-3">
                        <small>Debug - Available Categories:</small>
                        <pre>{{ kategoris }}</pre>
                        <small>Current sampah data:</small>
                        <pre>{{ sampah }}</pre>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <button type="button" @click="handleKembali" class="btn btn-secondary ms-2">KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>