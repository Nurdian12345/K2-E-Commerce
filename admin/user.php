<?php

class User
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM tb_user";
        $no = 1;
        $sql = mysqli_query($this->koneksi, $query);

        $users = [];

        while ($data = mysqli_fetch_array($sql)) {
            $users[] = $data;
            $no++;
        }

        return $users;
    }

    public function deleteUser($id)
    {
        // Implementasi kode untuk menghapus user berdasarkan ID
        $query = "DELETE FROM tb_user WHERE id = $id";
        mysqli_query($this->koneksi, $query);
    }
}

include '../koneksi.php';

$userObj = new User($koneksi);
$users = $userObj->getAllUsers();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['halaman']) && $_GET['halaman'] == 'hapususer' && isset($_GET['id'])) {
    // Hapus user berdasarkan ID jika permintaan datang dari halaman hapususer
    $userObj->deleteUser($_GET['id']);
    header('Location: index.php'); // Redirect kembali ke halaman utama setelah penghapusan
    exit();
}
?>

<h2>Data User</h2>
<a href="index.php?halaman=tambahuser" class="btn btn-outline-primary">Tambah Data</a><br>
<table class="table table-bordered table-hover mt-3">
    <tr>
        <td>No</td>
        <td>Nama Lengkap</td>
        <td>Email</td>
        <td>Aksi</td>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['id'] ?></td>
            <td><?php echo $user['fullname'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td>
                <a href="index.php?halaman=edituser&id=<?php echo $user['id'] ?>" class="btn btn-outline-success">Edit</a>
                <a href="index.php?halaman=hapususer&id=<?php echo $user['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
