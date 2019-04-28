# 制作帮助、教程的框架

## 安装前提

- Node.js (Should be at least nodejs 6.9)
- Git

## 安装Grav
  ```
    cd help
    git clone https://github.com/getgrav/grav.git
    bin/grav install
  ```

## 安装样式
  - Themes: Editorial

## 安装gitbook-cli
  ```
    cd help
    mkdir tutorial
    npm install -g gitbook-cli
    gitbook init
    gitbook build
    gitbook serve
  ```

## 初始化gitbook配置文件
  
  - [参考book.json](https://github.com/skygreen2001/gitbook-use/blob/master/book.json)
  ```
    gitbook install
  ```


## 参考资料

- [Grav](https://getgrav.org/)  
- [Learn Grav](https://learn.getgrav.org/)
- [gitbook-cli](https://github.com/GitbookIO/gitbook-cli)
- [Setup and Installation of GitBook](https://github.com/GitbookIO/gitbook/blob/master/docs/setup.md)
- [GitBook 简明教程](http://www.chengweiyang.cn/gitbook/index.html)
- [记录GitBook的一些配置及插件信息](https://github.com/zhangjikai/gitbook-use/)(http://gitbook.zhangjikai.com/)


