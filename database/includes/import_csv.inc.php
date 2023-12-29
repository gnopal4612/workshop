<?php


class Import_CSV
{

	private $tmpfile = [];

	private $raw_headers = [];
	private $sanitized_headers = [];

	private $raw_data = [];
	private $sanitized_data = [];

	private $num_rows = 0;
	private $file_path = '/workshop/includes/assets/uploads/';

	private $csv_error = [];

	// auto called when object is created
	function __construct($filename, $path = '')
	{
		$this->filename = $filename;
		if (!empty($path)) {
			$this->file_path = $path;
		}

		$this->process_csv();
	}

	function process_csv()
	{
		$tmpfile = fopen($_SERVER['DOCUMENT_ROOT'] . $this->file_path . $this->filename, "r");

		$i = 0;
		while ($line = fgetcsv($tmpfile)) 
		{
			if ($i == 0) 
			{
				$this->sanitize_headers($line);
			} 
			else 
			{
				$this->sanitize_data($line);
			}
			$i++;
		}

		fclose($tmpfile);
	}

	////////////////////////////////////////////////////////////////////////////////
	// SETTERS
	////////////////////////////////////////////////////////////////////////////////

	function sanitize_headers($line)
	{
		foreach ($line as $h) 
		{
			if (!empty($h)) 
			{
				$this->sanitized_headers[] = $this->clean($h);
			}
		}
	}

	function sanitize_data($line)
	{
		$nl = [];
		foreach ($line as $l) 
		{
			$nl[] = trim($l);
		}

		if (count($nl) > count($this->sanitized_headers)) 
		{
			$nwl = array_pop($nl);
		}

		$this->sanitized_data[] = array_combine($this->sanitized_headers, $nl);


	}

	////////////////////////////////////////////////////////////////////////////////
// GETTERS
////////////////////////////////////////////////////////////////////////////////

	function get_headers()
	{
		return $this->sanitized_headers;
	}

	function get_data()
	{
		return $this->sanitized_data;
	}

	function get_num_rows()
	{
		return count($this->sanitized_data);
	}

	////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////
	function clean($string)
	{
		$string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
		$string = str_replace('-', '_', $string);
		$string = str_replace("___y_n", "", $string);
		$string = preg_replace('/[^A-Za-z0-9\_]/', '', strtolower($string)); // Removes special chars.

		return $string;
	}

}