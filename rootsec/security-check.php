<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-check"></i> Security Check</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Security Check</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

                <div class="row">
				<div class="col-md-9">

							    <div class="nav-tabs-custom">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a href="#f1" data-toggle="tab" class="text-center">Command Execution</a>
									</li>
									<li>
										<a href="#f2" data-toggle="tab" class="text-center">PHP Code Execution</a>
									</li>
									<li>
										<a href="#f3" data-toggle="tab" class="text-center">Information Disclosure</a>
									</li>
									<li>
										<a href="#f4" data-toggle="tab" class="text-center">Filesystem Functions</a>
									</li>
									<li>
										<a href="#f5" data-toggle="tab" class="text-center">Other</a>
									</li>			
								</ul>
								<div class="tab-content">
									<div id="f1" class="tab-pane fade active in">
									    <br /><div class="well">Executing commands and returning the complete output</div>
										    <blockquote>
									    		<p>exec &nbsp;&nbsp;
<?php
if (function_exists('exec')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Returns last line of commands output</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>passthru &nbsp;&nbsp;
<?php
if (function_exists('passthru')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                &nbsp;&nbsp; <pre>Passes commands output directly to the browser</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>system &nbsp;&nbsp;
<?php
if (function_exists('system')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Passes commands output directly to the browser and returns last line</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>shell_exec &nbsp;&nbsp;
<?php
if (function_exists('shell_exec')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Returns commands output</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>popen &nbsp;&nbsp; 
<?php
if (function_exists('popen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Opens read or write pipe to process of a command</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>proc_open &nbsp;&nbsp; 
<?php
if (function_exists('proc_open')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Similar to popen() but greater degree of control</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>pcntl_exec &nbsp;&nbsp; 
<?php
if (function_exists('pcntl_exec')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Executes a program</pre></p>
									    	</blockquote>
									</div>
									
									<div id="f2" class="tab-pane fade">
										<br /><div class="well">Apart from eval there are other ways to execute PHP code: include/require can be used for remote code execution in the form of Local File Include and Remote File Include vulnerabilities.</div>
										    <blockquote>
									    		<p>eval &nbsp;&nbsp; 
                                                <span class="label label-danger">Not Disabled</span>
                                                <pre>Evaluate a string as PHP code</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>assert &nbsp;&nbsp; 
<?php
if (function_exists('assert')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                 <pre>Identical to eval()</pre></p>
									    	</blockquote>
                                            <blockquote>
									    		<p>preg_replace &nbsp;&nbsp; 
<?php
if (function_exists('preg_replace')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>Does an eval() on match</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>create_function &nbsp;&nbsp; 
<?php
if (function_exists('create_function')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Create an anonymous (lambda-style) function</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>include &nbsp;&nbsp; 
                                                <span class="label label-danger">Not Disabled</span>
                                                <pre>Includes and evaluates the specified file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>include_once &nbsp;&nbsp; 
                                                <span class="label label-danger">Not Disabled</span>
                                                <pre>Includes and evaluates the specified file during the execution of script</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>require &nbsp;&nbsp; 
                                                <span class="label label-danger">Not Disabled</span>
                                                <pre>Identical to include</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>require_once &nbsp;&nbsp; 
                                                <span class="label label-danger">Not Disabled</span>
                                                <pre>Identical to require except PHP will check if the file has already been included, and if so, not include (require) it again.</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>allow_url_fopen &nbsp;&nbsp; 
<?php
if (function_exists('allow_url_fopen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>
                                                <pre>This option enables the URL-aware fopen wrappers that enable accessing URL object like files - File inclusion vulnerability</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>allow_url_include &nbsp;&nbsp; 
<?php
if (function_exists('allow_url_include')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>This option allows the use of URL-aware fopen wrappers with the following functions: include, include_once, require, require_once - File inclusion vulnerability</pre></p>
									    	</blockquote>
									</div>
									
									<div id="f3" class="tab-pane fade">
									    <br /><div class="well">Most of these function calls are not sinks. But rather it maybe a vulnerability if any of the data returned is viewable to an attacker. If an attacker can see phpinfo() it is definitely a vulnerability.</div>
										    <blockquote>
									    		<p>phpinfo &nbsp;&nbsp; 
<?php
if (function_exists('phpinfo')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                              
                                                <pre>Outputs information about PHP's configuration</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>expose_php &nbsp;&nbsp; 
<?php
if (function_exists('expose_php')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                  
                                                <pre>Adds your PHP version to the response headers and this could be used for security exploits</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>display_errors &nbsp;&nbsp; 
<?php
if (function_exists('display_errors')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Shows PHP errors to the client and this could be used for security exploits</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>display_startup_errors &nbsp;&nbsp; 
<?php
if (function_exists('display_startup_errors')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Shows PHP startup sequence errors to the client and this could be used for security exploits</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>posix_getlogin &nbsp;&nbsp; 
<?php
if (function_exists('posix_getlogin')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Return login name</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>posix_ttyname &nbsp;&nbsp; 
<?php
if (function_exists('posix_ttyname')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Determine terminal device name</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>getenv &nbsp;&nbsp; 
<?php
if (function_exists('getenv')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets the value of an environment variable</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>get_current_user &nbsp;&nbsp; 
<?php
if (function_exists('get_current_user')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets the name of the owner of the current PHP script</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>proc_get_status &nbsp;&nbsp; 
<?php
if (function_exists('proc_get_status')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Get information about a process opened by proc_open()</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>get_cfg_var &nbsp;&nbsp; 
<?php
if (function_exists('get_cfg_var')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets the value of a PHP configuration option</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>disk_free_space &nbsp;&nbsp; 
<?php
if (function_exists('disk_free_space')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Returns available space on filesystem or disk partition</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>disk_total_space &nbsp;&nbsp; 
<?php
if (function_exists('disk_total_space')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Returns the total size of a filesystem or disk partition</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>diskfreespace &nbsp;&nbsp; 
<?php
if (function_exists('diskfreespace')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Alias of disk_free_space()</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>getcwd &nbsp;&nbsp; 
<?php
if (function_exists('getcwd')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets the current working directory</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>getmygid &nbsp;&nbsp; 
<?php
if (function_exists('getmygid')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Get PHP script owner's GID</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>getmyinode &nbsp;&nbsp; 
<?php
if (function_exists('getmyinode')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets the inode of the current script</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>getmypid &nbsp;&nbsp; 
<?php
if (function_exists('getmypid')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets PHP's process ID</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>getmyuid &nbsp;&nbsp; 
<?php
if (function_exists('getmyuid')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets PHP script owner's UID</pre></p>
									    	</blockquote>
									</div>
									
									<div id="f4" class="tab-pane fade">
									    <br /><div class="well">According to RATS all filesystem functions in PHP are nasty. Some of these don't seem very useful to the attacker. Others are more useful than you might think. For instance if allow_url_fopen=On then a url can be used as a file path, so a call to copy($_GET['s'], $_GET['d']); can be used to upload a PHP script anywhere on the system. Also if a website is vulnerable to a request send via GET everyone of those file system functions can be abused to channel and attack to another host through your server.</div>
										    <blockquote>
									    		<p>fopen &nbsp;&nbsp; 
<?php
if (function_exists('fopen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Opens file or URL</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>tmpfile &nbsp;&nbsp; 
<?php
if (function_exists('tmpfile')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Creates a temporary file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>bzopen &nbsp;&nbsp; 
<?php
if (function_exists('bzopen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Opens a bzip2 compressed file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>gzopen &nbsp;&nbsp; 
<?php
if (function_exists('gzopen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Open gz-file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>SplFileObject->__construct &nbsp;&nbsp; 
                                                <span class="label label-danger">Not Disabled</span>
                                                <pre>Write to filesystem (partially in combination with reading)</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>chgrp &nbsp;&nbsp; 
<?php
if (function_exists('chgrp')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Changes file group</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>chmod &nbsp;&nbsp; 
<?php
if (function_exists('chmod')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Changes file mode</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>chown &nbsp;&nbsp; 
<?php
if (function_exists('chown')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Changes file owner</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>copy &nbsp;&nbsp; 
<?php
if (function_exists('copy')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Copies file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>file_put_contents &nbsp;&nbsp; 
<?php
if (function_exists('file_put_contents')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre></pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>lchgrp &nbsp;&nbsp; 
<?php
if (function_exists('lchgrp')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Changes group ownership of symlink</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>lchown &nbsp;&nbsp; 
<?php
if (function_exists('lchown')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Changes user ownership of symlink</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>link &nbsp;&nbsp; 
<?php
if (function_exists('link')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Create a hard link</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>mkdir &nbsp;&nbsp; 
<?php
if (function_exists('mkdir')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Makes directory</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>move_uploaded_file &nbsp;&nbsp; 
<?php
if (function_exists('move_uploaded_file')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Moves an uploaded file to a new location</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>rename &nbsp;&nbsp; 
<?php
if (function_exists('rename')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Renames a file or directory</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>rmdir &nbsp;&nbsp; 
<?php
if (function_exists('rmdir')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Removes directory</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>symlink &nbsp;&nbsp; 
<?php
if (function_exists('symlink')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Creates a symbolic link</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>tempnam &nbsp;&nbsp; 
<?php
if (function_exists('tempnam')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Create file with unique file name</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>touch &nbsp;&nbsp; 
<?php
if (function_exists('touch')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Sets access and modification time of file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>unlink &nbsp;&nbsp; 
<?php
if (function_exists('unlink')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Deletes a file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>ftp_get &nbsp;&nbsp; 
<?php
if (function_exists('ftp_get')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Downloads a file from the FTP server</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>ftp_nb_get &nbsp;&nbsp; 
<?php
if (function_exists('ftp_nb_get')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Read from filesystem</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>file_exists &nbsp;&nbsp; 
<?php
if (function_exists('file_exists')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Checks whether a file or directory exists</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>file_get_contents &nbsp;&nbsp; 
<?php
if (function_exists('file_get_contents')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Reads entire file into a string</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>file &nbsp;&nbsp; 
<?php
if (function_exists('file')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Reads entire file into an array</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>fileatime &nbsp;&nbsp; 
<?php
if (function_exists('fileatime')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets last access time of file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>filectime &nbsp;&nbsp; 
<?php
if (function_exists('filectime')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets inode change time of file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>filegroup &nbsp;&nbsp; 
<?php
if (function_exists('filegroup')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file group</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>fileinode &nbsp;&nbsp; 
<?php
if (function_exists('fileinode')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file inode</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>filemtime &nbsp;&nbsp; 
<?php
if (function_exists('filemtime')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file modification time</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>fileowner &nbsp;&nbsp; 
<?php
if (function_exists('fileowner')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file owner</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>fileperms &nbsp;&nbsp; 
<?php
if (function_exists('fileperms')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file permissions</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>filesize &nbsp;&nbsp; 
<?php
if (function_exists('filesize')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file size</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>filetype &nbsp;&nbsp; 
<?php
if (function_exists('filetype')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets file type</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>glob &nbsp;&nbsp; 
<?php
if (function_exists('glob')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Find pathnames matching a pattern</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_dir &nbsp;&nbsp; 
<?php
if (function_exists('is_dir')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether filename is a directory</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_executable &nbsp;&nbsp; 
<?php
if (function_exists('is_executable')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether filename is executable</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_file &nbsp;&nbsp; 
<?php
if (function_exists('is_file')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether filename is a regular file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_link &nbsp;&nbsp; 
<?php
if (function_exists('is_link')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether filename is a symbolic link</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_readable &nbsp;&nbsp; 
<?php
if (function_exists('is_readable')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether a file exists and is readable</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_uploaded_file &nbsp;&nbsp; 
<?php
if (function_exists('is_uploaded_file')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether file was uploaded via HTTP POST</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>is_writable &nbsp;&nbsp; 
<?php
if (function_exists('is_writable')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Tells whether filename is writable</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>linkinfo &nbsp;&nbsp; 
<?php
if (function_exists('linkinfo')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gets information about a link</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>lstat &nbsp;&nbsp; 
<?php
if (function_exists('lstat')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gives information about a file or symbolic link</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>parse_ini_file &nbsp;&nbsp; 
<?php
if (function_exists('parse_ini_file')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Parse a configuration file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>pathinfo &nbsp;&nbsp; 
<?php
if (function_exists('pathinfo')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Returns information about a file path</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>readfile &nbsp;&nbsp; 
<?php
if (function_exists('readfile')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Outputs a file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>readlink &nbsp;&nbsp; 
<?php
if (function_exists('readlink')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Returns target of a symbolic link</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>realpath &nbsp;&nbsp; 
<?php
if (function_exists('realpath')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Returns canonicalized absolute pathname</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>stat &nbsp;&nbsp; 
<?php
if (function_exists('stat')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Gives information about a file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>gzfile &nbsp;&nbsp; 
<?php
if (function_exists('gzfile')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Read entire gz-file into an array</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>readgzfile &nbsp;&nbsp; 
<?php
if (function_exists('readgzfile')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Output a gz-file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>ftp_put &nbsp;&nbsp; 
<?php
if (function_exists('ftp_put')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Uploads a file to FTP server</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>ftp_nb_put &nbsp;&nbsp; 
<?php
if (function_exists('ftp_nb_put')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Stores a file on FTP server (non-blocking)</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>highlight_file &nbsp;&nbsp; 
<?php
if (function_exists('highlight_file')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Syntax highlighting of a file</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>show_source &nbsp;&nbsp; 
<?php
if (function_exists('show_source')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Alias of highlight_file()</pre></p>
									    	</blockquote>
									</div>
									
									<div id="f5" class="tab-pane fade">
									     <br />
										    <blockquote>
									    		<p>extract &nbsp;&nbsp; 
<?php
if (function_exists('extract')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Opens the door for register_globals attacks</pre></p>
									    	</blockquote>
                                            <blockquote>
									    		<p>parse_str &nbsp;&nbsp; 
<?php
if (function_exists('parse_str')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Works like extract if only one argument is given</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>putenv &nbsp;&nbsp; 
<?php
if (function_exists('putenv')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Sets value of an environment variable</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>ini_set &nbsp;&nbsp; 
<?php
if (function_exists('ini_set')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Sets value of a configuration option</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>mail &nbsp;&nbsp; 
<?php
if (function_exists('mail')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Has CRLF Injection in the 3rd parameter, opens the door for spam. </pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>header &nbsp;&nbsp; 
<?php
if (function_exists('header')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>On old systems CRLF injection could be used for xss or other purposes, now it is still a problem if they do a header("location: ..."); and they do not die();. The script keeps executing after a call to header(), and will still print output normally. This is nasty if you are trying to protect an administrative area. </pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>proc_nice &nbsp;&nbsp; 
<?php
if (function_exists('proc_nice')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Change the priority of current process</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>proc_terminate &nbsp;&nbsp; 
<?php
if (function_exists('proc_terminate')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Kills a process opened by proc_open</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>proc_close &nbsp;&nbsp; 
<?php
if (function_exists('proc_close')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Close a process opened by proc_open() and return the exit code of that process</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>pfsockopen &nbsp;&nbsp; 
<?php
if (function_exists('pfsockopen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Open persistent Internet or Unix domain socket connection</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>fsockopen &nbsp;&nbsp; 
<?php
if (function_exists('fsockopen')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Open Internet or Unix domain socket connection</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>apache_child_terminate &nbsp;&nbsp; 
<?php
if (function_exists('apache_child_terminate')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Terminate apache process after request</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>posix_kill &nbsp;&nbsp; 
<?php
if (function_exists('posix_kill')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Send a signal to a process</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>posix_setpgid &nbsp;&nbsp; 
<?php
if (function_exists('posix_setpgid')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Set process group id for job control</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>posix_setsid &nbsp;&nbsp; 
<?php
if (function_exists('posix_setsid')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Make current process a session leader</pre></p>
									    	</blockquote>
											<blockquote>
									    		<p>posix_setuid &nbsp;&nbsp; 
<?php
if (function_exists('posix_setuid')) {
    echo '<span class="label label-danger">Not Disabled</span>';
} else {
    echo '<span class="label label-success">Disabled</span>';
}
?>                                                
                                                <pre>Set UID of current process</pre></p>
									    	</blockquote>
									</div>
								</div>
							    </div>
                        
                     
                </div>
                    
				<div class="col-md-3">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Information & Tips</h3>
						</div>
				        <div class="box-body">
							  On this page you can see which vulnerable PHP Functions are enabled on your host.<br />
				              If you decide you can disable them from the php.ini file on your host.		
                        </div>
				     </div>
                     <div class="box">
						<div class="box-header">
							<h3 class="box-title">How to Disable PHP Functions</h3>
						</div>
				        <div class="box-body">
							  <ol>
									<li>Find the php.ini file on your host</li>
									<li>Open the php.ini file</li>
									<li>Find disable_functions and set new list as follows: &nbsp;&nbsp; <pre>disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_multi_exec,parse_ini_file,show_source</pre></li>
									<li>Save and close the file. Restart the HTTPD Server (Apache)</li>
				             </ol>		
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