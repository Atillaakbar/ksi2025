pipeline {
    agent any

    stages {
        // Stage 1: Checkout (Otomasi Webhook)
        stage('Checkout Code') {
            steps {
                echo 'Stage 1: Mengambil kode dari GitHub...'
                checkout scm
            }
        }

        // Stage 2: Install Dependencies (Persiapan Tugas 3)
        stage('Install Dependencies') {
            steps {
                echo 'Stage 2: Menginstal dependensi PHP (Composer) dan PHPUnit...'
                bat 'composer install --no-dev' 
            }
        }
        
        // Stage 3: Run Unit Tests (Tugas 3)
        stage('Run Unit Tests') {
            steps {
                echo 'Stage 3: Menjalankan PHPUnit dan membuat laporan JUnit...'
                // Menggunakan 'bat' untuk eksekusi yang stabil di Windows
                bat 'php vendor/bin/phpunit tests --log-junit target/junit.xml' 
            }
        }
        
        // Stage 4: Execute PHP Script (Tugas 2)
        stage('Execute PHP Script') {
            steps {
                echo 'Stage 4: Menjalankan skrip PHP index.php...'
                bat 'php index.php' 
            }
        }
        
        // Stage 5: Deploy to XAMPP (Stage Kustom Anda)
        stage('Deploy to XAMPP') {
            when {
                // Hanya jalankan deployment jika semua stage di atas berhasil
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
    }

    // Post Actions: Pelaporan dan Penanganan Kegagalan (Tugas 3)
    post {
        // Always: Selalu dijalankan untuk publikasi laporan tes
        always {
            echo 'Mempublikasikan hasil pengujian ke Jenkins...'
            junit 'target/junit.xml' 
        }
        success {
            echo 'SEMUA TUGAS CI/CD BERHASIL DIVERIFIKASI! 🎉'
        }
        failure {
            echo 'Pipeline gagal. Periksa log eksekusi untuk detail error tes.'
        }
    }
}
