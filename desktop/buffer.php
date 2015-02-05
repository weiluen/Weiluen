<?PHP

  // location and prefix for cache files
  define('CACHE_PATH', "tmp/cache_");

  // how long to keep the cache files (hours)
  define('CACHE_TIME', 36);

  // return location and name for cache file
  function cache_file()
  {
    return CACHE_PATH . md5($_SERVER['REQUEST_URI']);
  }

  // display cached file if present and not expired
  function cache_display()
  {
    $file = cache_file();

    // check that cache file exists and is not too old
    if(!file_exists($file)) return;
    if(filemtime($file) < time() - CACHE_TIME * 3600) return;

    // if so, display cache file and stop processing
    readfile($file);
    exit;
  }

  // write to cache file
  function cache_page($content)
  {
    if(false !== ($f = @fopen(cache_file(), 'w'))) {
      fwrite($f, $content);
      fclose($f);
    }
    return $content;
  }

  // execution stops here if valid cache file found
  cache_display();

  // enable output buffering and create cache file
  ob_start('cache_page');
?>