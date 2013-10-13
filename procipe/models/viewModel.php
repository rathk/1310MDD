<?php
/**
* Model for instantiating the views on the page.
*/
class viewModel
{
	public function __construct()
	{
		
	}
	public function getView($pagename='', $data=array())
	{
		include $pagename;
	}

	public function changeView($page)
	{
		//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?'.$page'>';
	}
}
?>