# 执行SQL查询语句

## 一步上手

只需要一步,就可以使用这个框架带来的好处了

* 引用init.php文件(根路径下)
  - 示例: 如果在根路径下引用: require_once("init.php");

## 开始使用

现在可以使用这个框架了,如果习惯了sql的写法，可以通过直接使用函数: **sqlExecute**

  - 示例如下:

    - 查询所有的博客记录:

      ```
      $sqlstr = "select * from bb_core_blog";
      sqlExecute($sqlstr);
      ```

  - 进一步了解: **sqlExecute**

    * 定位

      - 路径   : core/include/
      - 文件名称: common.php
      - github路径: https://github.com/skygreen2001/betterlife/blob/master/core/include/common.php

    * 定义如下

      ```
      /**
        * 直接执行SQL语句
        * @param mixed $sql SQL查询语句
        * @param string|class|bool $object 需要生成注入的对象实体|类名称
        * @return array 默认返回数组,如果$object指定数据对象，返回指定数据对象列表，$object=true，返回stdClass列表。
        */
      function sqlExecute($sqlstring,$object=null)
      ```


## 完整的示例代码

查询所有的博客数据[只需要三句]

```
<?php

require_once("init.php");
$sqlstr = "select * from bb_core_blog";
sqlExecute($sqlstr);

```

## 查询多数据库源
 
  - 场景1: 多用于访问多数据库，访问不同数据库表
  - 场景2: 进行数据的迁移，如需要将有多表关系的数据从正式服迁移到测试服，测试排查问题
  - 代码示例如下:

    ```
    // 多数据库源
    // 默认数据库源: Gc::$database_config
    $sql  = "select * from bb_core_blog;";
    $blog = sqlExecute($sql);
    print_pre($blog, true);
    // 修改数据库源后，之后调用框架数据库函数都使用新的数据源
    Gc::$database_config = array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bb',
        'username' => 'root',
        'password' => ''
    );
    Config_Db::initGc();
    Manager_Db::newInstance()->resetDao();
    $new_sql = "select * from bb_user_user;";
    $user    = sqlExecute($new_sql);
    print_pre($user, true);
    ```
