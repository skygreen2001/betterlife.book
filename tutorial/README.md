# 制作帮助、教程的框架

## 安装前提

- Node.js (Should be at least nodejs 6.9)
- Git
- PHP 7.1.3 以上


## 升级PHP
  ```
    sudo add-apt-repository ppa:ondrej/php
    sudo apt-get update
    sudo apt-get upgrade php
    sudo apt-get install php7.3-fpm
    sudo apt install php7.3-curl php7.3-gd php7.3-mysql php7.3-mbstring php7.3-zip php7.3-xml php7.3-mysqli php7.3-cli
    a2enmod proxy_fcgi setenvif
    a2enconf php7.3-fpm
    service php7.3-fpm restart
  ```

## 升级Composer
  ```
    apt remove composer
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    php composer-setup.php --install-dir=/usr/bin/
  ```

## 安装Grav
  ```
    git clone https://github.com/getgrav/grav.git tutorial
    composer install --no-dev -o
    bin/grav install
    bin/gpm install admin
  ```

## 初始化配置
  - Webserver 配置: https://github.com/getgrav/grav/tree/master/webserver-configs
  - 安装主题: Themes: Editorial
  - 修改样式: 在根路径相对路径下: tutorial/user/themes/editorial/css/custom.css
  - 切换中文: Admin(administrator) -> Language -> 中文(简体)(cn)
  - 设置中文: 设置 -> 语言 -> 已支持: zh
  - 修改php配置文件配置: upload_max_filesize = 50M (默认2M)
    ```
      vi /etc/php/7.3/fpm/php.ini
      service php7.3-fpm restart
      nginx -s reload
    ```

## 安装gitbook-cli
  ```
    cd help
    mkdir tutorial
    npm install -g gitbook-cli
    gitbook build
    gitbook serve
  ```
  - 遇到问题，重装gitbook
    ```
      npm cache clean -f
      npm install n stable -g
      npm cache clean -f
      rm -rf ~/.gitbook/*
      npm install gitbook-cli -g

## 初始化gitbook配置文件

  - [参考book.json](https://github.com/zhangjikai/gitbook-use/blob/master/book.json)
  ```
    gitbook install
  ```
## 高级定制

  - 结合Grav整合生成帮助|教程系统
  - [文件夹:php](php/)

## 参考资料

- [Grav](https://getgrav.org/)  
- [Learn Grav](https://learn.getgrav.org/)
- [Grav Permissions](https://learn.getgrav.org/16/troubleshooting/permissions)
- [Grav Deploy Config](https://github.com/getgrav/grav/tree/master/webserver-configs)

- [gitbook-cli](https://github.com/GitbookIO/gitbook-cli)
- [Setup and Installation of GitBook](https://github.com/GitbookIO/gitbook/blob/master/docs/setup.md)
- [GitBook 简明教程](http://www.chengweiyang.cn/gitbook/index.html)
- [记录GitBook的一些配置及插件信息](https://github.com/zhangjikai/gitbook-use/)(http://gitbook.zhangjikai.com/)
- [docsifyjs](https://github.com/docsifyjs/docsify)
- [hexo](https://hexo.io/)
- [PHP / PHP-FPM 7.2.9 Released — Here’s How To Install / Upgrade On Ubuntu 16.04 / 18.04](https://websiteforstudents.com/php-php-fpm-7-2-9-releaed-heres-how-to-install-upgrade-on-ubuntu-16-04-18-04/)
