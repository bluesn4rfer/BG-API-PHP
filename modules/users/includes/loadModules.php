<?php
	require("core/helpers/strings.php");

	function loadModules($dir = "modules"){
		$modules = array();
	        if (is_dir($dir)) {
				if ($dir_handle = opendir($dir)) {
					while (($file = readdir($dir_handle)) !== false) {
						if(!str_starts_with($file,".")){
							if(filetype($dir."/".$file) == "dir"){
								$modules[str_replace("modules/","","$dir/$file")] = true;
							}
						}
					}
					closedir($dir_handle);
				}
        	}
		return $modules;
	}
?>
