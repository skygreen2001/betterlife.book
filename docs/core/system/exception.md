# 异常处理

## 常用函数

- 使用示例: x( "错了不要紧，关键是知道为什么错了，怎么改？" )
- 定义:

  ```
  <?php
    /**
     * 自定义异常处理缩写表示
     * @param string $errorInfo 错误信息 
     * @param object $object    发生错误信息的自定义类 
     * @param int    $code      异常编码
     * @param string $extra     补充存在多余调试信息
     * @return void
     */
    function x($errorInfo, $object = null, $code = 0, $extra = null)

  ```

## 异常处理配置

- 路径: core/config/config/common/
- EXCEPTION_WAY: 异常处理方式
  - 0. 自定义
  - 1. filp/whoops 
  - 2. symfony/error-handler (包含在包laravel/framework里)
- filp/whoops配置: 异常文件打开编辑器
  - 默认: vscode
  - [Open Files In An Editor](https://github.com/filp/whoops/blob/master/docs/Open%20Files%20In%20An%20Editor.md)
  - 可供选择的编辑器
    - vscode
    - atom
    - sublime
      - Mac OS需要添加: https://github.com/inopinatus/sublime_url
    - phpstorm
    - emacs
    - macvim
    - idea
    - netbeans
    - textmate
    - espresso
    - xdebug
