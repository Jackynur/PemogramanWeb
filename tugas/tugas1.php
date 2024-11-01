<?php

// Namespace untuk pengelompokan kelas
namespace LibrarySystem;

// Trait untuk menambahkan harga pada buku
trait PriceTrait {
    private $price;

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }
}

// Abstract class Book dengan atribut dan metode dasar
abstract class Book {
    protected $title;
    protected $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    // Abstract method yang harus diimplementasikan di kelas turunan
    abstract public function getInfo();

    // Magic method untuk menampilkan objek sebagai string
    public function __toString() {
        return "Judul: $this->title, Penulis: $this->author";
    }
}

// Kelas Ebook yang mewarisi dari kelas Book
class Ebook extends Book {
    use PriceTrait; // Menggunakan trait PriceTrait

    private $fileSize;

    public function __construct($title, $author, $fileSize) {
        parent::__construct($title, $author);
        $this->fileSize = $fileSize;
    }

    public function getInfo() {
        return "Ebook - Judul: $this->title, Penulis: $this->author, Ukuran File: $this->fileSize MB, Harga: " . $this->getPrice();
    }
}

// Kelas PrintedBook yang mewarisi dari kelas Book
class PrintedBook extends Book {
    use PriceTrait; // Menggunakan trait PriceTrait

    private $pageCount;

    public function __construct($title, $author, $pageCount) {
        parent::__construct($title, $author);
        $this->pageCount = $pageCount;
    }

    public function getInfo() {
        return "Printed Book - Judul: $this->title, Penulis: $this->author, Jumlah Halaman: $this->pageCount, Harga: " . $this->getPrice();
    }
}

// Kelas Library untuk mengelola koleksi buku
class Library {
    private $collection = [];

    // Method untuk menambah buku ke koleksi
    public function addBook(Book $book) {
        $this->collection[] = $book;
    }

    // Method untuk menampilkan semua buku di koleksi
    public function showCollection() {
        foreach ($this->collection as $book) {
            echo $book->getInfo() . PHP_EOL;
        }
    }
}

// Contoh Penggunaan Program

// Membuat objek Library
$library = new Library();

// Menambahkan ebook ke koleksi perpustakaan
$ebook = new Ebook("Panduan PHP OOP", "A. Developer", 5);
$ebook->setPrice(50000); // Menggunakan trait PriceTrait untuk mengatur harga
$library->addBook($ebook);

// Menambahkan buku cetak ke koleksi perpustakaan
$printedBook = new PrintedBook("Belajar PHP dari Dasar", "B. Programmer", 300);
$printedBook->setPrice(75000); // Menggunakan trait PriceTrait untuk mengatur harga
$library->addBook($printedBook);

// Menampilkan koleksi buku di perpustakaan
$library->showCollection();
