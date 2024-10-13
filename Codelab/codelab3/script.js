function validateForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var address = document.getElementById('address').value;

    if (name === "") {
        alert("Nama harus diisi!");
        return false;
    }

    if (email === "") {
        alert("Email harus diisi!");
        return false;
    }

    if (address === "") {
        alert("Alamat harus diisi!");
        return false;
    }

    alert("Pendaftaran berhasil!");
    return true;
}
