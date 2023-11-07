# 新手上路

符合中国开发者思维方式的快速开发的框架，设计初衷快捷、简单、实用。

它包括一套实用的通用模版、后台管理模版、手机模版，并根据项目的需要，按照数据库的设计一键生成定制化的代码框架。

它自定义了一套快速开发报表的工具、Redis管理工具、数据库运维工具以协助快速开发。

## 帮助文档

  * [学习手册](https://skygreen2001.github.io)

## 一. 下载源码

  * [下载地址](https://github.com/skygreen2001/betterlife)

* **Git安装**

  - 下载Git
    - Git SCM  : https://git-scm.com/downloads
    - Bitbucket: https://www.atlassian.com/git/tutorials/install-git
    - Git大全   : https://gitee.com/all-about-git

  - 下载betterlife 

      ```
      > git clone https://gitee.com/skygreen2015/betterlife
      或
      > git clone https://github.com/skygreen2001/betterlife.git
      或
      > git clone https://github.com.cnpmjs.org/skygreen2001/betterlife
      ```

  - 安装Git客户端工具

    - [sourcetree](http://www.sourcetreeapp.com)
    - [GitKraken](https://www.gitkraken.com/)
    - [GitHub Desktop](https://desktop.github.com/)
    - [tortoiseGit](http://baoku.360.cn/soft/show/appid/102345451)

* **Docker安装**

  - [下载 Docker](https://docs.docker.com/get-docker/)
  - 下载betterlife

    ```
    > docker run -ti --rm -v ${HOME}:/root -v $(pwd):/git alpine/git clone https://gitee.com/skygreen2015/betterlife
    或
    > docker run -ti --rm -v ${HOME}:/root -v $(pwd):/git alpine/git clone https://github.com/skygreen2001/betterlife.git
    或
    > docker run -ti --rm -v ${HOME}:/root -v $(pwd):/git alpine/git clone https://github.com.cnpmjs.org/skygreen2001/betterlife
    ```

* **Composer安装**

  - 下载betterlife

    ```
    > composer create-project skygreen2001/betterlife betterlife
    ```

## 二. 通常安装

### 1. 安装运行环境

  以下工具任选一种即可

  - [ampps](http://www.ampps.com)

    可以直接在它上面下载安装(Wamp|Lamp|Mamp)

  - [Xampp](https://www.apachefriends.org/zh_cn/index.html)

    XAMPP是完全免费且易于安装的Apache发行版，其中包含MariaDB、PHP和Perl。

  - [Wamp](http://www.wampserver.com/en/)

    Windows下的Apache + Mysql + PHP
    [PhpStudy]: http://www.phpstudy.net/

  - [Lamp](https://lamp.sh/)

    LAMP指的Linux、Apache，MySQL和PHP的第一个字母
    [安装详细说明]: http://blog.csdn.net/skygreen_2001/article/details/19912159

  - [Mamp](http://www.mamp.info/en/)

    Mac环境下搭建 Apache/Nginx、MySQL、Perl/PHP/Python 平台。

  - [Laravel Valet](https://laravel.com/docs/8.x/valet) 
    - [Valet中文文档](https://learnku.com/docs/laravel/8.5/valet/)

  - [宝塔](https://www.bt.cn/)

  - [PhpStudy](https://www.xp.cn/)

  - 本地运行PHP server: php -S localhost:8000)

### 2. 安装须知

  - [PHP安装检查](../deploy/README.md)

### 3. 其它安装

  - [安装PHP第三方库和UEditor](../core/install/other_install.md)
    - 安装PHP第三方库主要是用composer
    - 后台【admin】在线编辑器使用百度的UEditor组件，需按该文档说明进行安装。

  - [安装示例数据库]
    - 新建Mysql数据库:betterlife, 运行脚本: install/db/mysql/db_betterlife.sql
      - 如果是Wamp,一般自带了Phpmyadmin，也可以安装Mysql数据库工具客户端如MysqlWorkbench、Sequel Pro或者Navicat等
      - 如果是Lamp或者Mamp需要另行安装Phpmyadmin
    - 示例数据库的具体定义说明可参考: [框架数据库示例](../core/database/example.md)

## 三. Docker安装

- 这是[二. 通常安装](README.md#二-通常安装)的替代方案
- 如果开发者熟悉Docker或者希望尝试通过Docker搭建开发环境(无需考虑因为操作系统，无法完整搭建应用运行环境，如在Mac操作系统下，因为权限问题无法安装php的zip或者redis，Mac Monterey版本后不再默认安装PHP), 可使用Docker安装

* **安装Docker**

  - [Get Docker](https://docs.docker.com/get-docker/)

* **Docker帮助文档**

  - [帮助文档](../core/install/docker/README.md)

* **Docker 运行应用**

  - 根路径下运行以下指令执行操作
  - 创建运行: docker-compose up -d
  - 运行应用: docker-compose start
  - 停止应用: docker-compose stop
  - 进入应用: docker exec -it bb /bin/bash

  - 删除所有的容器: docker-compose down
  - 删除生成的镜像: docker rmi bb_nginx bb mysql:5.7
  
* **安装后需知**

  - [需知说明](../core/install/docker/SETUP.md)

* **云平台**

  - [阿里云](https://market.aliyun.com/developer)
  - [Heroku](https://devcenter.heroku.com/categories/php)
  - [vagrant](https://app.vagrantup.com/laravel/boxes/homestead-7)

## 四. 安装开发工具

* [Visual Studio Code](https://code.visualstudio.com/)
* [Atom](https://atom.io)
* [Atom IDE](https://ide.atom.io/)
* [Sublime](http://www.sublimetext.com)
* [CodeLobster](https://www.codelobster.com)

## 五. 一步上手

  - 在一个php文件里只需要一步,就可以使用这个框架带来的好处了

    * 引用init.php文件(如果在根路径下)
      - 示例: 如果文件在根路径下引用: require_once("init.php");

## 六. 开始使用

  现在可以使用这个框架了,如果习惯了sql的写法，可以通过直接使用函数:`sqlExecute`

  例如:希望查看所有的博客记录

  传统的sql语句:select * from bb_core_blog

  完整的示例代码如下:

  ```
  <?php
  require_once("init.php");
  $blogs = sqlExecute("select * from bb_core_blog");
  print_r($blogs);
  ```

  输出打印显示如下:

  ```
  Array
  (
      [0] => Array
          (
              [blog_id] => 1
              [user_id] => 1
              [blog_name] => Web在线编辑器
              [blog_content] => 搜索关键字：在线编辑器
  引自：<a href="http://paranimage.com/22-online-web-editor/" target="\_blank">http://paranimage.com/22-online-web-editor/</a>
              [commitTime] => 1331953386
              [updateTime] => 2013-12-26 15:27:05
          )
      ......

  )
  ```

## 七. 面向对象

  参考: [数据对象通用方法](../core/dataobject/normalmethod.md)

  以类方法: 分页查询queryPage为例

  ```
  $blogs = Blog::queryPage(0,10);
  print_r($blogs);
  ```

  输出打印显示如下:

  ```
  Array
  (
      [0] => Blog Object
          (
              [blog_id] => 1
              [user_id] => 1
              [blog_name] => Web在线编辑器
              [blog_content] => 搜索关键字：在线编辑器
  引自：<a href="http://paranimage.com/22-online-web-editor/" target="\_blank">http://paranimage.com/22-online-web-editor/</a>
              [id:protected] =>
              [commitTime] => 1331953386
              [updateTime] => 2013-12-26 15:27:05
          )
      .....

  )
  ```

## 八. 工程重用

  **项目重用侧重于对已有功能模块、数据库表和代码的重用**

  项目重用即工程重用,是同一个功能的两种说法。

  前面我们掌握了这个框架最基础的概念,接下来我们关注的是怎样根据自己项目的需要,快速搭建一个项目的框架;

  - 工程重用可通过访问框架本地首页地址: http://127.0.0.1/betterlife/

  - 下方应有以下文字链接: 工程重用 | 数据库说明书 | 代码生成器 | 报表生成器 | 工具箱 | 帮助;

  - 点击其中的文字链接:工程重用

  - 工程重用链接地址: http://127.0.0.1/betterlife/tools/dev/index.php

  - 根据自己项目的需求修改相关项目配置:
    * Web项目名称【中文】
    * Web项目名称【英文】
    * Web项目别名
    * 输出Web项目路径
    * 数据库名称
    * 数据库表名前缀
    * 帮助地址
    * 重用类型

  - 假设我们需要创建一个新的项目:bettercity

  - 它的定义如下:
    * Web项目名称【中文】:美好的城市-上海
    * Web项目名称【英文】:bettercity
    * Web项目别名        :Bc
    * 输出Web项目路径    :bettercity
    * 数据库名称         :bettercity
    * 数据库表名前缀     :bc_
    * 帮助地址           :默认的值,不变
    * 重用类型           :通用版

## 九. 代码生成

  **代码生成侧重于对新增功能模块、数据库表和代码的快速上手使用**

  在新生成的项目里:bettercity

  * 如果新项目的业务逻辑和主流程大致相同, 那么可以考虑重用现有的数据库, 使用[数据库定义的小工具](../core/database/databasetools.md)里的工具[修改数据库表前缀名]

    - 访问地址:http://127.0.0.1/bettercity/tools/tools/db/rename_db_prefix.php

  * 如果新项目的业务逻辑和原项目的主流程不同, 可以按照[2.数据库原型设计规范]定义数据库

  * 在完成了新项目的数据库设计之后, 就可以使用代码生成工具生成新项目的通用代码。

  * 代码生成可通过访问框架本地首页地址: http://127.0.0.1/bettercity/

  * 下方应有以下文字链接: 工程重用 | 数据库说明书 | 代码生成器 | 报表生成器 | 工具箱 | 帮助;
  * 点击其中的文字链接: 代码生成器 

  * 一键生成链接地址:http://127.0.0.1/bettercity/tools/tools/autocode/db_onekey.php

## 十. 工作流定义

### 1. 工具定义

  * 数据库原型设计: MysqlWorkBench
  * 代码原型     : Betterlife框架的代码生成工具

  * 页面原型设计    : Axure      [Visio]
  * 设计图到静态页面 : Dreamweaver | Visual Studio Code | Sublime | Atom

  * 中间件服务器: nginx | Apache
  * 部署工具   : Wamp ｜ Lamp ｜ Mamp | ampps | Xampp
  * 开发语言   : Php
  * 数据库     : Mysql

### 2. 流程定义

  1. 数据层: MysqlWorkBench -> Mysql -> Betterlife框架的代码生成工具 -> 生成前端和后台代码
  2. 表示层: Axure -> Dreamweaver | Visual Studio Code | Sublime | Atom -> 静态标准Html页面
  3. 逻辑层: 整合数据层 <=> 表示层[模板：Smarty | twig]

## 十一. 部署

* [部署说明](../deploy/README.md)

### 1. 推荐Web服务器

* [使用 nginx](../deploy/nginx.md)

### 2. 在Linux上安装LAMP

* [部署Lamp](../deploy/lamp.md)

## 参考资料

  - [帮助文档源码](https://github.com/skygreen2001/betterlife.book)
