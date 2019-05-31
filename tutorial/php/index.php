<?php
require_once("util.php");
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

class CreateGitBook {
    /**
     * GRAV生成的markdown文件
     */
    public static $md_path;
    /**
     * Gitbook的输出路径
     */
    public static $dest_path;
    /**
     * Gitbook的SUMMARY文件名称
     */
    public static $summary_file;
    /**
     * 经过整理后的GRAV生成的markdown文件列表
     */
    public static $md_files;
    
    /**
     * 是否复制GRAV生成的markdown文件到预处理的路径
     */
    public static $isCopyGravMDFiles = true;
    /**
     * 是否生成Summary文件
     */
    public static $isCreateSummary = true;
    /**
     * 是否一级导航直接导航至二级菜单的路径
     */
    public static $isNavSubUrl = true;

    /**
     * 初始化
     */
    public static function init() {
      self::$md_path   = ".." . DS . ".." . DS . "user" . DS . "pages" . DS;
      self::$dest_path = ".." . DS . "md";
      self::$summary_file = "SUMMARY.md";
      if( !contains( $_SERVER['HTTP_HOST'], array("127.0.0.1","localhost","192.168.") ) ) {
          self::$isCopyGravMDFiles = true;
      }
    }

    /**
     * 主程序
     */
    public static function main() {
      self::init();
      self::getMdFiles();
      self::copyGitBookFiles();
      if (self::$isCreateSummary) {
        self::createSummaryFile();
      }
      // die();
      self::createGitBookWeb();
    }

    /**
     * - 复制Markdown源文档到指定路径下
     * - 获取所有GRAV生成的markdown文件列表
     */
    public static function getMdFiles() {
      if (self::$isCopyGravMDFiles) {
          @rcopy(self::$md_path, self::$dest_path);
      }

      $md_files = array();
      $md_files = searchAllFilesInDirectory( self::$dest_path, $md_files, "md" );

      usort($md_files,  "cmpfilename");
      // sort($md_files);
      // print_r($md_files);

      $level_datas = level_data($md_files);
      // print_r($level_datas);
      // $md_files = arrange_data($level_datas, 1) ;
      $md_files = arrange_all_data($level_datas);
      // print_r($md_files);
      self::$md_files = array_multi2single($md_files);
    }

    /**
     * gitbook 生成
     * 创建Gitbook网站内容
     * [PHP 执行命令时sudo权限的配置](https://www.cnblogs.com/wpqwpq/p/6482843.html)
     * - 命令行执行: sudo visudo
     * - 添加两行:
     *   - www-data ALL=(root) ALL
     *   - %www-data ALL=(ALL:ALL) NOPASSWD:ALL
     * - 重启apache或者nginx
     */
    // system('whoami');
    /**
     *
     */
    public static function createGitBookWeb() {
      // 复制logo
      $ico_file = "favicon.ico";
      $dest_ico_file = "_book/gitbook/images/" . $ico_file;
      exec("cd ../ && sudo gitbook build && sudo chmod -R 0777 _book/ && sudo cp php/$ico_file $dest_ico_file");
    }

    /**
     * 复制GRAV所有的md文件处理保存为Gitbook的README.md文件
     */
    public static function copyGitBookFiles() {

      foreach (self::$md_files as $md_file) {
          if (strpos($md_file, "README.md")) continue;
          $path = dirname($md_file);
          $level = substr_count($path, DS);
          if ($level > 1) $level -= 1;
          // echo $path . "<br/>";
          $dst_md = $path . DS . "README.md";
          $content = file_get_contents($md_file);
          $matches = preg_split('/^-{3}$/mis', $content);
          $title = $matches[1];
          if ($title) {
              $title = substr($title, strpos($title, "title:") + 6 );
              if ($title) {
                  $title = substr($title, 0, strpos($title, "\n"));
              }
              $title = trim($title);
          }
          $dst_url = str_replace(DS, "/", $dst_md);
          $dst_url = str_replace("../", "", $dst_url);
          if ($level < 1) $level = 1;
          $prefix_summary = str_repeat(" ", ($level -1) * 2);
          $content = $matches[2];
          if ($content) $content = trim($content);
          $build_content = self::create_content_summary($content, $dst_url, $prefix_summary);
          $content = $build_content["content_result"];
          file_put_contents($dst_md, $content);
      }

      // 复制首页
      $content = file_get_contents(self::$dest_path . DS . "01.home" . DS . "README.md");

      if ($content) {
        $content = str_replace("![](", "![](md/01.home/", $content);
        file_put_contents(".." . DS . "README.md", $content);
      }
    }

