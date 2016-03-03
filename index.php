<?php require('command-search-inc.php');
parse();
//var_dump($commands);
?>
<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="audience" content="all" />
    <meta name="document-rights" content="" />
    <meta name="language" content="en" />
    <meta name="robots" content="INDEX, FOLLOW" />
    <meta name="title" content="XPlane2Blender - Command Search" />
    <meta name="author" content="Ondrej Brinkel" />
    <meta name="owner" content="Ondrej Brinkel" />
    <meta name="publisher" content="Ondrej Brinkel" />
    <meta name="copyright" content="Ondrej Brinkel 2016" />
    <meta name="keywords" content="X-Plane, X-Plane 9, X-Plane 10, Commands, Command, XPlane2Blender" />
    <meta name="description" content="Search X-Plane Commands" />
    <meta name="document-type" content="Public" />

    <meta name="document-distribution" content="Global" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <title>X-Plane - Command Search</title>

    <link rel="stylesheet" href="command-search.css" type="text/css" />
    <script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="jquery.zclip.min.js"></script>
	<script type="text/javascript" src="command-search.js"></script>
</head>
<body>
    <div id="page">
        <div id="header">
            <h1>X-Plane - Command Search</h1>
			<ol class="howto">
				<li>Type in your search criteria and click "Search".</li>
				<li>Click on the command name you want to copy.</li>
				<li>Double click "Copy to clipboard" and paste the command into Blender.</li>
			</ol>
        </div>
		<div id="search">
			<form method="get">
				<label for="search-name">Name</label><input name="name" type="text" id="search-name" value="<?php print (isset($_GET['name']))?$_GET['name']:''; ?>" />
				<label for="search-description">Description</label><input name="description" type="text" value="<?php print (isset($_GET['description']))?$_GET['description']:''; ?>" />
				<input name="submit" type="submit" id="search-submit" value="Search"/>
			</form>
			<button id="copy-button" title="Double click to copy to clipboard">Copy to clipboard</button>
			<label for="test-copy">Test your clipboard</label><input id="test-copy" type="text" name="test" value="" />
			<p id="messages">
				Search matched <?php print count($commands); ?> commands. Found in <?php print $time; ?> seconds
			</p>
			<div class="clear"></div>
		</div>
        <div id="content">
            <table>
                <thead>
                    <th></th>
					          <th>Name</th>
                    <th>Description</th>
                </thead>
                <tbody id="search-results">
					      <?php print fillTable();?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
