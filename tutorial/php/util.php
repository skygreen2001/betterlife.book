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






?>
