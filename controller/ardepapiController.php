<?php  

/**
* 
*/
class ardepapiController extends baseController
{
	public $layout = 'view/layout/ardepapiLayout.php';
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return helperView::showLayout();
	}

	
}