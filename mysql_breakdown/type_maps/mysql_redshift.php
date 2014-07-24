<?php
class map_mysql_redshift{
    public $type = array(
        'TINYINT'=>'SMALLINT',
        'MEDIUMINT'=>'INT',
        'TINYINT UNSIGNED'=>'SMALLINT',
        'SMALLINT UNSIGNED'=>'INTEGER',
        'MEDIUMINT UNSIGNED'=>'INTEGER',
        'INT UNSIGNED'=>'BIGINT',
        'BIGINT UNSIGNED'=>'NUMERIC(20)',
        'DOUBLE'=>'FLOAT8',
        'FLOAT'=>'DECIMAL',
        'DECIMAL'=>'NUMERIC',
        'BOOLEAN'=>'BOOL',
        'DATETIME'=>'TIMESTAMP',
        'TIMESTAMP DEFAULT'=>'TIMESTAMP',
        'NOW'=>'NOW()', // in MYSQL it is () the the breakdown will takeaway the ()
        'LONGTEXT'=>'TEXT',
        'MEDIUMTEXT'=>'TEXT',
        'BLOB'=>'BYTEA',
        'ENUM'=>'VARCHAR(100)',
        'TEXT'=>'VARCHAR(65535)',
        'SET'=>'TEXT',
    );

    public $encode_map = array(
	'VARCHAR' => 'TEXT255',
	'ENUM' => 'TEXT255',
	'BIGINT' => 'MOSTLY16',
        'TINYINT'=> 'MOSTLY8',
	'INT' => 'MOSTLY16',
	'SMALLINT' => 'MOSTLY8',
        'DATE'=>'DELTA32K',
        'TIME'=>'DELTA32K',
        'DATETIME'=>'DELTA32K',
        'TIMESTAMP'=>'DELTA32K',
	'CHAR' => 'BYTEDICT',
	'TEXT' => 'TEXT32K'
    );
    public $remove_length = array('BIGINT','SMALLINT','INTEGER','INT');
    public $remove_default_map = array('TIMESTAMP','DATE','TIME');

}
