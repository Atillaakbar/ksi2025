pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Stage 1: Mengambil kode dari GitHub...'
                // Menggunakan 'checkout scm' akan mengambil kode dari repositori yang dikonfigurasi di Job Jenkins.
                checkout scm
            }
        }

        // --- Tugas 3: Persiapan Testing ---
        stage('Install Dependencies') {
            steps {
                echo 'Stage 2: Menginstal dependensi PHP (Composer)...'
                // Menginstal semua dependensi, termasuk PHPUnit yang didefinisikan di composer.json
                powershell 'composer install'
            }
        }
        
        // --- Tugas 3: Pengujian Unit ---
        stage('Run Unit Tests') {
            steps {
                echo 'Stage 3: Menjalankan PHPUnit dan membuat laporan JUnit...'
                // Menjalankan tes dan menyimpan hasilnya ke file XML untuk pelaporan Jenkins
                powershell 'vendor/bin/phpunit --log-junit target/junit.xml' 
            }
        }
        
        // --- Tugas 2: Eksekusi Kode ---
        stage('Execute PHP Script') {
            steps {
                echo 'Stage 4: Menjalankan powershell php index.php...'
                // Perintah wajib sesuai permintaan tugas
                powershell 'php index.php' 
            }
        }
        
        // --- Stage Kustom: Deployment ---
        stage('Deploy to XAMPP') {
            steps {
                echo 'Stage 5: Menyalin file ke folder XAMPP htdocs...'
                bat '''
                rmdir /S /Q C:\\xampp\\htdocs\\ksi2025
                xcopy /E /I /Y . C:\\xampp\\htdocs\\ksi2025
                '''
            }
        }
    }

    // --- Tugas 3: Pelaporan (Post-Build Action) ---
    post {
        // Blok 'always' memastikan laporan diterbitkan, meskipun ada tes yang gagal.
        always {
            echo 'Mempublikasikan hasil pengujian ke Jenkins...'
            // Membaca file XML yang dibuat oleh PHPUnit untuk menampilkan laporan grafis
            junit 'target/junit.xml' 
        }
        failure {
            echo 'Pipeline gagal. Cek Console Output untuk detail error!'
        }
    }
}
