<?php
class map_mysql_redshift{
    public $type = array(
        'TINYINT'=>'INT2',
        'SMALLINT'=>'INT2',
        'MEDIUMINT'=>'INT',
        'BIGINT'=>'INT8',
        'BIT'=>'BIT',
        'TINYINT UNSIGNED'=>'INT2',
        'SMALLINT UNSIGNED'=>'INT',
        'MEDIUMINT UNSIGNED'=>'INT',
        'INT'=>'INT',
        'INT UNSIGNED'=>'BIGINT',
        'BIGINT UNSIGNED'=>'NUMERIC(20)',
        'DOUBLE'=>'FLOAT8',
        'FLOAT'=>'FLOAT4',
        'DECIMAL'=>'NUMERIC',
        'NUMERIC'=>'NUMERIC',
        'BOOLEAN'=>'BOOL',
        'DATE'=>'DATE',
        'TIME'=>'TIME',
        'DATETIME'=>'TIMESTAMP',
        'TIMESTAMP'=>'TIMESTAMP',
        'TIMESTAMP DEFAULT'=>'TIMESTAMP DEFAULT',
        'NOW'=>'NOW()', // in MYSQL it is () the the breakdown will takeaway the ()
        'LONGTEXT'=>'TEXT',
        'MEDIUMTEXT'=>'TEXT',
        'BLOB'=>'BYTEA',
        'VARCHAR'=>'CHARACTER VARYING',
        'CHAR'=>'CHARACTER',
        'ENUM'=>'TEXT',
        'TEXT'=>'TEXT',
        'SET'=>'TEXT',
    );
    
    public $remove_length = array(
        'INT2',
        'INT',
        'INT8',
        'TEXT',
    );
}