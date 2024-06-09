pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Checking out'
                checkout scm
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

        stage('Build') {
            steps {
                echo 'Building'
            }
        }

        stage('Test') {
            steps {
                echo 'Testing'
                sh 'php /var/www/html/vendor/bin/phpunit /var/www/html/tests --configuration /var/www/html/tests/phpunit.xml'
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
            sh 'docker-compose down'
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