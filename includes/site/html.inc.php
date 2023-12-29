<?php

class Html
{
	public $output = [];

	// auto called when object is created
	function __construct($data)
	{
		foreach ($data as $field => $settings) 
		{

			$this->output[] = '<div class="input-group mb-2">';
			$this->output[] = '<label class="input-group-text col-3" for="' . $settings['properties']['id'] . '" >' . $settings['label'] . '</label>';

			$inject = '';
			foreach ($settings['properties'] as $p => $v)
			{
				$inject .= $p . '="' . $v . '" ';
			}
			// $inject = sprintf('name="%s" id="%s"', $settings['properties']['name'], $settings['properties']['id']);

			switch ($settings['input']) 
			{
				case 'select':

					$this->output[] = '<select class="form-select" ' . $inject . ' aria-label="">';

					foreach ($settings['options'] as $option) 
					{
						$this->output[] = '<option>' . $option . '</option>';
					}

					$this->output[] = '</select>';
					break;
				case 'checkbox':

					break;
				case 'radio':

					break;
				case 'textarea':

					break;
				case 'button':

					break;
				default:
					$this->output[] = '<input type="text" class="form-control"  ' . $inject . ' aria-label="" aria-describedby="inputGroup-sizing-default">';
			}

			$this->output[] = '</div>';

		}
	}

	/// Builder Functions /// 



	/// Form Functions ///
	function text()
	{
	}

	function select()
	{
	}

	function checkbox()
	{
	}

	function radio()
	{
	}

	function button()
	{

	}


	///  Setters /// 


	/// Getters ///
	function display_form()
	{
		echo implode('', $this->output);
	}


}