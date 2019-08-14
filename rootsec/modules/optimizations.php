<?php
//Optimization Functions
$table = $prefix . 'optimization-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);

if ($row['html-minify'] == "Yes") {
    
    function htmlcompress($buffer)
    {
        $search  = array(
            '/\>[^\S ]+/s', // Strip whitespaces after tags, except space
            '/[^\S ]+\</s', // Strip whitespaces before tags, except space
            '/(\s)+/s', // Shorten multiple whitespace sequences
			'/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
			''
        );
        $buffer  = preg_replace($search, $replace, $buffer);
        $buffer  = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);
        return $buffer;
    }
    
    ob_start("htmlcompress");
    
}
?>