    /**
     * 算法说明:
     *    书写Summary.md规则: 以文件名的目录层级|名称命名决定它所在的位置
     */
    public static function createSummaryFile() {
      $summary_contents = "# Summary\n\n";
      $summary_contents = "* [首页](README.md)\n";

      foreach (self::$md_files as $md_file) {
          if (strpos($md_file, "README.md")) continue;
          $path = dirname($md_file);
          $level = substr_count($path, DS);
          if ($level > 1) $level -= 1;
          // echo $path . "<br/>";
          $dst_md = $path . DS . "README.md";
          $content = file_get_contents($md_file);
          $matches = preg_split('/^-{3}$/mis', $content);
          $title = $matches[1];
          if ($title) {
              $title = substr($title, strpos($title, "title:") + 6 );
              if ($title) {
                  $title = substr($title, 0, strpos($title, "\n"));
              }
              $title = trim($title);
          }
          $dst_url = str_replace(DS, "/", $dst_md);
          $dst_url = str_replace("../", "", $dst_url);
          if ($level < 1) $level = 1;
          $prefix_summary = str_repeat(" ", ($level -1) * 2);
          $summary_contents .= $prefix_summary . "* [" . $title . "](" . $dst_url . ")\n";

          if (self::$isNavSubUrl && $level == 2) {
            $p_url = dirname($dst_url);
            $p_url = dirname($p_url);
            // die($p_url);
            $summary_contents = str_replace("(" . $p_url . DS . "README.md)", "(" . $dst_url . ")", $summary_contents);
          }

          $content = $matches[2];
          if ($content) $content = trim($content);
          $build_summary_content = self::create_content_summary($content, $dst_url, $prefix_summary);
          $summary_contents .= $build_summary_content["summary_content"];
      }
      // echo $summary_contents;
      file_put_contents(".." . DS . self::$summary_file, $summary_contents);
    }

    /**
     * 创建Gitbook README.md 和 SUMMAERY.md 文件内容
     */
    public static function create_content_summary($content, $url, $prefix_summary) {
        $result = array();
        $summary_content = "";
        $content_result  = "";
        $line_content = preg_split('/[;\r\n]+/s', $content);
        $count_2 = 0;
        $count_3 = 0;
        $count_4 = 0;
        foreach ($line_content as $line) {
          if (startWith($line, "#### ")) {
              $count_4 ++;
              $summary_content .= $prefix_summary . "      * [" . trim(str_replace("#### ", "", $line)) . "](" . $url . "#v". $count_4 .")\n";
              $content_result .= $line . "{#v". $count_4 ."}" . "\n\n";
          } elseif (startWith($line, "### ")) {
              $count_3 ++;
              $summary_content .= "    * [" . trim(str_replace("### ", "", $line)) . "](" . $url . "#t". $count_3 .")\n";
              $content_result .= $line . "{#t". $count_3 ."}" . "\n\n";
          } elseif (startWith($line, "## ")) {
              $count_2 ++;
              $summary_content .= $prefix_summary . "  * [" . trim(str_replace("## ", "", $line)) . "](" . $url . "#f". $count_2 .")\n";
              $content_result .= $line . "{#f". $count_2 ."}" . "\n\n";
          } else {
              $content_result .= $line . "\n\n";
          }
        }
        $result["summary_content"] = $summary_content;
        $result["content_result"] = $content_result;
        return $result;
    }

}

CreateGitBook::main();

// 跳转至目标预览页面
header("location:../_book/index.html");
die();

?>
