<?php
declare(strict_types=1);

// namespace Core;
class View
{
	function render(string $content, string $template)
	{	
		$file = 'views/'.$template;
		if(file_exists($file)) {
			include $file;
		}
	}
}