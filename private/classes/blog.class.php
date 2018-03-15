<?php

class blog extends DatabaseObject {


static protected $table_name = 'blog';
static protected $db_columns = ['blogid', 'blogName', 'url', 'email', 'contractFName', 'contractLName', 'qualityScore', 'mozDA', 'sponsors', 'fqshop', 'gfairy', 'mstar'];


public $blogid;
public $blogName;
public $url;
public $contractFName;
public $contractLName;
public $qualityScore;
public $mozDA;
public $sponsors;
public $fqshop;
public $gfairy;
public $mstar;


// construct method
public function __construct($args=[]) {
  $this->useridid = $args['userid'] ?? NULL;
  $this->blogName = $args['blogName'] ?? '';
  $this->url = $args['url'] ?? '';
  $this->email = $args['email'] ?? '';
  $this->contractFName = $args['contractFName'] ?? '';
  $this->contractLName = $args['contractLName'] ?? '';
  $this->qualityScore = $args['qualityScore'] ?? '';
  $this->mozDA = $args['mozDA'] ?? '';
  $this->sponsors = $args['sponsors'] ?? '';
  $this->fqshop = $args['fqshop'] ?? '';
  $this->gfairy = $args['gfairy'] ?? '';
  $this->mstar = $args['mstar'] ?? '';

}


//remember to comment out 
static public function qualityScore($mozDA, $sponsors, $fqshop, $gfairy, $mstar){
if($fqshop == 1){$fq = 10;}else{$fq = 0;}
if($gfairy == 1){$gf = 10;}else{$gf = 0;}
if($mstar == 1){$ms = 10;}else{$ms = 0;}

$qualScore = $fg + $gf + $ms +$mozDA + $sponsors;

return $qualScore;

}

}
?>
