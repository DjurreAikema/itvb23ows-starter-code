FROM jenkins/jenkins:lts-jdk17

ENV JAVA_OPTS -Djenkins.install.runSetupWizard=false

COPY plugins.txt /usr/share/jenkins/ref/plugins.txt

RUN  jenkins-plugin-cli -f /usr/share/jenkins/ref/plugins.txt

USER root
RUN apt-get update \
    && apt-get install -y php-cli php-xml \
    && apt-get install -y php-mbstring\
    && apt-get install -y php-mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH="/usr/local/bin/composer/vendor/bin:${PATH}"
RUN composer global require phpunit/phpunit

WORKDIR /var/www/html
COPY src/composer.json composer.json
RUN composer install

USER jenkins