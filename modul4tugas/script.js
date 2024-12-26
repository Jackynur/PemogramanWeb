const apiUrl = 'http://localhost:8000/api/product'; // Ganti dengan URL API Anda

// Muat produk saat halaman dimuat
window.onload = () => fetchProducts();

async function fetchProducts(searchQuery = '') {
    const url = searchQuery ? `${apiUrl}/${encodeURIComponent(searchQuery)}` : apiUrl;

    try {
        const response = await fetch(url);
        const data = await response.json();

        const tableBody = document.getElementById('productTable');
        tableBody.innerHTML = '';

        if (data.code === 200 && data.data.length > 0) {
            data.data.forEach(product => {
                const row = `
                    <tr>
                        <td>${product.id}</td>
                        <td>${product.product_name}</td>
                        <td>
                            <button class="edit" onclick="editProduct(${product.id}, '${product.product_name}', '${product.deskripsi || ''}')">Edit</button>
                            <button class="delete" onclick="deleteProduct(${product.id})">Hapus</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        } else {
            tableBody.innerHTML = '<tr><td colspan="4">Tidak ada produk ditemukan.</td></tr>';
        }
    } catch (error) {
        console.error('Gagal memuat produk:', error);
    }
}

function editProduct(id, name, deskripsi) {
    document.getElementById('formTitle').textContent = 'Edit Produk';
    document.getElementById('productId').value = id;
    document.getElementById('productName').value = name;
    document.getElementById('productFormSection').style.display = 'block';
}

document.getElementById('addProductButton').addEventListener('click', () => {
    document.getElementById('formTitle').textContent = 'Tambah Produk';
    document.getElementById('productId').value = '';
    document.getElementById('productName').value = '';
    document.getElementById('productFormSection').style.display = 'block';
});

document.getElementById('cancelButton').addEventListener('click', () => {
    document.getElementById('productFormSection').style.display = 'none';
});

document.getElementById('productForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const id = document.getElementById('productId').value;
    const product = {
        product_name: document.getElementById('productName').value,
    };

        const response = await fetch(id ? `${apiUrl}/${id}` : apiUrl, {
            method: id ? 'PUT' : 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(product)
        });

        const data = await response.json();

        if (data.code === 200) {
            alert(id ? 'Produk berhasil diperbarui' : 'Produk berhasil ditambahkan');
            document.getElementById('productFormSection').style.display = 'none';
            fetchProducts();
        } else {
            alert('Gagal menyimpan produk.');
        }
});

async function deleteProduct(id) {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        try {
            const response = await fetch(`${apiUrl}/${id}`, { method: 'DELETE' });
            const data = await response.json();

            if (data.code === 200) {
                alert('Produk berhasil dihapus');
                fetchProducts();
            } else {
                alert('Gagal menghapus produk.');
            }
        } catch (error) {
            console.error('Gagal menghapus produk:', error);
        }
    }
}

document.getElementById('searchButton').addEventListener('click', () => {
    const searchQuery = document.getElementById('searchInput').value.trim();
    fetchProducts(searchQuery);
});

document.getElementById('searchInput').addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
        const searchQuery = e.target.value.trim();
        fetchProducts(searchQuery);
    }
});