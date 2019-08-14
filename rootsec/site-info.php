<?php
require("core.php");
head();

//Clean URL
function clean_url($site)
{
    $site = strtolower($site);
    $site = str_replace(array(
        'http://',
        'https://',
        'www.',
        '/'
    ), '', $site);
    return $site;
}

$site = clean_url($site_url);
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-info-circle"></i> Site Info</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Site Info</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
//Alexa Rank Check
function alexaRank($site)
{
    @$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url=' . $site);
    @$a = $xml->SD[1]->POPULARITY;
    if ($a != null) {
        $alexa_rank = $xml->SD[1]->POPULARITY->attributes()->TEXT;
        if ($alexa_rank == null)
            $alexa_rank = 'No Rank';
    } else {
        $alexa_rank = 'No Rank';
    }
    
    return $alexa_rank;
}

//Host Info Check
function host_info($site)
{
    $ch = curl_init('http://www.iplocationfinder.com/' . $site);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $data = curl_exec($ch);
    preg_match('~ISP.*<~', $data, $isp);
    preg_match('~Country.*<~', $data, $country);
    preg_match('~IP:.*<~', $data, $ip);
    
    @$country = explode(':', strip_tags($country[0]));
    @$country = trim(str_replace('Hide your IP address and Location here', '', $country[1]));
    if ($country == '')
        $country = 'Not Available';
    
    @$isp = explode(':', strip_tags($isp[0]));
    @$isp = trim($isp[1]);
    if ($isp == '')
        $isp = 'Not Available';
    
    @$ip = $ip[0];
    $ip = trim(str_replace(array(
        'IP:',
        '<',
        '/label>',
        '/th>td>',
        '/td>'
    ), '', $ip));
    if ($ip == '')
        $ip = 'Not Available';
    $data = $ip . "::" . $country . "::" . $isp . "::";
    return $data;
}

//Robots.txt Check
function robocheck($site)
{
    $robots_file = $_SERVER['DOCUMENT_ROOT'] . "/robots.txt";
    if (file_exists($robots_file)) {
        return 1;
    } else {
        return 0;
    }
}

//Sitemap Check
function sitemap_check($site)
{
    $sitemap_file = $_SERVER['DOCUMENT_ROOT'] . "/sitemap.xml";
    if (file_exists($sitemap_file)) {
        return 1;
    } else {
        return 0;
    }
}

//Alexa PageRank
$alexa = alexaRank($site);

//Sitemap
$sitemap_r = sitemap_check($site);

//Robots.txt
$robo_r = robocheck($site);

function checkOnline($site)
{
    $curlInit = curl_init($site);
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    
    $response         = curl_exec($curlInit);
    $GLOBALS['rtime'] = curl_getinfo($curlInit);
    curl_close($curlInit);
    if ($response)
        return true;
    return false;
}

//Title, Description, Keywords
if (checkOnline($site)) {
    $vtime = $rtime['total_time'];
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_URL, $site_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60');
    curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
    $html = curl_exec($ch);
    curl_close($ch);
    $html = str_ireplace(array(
        "Title",
        "TITLE"
    ), "title", $html);
    $html = str_ireplace(array(
        "Description",
        "DESCRIPTION"
    ), "description", $html);
    $html = str_ireplace(array(
        "Keywords",
        "KEYWORDS"
    ), "keywords", $html);
    $html = str_ireplace(array(
        "Author",
        "AUTHOR"
    ), "author", $html);
    $html = str_ireplace(array(
        "Content",
        "CONTENT"
    ), "content", $html);
    $html = str_ireplace(array(
        "Meta",
        "META"
    ), "meta", $html);
    $html = str_ireplace(array(
        "Name",
        "NAME"
    ), "name", $html);
    
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');
    
    @$title = $nodes->item(0)->nodeValue;
    
    $metas = $doc->getElementsByTagName('meta');
    
    for ($i = 0; $i < $metas->length; $i++) {
        $meta = $metas->item($i);
        if ($meta->getAttribute('name') == 'description')
            $description = $meta->getAttribute('content');
        if ($meta->getAttribute('name') == 'keywords')
            $keywords = $meta->getAttribute('content');
        if ($meta->getAttribute('name') == 'author')
            $author = $meta->getAttribute('content');
    }
    if ($title == '')
        $title = '<h4><span class="label label-default">No Title</span></h4>';
    if (@$description == '')
        $description = '<h4><span class="label label-default">No Description</span></h4>';
    if (@$keywords == '')
        $keywords = '<h4><span class="label label-default">No Keywords</span></h4>';
    if (@$author == '')
        $author = '<h4><span class="label label-default">No Author</span></h4>';
}

