<?php

class Contract extends DatabaseObject {


static protected $table_name = 'contract';
static protected $db_columns = ['contractid','paymentDate','paymentAmount', 'contractLength','blogid'];


public $contractid;
public $paymentDate;
public $paymentAmount;
public $contractLength;
public $blogid;



// construct method
public function __construct($args=[]) {
  $this->contractid = $args['contractid'] ?? NULL;
  $this->paymentDate = $args['paymentDate'] ?? '';
  $this->paymentAmount = $args['paymentAmount'] ?? '';
  $this->contractLength = $args['contractLength'] ?? '';
  $this->blogid = $args['blogid'] ?? '';


}


//remember to comment out 
static public function find_by_contract($id) {
	$sql = "SELECT * FROM contract";
	$sql .= " WHERE blogid='" . $id . "'";
	return static::find_by_sql($sql);
	
  }
}
?>
