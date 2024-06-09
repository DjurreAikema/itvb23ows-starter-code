pipeline {
    agent { label '!windows' }

    stages {
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
                dir("src") {
                    sh 'docker-compose -f docker-compose.yml run --rm php sh -c "cd /var/www/html && composer update && ./vendor/bin/phpunit tests"'
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