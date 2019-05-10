<?php
require_once("util.php");

if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

$md_path   = ".." . DS . ".." . DS . "user" . DS . "pages" . DS;
$dest_path = ".." . DS . "md";
$summary_file = "SUMMARY.md";

// -. 复制Markdown源文档到指定路径下
@rcopy($md_path, $dest_path);

$md_files = array();
$md_files = searchAllFilesInDirectory( $dest_path, $md_files, "md" );
sort($md_files);
// print_r($md_files);

$summary_contents = "# Summary\n\n";
$summary_contents = "* [首页](README.md)\n";
foreach ($md_files as $md_file) {
    if (strpos($md_file, "README.md")) continue;

    $path = dirname($md_file);
    // echo $path . "<br/>";
    $dst_md = $path . DS . "README.md";
    $content = file_get_contents($md_file);
    // preg_match('/^(-{3})(.*)(-{3})$/mis', $content, $matches);
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
    // if (!strpos($md_file, "01.home")) {
    $summary_contents .= "* [" . $title . "](" . $dst_url . ")\n";
    // }
    // print_r($title);echo "<br>";
    $content = $matches[2];
    if ($content) $content = trim($content);
    // print_r($content);echo "<br>";
    // echo "<br>";
    $build_summary_content = create_summary_file($content, $dst_url);
    $summary_contents .= $build_summary_content["summary_content"];
    $content = $build_summary_content["content_result"];
    file_put_contents($dst_md, $content);
}

// 复制首页
$content = file_get_contents($dest_path . DS . "01.home" . DS . "README.md");

if ($content) {
  $content = str_replace("![](", "![](md/01.home/", $content);
  file_put_contents(".." . DS . "README.md", $content);
}

// echo $summary_contents;
file_put_contents(".." . DS . $summary_file, $summary_contents);

// gitbook 生成
/**
 * [PHP 执行命令时sudo权限的配置](https://www.cnblogs.com/wpqwpq/p/6482843.html)
 * - 命令行执行: sudo visudo
 * - 添加两行:
 *   - www-data ALL=(root) ALL
 *   - %www-data ALL=(ALL:ALL) NOPASSWD:ALL
 * - 重启apache或者nginx
 */
// system('whoami');
// 复制logo
$ico_file = "favicon.ico";
$dest_ico_file = "_book/gitbook/images/" . $ico_file;
exec("cd ../ && sudo gitbook build && sudo chmod -R 0777 _book/ && sudo cp php/$ico_file $dest_ico_file");

// 跳转至目标预览页面
header("location:../_book/index.html");
die();

/**
 * 创建Gitbook SUMMAERY.md 文件内容
 */
function create_summary_file($content, $url) {
    $result = array();
    $summary_content = "";
    $content_result  = "";
    $line_content = preg_split('/[;\r\n]+/s', $content);
    $count = 0;
    $count_3 = 0;
    foreach ($line_content as $line) {
      if (startWith($line, "## ")) {
          $count ++;
          $summary_content .= "  * [" . trim(str_replace("## ", "", $line)) . "](" . $url . "#f". $count .")\n";
          $content_result .= $line . "{#f". $count ."}" . "\n\n";
      } elseif (startWith($line, "### ")) {
          $count_3 ++;
          $summary_content .= "    * [" . trim(str_replace("### ", "", $line)) . "](" . $url . "#t". $count_3 .")\n";
          $content_result .= $line . "{#t". $count_3 ."}" . "\n\n";
      } else {
          $content_result .= $line . "\n\n";
      }
    }
    $result["summary_content"] = $summary_content;
    $result["content_result"] = $content_result;
    return $result;
}


?>
