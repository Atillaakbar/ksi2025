pipeline {
    // Gunakan agent 'any' jika Jenkins bisa menggunakan agent manapun.
    // Jika Anda menggunakan agent khusus Windows (karena ada perintah 'powershell'), Anda bisa menggunakan 'agent { label 'nama-agent-windows' }'
    agent any 

    stages {
        stage('Checkout Code') {
            steps {
                echo 'Mengambil kode dari GitHub...'
                // Mengambil kode dari repositori yang sudah dikonfigurasi di Jenkins Job
                git url: 'URL_REPOSITORI_ANDA', branch: 'main' 
                // Ganti 'main' jika branch utama Anda adalah 'master' atau yang lain
            }
        }
        
        stage('Install Dependencies (Composer)') {
            steps {
                echo 'Menginstal dependensi PHP (termasuk PHPUnit)...'
                // Asumsi Anda menggunakan Composer untuk instalasi PHPUnit
                powershell 'composer install --no-dev' 
                // Gunakan powershell jika agent Anda adalah Windows, jika Linux/macOS gunakan 'sh'
            }
        }

        stage('Run Unit Tests (Task 3)') {
            steps {
                echo 'Menjalankan PHPUnit...'
                // Jalankan PHPUnit dan buat laporan dalam format JUnit XML
                powershell 'vendor/bin/phpunit --log-junit target/junit.xml' 
            }
        }
        
        stage('Execute PHP (Task 2)') {
            steps {
                echo 'Menjalankan skrip index.php...'
                // Perintah spesifik yang diminta: menjalankan index.php
                powershell 'php index.php' 
            }
        }
        
        stage('Publish Test Results') {
            // Stage ini opsional namun sangat direkomendasikan
            // untuk menampilkan hasil tes di antarmuka Jenkins.
            when {
                // Pastikan stage ini selalu dijalankan, meskipun tes sebelumnya gagal
                always() 
            }
            steps {
                echo 'Mempublikasikan hasil pengujian...'
                junit 'target/junit.xml' 
            }
        }
    }
}
