<?php

////////////////////////////////////////////////////////////////////////////////
// FUNCTION create_table()
////////////////////////////////////////////////////////////////////////////////
function create_table_query($table_name, $fields)
{
    global $pdo;

    $sql['query'] = 'CREATE TABLE IF NOT EXISTS `' . $table_name . '` (
					`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,                     
                    `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ';

    foreach ($fields as $field)
    {
        if (strpos($field, 'note') !== false)
        {
            $sql['query'] .= '`' . $field . '` TEXT DEFAULT NULL'  . (end($fields) == $field ? '' : ',');
        }
        else
        {
            $sql['query'] .= '`' . $field . '` VARCHAR(100) DEFAULT NULL'  . (end($fields) == $field ? '' : ',');
        }
    }

    if ($table_name == 'inventory' && in_array('mac_address', $fields))
    {
        $sql['query'] .= ', UNIQUE (mac_address)';
    }

    $sql['query'] .= ')';

    return $sql['query'];
}

////////////////////////////////////////////////////////////////////////////////
// FUNCTION fetch_existing_tables()
////////////////////////////////////////////////////////////////////////////////
function fetch_existing_tables()
{
	$data = [];

    $db = new Cosmos([
        'query' => 'SHOW TABLES FROM workshop',
    ]);
    $existing_tables = [];

    $et = $db->fetchAll();

    foreach ($et as $val)
    {
        $existing_tables[] = $val['Tables_in_workshop'];
    }
	
	if (!empty($existing_tables))
	{
		foreach ($existing_tables as $table)
		{
			$data[] = [
                'table' => $table, 
                'count' => fetch_existing_table_record_count($table)
			];
		}
	}

    return $data;
}

////////////////////////////////////////////////////////////////////////////////
// FUNCTION fetch_existing_table_record_count($table)
////////////////////////////////////////////////////////////////////////////////
function fetch_existing_table_record_count($table)
{
	$db = new Cosmos([
		'query' => 'SELECT COUNT(*) as count FROM ' . $table . ';',
	]);

    $count = $db->fetch();

	return $count['count'];
}


////////////////////////////////////////////////////////////////////////////////
// FUNCTION fetch_existing_table_record_count($table)
////////////////////////////////////////////////////////////////////////////////
function insert_asset($table_name = '', $data)
{
    global $pdo;
    $sql_error = [];

    $sql['query'] = 'INSERT INTO `' . $table_name . '` ';
    $sql['query'] .= '(' . implode(', ', array_keys($data[0])) . ') ';
    $ph = array_fill(0, count(array_keys($data[0])), '?');
    $sql['query'] .= 'VALUES (' . implode(', ', $ph) . ')' ;

    $errors = [];

    foreach ($data as $i => $item)
    {
        try
        {
            if (!$sql['sth'] = $pdo->prepare($sql['query']))
            {
                $error[] = 'prepare fail';
            }
            elseif (!$sql['sth']->execute(array_values($item)))
            {
                $error[] = 'execute fail';
            }
        }
        catch (PDOException $e)
        {
            $error[] = $e->getMessage();       
        }
    }

}
///////////////////////////////////////////////////////////////////////////////////
// Function get_table_fields()
///////////////////////////////////////////////////////////////////////////////////
function get_table_fields($tablename)
{
	$search = new Cosmos([
		'query' => "SELECT group_concat(COLUMN_NAME) as fields
					FROM INFORMATION_SCHEMA.COLUMNS
					WHERE TABLE_SCHEMA = 'workshop' AND TABLE_NAME = '" . $tablename . "'",
		'args' => []
	]);

	$db_table = $search->fetch();
	
	$db_table['fields'] = str_replace('id,', '', $db_table['fields']);
	$db_table['fields'] = str_replace('timestamp,', '', $db_table['fields']);

	$fields = explode(',', $db_table['fields']); 
	
	return $fields;
}