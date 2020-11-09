FROM php:7.4-fpm

# Аргументы принимающие из docker-compose.yml
ARG user
ARG uid

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    mc \
    nano \
    vim \
    libmagickwand-dev \
    imagemagick \
    zlib1g-dev \
    libzip-dev \
    unzip \
    zsh \
    mariadb-client \
    git


RUN curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh
RUN bash ./nodesource_setup.sh
RUN rm ./nodesource_setup.sh
RUN apt install nodejs -y

# Очистка кэша apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка расширений php
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis


# Xdebug
RUN pecl install xdebug
COPY ./docker/conf/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Image Magick
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

# Последний композер
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создание системного пользователя
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# zsh & nano
RUN su $user -c "git clone --depth=1 https://github.com/romkatv/powerlevel10k.git ~/powerlevel10k"
RUN su -l $user -c "curl https://gist.githubusercontent.com/pavel-one/30e918532947b5a17eea7c1f31651ae9/raw/37f6bbba2ac07c87335f784fdef6807a8b8a78c6/.zshrc >> ~/.zshrc"
RUN su -l $user -c "curl https://gist.githubusercontent.com/pavel-one/04b8130e249388bc3d621830a1b4945d/raw/ca2f511a9cfa99ce77310ecba466697732f50b63/.p10k.zsh >> ~/.p10k.zsh"
RUN su -l $user -c "echo 'include /usr/share/nano/*.nanorc' >> ~/.nanorc"
RUN su -l $user -c "echo 'set constantshow' >> ~/.nanorc"
RUN su -l $user -c "echo 'set linenumbers' >> ~/.nanorc"
RUN su -l $user -c "git clone https://github.com/zsh-users/zsh-syntax-highlighting.git ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-syntax-highlighting"
RUN su -l $user -c "git clone https://github.com/zsh-users/zsh-autosuggestions ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-autosuggestions"

# Установка рабочей директории
WORKDIR /var/www

USER $user