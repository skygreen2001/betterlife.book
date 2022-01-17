# 框架安全管理

- [浅谈PHP安全规范](https://www.freebuf.com/articles/web/184567.html)


## 框架的保护措施

- 本框架无CTF中常用的php伪协议利用问题。
- 本框架执行预编译SQL语句，可以防止SQL注入黑客技术
- 设置文件夹权限
  - 设置根路径下tools目录不可访问
    - chmod -R 0744 tools/
    - 需要维护可临时还原配置权限: chmod -R 0755 tools/
    - 维护完成后仍需设置目录外界不可访问: chmod -R 0744 tools/

## 敏感配置

- 如果安装的是nginx服务器
  - 隐藏nginx版本比较简单，只需要修改下nginx.conf配置文件
    - server_tokens off;
  - 将server中nginx替换为 GFW 或者 *****
    - 需要更改Nginx的源码，然后重新编译安装，需要改动的源代码信息如下模块。
    - 编辑 src/http/ngx_http_header_filter_module.c文件，找到下面一行: 
      - static u_char ngx_http_server_string[] = "Server: nginx" CRLF;
      - 将上面nginx替换为 GFW 或者 ******

- 以下是一些常见的配置举例，更多请查看：http://php.net/manual/zh/ini.core.php#ini.variables-order。
  - 不在请求头中泄露php信息: expose_php=Off
    - 决定是否暴露 PHP 被安装在服务器上（例如在 Web 服务器的信息头中加上其签名：X-Powered-By: PHP/5.3.7)。
  - 限制php访问文件系统
    - open_basedir = "/var/www/html/:/usr/local/lib/php/:/tmp"
    - 如果应用名是bb, open_basedir = "/var/www/html/bb/:/usr/local/lib/php/:/tmp"
    - 如果是windows服务器, 中间用`;`隔开, open_basedir = "/var/www/html/bb/;/usr/local/lib/php/;/tmp"
  - 上传文件默认路径:
    - 默认路径: /tmp
    - upload_tmp_dir="/var/www/html/bb/upload/tmp"
    - 需修改路径权限: chmod -R 0755 /var/www/html/bb/upload/tmp
  - session保存路径:
    - 默认路径: /tmp
    - session.save_path="/var/www/html/bb/upload/tmp"
    - 需修改路径权限: chmod -R 0777 /var/www/html/bb/upload/tmp
    - 如果权限是 0755, safari浏览器可能会无法访问，要求设置路径到 /tmp
  - 禁用危险函数
    - disable_functions = phpinfo,passthru,assert,system,get_included_files,get_defined_functions,get_defined_constants,glob,``,chroot,scandir,chgrp,chown,shell_exec,proc_open,proc_get_status,ini_alter,ini_restore,dl,pfsockopen,openlog,syslog,readlink,symlink,popepassthru,stream_socket_server,fsocket,fsockopen 
    - 其中: assert, shell_exec, fsockopen, openlog, syslog, fsockopen 在框架代码生成，系统日志(一般都使用文件日志)等极少数情况下会使用到，安全一般是在服务器上使用到，因此在这里也可以进行禁用
  - 关闭远程代码执行: 
    - allow_url_fopen=Off
    - allow_url_include=Off
    - 有的采集功能需要allow_url_fopen为on，而服务器供应商却因为不安全而关闭，导致不能采集。
  - 不回显php错误(包括运行错误时和启动时错误), 但是进行错误记录:
    - play_errors=Off  
    - display_startup_errors=off
    - log_errors=On
    - error_log=/var/log/httpd/php_scripts_error.log
  - 资源管理防止过分消耗服务器资源
    - max_execution_time = 30
    - max_input_time = 30
    - memory_limit = 40M
- [Linux使用iptables如何封禁IP或端口](https://www.modb.pro/db/48026)
- [Nginx 屏蔽ip地址的方法](https://zhuanlan.zhihu.com/p/88801910)
- [nginx限制某个IP同一时间段的访问次数](https://blog.csdn.net/u010094934/article/details/72697086)

## 参考

- [PHP手册: 安全](https://www.php.net/manual/zh/security.php)
- [网络安全行业门户](https://www.freebuf.com/)
- [Damn Vulnerable Web Application (DVWA)](https://dvwa.co.uk/)
- [洞悉漏洞 -> 社区](https://www.seebug.org/)
- [黑基网](https://www.hackbase.net/)