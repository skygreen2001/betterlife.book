# 自定义标签

## 定位

- 路径    : taglib/
- 文件名称: taglib.php

- 所有自定义标签类的父类: TagClass.php

- 框架中已实现自定义标签:

  * 自定义超链接
  * 自定义分页标签
  * 自定义标签示例

## 定义标示

- 自定义标签定义标示:my

  - 源码文件:taglib/taglib/TagClass.php
    ```
    abstract class TagClass {
    const PREFIX="my";
    ```

## 自定义超链接

- 路径    : taglib/taglib/
- 文件名称: TagHrefClass.php
- 源码文件: taglib/taglib/TagHrefClass.php
  - 可以设置链接地址是否加密
    ```
    /**
      * 是否加密
      * @var bool
      */
    public static $isMcrypt=false;
    ```
  - 示例页面:home/betterlife/view/default/core/blog/display.tpl里定义为: `<my:a href="..."`

## 自定义分页标签

- 路径   : taglib/taglib/
- 文件名称: TagPageClass.php
- 示例页面: home/betterlife/view/default/core/blog/display.tpl里定义为: `<my:page src="...`

## 自定义标签示例

- 路径    : taglib/taglib/
- 文件名称: TagDemoClass.php
