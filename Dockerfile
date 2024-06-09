FROM jenkins/jenkins:lts-jdk17

ENV JAVA_OPTS -Djenkins.install.runSetupWizard=false

COPY plugins.txt /usr/share/jenkins/ref/plugins.txt
RUN  jenkins-plugin-cli -f /usr/share/jenkins/ref/plugins.txt

USER root

RUN apt-get update && apt-get install -y docker.io

USER jenkins