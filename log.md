# 日志处理

## 常用函数

- 使用示例: logme( "我在想事情呢!等等我......" );
- 定义:

  ```
  <?php
    /**
    * 记录日志
    * @param string $message 日志记录的内容
    * @param enum $level 日志记录级别
    * @param string $category 日志内容业务分类
    * @return void
    */
    function logme($message, $level = EnumLogLevel::INFO, $category = '')

  ```

## 日志处理配置

- 根路径下全局变量定义配置文件: Gc.php

  ```
  <?php

    public static $log_config = array(
        /**
         * 默认日志记录的方式。
         * 
         * 一般来讲，日志都通过log记录，由本配置决定它在哪里打印出来。
         * 
         * 可通过邮件发送重要日志，可在数据库或者文件中记录日志。也可以通过Firebug显示日志。
         * 
         * EnumLogType::FILE : 3
         */
        'logType'          => EnumLogType::FILE,
        /**
         * 允许记录的日志级别
         */
        'log_record_level' => array('EMERG','ALERT','CRIT','ERR','INFO'),
        /**
         * 日志文件路径
         * 
         * 可指定日志文件放置的路径
         * 
         * 如果为空不设置，则在网站应用根目录下新建一个log目录，放置在它下面
         */
        'logpath'       => '',
        /**
         * 检测日志文件大小，超过配置大小则备份日志文件重新生成，单位为字节
         */
        'log_file_size' => 1024000000,
        /**
         * 日志记录的时间格式
         */
        'timeFormat'    => '%Y-%m-%d %H:%M:%S',
        /**
         * 通过邮件发送日志的配置。
         */
        'config_mail_log' => array(
            'subject'     => '重要的日志事件',
            'mailBackend' => '',
        ),
        'log_table' => 'bb_log_log',
    );
  ```
