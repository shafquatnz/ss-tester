<?php

namespace MySite;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HiddenField;

class DemoForm extends Form
{
	public function __construct($controller, $name, $action, $actionLabel) 
    {
		$fields = FieldList::create(
			TextField::create('numOne','First Number'),
			TextField::create('numTwo','Second Number'),
		);
		$actions = FieldList::create(
			FormAction::create($action, $actionLabel)
		);
		$required = RequiredFields::create(['numOne', 'numTwo']);
		parent::__construct($controller, $name, $fields, $actions, $required);
	}    
}
