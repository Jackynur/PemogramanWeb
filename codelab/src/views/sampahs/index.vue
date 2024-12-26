<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../api/index.js';

const sampahs = ref([]);
const router = useRouter();

async function fetchSampahs() {
    try {
        const response = await api.get('/sampahs');
        sampahs.value = response.data;
    } catch (error) {
        console.error('Error:', error);
    }
}

async function deleteSampah(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        try {
            await api.delete(`/sampahs/${id}`);
            fetchSampahs(); // Refresh data setelah hapus
        } catch (error) {
            console.error('Error:', error);
        }
    }
}

onMounted(() => {
    fetchSampahs();
});
</script>

<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4>Data Sampah</h4>
                <router-link to="/sampahs/create" class="btn btn-success mb-3">TAMBAH SAMPAH</router-link>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Sampah</th>
                            <th>Berat (kg)</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sampah in sampahs" :key="sampah.id">
                            <td>{{ sampah.nama }}</td>
                            <td>{{ sampah.berat }}</td>
                            <td>{{ sampah.kategori?.nama_kategori }}</td>
                            <td>
                                <router-link :to="`/sampahs/${sampah.id}/edit`" class="btn btn-sm btn-primary me-2">Edit</router-link>
                                <button @click="deleteSampah(sampah.id)" class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>