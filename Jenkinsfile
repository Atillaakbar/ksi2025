pipeline {
    // Menentukan agen yang akan menjalankan pipeline
    agent any

    stages {
        // Stage 1: Checkout Code (Memastikan Webhook berfungsi)
        stage('Checkout Code') {
            steps {
                echo 'Stage 1: Mengambil kode dari GitHub...'
                checkout scm
            }
        }

        // Stage 2: Instalasi Dependensi (Persiapan Unit Test)
        stage('Install Dependencies') {
            steps {
                echo 'Stage 2: Menginstal dependensi PHP (Composer) dan PHPUnit...'
                powershell 'composer install --no-dev' 
            }
        }
        
        // Stage 3: Menjalankan Unit Test (Tugas 3)
        stage('Run Unit Tests') {
    steps {
        echo 'Stage 3: Menjalankan PHPUnit dan membuat laporan JUnit...'
        // Mengganti .\\ menjadi ./ (forward slash) untuk kompatibilitas yang lebih baik
        powershell 'php ./vendor/bin/phpunit tests --log-junit target/junit.xml' 
    }
}
        
        // Stage 4: Eksekusi Kode PHP (Tugas 2)
       stage('Execute PHP Script') {
    steps {
        echo 'Stage 4: Menjalankan powershell php index.php...'
        // Mengganti .\\ menjadi ./ (forward slash)
        powershell 'php ./index.php' 
    }
}
        
        // Stage 5: Deployment ke XAMPP (Stage Kustom Anda)
        stage('Deploy to XAMPP') {
            when {
                // Deployment hanya dijalankan jika semua stage di atas berhasil
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

    // Post Actions: Pelaporan dan Penanganan Kegagalan
    post {
        // Selalu dijalankan untuk publikasi laporan tes
        always {
            echo 'Mempublikasikan hasil pengujian ke Jenkins...'
            junit 'target/junit.xml' 
        }
        success {
            echo 'SEMUA TUGAS CI/CD BERHASIL DISELESAIKAN! 🎉'
        }
        failure {
            echo 'Pipeline gagal. Periksa log eksekusi untuk detail error tes atau eksekusi.'
        }
    }
}
