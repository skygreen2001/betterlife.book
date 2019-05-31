<?php
// removes files and non-empty directories
function rrmdir($dir) {
  if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file)
    if ($file != "." && $file != "..") rrmdir("$dir/$file");
    rmdir($dir);
  }
  else if (file_exists($dir)) unlink($dir);
}

function rcopy($src, $dst) {
  if (file_exists($dst)) rrmdir($dst);
  if (is_dir($src)) {
    mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
  }
  else if (file_exists($src)) copy($src, $dst);
}

/**
 * 需要的字符是否在目标字符串的开始
 * @param string $haystack 目标字符串
 * @param string $needle 需要的字符
 * @param bool $strict 是否严格区分字母大小写
 * @return bool true:是，false:否。
 */
function startWith( $haystack, $needle, $strict=true )
{
    if (!$strict){
        $haystack=strtoupper($haystack);
        $needle=strtoupper($needle);
    }
    return strpos($haystack, $needle) === 0;
}

/**
 * 查看字符串里是否包含指定字符串
 * @param mixed $subject
 * @param mixed $needle
 */
function contain($subject, $needle)
{
    if ( empty($subject) || empty($needle) ) return false;
    if ( strpos(strtolower($subject), strtolower($needle))!== false ) {
        return true;
    } else {
        return false;
    }
}

/**
 * 查看字符串里是否包含数组中任意一个指定字符串
 * @param mixed $subject
 * @param mixed $array
 */
function contains($subject, $array)
{
    $result = false;
    if ( !empty($array) && is_array($array) ) {
        foreach ($array as $element) {
            if (contain($subject, $element)) {
                return true;
            }
        }
    }
    return $result;
}

function searchAllFilesInDirectory($path, $data, $agreesuffix = array("php")) {
    $handle = @opendir($path);
    if ( $handle ) {
        while (false !== ($file = @readdir($handle))) {
            if ( $file[0] == "." ) {
                continue;
            }
            $nextpath = $path . DS . $file;

            if ( is_dir($nextpath) ) {
                $data = searchAllFilesInDirectory( $nextpath, $data, $agreesuffix );
            } else {
                if ( $file !== "Thumbs.db" ) {
                    if ( $agreesuffix == "*" ) {
                        $data[dirname($nextpath) . DS . 'a' . basename($nextpath)] = $nextpath;
                    } else if ( is_string($agreesuffix) ) {
                        $fileSuffix = explode('.', $file);
                        $fileSuffix = end($fileSuffix);
                        $fileSuffix = strcasecmp($fileSuffix, $agreesuffix);
                        if ( $fileSuffix === 0 ) {
                            $nextpath_tmp      = dirname($nextpath);
                            $nextpath_basename = basename($nextpath);
                            $data[$nextpath_tmp . DS . 'a' . $nextpath_basename] = $nextpath;
                        }
                    } else if ( is_array($agreesuffix) ) {
                        foreach ($agreesuffix as $suffix) {
                            $fileSuffix = explode('.', $file);
                            $fileSuffix = end($fileSuffix);
                            $fileSuffix = strcasecmp($fileSuffix, $suffix);
                            if ( $fileSuffix === 0 ) {
                                $data[dirname($nextpath) . DS . 'a' . basename($nextpath)] = $nextpath;
                            }
                        }
                    }
                }

            }
        }
        @closedir($handle);
    }
    return $data;
}



function level_data($md_files) {
    $result = [];
    foreach ($md_files as $md_file) {
        if (strpos($md_file, "README.md")) continue;
        $path = dirname($md_file);
        $level = substr_count($path, DS);
        if ($level > 1) $level -= 1;
        $result[$level][] = $md_file;
    }
    // print_r($result);
    return $result;
}
function arrange_level_data($one_level_data, $sub_level_datas) {
    $result = [];
    $root_dir = dirname($one_level_data);
    $count = 1;
    foreach ($sub_level_datas as $key => $sub_level_data) {
      $sub_dir = dirname($sub_level_data);
      if (contain($sub_dir, $root_dir)) {
        $result[$count++] = $sub_level_data;
      }
    }
    return $result;
}

