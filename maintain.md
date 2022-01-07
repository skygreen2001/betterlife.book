# 运维

## 运维工具

  - 路径          : tools/maintain.php
  - 运维工具汇总地址: http://127.0.0.1/betterlife/tools/maintain.php
    - 均为示例
    - 代码已注释，需取消注释使用

### 清单

  - 导出数据到Excel
  - 统计代码行数
  - 多数据库源
  - 显示超过限制数量的表
  - 生成报表

### 导出数据到Excel

  - 场景1: 了解工程开发工作量
  - 场景2: 一般用于申请软件专利需指导总计代码行数
  - 代码示例如下
    ```
    $response = Manager_Service::blogService()->exportBlog();
    echo $response["data"];
    echo "<script>window.open('" . $response["data"] . "');</script>";
    ```

### 统计代码行数

  - 场景1: 了解工程开发工作量
  - 场景2: 一般用于申请软件专利需指导总计代码行数
  - 代码示例如下
    ```
    $file_path =  Gc::$nav_root_path;
    $f_files   = UtilFileSystem::getAllFilesInDirectory( $file_path, "php" );
    // $f_files   = UtilFileSystem::getAllFilesInDirectory($file_path, array("js", "php", "tpl", "css", "json"));
    echo "共计:" . count($f_files) . "个源文件<br/>";
    $lines = 0;
    foreach ($f_files as $key => $f_file) {
        $content = file_get_contents($f_file);
        $content = preg_split("/[\r\n]/i", $content, 0, PREG_SPLIT_NO_EMPTY);
        $lines  += count($content);
        echo $f_file . "<br/>";
    }
    echo "共计:" . $lines . "行<br/>";
    ```

### 多数据库源
 
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

### 显示超过限制数量的表

  - http://127.0.0.1/betterlife/tools/tools/db/db_countrows.php?l=10000
  - 参数: l: 限制数量

### 生成报表

  - [报表系统](report.md) 