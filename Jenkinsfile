pipeline {
    agent any

    stages {
        stage('Test') {
            steps {
                script {
                    // Define the Docker image name
                    def imageName = "itvb23ows-starter-code-php:latest"

                    // Build the Docker image
//                     docker.build(imageName, 'src/')

                    // Run the Docker container
                    docker.image(imageName).inside {
                        // Commands to run inside the container
                        sh 'chmod +x /var/www/html/vendor/bin/phpunit && /var/www/html/vendor/bin/phpunit /var/www/html/'
                    }
                }
            }
        }

        stage('SonarQube') {
            steps {
                script { scannerHome = tool 'ows_sonar' }
                withSonarQubeEnv(installationName: 'sq1') {
                    sh "${scannerHome}/bin/sonar-scanner \
                    -D sonar.projectKey=sq1 \
                    -D sonar.host.url=http://sonarqube:9000/"
                }
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying'
            }
        }
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