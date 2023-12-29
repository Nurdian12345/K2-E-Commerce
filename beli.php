<?php
session_start();

class ShoppingCart{
    private $koneksi;
    public function __construct($koneksi){
        $this->koneksi = $koneksi;
    }
    public function addTocart($id){
        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id] += 1;
        } else {
            $_SESSION['keranjang'][$id] = 1;
        }
        echo "<script>alert('produk telah masuk ke keranjang belanja')</script>";
        echo "<script>location='cart.php'</script>";
    }
}

include('koneksi.php');

$cartObj = new ShoppingCart($koneksi);

$id = $_GET['id'];

$cartObj->addTocart($id);