function arrange_data($level_datas, $level) {
  $result = [];
  $level_one_datas = $level_datas[$level];
  if ($level_one_datas) {
    if (is_array($level_one_datas)) {
      foreach ($level_one_datas as $key => $level_data) {
          $sub_files = arrange_level_data($level_data, $level_datas[$level+1]);
          if ($sub_files) {
              $result[$key+1]["_"] = $level_data;
              $result[$key+1]["sub"] = $sub_files;
          } else {
              $result[$key+1] = $level_data;
          }
      }
    } else {
      $result[$level][] = $level_one_datas;
    }
  }
  return $result;
}

function arrange_all_data($level_datas, $current_level=1, $level_data="") {
    $count_levels = count($level_datas);
    $result = [];
    if (!empty($level_data)) {
      $root_dir = dirname($level_data);
      $sub_files = arrange_level_data($level_data, $level_datas[$current_level+1]);
      if (!$sub_files) {
        $sub_files = arrange_data($level_datas, $current_level);
        $count = 1;
        foreach ($sub_files as $key => $sub_level_data) {
          if (is_string($sub_level_data)) {
            $sub_dir = dirname($sub_level_data);
            if (contain($sub_dir, $root_dir)) {
              $result[$count++] = $sub_level_data;
            }
          }
        }
        return $result;
      }
    }
    if ($current_level == $count_levels - 1) {
      if (empty($level_data)) {
        $result = arrange_data($level_datas, $current_level);
      } else {
        $root_dir = dirname($level_data);
        $sub_files = arrange_data($level_datas, $current_level);
        $count = 1;
        foreach ($sub_files as $key => $sub_level_data) {
          if (is_string($sub_level_data)) {
            $sub_dir = dirname($sub_level_data);
            if (contain($sub_dir, $root_dir)) {
              $result[$count++] = $sub_level_data;
            }
          }
        }
      }
      return $result;
    } else {
      $level_one_datas = $level_datas[$current_level];
      $next_level = $current_level + 1;
      foreach ($level_one_datas as $key => $level_data) {
          $sub_files = arrange_level_data($level_data, $level_datas[$next_level]);
          if ($sub_files) {
              $subs = arrange_all_data($level_datas, $next_level, $level_data);
              if ($subs) {
                $result[$key+1]["_"] = $level_data;

                $re_subs = $subs;

                $root_dir = dirname($level_data);
                $re_subs = [];
                $count = 1;
                // echo "subs:"; echo "\r\n";
                // print_r( $subs);echo "\r\n";
                foreach ($subs as $sub_key => $sub) {
                  if (is_array($sub) && array_key_exists("_", $sub)) {
                    // echo $root_dir;echo "\r\n";
                    // print_r($sub); echo "\r\n";
                    // echo "sub:" . $sub["_"];echo "\r\n";
                    $sub_dir = dirname($sub["_"]);
                    if (contain($sub_dir, $root_dir)) {
                      $re_subs[$count++] = $sub;
                    }
                  } else {
                    $sub_dir = dirname($sub);
                    if (contain($sub_dir, $root_dir)) {
                      $re_subs[$count++] = $sub;
                    }
                  }
                }

                // print_r($re_subs); echo "\r\n";
                $result[$key+1]["sub"] = $re_subs;
                // print_r($result); echo "\r\n";
              } else {
                $result[$key+1] = $level_data;
              }

          } else {
              $result[$key+1] = $level_data;
          }
      }
    }
    return $result;
}

/**
 * 多个数组合成一个数组
 */
function array_multi2single($array)
{
    static $result_array = array();
    foreach ($array as $value) {
        if (is_array($value)) {
            array_multi2single($value);
        } else
            $result_array[] = $value;
    }
    return $result_array;
}



function cmpfilename($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    $l_a = substr_count($a, DS);
    $l_b = substr_count($b, DS);

    if ($l_a  == $l_b) {
        return ($a < $b) ? -1 : 1;
    }
    return $l_a > $l_b ? 1 : -1;
}

?>
