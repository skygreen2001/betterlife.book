# 代码规范

## 代码规范定制

- 遵循[PSR12](https://www.php-fig.org/psr/psr-12/)规范, 在它的基础上定制了betterlife框架的代码规范
- 配置文件: install/phpcs.xml
  - [PHP_CodeSniffer Advanced Usage](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage)
- 检查工具: composer check-style
- 修复工具: composer fix-style

## vscode 配置

- 安装插件(Extensions): phpcs
  - 检查工具: 开发代码使用
  - 修改配置(Settings)
    - Phpcs: Auto Config Search
      - 勾选: true
    - Phpcs: Enable
    - Phpcs: Show Sources
    - Phpcs: Standard
      - Edit in settings.json
  - 修改配置文件(settings.json):
    ```
    {
        ......
        "phpcs.showSources": true,
        "phpcs.standard": "install/phpcs.xml"
    }
    ```
- 安装插件(Extensions): php cs fixer
  - 修复工具: 开发代码使用
  - [配置说明](https://github.com/junstyle/vscode-php-cs-fixer)
  - 修改配置(Settings)
    - PHP-cs-fixer: Auto Fix By Semicolon
      - 勾选: true
    - PHP-cs-fixer: Onsave
      - 勾选: true
  - 修改配置文件(settings.json):
    ```
    {
        ......
        "php-cs-fixer.autoFixBySemicolon": true,
        "php-cs-fixer.onsave": true,
        "[php]": {
            "editor.defaultFormatter": "junstyle.php-cs-fixer"
        }
    }
    ```



## 参考资料

- [php-fig](https://www.php-fig.org/)
- [PHP The Right Way: 中文版](https://laravel-china.github.io/php-the-right-way/)
  - [PHP The Right Way](https://phptherightway.com/)
  - [PHP 之道（PHP The Right Way 中文版）](https://learnku.com/docs/php-the-right-way)
- [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [Pear Coding Standards](https://pear.php.net/manual/en/standards.php)
- [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- [Symfony Coding Standards](https://symfony.com/doc/current/contributing/code/standards.html)