//Host Info
$data         = host_info($site);
$data         = explode("::", $data);
$host_ip      = $data[0];
$serverip     = getHostByName(getHostName());
$host_country = $data[1];
$host_isp     = $data[2];

$inipath = php_ini_loaded_file();

if ($inipath) {
    $iniflp = $inipath;
} else {
    $iniflp = 'A php.ini file is not loaded';
}

$zend_version = zend_version();
?>
                    
                <div class="row">
				<div class="col-md-6">
                      <div class="box">
							<div class="box-header">
								<h3 class="box-title"><?php
echo $site;
?></h3>
							</div>
							<div class="box-body">
                                    <table class="table table-bordered">
												<thead>
													<tr style="background-color: #F3F4F5;">
														<th>Site Stats & Information</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Response Time</td>
														<td><h4><span class="label label-success"><?php
echo $vtime;
?> sec</span></h4></td>
													</tr>
                                                    <tr>
														<td>Global Rank</td>
														<td><h4><span class="label label-primary"># <?php
echo $alexa;
?></span></h4></td>
													</tr>
													<tr>
														<td>PHP Configuration File (php.ini)</td>
														<td><h4><span class="label label-warning"><?php
echo $iniflp;
?></span></h4></td>
													</tr>
													<tr>
														<td>Zend Version</td>
														<td><h4><span class="label label-danger"><?php
echo $zend_version;
?></span></h4></td>
													</tr>
												</tbody>
                                        
                                                <thead>
													<tr style="background-color: #F3F4F5;">
														<th>Meta Tags</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Title</td>
														<td><?php
echo $title;
?></td>
													</tr>
                                                    <tr>
														<td>Description</td>
														<td><?php
echo $description;
?></td>
													</tr>
                                                    <tr>
														<td>Keywords</td>
														<td><?php
echo $keywords;
?></td>
													</tr>
                                                    <tr>
														<td>Author</td>
														<td><?php
echo $author;
?></td>
													</tr>
												</tbody>
                                        
                                                <thead>
													<tr style="background-color: #F3F4F5;">
														<th>Crawling files</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Robots.txt</td>
														<td>
<?php
if ($robo_r == "0") {
    echo '<h4><span class="label label-danger">No</span></h4>';
} else {
    echo '<h4><span class="label label-success">Yes</span></h4>';
}
?>
                                                        </td>
													</tr>
                                                    <tr>
														<td>XML Sitemap</td>
														<td>
<?php
if ($sitemap_r == "0") {
    echo '<h4><span class="label label-danger">No</span></h4>';
} else {
    echo '<h4><span class="label label-success">Yes</span></h4>';
}
?>
                                                        </td>
													</tr>
												</tbody>
								     </table>
							</div>
				      </div>
                    
