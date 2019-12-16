try {
    var halaman = location.pathname;
    halaman = halaman.split('/');
    if (halaman[halaman.length-1]=='') $('#beranda').addClass('active');
    else $('#'+halaman[halaman.length-1]).addClass('active');    
} catch (error) {}

function hapus_pengguna(username) {
    c = confirm('Anda yakin ingin menghapus?');
    if (c) location.href='./hapus-pengguna?username='+username;
}

function hapus_kriteria(id) {
    c = confirm('Anda yakin ingin menghapus? Bobot Pakar/Ahli juga akan terhapus.');
    if (c) location.href='./hapus-kriteria?id='+id;
}

function cek_isian_matrix_perbandingan() {
    
}

$('#form-perbandingan-matrix').submit(function(e){
    names = [];c = 0;
    $('input').each(function() {
        if (!names.includes(this.name)) {
            if (this.name!='') names.push(this.name);
        }
        if (this.checked) c++;
    });
    if (names.length!=c) {
        $('#pesan-error').html('<div class="alert alert-dismissable alert-danger"><b>Terdapat perbandingan yang belum terisi</b>, silahkan cek kembali.</div>');
        return false;
    } else return true;
});