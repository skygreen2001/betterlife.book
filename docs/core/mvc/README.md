# 框架MVC

## 概述

- 框架设计之初主要关注于Web网站开发，因此采用标准的MVC模式定义了整个网站的结构；
- 规划设计大量借鉴了Java阵营中Spring+Hibernate+Struts的优秀设计，并基于实用简化的原则对其进行了调整完善。

## 导航规则

### url规则

* url形式如: http://www.bb.com/betterlife/index.php?go=betterlife.auth.login
* 与导航规则相关的url参数是: go=betterlife.auth.login
* 这段参数定义: go=模块名.控制器名称.表示层页面名称
* 因此go=betterlife.auth.login意义是:
  - 模块名:betterlife, 代表根路径下目录: home/betterlife
    - 模块名定义中的home, 是默认固定定义的, 参考根路径下Gc.php里变量: $module_root, 可自定义修改
    - 模块名定义betterlife, 参考根路径下Gc.php里变量: $$module_names, 在home目录下的模块需要都在这里定义，才能通过url进行访问。
  - 控制器名称: auth, 代表控制器类: Action_Auth, 在目录: home/betterlife/action/Action_Auth.php
  - 表示层页面名称: login, 代表页面login.tpl, 在目录: home/betterlife/view/bootstrap/core/auth/
    - 对应控制器类:Action_Auth 里的方法: public function login()
    - 对应目录: home/betterlife/view/bootstrap/core/控制器名称/
    - 对应目录里bootstrap定义: 模版名称, 参考根路径下Gc.php里变量: $self_theme_dir 和 $self_theme_dir_every
    - 表示层的布局页面在目录:  home/betterlife/view/bootstrap/layout

### 导航的核心逻辑控制

* 路径   : core/main/
* 文件名称: Router.php

## 层级关系

* domain : 实体类,数据对象层,所有层都可以使用它;
* service: 服务类,业务逻辑层。
* action : 控制器层,也有定义为controller的。
* view   : 显示页面,表示层;包括html,js,css,images等资源文件

- 常规的调用关系如下:
  - domain <- service <- action <- view

- 在使用框架之初,因为业务逻辑比较简单,更常用的调用关系如下:
  - domain <- action <- view

- 在框架的示例前台应用中,一般都采用这种方式实现
- 一般来讲，它已经足够解决比较复杂的问题了，service实在多余
- 在常规的Web应用开发中,service层的设计并未大量投入使用