<?php
$files     = 0;
$folders   = 0;
$images    = 0;
$phpfiles  = 0;
$htmlfiles = 0;
$cssfiles  = 0;
$jsfiles   = 0;
$dir       = glob("../");
foreach ($dir as $obj) {
    if (is_dir($obj)) {
        $folders++;
        $scan = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($obj, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($scan as $file) {
            if (is_file($file)) {
                $files++;
                $exp = explode(".", $file);
                if ($exp[1] == "png" || $exp[1] == "jpg" || $exp[1] == "gif" || $exp[1] == "bmp" || $exp[1] == "tiff" || $exp[1] == "exif") {
                    $images++;
                }
                if ($exp[1] == "php" || $exp[1] == "phtml" || $exp[1] == "php3" || $exp[1] == "php4" || $exp[1] == "php5" || $exp[1] == "phps") {
                    $phpfiles++;
                }
                if ($exp[1] == "html" || $exp[1] == "htm" || $exp[1] == "xhtml") {
                    $htmlfiles++;
                }
                if ($exp[1] == "css") {
                    $cssfiles++;
                }
                if ($exp[1] == "js") {
                    $jsfiles++;
                }
            } else {
                $folders++;
            }
        }
    } else {
        $files++;
    }
}
?>
                      <div class="row">
                          <div class="col-md-6">
                           <div class="small-box bg-red">
                              <div class="inner">
                                <h3><?php
echo $files;
?></h3>
                                <p>Files</p>
                              </div>
                              <div class="icon">
                                <i class="fa fa-file"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="small-box bg-aqua">
                               <div class="inner">
                                 <h3><?php
echo $folders;
?></h3>
                                 <p>Folders</p>
                               </div>
                               <div class="icon">
                                 <i class="fa fa-folder"></i>
                               </div>
                             </div>
                          </div>
                          <div class="col-md-6">
                            <div class="small-box bg-green">
                              <div class="inner">
                                <h3><?php
echo $images;
?></h3>
                                <p>Images</p>
                              </div>
                              <div class="icon">
                                <i class="fa fa-file-image-o"></i>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
				<div class="col-md-6">
<?php
if (!function_exists("view_size")) {
    function view_size($size)
    {
        if (!is_numeric($size)) {
            return FALSE;
        } else {
            if ($size >= 1073741824) {
                $size = round($size / 1073741824 * 100) / 100 . " GB";
            } elseif ($size >= 1048576) {
                $size = round($size / 1048576 * 100) / 100 . " MB";
            } elseif ($size >= 1024) {
                $size = round($size / 1024 * 100) / 100 . " KB";
            } else {
                $size = $size . " B";
            }
            return $size;
        }
    }
}

if (is_callable("disk_free_space") && is_callable("disk_total_space")) {
    $directory = '/';
    @$free = disk_free_space($directory);
    @$total = disk_total_space($directory);
    if ($free === FALSE) {
        $free = 0;
    }
    if ($total === FALSE) {
        $total = 0;
    }
    if ($free < 0) {
        $free = 0;
    }
    if ($total < 0) {
        $total = 0;
    }
    @$used = $total - $free;
    @$free_percent = round(100 / ($total / $free), 2);
    @$used_percent = round(100 / ($total / $used), 2);
?>
               <div class="row">
                      <div class="col-md-6">
                            <div class="info-box bg-aqua">
                               <span class="info-box-icon"><i class="fa fa-hdd-o"></i></span>

                               <div class="info-box-content">
                                 <span class="info-box-text">HDD Total Space</span>
                                 <span class="info-box-number"><?php
    echo view_size($total);
?></span>

                                 <div class="progress">
                                   <div class="progress-bar" style="width: <?php
    echo $used_percent;
?>%"></div>
                                 </div>
                                     <span class="progress-description">
                                         Used Space: <span class="text-semibold"><?php
    echo view_size($used);
?></span>
                                     </span>
                               </div>
                            </div>
                        </div>
                      <div class="col-md-6">
                            <div class="info-box bg-aqua">
                               <span class="info-box-icon"><i class="fa fa-hdd-o"></i></span>

                               <div class="info-box-content">
                                 <span class="info-box-text">HDD FREE SPACE</span>
                                 <span class="info-box-number"><?php
    echo view_size($free);
?></span>

                                 <div class="progress">
                                   <div class="progress-bar" style="width: <?php
    echo $free_percent;
?>%"></div>
                                 </div>
                                     <span class="progress-description">Free <span class="text-semibold"><?php
    echo $free_percent;
?>%</span> of <span class="text-semibold"><?php
    echo view_size($total);
?></span>
                                     </span>
                               </div>
                            </div>
                        </div>
                 </div>
                   
                <p><i class="fa fa-hdd-o"></i> Free HDD Space</p>
                <div class="progress progress-xl progress-striped light active">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php
    echo $free_percent;
?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php
    echo $free_percent;
?>%;">
						<strong><?php
    echo $free_percent;
?>%</strong>
					</div>
				</div>
                    
                <p><i class="fa fa-hdd-o"></i> Used HDD Space</p>
                <div class="progress progress-xl progress-striped light active">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php
    echo $used_percent;
?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php
    echo $used_percent;
?>%;">
						<strong><?php
    echo $used_percent;
?>%</strong>
					</div>
				</div>
<?php
}

$extensions = get_loaded_extensions();
$countext   = count($extensions);
?>
                <div class="box">
					<div class="box-header">
				         <h3 class="box-title">Loaded PHP Extensions - <span class="label label-primary"><?php
echo $countext;
?></span></h3>
					</div>
					<div class="box-body">
<pre><ul>
<?php
foreach ($extensions as $extension) {
    echo "<li>" . $extension . "</li>";
}
?>
</ul></pre>
					</div>
				</div>
                    
				</div>
               
                <div class="col-md-12">
                    <h3 class="mt-none">Host Information</h3>
                    <p>Information about the Web Host, IP Address, Name Servers & More.</p><br />
                    
					<div class="row">
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Domain IP</p>
									<i class="fa fa-user fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $serverip;
?></p>
								</div>
							</div>
                       </div>
                    
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Country</p>
									<i class="fa fa-globe fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $host_country;
?></p>
								</div>
							</div>
                       </div>

                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Server Software</p>
									<i class="fa fa-database fa-5x"></i>
									<hr>
									<p class="h2 text-thin">
<?php
@$version = explode("/", $_SERVER['SERVER_SOFTWARE']);
@$softNum = explode(" ", $version[1]);
@$soft    = $version[0] . '/' . $softNum[0];
echo $soft;
?>
                                    </p>
								</div>
							</div>
                       </div>
                    
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">ISP</p>
									<i class="fa fa-tasks fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $host_isp;
?></p>
								</div>
							</div>
                       </div>
					</div>
                    
					<div class="row">
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Server OS</p>
									<i class="fa fa-desktop fa-5x"></i>
									<hr>
									<p class="h2 text-thin">
<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    echo 'Windows';
} elseif (PHP_OS === 'Linux') {
    echo 'Linux';
} elseif (PHP_OS === 'FreeBSD') {
    echo 'FreeBSD';
} elseif (PHP_OS === 'OpenBSD') {
    echo 'OpenBSD';
} elseif (PHP_OS === 'NetBSD') {
    echo 'NetBSD';
} elseif (PHP_OS === 'SunOS') {
    echo 'SunOS';
} elseif (PHP_OS === 'Unix') {
    echo 'Unix';
} elseif (PHP_OS === 'Darwin') {
    echo 'Darwin';
} elseif (PHP_OS === 'HP-UX') {
    echo 'HP-UX';
} elseif (PHP_OS === 'IRIX64') {
    echo 'IRIX64';
} elseif (PHP_OS === 'CYGWIN_NT-5.1') {
    echo 'CYGWIN';
} elseif (PHP_OS === 'GNU') {
    echo 'GNU';
} elseif (PHP_OS === 'DragonFly') {
    echo 'DragonFly';
} elseif (PHP_OS === 'MSYS_NT-6.1') {
    echo 'MSYS';
} else {
    echo 'Unknown';
}
?>                                    
                                    </p>
								</div>
							</div>
                       </div>
                       
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">PHP Version</p>
									<i class="fa fa-file-code-o fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo phpversion();
