<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../api/index.js';

const router = useRouter();

const kategori = ref({
    nama_kategori: ''
});

const validation = ref([]);

async function store() {
    try {
        await api.post('/kategoris', kategori.value);
        router.push({ name: 'kategoris.index' });
    } catch (error) {
        validation.value = error.response.data;
    }
}
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Tambah Kategori</h4>
                        <hr>
                        <form @submit.prevent="store">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" v-model="kategori.nama_kategori" placeholder="Masukkan Nama Kategori">
                                <div v-if="validation.nama_kategori" class="text-danger">{{ validation.nama_kategori[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <router-link :to="{ name: 'kategoris.index' }" class="btn btn-secondary ms-2">KEMBALI</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>