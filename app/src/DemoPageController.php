<?php

namespace MySite;
use PageController;
use MySite\DemoForm;
use MySite\CalculationHelper;

class DemoPageController extends PageController 
{

	private static $allowed_actions = [
        'index', 'DemoEntryForm'
	];

	public function index()
    {
        return [
			'DemoAction' => 'index'
		];
	}
	
	public function DemoEntryForm()
    {
        $form = new DemoForm($this, 'DemoEntryForm', 'processData', 'Add the numbers');
        return $form;
	}

    public function processData($data, $form)
    {
		$result = CalculationHelper::addTwoNumbers($data['numOne'], $data['numTwo']);
        return [
			'numOne' => $data['numOne'],
			'numTwo' => $data['numTwo'],
			'result' => $result
		];
	}
	
}