?></p>
								</div>
							</div>
                       </div>
                    
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">MySQL Version</p>
									<i class="fa fa-list-alt fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo mysqli_get_server_info($connect);
?></p>
								</div>
							</div>
                       </div>
                    
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Server Port</p>
									<i class="fa fa-plug fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $_SERVER['SERVER_PORT'];
?></p>
								</div>
							</div>
                       </div>
                    </div>
                    
					<div class="row">
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">OpenSSL Version</p>
									<i class="fa fa-lock fa-5x"></i>
									<hr>
									<p class="h2 text-thin">
<?php
if (!extension_loaded('openssl')) {
    echo 'Deactivated';
} elseif (OPENSSL_VERSION_NUMBER < 0x009080bf) {
    echo '<font style="color: red;">Out-of-Date</font>';
} else {
    echo '<font style="color: green;">Latest</font>';
}
?></p>
								</div>
							</div>
                       </div>
                    
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">cURL Extension</p>
									<i class="fa fa-link fa-5x"></i>
									<hr>
									<p class="h2 text-thin">
<?php
if (function_exists('curl_version')) {
    echo '<font style="color: green;">Enabled</font>';
} else {
    echo '<font style="color: red;">Disabled</font>';
}
?></p>
								</div>
							</div>
                       </div>
                      
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Server Protocol</p>
									<i class="fa fa-hdd-o fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo $_SERVER['SERVER_PROTOCOL'];
?></p>
								</div>
							</div>
                       </div>
                     
                       <div class="col-md-3">
							<div class="box">
								<div class="box-body text-center">
									<p class="text-uppercase mar-btm text-sm" style="font-size: 20px">Gateway Interface</p>
									<i class="fa fa-sitemap fa-5x"></i>
									<hr>
									<p class="h2 text-thin"><?php
echo @$_SERVER['GATEWAY_INTERFACE'];
?></p>
								</div>
							</div>
                       </div>
                    </div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
        </div>
</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->            
                
<?php
footer();
?>