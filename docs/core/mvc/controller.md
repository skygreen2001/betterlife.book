# 控制器层

## 所有控制器父类

* 路径   :core/model/

* 文件名称: ActionBasic.php

* github路径:  [https://github.com/skygreen2001/betterlife/blob/master/core/model/ActionBasic.php](https://github.com/skygreen2001/betterlife/blob/master/core/model/ActionBasic.php)

* 每个控制器都继承自它，它是所有控制器的父类；规范要求：所有控制器要求的前缀:Action_;

* 在Action所有的方法执行之前可以执行的方法: beforeAction
  * 示例: 所有网站的head部分的title和description赋值
    ```php
    $this->keywords    = Gc::$site_name;
    $this->description = Gc::$site_name;
    ```

  * 示例: Action的变量可以被覆盖重载，如来自前端的控制器文件: home/betterlife/action/Action_Blog.php
    ```php
    $this->keywords    .= "-博客";
    $this->description .= "-显示博客列表";
    ```

* 在Action所有的方法执行之后可以执行的方法: afterAction
  * 示例: 所有网站的head部分的title和description显示在页面的变量里
    ```php
      $this->view->set( "keywords", $this->keywords );
      $this->view->set( "description", $this->description );
    ```
  * 示例页面在文件: home/betterlife/view/default/layout/normal/header.tpl
    ```html
    <meta name="keywords" content="{$keywords}" />
    <meta name="description" content="{$description}" />
    ```

* 可供选择的集成在线编辑器:

  * CKEditor
  * KindEditor
  * xhEditor
  * UEditor

* 默认集成在线编辑器:UEditor

## 前台控制器父类

* 路径   : home/betterlife/action/
* 文件名称: Action.php
* 父类   : ActionBasic.php

## 后台控制器父类

* 路径   : home/admin/action/
* 文件名称: ActionAdmin.php
* 父类   : ActionBasic.php

## 通用模版控制器父类

* 路径   : home/model/action/
* 文件名称: ActionModel.php
* 父类   : ActionBasic.php

## 报表控制器父类

* 路径   : home/report/action/
* 文件名称: ActionReport.php
* 父类   : ActionBasic.php

## 控制器常用变量

* 控制器默认属性: data
  * 前端请求的变量都汇总到这个变量下
  * $this->data = $_GET 和 $_POST的变量的合并;
  * 代码示例如下:
    
    - 如url: http://localhost/betterlife/index.php?go=admin.blog.view&id=3

    ```php
    $blog_id = @$this->data["id"]; 
    ```

* 控制器默认属性: view
  * 所有Web应用模块下的控制器都遵循这个规则，拥有这个变量
  * 所有需要显示到页面的数据变量都应该挂在它下面
  * 显示层的变量可以用set方法: $this->view->set( $var, $value )赋值
  * 代码示例来自: core/model/Action_Basic.php

    ```php
    $this->view->set( "keywords", $this->keywords );
    $this->view->set( "description", $this->description );
    ```
  * 显示层的变量可以用属性: $this->view->{ $var } = $value 赋值
  * 代码示例来自: home/betterlife/action/Action_Blog.php

    ```php
    $this->view->message = "博客提交成功";
    $this->view->color   = "green";
    ```

    ```html
    ......
      <font color="{$color}">{$message|nl2br|default:''}</font>
    ......
    ```

## 控制器定义表示层对象

* 控制器默认属性: viewObject
* 该属性挂在控制器默认属性: view 下
* 在控制器类里可以定义表示层显示对象类继承自ViewObject
* 表示层显示对象可以直接输出显示
* 表示层对象方法需挂在在显示层页面里应挂在该对象变量下
* 代码示例来自: home/betterlife/action/Action_Blog.php

  ```php
  <?php

  class Action_Blog extends Action
  {

      ......

      public function display()
      {
          ......

          $view                   = new View_Blog($this);
          $view->blogs            = $blogs;
          $view->countBlogs       = $count;
          $this->view->viewObject = $view;
      }
  }

  /**
   *  Blog表示层对象
   */
  class View_Blog extends ViewObject
  {
      public $blog;
      public $blogs;
      public $countBlogs;
      public function count_comments($blog_id) {
          return Comment::count( "blog_id=" . $blog_id );
      }
  }
  ```

  ```html
  ......
      <b>共计{$countBlogs} 篇博客</b>
      {if $blogs}
      {foreach item=blog from=$blogs}
      <div id='blog{$blog.blog_id}' class="block">
          ......
          评论数:{$viewObject->count_comments($blog.blog_id)}<br/>
      </div>

  ......
  ```

## 控制器常用方法

* 加载通用的Javascript库: loadJs
  * 调用示例: $this->loadJs( "js/edit.js" );
  * 一般js文件引用是在文件里完成的，框架也提供了在控制器里引用Js文件的功能
  * 定义:
    ```php
    /**
     * 加载通用的Javascript库
     * 
     * 默认:当前模板目录下:js/index.js
     * 
     * @param string $defaultJsFile 默认需加载JS文件
     */
    public function loadJs($defaultJsFile = "js/index.js")
    ```
  * 页面引用一般放在文件: home/{module}/view/{theme_dir}/layout/normal/layout.tpl
    * 如module前端theme是default  : home/betterlife/view/default/layout/normal/layout.tpl
    * 如module前端theme是bootstrap: home/betterlife/view/bootstrap/layout/normal/layout.tpl
    * 如module后端theme是default  : home/admin/view/default/layout/normal/layout.tpl
    * 页面引用示例:
      ```html
      <!DOCTYPE html>
      <html lang="zh-CN" id="index">
        <head>
        ......
        {$viewObject->js_ready|default:""}
      </head>
      ```
    * 也可以根据需要在页面的最后引用，需注意这是全局的，即所有页面都会因用它；
    * 示例在文件: home/admin/view/default/layout/normal/layout.tpl
      ```html
      <!DOCTYPE html>
      <html lang="zh-CN" id="index">
        <head>
        ......
      </head>
      <body>
        ......
        {$viewObject->js_ready|default:""}
      </body>
    </html>
      ```

* 加载通用的Css文件: loadJs
  * 调用示例: $this->loadCss( "resources/css/edit.css" );
  * 一般css文件引用是在文件里完成的，框架也提供了在控制器里引用css文件的功能
  * 定义:
    ```php
    /**
     * 加载通用的Css
     * 
     * 默认:当前模板目录下:resources/css/index.css
     * @param string $defaultCssFile 引用的css文件
     * @return void
     */
    public function loadCss($defaultCssFile = "resources/css/index.css")
    ```
  * 页面引用一般放在文件: home/{module}/view/{theme_dir}/layout/normal/layout.tpl
    * 如module前端theme是default  : home/betterlife/view/default/layout/normal/layout.tpl
    * 如module前端theme是bootstrap: home/betterlife/view/bootstrap/layout/normal/layout.tpl
    * 如module后端theme是default  : home/admin/view/default/layout/normal/layout.tpl
    * 页面引用示例:
      ```html
      <!DOCTYPE html>
      <html lang="zh-CN" id="index">
        <head>
        ......
        {$viewObject->css_ready|default:""}
      </head>
      ```

* 加载在线编辑器: load_onlineditor
  * 调用示例: $this->load_onlineditor( "blog_content" );
  * 定义:
    ```php
    /**
     * 加载在线编辑器
     * @param array|string $textarea_ids Input为Textarea的名称name[一个页面可以有多个Textarea]
     * @return void
     */
    public function load_onlineditor($textarea_ids = "content")
    ```
  * 该方法应配合页面使用
  * 页面示例:
    ```php
    {if ($online_editor == 'UEditor')}
        <script>
          $(function(){
            if( typeof UE != 'undefined' ) {
              pageInit_ue_blog_content();
            
              // 在线编辑器设置默认样式
              ue_blog_content.ready(function(){
          
                  UE.dom.domUtils.setStyles(ue_blog_content.body, {
                      'background-color': '#4caf50','color': '#fff','font-family' : "'Microsoft Yahei','Helvetica Neue', Helvetica, STHeiTi, Arial, sans-serif", 'font-size' : '16px'
                  });
                
              });
            }
          });
        </script>
    {/if}
    ```
  * 在[数据库原型设计规范](../database/README.md)中定义的[大数据, 需TextArea输入大文本列定义规则]，可用[代码生成器](../../ace/autocode/README.md)自动生成所有代码。

* 上传图片文件: uploadImg
  * 调用示例: 
    ```php
    $result = $this->uploadImg($_FILES, "icon_url", "icon_url", "blog");
    $this->uploadImg($_FILES, "icon_url", "subdir", "test.png");
    ```
  * 定义:
    ```php
    /**
     * 上传图片文件
     * @param array  $files 上传的文件对象
     * @param string $uploadFlag 上传标识,上传文件的input组件的名称
     * @param string $upload_dir 上传文件存储的所在目录[最后一级目录，一般对应图片列名称]
     * @param string $defaultId 上传文件所在的目录标识，一般为类实例名称; 如果包含有 . 则为指定文件名, 文件名后缀名会自动修改为上传文件的后缀名.
     * @param int    $file_permit_upload_size 允许上传的文件尺寸大小: 默认10M
     * @param boolean $is_permit_same_filename 是否允许用同一个名字
     * @return array 图片存储路径等信息
     * 
     *   - 返回数组key定义
     *     - success  : 是否操作成功
     *     - file_name: 文件存储根路径upload/images的相对路径 
     * 
     * @Example
     *     - $this->uploadImg($_FILES, "icon_url", "icon_url", "blog");
     * 
     *       [说明] 生成的图片会是 images/blog/icon_url/201806011225.png  类似的路径
     * 
     *     - $this->uploadImg($_FILES, "icon_url", "subdir", "test.png");
     * 
     *       [说明] 生成的图片会是 images/subdir/test.png  类似的路径
     * 
     *             如果上传文件为jpg后缀名，则会是 images/subdir/test.jpg  类似的路径
     */
    public function uploadImg($files, $uploadFlag, $upload_dir, $defaultId = "default", $file_permit_upload_size = 10, $is_permit_same_filename = false) 

    ```

* 上传多个图片文件: uploadImg
  * 调用示例: 
    ```php
    $result = $this->uploadImgs($_FILES, "icon_url", "icon_url", "blog");
    $this->uploadImg($_FILES, "icon_url", "subdir", "test.png");
    ```
  * 定义:
    ```php
    /**
     * 上传多个图片文件
     * @param array $files 上传多个文件的对象
     * @param array $uploadFlag 上传标识,上传文件的input组件的名称
     * @param array $upload_dir 上传文件存储的所在目录[最后一级目录，一般对应图片列名称]
     * @param array $defaultId 上传文件所在的目录标识，一般为类实例名称; 如果包含有 . 则为指定文件名, 文件名后缀名会自动修改为上传文件的后缀名.
     * @param array $isReturnAll 是否返回所有值，当多个图片文件上传，有的是空的，是否也返回空；保证传入和返回的数组数量相等
     * @return array 图片存储路径等信息
     * 
     *   - 返回数组key定义
     *     - success    : 是否操作成功
     *     - file_name[]: 数组, 多个文件存储根路径upload/images的相对路径 
     * 
     * @Example
     *     - $this->uploadImgs($_FILES, "icon_url", "icon_url", "blog");
     *       [说明] 生成的图片会是 images/blog/icon_url/201806011225.png  类似的路径
     *     - $this->->uploadImgs($_FILES, "icon_url", "subdir", "test.png");
     *       [说明] 生成的图片会是 images/subdir/test.png  类似的路径
     *             如果上传文件为jpg后缀名，则会是 images/subdir/test.jpg  类似的路径
     */
    public function uploadImgs($files, $uploadFlag, $upload_dir, $defaultId = "default", $file_permit_upload_size = 10, $isReturnAll = false)

    ```

## 内部跳转

* 以下的 redirect 和 go 是通用的功能，可以理解 go 是 redirect 的别名。

  ```php
  <?php
  /**
   * 内部转向到另一网页地址
   *
   * @param mixed $action
   * @param mixed $method
   * @param array|string $querystringparam
   * 示例：
   *     index.php?go=betterlife.blog.write&pageNo=8&userId=5
   *     $action：blog
   *     $method：write
   *     $querystring：pageNo=8&userId=5
   *                   array('pageNo'=>8,'userId'=>5)
   */
  public function redirect($action, $method, $querystring="")

  /**
   * 内部转向到另一网页地址
   *
   * @param mixed $action
   * @param mixed $method
   * @param array|string $querystringparam
   * 示例：
   *     index.php?go=betterlife.blog.write&pageNo=8&userId=5
   *     $action：blog
   *     $method：write
   *     $querystring：pageNo=8&userId=5
   *                   array('pageNo'=>8,'userId'=>5)
   */
  public function go($action, $method, $querystring = "")
  ```
