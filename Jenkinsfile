pipeline {
    agent {
        docker {
            image 'docker:latest'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }

    environment {
        DOCKER_COMPOSE_VERSION = '1.29.2'
    }

    stages {
        stage('Setup Docker Compose') {
            steps {
                script {
                    // Check if docker-compose is installed
                    sh 'docker-compose --version || curl -L "https://github.com/docker/compose/releases/download/$DOCKER_COMPOSE_VERSION/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose && chmod +x /usr/local/bin/docker-compose'
                }
            }
        }
        stage('Install Dependencies') {
            steps {
                sh 'docker-compose run --rm php composer install'
            }
        }
        stage('Run PHPUnit Tests') {
            steps {
                sh 'docker-compose run --rm php vendor/bin/phpunit'
            }
        }
//         stage('SonarQube') {
//             steps {
//                 script { scannerHome = tool 'ows_sonar' }
//                 withSonarQubeEnv(installationName: 'sq1') {
//                     sh "${scannerHome}/bin/sonar-scanner \
//                     -D sonar.projectKey=sq1 \
//                     -D sonar.host.url=http://sonarqube:9000/"
//                 }
//             }
//         }
//
//         stage('Build') {
//             steps {
//                 echo 'Building'
//                 sh 'docker-compose run --rm php composer install'
//             }
//         }
//
//         stage('Test') {
//             steps {
//                 echo 'Testing'
//                 sh 'docker-compose run --rm php vendor/bin/phpunit /var/www/html/Tests'
//             }
//         }
//
//         stage('Deploy') {
//             steps {
//                 echo 'Deploying'
//             }
//         }
    }

    post {
        always {
            echo 'This will always run'
        }
        success {
            echo 'This will run only if successful'
        }
        failure {
            echo 'This will run only if failed'
        }
        unstable {
            echo 'This will run only if the run was marked as unstable'
        }
        changed {
            echo 'This will run only if the state of the Pipeline has changed'
            echo 'For example, if the Pipeline was previously failing but is now successful'
        }
    }
}