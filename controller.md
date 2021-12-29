# 控制器层

## 所有控制器父类

* 路径   :core/model/

* 文件名称: ActionBasic.php

* github路径:  [https://github.com/skygreen2001/betterlife/blob/master/core/model/ActionBasic.php](https://github.com/skygreen2001/betterlife/blob/master/core/model/ActionBasic.php)

* 每个控制器都继承自它，它是所有控制器的父类；规范要求：所有控制器要求的前缀:Action_;

* 在Action所有的方法执行之前可以执行的方法:beforeAction

* 在Action所有的方法执行之后可以执行的方法:afterAction

* 可供选择的集成在线编辑器:

  * CKEditor
  * KindEditor
  * xhEditor
  * UEditor

* 默认集成在线编辑器:UEditor

## 前台控制器父类

* 路径   : home/betterlife/action/

* 文件名称: Action.php

## 后台控制器父类

* 路径   : home/admin/action/

* 文件名称: ActionAdmin.php

## 通用模版控制器父类

* 路径   : home/model/action/

* 文件名称: ActionModel.php

## 报表控制器父类

* 路径   : home/report/action/

* 文件名称: ActionReport.php

## 控制器常用变量

* 控制器默认属性: data
* 控制器默认属性: view
  * 所有Web应用模块下的控制器都遵循这个规则，拥有这个变量
  * 所有需要显示到页面的数据变量都应该挂在它下面
  * 代码示例来自: home/betterlife/action/Action_Blog

    ```php

    ```

    ```html
        ......
            <b>共计{$countBlogs} 篇博客</b>
            {if $blogs}
        ......
    ```

## 控制器定义表示层对象

* 在控制器类里可以定义表示层显示对象类继承自ViewObject
* 表示层显示对象可以直接输出显示
* 代码示例来自: home/betterlife/action/Action_Blog

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
      ......
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
