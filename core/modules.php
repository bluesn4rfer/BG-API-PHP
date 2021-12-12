<?php
	function loadModules($dir = "modules"){
		$modules = array();
	        if (is_dir($dir)) {
        	        if ($dir_handle = opendir($dir)) {
                	        while (($file = readdir($dir_handle)) !== false) {
					if(!str_starts_with($file,".")){
						if(filetype($dir."/".$file) == "dir"){
							$modules = array_merge($modules, loadModules($dir."/".$file));
						}
						else{
							if(str_ends_with($file,".php")){
								$modules[str_replace(".php","",$file)] = str_replace("modules/","",$dir);
							}
						}
					}
                        	}
                        	closedir($dir_handle);
                	}
        	}
		return $modules;
	}
?>
