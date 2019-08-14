<?php
require("core.php");
head();

if (isset($_POST['ht-edit'])) {
    
    $fn = $_SERVER['DOCUMENT_ROOT'] . "/.htaccess";
    @$file = fopen($fn, "w+");
    fwrite($file, $_POST['htaccess']);
    fclose($file);
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-columns"></i> .htaccess Editor</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">.htaccess Editor</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
$htaccess = $_SERVER['DOCUMENT_ROOT'] . "/.htaccess";
if (!file_exists($htaccess)) {
    echo '<div class="callout callout-info">
				No created <strong>.htaccess</strong> file was found on your website and will now be created in the website\'s root folder - <strong>' . $htaccess . '</strong> .
          </div>';
    $content = "";
    $fp      = fopen($htaccess, "wb");
    fwrite($fp, $content);
    fclose($fp);
}
?>
                    
                <div class="row">
				<div class="col-md-9">
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">.htaccess Editor</h3>
						</div>
						<div class="box-body">
                            <form method="post">
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="htaccess" rows="25" type="text"><?php
$htaccess = $_SERVER['DOCUMENT_ROOT'] . "/.htaccess";
echo file_get_contents($htaccess);
?></textarea>
                                    </div>
                                    <div class="col-md-4">
                                    <p>Please double check them before saving as a mistake could make your website inaccessible.</p>
                                     <ul class="description">
                                         <li><a href="https://www.google.com/search?q=htaccess+tutorial" title="Search for htaccess tutorials" target="_blank">
                                             <img width="16px" src="http://google.com/favicon.ico" alt="google favicon"> htaccess tutorial</a>
                                         </li>
                                         <li><a href="https://httpd.apache.org/docs/current/howto/htaccess.html" title="Read about htaccess at apache.org" target="_blank">
                                             <img width="16px" src="http://apache.org/favicon.ico" alt="apache favicon"> htaccess</a>
                                         </li>
                                         <li><a href="https://httpd.apache.org/docs/current/mod/mod_rewrite.html" title="Read about mod_rewrite at apache.org" target="_blank">
                                             <img width="16px" src="https://apache.org/favicon.ico" alt="apache favicon"> mod_rewrite</a>
                                         </li>
                                     </ul>
                                    </div>
                        </div>
                        <div class="panel-footer text-right">
				            <input class="btn btn-flat btn-primary" type="submit" name="ht-edit" value="Save all changes">
				        </div>
                        </form>
                     </div>
                </div>
                    
				<div class="col-md-3">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Information & Tips</h3>
						</div>
				        <div class="box-body">
						A .htaccess (hypertext access) file is a directory-level configuration file supported by several web servers, that allows for decentralized management of web server configuration. They are placed inside the web tree, and are able to override a subset of the server's global configuration for the directory that they are in, and all sub-directories.
                        </div>
				     </div>
                    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Common Usage</h3>
						</div>
				        <div class="box-body">
<ul>
<li><strong>Authorization, authentication</strong></li>
A .htaccess file is often used to specify security restrictions for a directory, hence the filename "access". The .htaccess file is often accompanied by a .htpasswd file which stores valid usernames and their passwords.
<li><strong>Rewriting URLs</strong></li>
Servers often use .htaccess to rewrite long, overly comprehensive URLs to shorter and more memorable ones.
<li><strong>Blocking</strong></li>
Use allow/deny to block users by IP address or domain. Also, use to block bad bots, rippers and referrers. Often used to restrict access by Search Engine spiders
<li><strong>SSI</strong></li>
Enable server-side includes.
<li><strong>Directory listing</strong></li>
Control how the server will react when no specific web page is specified.
    <li><strong>Customized error responses</strong></li>
Changing the page that is shown when a server-side error occurs, for example HTTP 404 Not Found or, to indicate to a search engine that a page has moved, HTTP 301 Moved Permanently.
<li><strong>MIME types</strong></li>
Instruct the server how to treat different varying file types.
<li><strong>Cache Control</strong></li>
.htaccess files allow a server to control caching by web browsers and proxies to reduce bandwidth usage, server load, and perceived lag.
</ul>
                        </div>
				     </div>
				</div>
				</div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<?php
footer();
?>