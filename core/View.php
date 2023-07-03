<?php
declare(strict_types=1);

// namespace Core;
class View
{
	function render(string $content, string $template)
	{	
		include 'views/'.$template;
	}
}