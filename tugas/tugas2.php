<?php

function cetakBilangan($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Jika bilangan habis dibagi 4 dan 6
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024" . "<br>";
        }
        // Jika bilangan habis dibagi 5
        elseif ($i % 5 == 0) {
            echo "2024" . "<br>";
        }
        // Jika bilangan hanya habis dibagi 4 tetapi tidak habis dibagi 6
        elseif ($i % 4 == 0) {
            echo "Pemrograman" . "<br>";
        }
        // Jika bilangan hanya habis dibagi 6 tetapi tidak habis dibagi 4
        elseif ($i % 6 == 0) {
            echo "Website" . "<br>";
        }
        // Jika tidak memenuhi kondisi di atas, cetak bilangan itu sendiri
        else {
            echo $i . "<br>";
        }
    }
}

// Contoh pemanggilan fungsi
cetakBilangan(25);

