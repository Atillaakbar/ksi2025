pipeline {
    // Agen apa pun yang tersedia, diutamakan yang memiliki PHP/Composer/Powershell
    agent any

    stages {
        // Stage 1: Mengambil Kode dari GitHub (Tugas 1 - Otomasi Webhook)
        stage('Checkout Code') {
            steps {
                echo 'Stage 1: Mengambil kode dari GitHub...'
                // Mengambil kode dari repositori yang dikonfigurasi di Job Jenkins
                checkout scm
            }
        }

        // Stage 2: Instalasi Dependensi (Persiapan Tugas 3)
        stage('Install Dependencies') {
            steps {
                echo 'Stage 2: Menginstal dependensi PHP (Composer) dan PHPUnit...'
                // Menginstal semua dependensi, termasuk PHPUnit dari composer.json
                powershell 'composer install --no-dev' 
            }
        }
        
        // Stage 3: Menjalankan Unit Test (Tugas 3)
        stage('Run Unit Tests') {
            steps {
                echo 'Stage 3: Menjalankan PHPUnit dan membuat laporan JUnit...'
                // Menjalankan tes di folder 'tests' dan membuat laporan XML
                // Jika folder tes Anda bernama lain, ganti 'tests'
                powershell 'vendor/bin/phpunit tests --log-junit target/junit.xml' 
            }
        }
        
        // Stage 4: Eksekusi Kode PHP (Tugas 2)
        stage('Execute PHP Script') {
            steps {
                echo 'Stage 4: Menjalankan powershell php index.php...'
                // Perintah wajib sesuai permintaan tugas
                powershell 'php index.php' 
            }
        }
        
        // Stage 5: Deployment ke XAMPP (Stage Kustom Anda)
        stage('Deploy to XAMPP') {
            when {
                // Hanya jalankan deployment jika semua stage di atas berhasil (success)
                expression { return currentBuild.result == null || currentBuild.result == 'SUCCESS' }
            }
            steps {
                echo 'Stage 5: Menyalin file ke folder XAMPP htdocs...'
                bat '''
                rmdir /S /Q C:\\xampp\\htdocs\\ksi2025
                xcopy /E /I /Y . C:\\xampp\\htdocs\\ksi2025
                '''
            }
        }
    } // Akhir dari stages

    // Post Actions: Pelaporan dan Pembersihan (Tugas 3)
    post {
        // Always: Selalu dijalankan, meskipun stage di atas gagal (untuk publikasi laporan)
        always {
            echo 'Mempublikasikan hasil pengujian ke Jenkins...'
            // Membaca file XML untuk menampilkan laporan tes secara grafis
            junit 'target/junit.xml' 
        }
        failure {
            echo 'Pipeline gagal. Periksa log eksekusi dan pastikan PHP, Composer, dan PHPUnit ada di PATH.'
        }
        success {
            echo 'SEMUA TUGAS CI/CD BERHASIL DISELESAIKAN! 🎉'
        }
    }
}
