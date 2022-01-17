# 通用方法详细说明

- 数据对象通用方法都定义在类`DataObject`和`DataObjectFunc`里

- DataObject
  - 路径   : core/model/
  - 文件名称: DataObject.php
  - github路径: https://github.com/skygreen2001/betterlife/blob/master/core/model/DataObject.php

- DataObjectFunc
  - 路径   : core/model/
  - 文件名称: DataObjectFunc.php
  - github路径: https://github.com/skygreen2001/betterlife/blob/master/core/model/dataobject/DataObjectFunc.php

## 定义通用方法列表

定义通用方法分为两类: 实例方法和类方法。

### 实例方法【需实例化数据对象】

一般来讲数据对象的增删改定义为实例方法

* save: 保存数据对象

      函数定义: public function save()
      函数说明:
         * @example 示例如下
         * 示例如下:
         * 
         *       $user   = new User();
         *       $user->setUsername( "betterlife" );
         *       $user->setPassword( "123456" );
         *       $user_id = $user->save();
         * @return int 保存对象记录的ID标识号

* update: 更新数据对象

      函数定义: public function update()
      函数说明:
         * @example 示例如下
         * 示例如下:
         * 
         *       $user             = User::getById( 3 );
         *       $user["username"] = "shanghai";
         *       $user->update();
         * @return boolen 是否更新成功；true为操作正常

* saveOrUpdate: 保存或修改数据对象

      函数定义: public function saveOrUpdate()
      函数说明:
         * @example 示例如下
         * 
         *       $user     = User::getById( 3 );
         *       $user["username"] = "shanghai";
         *       $user_id          = $user->saveOrUpdate();
         * @return boolen 是否保存或更新成功；true为操作正常

* delete: 删除数据对象

      函数定义: public function delete()
      函数说明: 
          * @example 示例如下
          * 
          *       $user     = User::getById( 3 );
          *       $isDelete = $user->delete();
          * @return boolen 是否删除成功；true为操作正常

### 类方法【静态方法】

一般来讲数据对象的查询定义为类方法

* updateProperties: 更新对象指定的属性

      函数定义: public static function updateProperties($sql_ids, $array_properties)
      函数说明:
         * @example 示例如下
         * 
         *        $isUpdate = User::updateProperties( "1, 2", "loginTimes = 100" );
         * @param array|string $sql_ids 需更新数据的ID编号或者ID编号的Sql语句
         * 示例如下: 
         * 
         *        1. 1, 2, 3
         *        2. array(1, 2, 3)
         * 
         * @param string $array_properties 指定的属性
         * 示例如下: 
         * 
         *        1. pass = 1, name = 'sky'
         *        2. array("pass" => "1", "name" => "sky")
         * @return boolen 是否更新成功；true为操作正常

* updateBy: 根据条件更新数据对象指定的属性

      函数定义: public static function updateBy($filter, $array_properties)
      函数说明:
         * @example 示例如下
         * 
         *        $isUpdate = User::updateBy( "username = 'admin'", "loginTimes = 500" );
         * @param mixed $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $array_properties 指定的属性
         * 示例如下: 
         * 
         *        1. pass = 1, name = 'sky'
         *        2. array("pass" => "1", "name" => "sky")
         * @return boolen 是否更新成功；true为操作正常

* deleteByID: 由标识删除指定ID数据对象

      函数定义:public static function deleteByID($id)
      函数说明:
         * @example 示例如下
         * 
         *       $isDelete = User::deleteByID( 4 );
         * @param mixed $id 数据对象编号
         * @return boolen 是否修改成功

* deleteByIds: 根据主键删除多条记录

      函数定义: public static function deleteByIds($ids)
      函数说明:
         * @example 示例如下
         * 
         *       $isDelete = User::deleteByIds( "5, 6, 7" );
         * @param array|string $ids 数据对象编号
         * 
         * 形式如下:
         *     1. array: array(1, 2, 3, 4, 5)
         *     2. 字符串: 1, 2, 3, 4
         * @return boolen 是否修改成功

* deleteBy: 根据条件删除多条记录

      函数定义: public static function deleteBy($filter)
      函数说明:
         * @example 示例如下
         * 
         *       $isDelete = User::deleteBy( "username = 'betterlife7'" );
         * @param mixed $filter 查询条件, 在where后的条件
         * @example 示例如下: 
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * @return boolen 是否修改成功

