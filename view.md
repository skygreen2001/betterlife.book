# 显示层

- 显示层默认使用PHP阵营最成熟的Smary框架
- 可以在Smarty模板引擎中显示页面tpl文件中直接使用以下通用的变量，它们定义在框架核心文件里：core/main/View.php
  * isDev        : 是否本地调试，同Gc::$dev_debug_on配置，如果域名为127.0.0.1、localhost、192.168.开头的设置为本地调试状态
  * url_base     : 网站根路径
  * site_name    : 网站应用的名称,展示给网站用户,一般为中文
  * appName      : 网站应用的名称,网站导航使用,一般为英文
  * template_url : 显示层所在路径，一般前台在home/web应用名/view/default/,后台在home/admin/view/default/
  * templateDir  : 显示层所在物理路径，一般用在smarty模板继承layout地方定义需要用到
  * upload_url   : 上传文件网络路径
  * uploadImg_url: 上传图片定义网络路径
  * encoding     : 网站字符编码,一般为UTF-8或者GBK

## 表示层实现

### 基本实现

- 框架在开发初期参考Thinkphp，实际整合了三套表示层框架，如下所示：
  - 模板: Smarty | Twig | PHPTemplate
    * Smarty
    * Twig
    * PHPTemplate

- 在实践中完整验证了Smarty和Twig的通用性，
- 在未来可能整合的表示层框架:
  - Blade Templates

- 已废弃使用的模版: 
  - SmartTemplate
  - EaseTemplate
  - TemplateLite
  - Flexy【HTML_Template_Flexy】
 
- 这些模版在框架中的实现可参考早期的框架，也可以直接移植过来: 
  - [betterlife.zero](https://github.com/skygreen2001/betterlife.zero)

### 表示层框架切换

- 表示层框架可从一种切换到另一种。
- 具体切换的方式示例放在前台显示下: home/betterlife/view/。
- 框架所有的应用模块表示层默认都使用smarty框架。
  - 所有应用模块的表示层默认全局配置在Gc.php(根路径下)，配置如下:
    ```
    ......

    /**
    * 模板模式
    * 
    * 本框架自带四种开源模板支持
    * 
    * - 1: Smarty
    * - 2: Twig
    * - 3: PHPTemplate
    * - 0: 不支持任何模板
    * 
    * 默认在这里指定支持其中一种；
    * 
    * 若在开发中需要用到多种模板技术,需在使用时通过View进行指定使用
    * 
    * 当模板为1:Smarty时，模板的标签写法参考/home/betterlife/view/default/core/blog/display.tpl
    * @var int
    * @static
    */
    public static $template_mode = 1; // View::TEMPLATE_MODE_TWIG;

    ......

    /**
    * 开发者自定义当前使用模板目录名
    * 
    * @example 示例:
    * 示例如下:
    * 
    *     D:\wamp\www\betterlife\home\betterlife\view\default
    * 
    *     default即自定义当前使用模板目录名
    * @var string
    * @static
    */
    public static $self_theme_dir = 'default';

    ......

    /**
    * 模板文件后缀名称
    * 
    * 一般为.tpl,.twig,.php,.html,.htm;
    * 
    * 一般不支持开源模板的时候，使用.php后缀名；即仍可以使用php语法；但不利于逻辑层和页面设计html代码分离
    * 
    * 模板文件一般通用tpl后缀；也有开源模板通常使用html或者htm后缀名；实际上后缀名为任何名称都可以
    * 
    * @var string
    * @static
    */
    public static $template_file_suffix = '.tpl';

    ```

- 前台显示默认配置在Gc.php(根路径下)，配置如下:

    ```
    ......

    /**
        * 每个模块可以定义自己的模板模式
        * 
        * 如果没有定义，则使用$template_mode默认定义的名称，一般都是1:Smarty
        * @var mixed
        */
    public static $template_mode_every = array(
        'betterlife' => 1,
    );

    ......

    /**
        * 每个模块可以定义自己显示的模板名
        * 
        * 如果没有定义，则使用$self_theme_dir默认定义的名称，一般都是default
        * 
        * @var mixed
        */
    public static $self_theme_dir_every = array(
        'betterlife' => 'bootstrap'
    );

    ......

    /**
        * 每个模块可以定义自己的模板后缀名
        * 
        * 如果没有定义，则使用$template_file_suffix默认定义的名称，一般都是.tpl
        * @var mixed
        */
    public static $template_file_suffix_every = array(
        'betterlife' => '.tpl',
    );

    ```

- 如果将表示层框架从smarty切换成twig
  - 修改根路径下的composer.json
    ```
    "require": {
        ......
        "twig/twig"          : "^2.0",
        ......

    ```
  - 需修改Gc.php(根路径下)，配置如下:
    ```
    ......

    /**
        * 每个模块可以定义自己的模板模式
        * 
        * 如果没有定义，则使用$template_mode默认定义的名称，一般都是1:Smarty
        * @var mixed
        */
    public static $template_mode_every = array(
        'betterlife' => 2,// View::TEMPLATE_MODE_TWIG
    );

    ......

    /**
        * 每个模块可以定义自己显示的模板名
        * 
        * 如果没有定义，则使用$self_theme_dir默认定义的名称，一般都是default
        * 
        * @var mixed
        */
    public static $self_theme_dir_every = array(
        'betterlife' => 'twig'
    );

    ......

    /**
        * 每个模块可以定义自己的模板后缀名
        * 
        * 如果没有定义，则使用$template_file_suffix默认定义的名称，一般都是.tpl
        * @var mixed
        */
    public static $template_file_suffix_every = array(
        'betterlife' => '.twig',
    );

    ```

## 显示层位置

### 后台管理: home/admin/view

  - 默认在default目录下

### 前台显示: home/betterlife/view/

  - 默认在bootstrap目录下
    ```
    /**
     * 每个模块可以定义自己显示的模板名
     * 如果没有定义，则使用$self_theme_dir默认定义的名称，一般都是default
     * @var mixed
     */
    public static $self_theme_dir_every=array(
        'betterlife'=>'bootstrap'
    );
    可通过设置Gc.php里的$self_theme_dir_every的bootstrap为default即可设置回默认default样式。
    public static $self_theme_dir_every=array(
        'betterlife'=>'default'
    );
    ```

### 通用模版显示:home/model/view/

  - 默认在default目录下


## 打开调试窗口

  - 如果在mvc框架中表示层使用了smarty框架,可在Gc.php文件里调整以下配置进行调试。

    ```
    /**
     * 是否打开Smarty Debug Console窗口
     * @var bool
     * @static
     */
    public static $dev_smarty_on = false;
    ```
