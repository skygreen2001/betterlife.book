# 框架小词典

## 常量

- DS
  - DS = DIRECTORY_SEPARATOR
- HH
  - HH = PHP_EOL
  - 框架中对于换行符的定义，HH是`换行`中文拼音huan hang的头字母缩写
- BR
  - BR = "<br/>"
  - 框架中对于浏览器中网页换行的定义
- LS
  - 本地服务器常用关键词, 是Local Server头字母缩写
  - LS = array("127.0.0.1", "localhost", "192.168.", '.test')

- 定义在根路径下Gc.php文件里

## 快捷函数

- x
  - 异常信息记录，中文读作错，叉叉
  - 使用示例: x( "错了不要紧，关键是知道为什么错了，怎么改？" )
- ts
  - 调试信息记录，中文读作调试，是`调试`中文拼音tiao shi的头字母缩写
  - 使用示例: ts( "调试很重要，记录下调试信息。" )
- rz
  - 记录日志，中文读作日志，是`日志`中文拼音ri zhi的头字母缩写
  - 使用示例: rz( "日志记录在根路径log目录下" )
- 定义在根路径下core/include/shorcut.php文件里