* increment: 对属性进行递增

      函数定义: public static function increment($property_name, $incre_value = 1, $filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $isPlus = User::increment( "loginTimes", 5, "user_id > 1" );
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * @param string property_name 属性名称
         * @param int incre_value 递增数
         * @return boolen 是否修改成功

* decrement: 对属性进行递减

      函数定义: public static function decrement($property_name, $decre_value = 1, $filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $isMinus = User::decrement( "loginTimes", 3, "user_id > 1" );
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * @param string property_name 属性名称
         * @param int decre_value 递减数
         * @return boolen 是否修改成功

* existByID: 由标识判断指定ID数据对象是否存在

      函数定义: public static function existByID($id)
      函数说明:
         * @example 示例如下
         * 
         *        $isExist = User::existByID( 1 );
         * @param mixed $id 数据对象编号
         * @return bool 是否存在

* existBy: 判断符合条件的数据对象是否存在

      函数定义: public static function existBy($filter)
      函数说明:
         * @example 示例如下
         * 
         *        $isExist = User::existBy( "username = 'china'" );
         * @param mixed $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * @return bool 是否存在

* select: 查询当前对象需显示属性的列表

      函数定义: public static function select($columns, $filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID, $limit = null)
      函数说明:
         * @example 示例如下
         * 
         *        $blog_names = Blog::select( "blog_name" );
         * @param string $columns指定的显示属性, 同SQL语句中的Select部分。
         * 示例如下: 
         * 
         *        id,name,commitTime
         * 
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 示例如下: 
         * 
         *        1. id asc;
         *        2. name desc;
         * 
         * @param string $limit 分页数量:limit起始数被改写, 默认从1开始, 如果是0, 同Mysql limit语法；
         * 示例如下: 
         * 
         *    6, 10  从第6条开始取10条(如果是mysql的limit, 意味着从第五条开始, 框架里不是这个意义。)
         *    1, 10 (相当于第1-第10条)
         *    10 (相当于第1-第10条)
         * 
         * @return 查询列数组, 当只有一个值的时候如select count(表名_id), 自动从数组中转换出来值字符串

* selectOne: 查询当前对象单个需显示的属性

      函数定义: public static function selectOne($columns, $filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID)
      函数说明:
         * @example 示例如下
         * 
         *        $blog_name = Blog::selectOne( "blog_name" );
         * @param string 指定的显示属性, 同SQL语句中的Select部分。
         * 示例如下: 
         * 
         *        id, name, commitTime
         * 
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 示例如下: 
         *        1. id asc;
         *        2. name desc;
         * @return 查询列数组, 自动从数组中转换出来值字符串,最后只返回一个值

* get: 查询数据对象列表

      函数定义: public static function get($filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID, $limit = null)
      函数说明:
         * @example 示例如下
         * 
         *        $blogs = Blog::get();
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 示例如下: 
         * 
         *        1. id asc;
         *        2. name desc;
         * 
         * @param string $limit 分页数量:limit起始数被改写, 默认从1开始, 如果是0, 同Mysql limit语法；
         * 示例如下: 
         * 
         *    6, 10  从第6条开始取10条(如果是mysql的limit, 意味着从第五条开始, 框架里不是这个意义。)
         *    1, 10 (相当于第1-第10条)
         *    10 (相当于第1-第10条)
         * 
         * @return array 对象列表数组

* getOne: 查询得到单个对象实体

      函数定义: public static function getOne($filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID)
      函数说明:
         * @example 示例如下
         * 
         *        $blog = Blog::getOne();
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 示例如下:
         *        1. id asc;
         *        2. name desc;
         * @return object 单个对象实体

* getById: 根据表ID主键获取指定的对象

      函数定义: public static function getById($id)
      函数说明:
         * @example 示例如下
         * 
         *        $blog = Blog::getById( 1 );
         * @param string $id 数据对象编号
         * @return 数据对象

* count: 数据对象总计数

      函数定义: public static function count($filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $countBlogs = Blog::count( "blog_id>3" );
         * @param object|string|array $filter
         *        $filter 格式示例如下: 
         *            0. "id = 1, name = 'sky'"
         *            1. array("id = 1", "name = 'sky'")
         *            2. array("id" => "1", "name" => "sky")
         *            3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * @return int 对象总计数

* queryPage: 数据对象分页

      函数定义: public static function queryPage($startPoint, $endPoint, $filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID)
      函数说明:
         * @example 示例如下
         * 
         *        $blogs = Blog::queryPage( 0, 10,
         *            array(
         *                "(blog_content like '%关键字%' or blog_content like '%公开课%')",
         *                "blog_id<4",
         *                "user_id"=>1
         *            )
         *        );
         * @param int $startPoint  分页开始记录数
         * @param int $endPoint    分页结束记录数
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * @param string $sort 排序条件
         * 默认为 id desc
         * 
         * 示例如下: 
         * 
         *        1. id asc;
         *        2. name desc;
         * @return mixed 对象分页

* queryPageByPageNo: 数据对象分页根据当前页数和每页显示记录数

      函数定义: public static function queryPageByPageNo($pageNo, $filter = null, $pageSize = 10, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID)
      函数说明:
         * @example 示例如下
         * 示例如下:
         * 
         *        $blogs = Blog::queryPageByPageNo( 1, null, 3 );
         * @param int $pageNo  当前页数
         * @param int $pageSize 每页显示记录数
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 默认为 id desc
         * 示例如下: 
         * 
         *        1. id asc;
         *        2. name desc;
         * 
         * @return array
         *  返回:
         *        - count    : 符合条件的记录总计数
         *        - pageCount: 符合条件的总页数
         *        - data     : 对象分页

### 其他实例方法

* toXml: 数据对象转换成xml字符串

      函数定义: public function toXml($isAll = true, $filterArray = null)
      函数说明:
         * @example 示例如下
         *         $blog = Blog::getById( 1 );
         *         print_r( $blog->toXml() );
         * @param $filterArray 需要过滤不生成的对象的field
         * 示例: $filterArray = array("id", "commitTime");
         * @param $isAll 是否对象所有的field都要生成，包括没有内容或者内容为空的field
         * @return string xml内容

* toJson: 数据对象转换成Json字符串

      函数定义: public function toJson($isAll = false)
      函数说明:
         * @example 示例如下
         *         $blog = Blog::getById( 1 );
         * @param $isAll 是否对象所有的field都要生成，包括没有内容或者内容为空的field
         * @return string Json格式的数据格式的字符串。

* toArray: 数据对象转换成数组

      函数定义: public function toArray($isAll = true)
      函数说明:
         * 示例如下:
         * 
         *         $blog = Blog::getById( 1 );
         * 
         *         print_r( $blog->toArray() );
         * @param $isAll 是否对象所有的field都要生成，包括没有内容或者内容为空的field
         * @return 数组

* saveRelationForManyToMany: [数据对象多对多存储]

      函数定义: public function saveRelationForManyToMany($relation_object, $relation_id_value, $other_column_values = null)
      函数说明:
         * 
         * @example 示例如下:
         * 
         * 示例1【多对多-主控端】: 
         * 
         *      $user = new User();
         * 
         *      $user->setId(2);
         * 
         *      $user->saveRelationForManyToMany( "roles", "3", array("commitTime" => date("Y-m-d H:i:s")) );
         * 
         *      说明:roles是在User数据对象中定义的变量: 
         * 
         *      static $many_many = array(
         * 
         *          "roles" => "Role",
         * 
         *      );
         * 
         * 示例2【多对多-被控端】: 
         * 
         *      $role = new Role();
         * 
         *      $role->setId(5);
         * 
         *      $role->saveRelationForManyToMany( "users", "6", array("commitTime" => date("Y-m-d H:i:s")) );
         * 
         *      说明:users是在Role数据对象中定义的变量: 
         * 
         *      static $belongs_many_many = array(
         * 
         *          "users" => "User",
         * 
         *      );
         * 
         * @param mixed $relation_object 多对多|从属于多对多关系定义对象
         * @param mixed $relation_id_value 关系对象的主键ID值。
         * @param array $other_column_values 其他列值键值对【冗余字段便于查询的数据列值】, 如有一列: 记录关系创建时间。
         * @return mixed 保存对象后的主键

### 其他类方法

* max: 获取数据对象指定属性[表列]最大值

      函数定义: public static function max($column_name = null, $filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $max = User::max( "loginTimes" );
         * @param string $column_name 列名, 默认为数据对象标识
         * @param object|string|array $filter 查询条件, 在where后的条件
         * @return int 数据对象标识最大值

* min: 获取数据对象指定属性[表列]最小值

      函数定义: public static function min($column_name = null, $filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $min = User::min( "loginTimes" );
         * @param string $column_name 列名, 默认为数据对象标识
         * @param object|string|array $filter 查询条件, 在where后的条件
         * @return int 数据对象列名最小值, 如未指定列名, 为标识最小值

* sum: 获取数据对象指定属性[表列]总和

      函数定义: public static function sum($column_name = null, $filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $sum = User::sum( "loginTimes" );
         * @param string $column_name 列名
         * @param object|string|array $filter 查询条件, 在where后的条件
         * @return int 数据对象列名总数

* countMultitable: 对象总计数[多表关联查询]

      函数定义: public static function countMultitable($from, $filter = null)
      函数说明:
         * @example 示例如下
         * 
         *        $comments = Comment::countMultitable( "Blog a, Comment b", "b.blog_id = a.blog_id and a.blog_name like '%Web%'" );
         * @param string|array $from 来自多张表或者多个类[必须是数据对象类名], 在from后的多张表名, 表名之间以逗号[,]隔开
         * 
         *        示例如下: 
         *            0. "table1, table2"
         *            1. array("table1", "table2")
         *            2. "class1, class2"
         *            3. array("class1", "class2")
         * 
         * @param object|string|array $filter
         * 
         *        $filter 格式示例如下: 
         *            0. 允许对象如new User(id = "1", name = "green");
         *            1. "id = 1", "name = 'sky'"
         *            2. array("id = 1", "name = 'sky'")
         *            3. array("id" => "1", "name" => "sky")
         * 
         * @return int 对象总计数

* queryPageMultitable: 对象分页[多表关联查询]

      函数定义: public static function queryPageMultitable($startPoint, $endPoint, $from, $filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID)
      函数说明:
         * @example 示例如下
         * 
         *        $comments = Comment::queryPageMultitable( 1, 6, "Blog a, Comment b", "b.blog_id = a.blog_id and a.blog_name like '%Web%'" );
         * @param int $startPoint  分页开始记录数
         * @param int $endPoint    分页结束记录数
         * @param string|array $from 来自多张表或者多个类[必须是数据对象类名], 在from后的多张表名, 表名之间以逗号[,]隔开
         * 示例如下: 
         * 
         *        0. "table1, table2"
         *        1. array("table1", "table2")
         *        2. "class1, class2"
         *        3. array("class1", "class2")
         * 
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 默认为 id desc
         * 示例如下: 
         * 
         *        1. id asc;
         *        2. name desc;
         * @return mixed 对象分页

* getMultitable: 查询数据对象列表[多表关联查询]

      函数定义: public static function getMultitable($from, $filter = null, $sort = CrudSQL::SQL_ORDER_DEFAULT_ID)
      函数说明:
         * @example 示例如下
         * 
         *        $comments = Comment::getMultitable( "Blog a, Comment b", "b.blog_id = a.blog_id and a.blog_name like '%Web%'" );
         * @param string|array $from 来自多张表或者多个类[必须是数据对象类名], 在from后的多张表名, 表名之间以逗号[,]隔开
         * 示例如下: 
         * 
         *        0. "table1, table2"
         *        1. array("table1", "table2")
         *        2. "class1, class2"
         *        3. array("class1", "class2")
         * 
         * @param object|string|array $filter 查询条件, 在where后的条件
         * 示例如下: 
         * 
         *        0. "id = 1, name = 'sky'"
         *        1. array("id = 1", "name = 'sky'")
         *        2. array("id" => "1", "name" => "sky")
         *        3. 允许对象如new User(id = "1", name = "green");
         * 
         * 默认:SQL Where条件子语句。如: "( id = 1 and name = 'sky' ) or ( name like '%sky%' )"
         * 
         * @param string $sort 排序条件
         * 默认为 id desc
         * 示例如下: 
         * 
         *        1. id asc;
         *        2. name desc;
         * @return mixed 对象分页
    

* saveDeleteRelateions: 同步删除取消了已有多对多关系、保存新增多对多关系

      函数定义:public static function saveDeleteRelateions($id_name, $id, $rel_name, $other_ids) 
      函数说明:
         * @example 示例如下:
         *
         *     Userrole::saveDeleteRelateions( "user_id", 1, "role_id", array(1, 2) );
         * @param string $id_name 主标识名称
         * @param int $id 主标识
         * @param string $rel_name 关系标识名称
         * @param array $other_ids 关系标识组
          