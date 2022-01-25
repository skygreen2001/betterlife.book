# Api

## 介绍

  - 类似spring boot、Laravel resource、Restful
  - 提供给前端Ajax请求、axios使用
  - 提供给jQuery、react、vuejs、angularjs、angular使用

## 分类

  - Api工具
  - MVC Api

## Api工具

  - [api工具](../tools/toolsapi.md)
    - 只需要引入 `init.php` 文件
    - 开发接近原生，无需使用MVC路由规则
    - 同时可以利用betterlife框架的好处。
    - 去除了MVC路由的复杂性，开发更简洁，代码更易读

## MVC Api

  - 可以在[控制器层](controller.md)里使用。
    - 各种控制器层都可以使用， 
      - [前台控制器](controller.md)
      - [后台控制器](controller.md)
      - [通用模版控制器](controller.md)
      - [报表控制器](controller.md)
      - [前台控制器](controller.md)
    - 简而言之，规则就是控制器函数有返回的都是Api请求，没有返回的就是Mvc渲染页面请求
  - MVC Api使用了MVC的路由规则，Url需遵循MVC的路由规则。

## MVC Api 示例

  - 示例文件: home/betterlife/action/Action_Ajax.php
  - 示例1: 返回字符串
    ```php
    /**
     * 仅供测试:Ajax请求返回字符串
     */
    public function test()
    {
        return "Hello world!";
    }
    ``` 
  - 示例2: 返回json格式字符串，前端多数请求使用这种返回
    ```php
    /**
     * 仅供测试:Ajax请求返回json格式字符串
     */
    public function index()
    {
        $result = array(
            "id" => 1,
            "ti" => "标题缩写",
            "hi" => "Welcome to ajax!",
            "ha" => "^_^"
        );
        return $result;
    }
    ``` 