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
}
?>