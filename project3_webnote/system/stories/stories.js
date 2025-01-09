function menulis() {
    window.location.href = "../tambah.php";
}


// fitur delete dan restore
const deleteButtons = document.querySelectorAll('.delete');
const restoreButtons = document.querySelectorAll('.restore');

deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
        Swal.fire({
            title: 'Yakin menghapus data ini?',
            text: 'Data akan dipindah ke sampah',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#fc4d3d',
            cancelButtonColor: '#3db5ff',
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data anda berhasil dihapus',
                    icon: 'success',
                    confirmButtonColor: '#fc4d3d',
                }).then(() => {
                    // Cari elemen form terdekat dan submit
                    button.closest('form').submit();
                });
            } else {
                window.location.href = 'private.php';
            }
        });
    });
});

restoreButtons.forEach((button) => {
    button.addEventListener('click', () => {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data anda berhasil pulihkan',
            icon: 'success',
            confirmButtonColor: '#fc4d3d',
        }).then(() => {
            // Cari elemen form terdekat dan submit
            button.closest('form').submit();
        });
    });
});


// fitur dropdown
const dropdownMenu = document.getElementById('dropdownMenu');

window.addEventListener('click', (event) => {
    if (event.target.closest('#dropdownButton')) {
        console.log("klik")
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    } else {
        dropdownMenu.style.display = "none";
    }
});