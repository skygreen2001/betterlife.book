# 在Linux上安装LAMP

以下在Ubuntu Desktop 和Ubuntu Server上均有效

## 安装Lamp

  - [安装升级]
    
    apt-get update

  - [安装Apache＋php＋mysql]

    sudo apt-get install php7 mysql-server apache2

  - [安装php_curl]

    sudo apt-get install curl libcurl3 libcurl3-dev php7-curl

## 运行Lamp

1. 修改配置文件: sudo vi /etc/apache2/apache2.conf

   * 在文件里添加一行:ServerName 1.1.1.1 [域名对应的ip地址]
   * 说明：如果不添加这一行，启动Apache的时候会提示:

      ```
      apache2: Could not reliably determine the server's fully qualified domain name, using 10.241.42.221 for ServerName

      ... waiting apache2: Could not reliably determine the server's fully qualified domain name, using 10.241.42.221 for ServerName
      ```

   * 修改主机名称

     - vi /etc/hostname
     - 修改成新主机名后，执行命令:hostname 新主机名

   * 允许服务器访问外网
     - vi /etc/resolv.conf
     - 添加  nameserver 8.8.8.8
     - service networking restart

2. 启动apache

    - service apache2 restart

3. 启动mysql

    - service mysql restart

4. 在/var/www下添加phpinfo.php查看phpinfo信息[该文件正式上线应去除]
    - phpinfo.php 内容如下:

      ```
      <?php
          phpinfo();

      ```
    - 也可以在命令行里运行, 效果和网页里的`phpinfo()`一样

      ```
      php -i
      ```