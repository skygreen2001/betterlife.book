# 调试工具

除了常规的echo方式外，betterlife还提供了许多协助调试的工具

## 调试板工具

  - DebugMe
    - 修改配置: $isShowDebug 打开关闭调试板
      ```
      /**
       * 是否显示调试板
       */
      public static $isShowDebug      = false;
      ```
    - 在开发中记录信息显示在调试板上
      ```
      DebugMe::info("Hello, Welcome to Betterlife!");
      ```
  - 使用了: [maximebf/debugbar](https://github.com/maximebf/php-debugbar)
    - [帮助文档](http://phpdebugbar.com/docs/)

## Docker开发调试应用

  - 使用调试工具: Xdebug
  - 主要用于在本地无法安装Xdebug的情况
  - 需要安装Docker工具
  - 使用开发工具: Visual Studio Code
    - 调试配置文件: .vscode/launch.json
  - 修改配置文件: install/docker/Dockerfile
    - 取消调试注释部分: debug with xdebug 
  - 在 Visual Studio Code 里开启调试模式


## Smarty调试配置

- 根路径下全局变量定义配置文件: Gc.php

  ```
  /**
   * 是否打开Smarty Debug Console窗口
   * @var bool
   * @static
   */
  public static $dev_smarty_on = true;
  ```
- 本框架页面主体使用Smarty开发，使用Smarty开发的页面可以使用该功能
- 使用其它如Twig模版引擎的无法使用该调试工具
- 默认关闭Smarty调试显示面板

## 性能优化调试配置

- 主要用于性能优化提供各阶段运行时间参数数据
- 默认关闭性能优化调试面板
- 根路径下全局变量定义配置文件: Gc.php

  ```
  /**
   * 是否要Profile网站性能
   * @var bool
   * @static
   */
  public static $dev_profile_on = false;
  ```