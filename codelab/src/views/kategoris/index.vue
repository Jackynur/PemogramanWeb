<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../api/index.js';

const kategoris = ref([]);
const router = useRouter();

// Mengambil data kategori
async function fetchKategoris() {
    try {
        const response = await api.get('/kategoris');
        kategoris.value = response.data.data;
    } catch (error) {
        console.error('Error:', error);
    }
}

// Hapus kategori
async function deleteKategori(id) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
        try {
            await api.delete(`/kategoris/${id}`);
            await fetchKategoris();
        } catch (error) {
            console.error('Error:', error);
        }
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
                        <h4>Data Kategori</h4>
                        <router-link :to="{ name: 'kategoris.create' }" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</router-link>
                        
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="kategori in kategoris" :key="kategori.id">
                                    <td>{{ kategori.nama_kategori }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'kategoris.edit', params: { id: kategori.id } }" class="btn btn-sm btn-primary me-2">EDIT</router-link>
                                        <button @click="deleteKategori(kategori.id)" class="btn btn-sm btn-danger">HAPUS</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>