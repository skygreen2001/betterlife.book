# 路由器处理

## 路由跳转

- 在全局配置文件Gc.php里:

  ```
  /**
   * URL访问模式,可选参数0、1、2、3,代表以下四种模式：<br/>
   * 0 (普通模式);<br/>
   * 1 (PATHINFO 模式); eg:<br/>
   * 2 (REWRITE  模式); 需要打开.htaccess里的注释行: RewriteEngine On;
   *                    eg: http://localhost/betterlife/betterlife/auth/login<br/>
   * 3 兼容模式(通过一个GET变量将PATHINFO传递给dispather，默认为s index.php?s=/module/action/id/1)<br/>
   * 当URL_DISPATCH_ON开启后有效; 默认为PATHINFO 模式，提供最好的用户体验和SEO支持
   * @var int
   * @static
   */
  public static $url_model=0;
  ```

## 控制器核心组成部分

  - 路由器
    * 路径   : core/main/
    * 文件名称: Router.php
    * 在这里定义了路由规则和各种Url改写转发。

  - 分发器
    * 路径   : core/main/
    * 文件名称: Dispatcher.php
    * 衔接从路由规则到显示指定页面的全过程
    * 在跳转控制文件core/main/Router.php里，集中控制了Action的前因后果的处理。

## 路由加密

路由路径可以进行加密，是防止攻击的一种手段

- 在页面中的超链接需要改写[自定义标签](../../original/customtag.md)
  - 从`<a href="跳转的链接地址">` 改为: `<my:a href="跳转的链接地址">`

- 修改文件配置:  taglib/taglib/TagHrefClass
  - 修改属性: $isMcrypt = true;
    ```
    /**
    * 是否加密
    * @var bool
    */
    public static $isMcrypt = false;
    ```
- 属性: $isMcrypt 默认是 false,即不进行加密
