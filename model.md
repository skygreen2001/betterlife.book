# 数据模型层

## 概述

- 数据模型层数据实体类都继承自:[DataObject]((dataobject.md))
- 数据库表对应数据对象类定义在一般都放置在前台src目录下；
- 如框架示例betterlife即放置位置在以下路径: home/betterlife/src/domain

- 代码生成也在这个位置下，如果重用工程后的名称bettercity，那么路径就应该是: home/bettercity/src/domain

- 由于所有的数据实体类都继承自[DataObject]((dataobject.md)), 可以使用[数据对象通用方法](normalmethod.md)里说明的方法
  - 直接执行数据库的操作
  - 可以使用数据对象所有的特性


## 代码生成

- 可以通过代码生成[代码生成](autocode.md)该应用的所有数据对象
  - 数据库配置正确
  - 数据库表定义严格遵循[数据库设计规范](databasedefinerule.md)



