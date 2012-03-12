<?php
defined('_UOVCA') or die();

class Db {
	
	static private $instance = null;
	
	public function __construct(){
		$db = Config::get('database');
		
		$conn_string = "host=".$db->host." port=".$db->port." dbname=".$db->database." user=".$db->user." password=".$db->password;
		$this->link = pg_connect($conn_string);
	
		if (!$this->link) die('Could not connect to the database.');
	}
	
	public static function getInstance(){
		if (!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function buildQuery($sql){
		$qb = new queryBuilder($sql);
		return $qb->build();
	}
	
	private function query($sql, $type='list'){
		
		//debug(__FILE__.':'.__LINE__);
		//debug($sql);
		
		
		$sql = trim($sql);
		if(!$sql)return false;
		
		$sql= $this->replacePrefix($sql);
		
		$result = pg_exec($this->link, $sql);
	
		if ($result == false)die('Uncovered an error in your SQL query script: "' . pg_errormessage($this->link) . '"<br />'.$sql);
		else{
			if(!pg_num_rows($result))return null;
			
			if($type=='record'){				
				$row=pg_fetch_array($result, 0, PGSQL_NUM);
				return $row[0];
			}
			else if($type=='row'){
				$row=pg_fetch_object($result);
				return $row;
			}
			else {//$type='list'
				$out = array();
				while ($row = pg_fetch_object($result)) {
					$out[]=$row;
				}
				return $out;
			}
		}
	}
	
	public function getList($sql){
		return $this->query($sql);
	}
	
	public static function getRow($sql){
		
		$q = self::getInstance();
		
		if(is_array($sql))$sql = $q->buildQuery($sql);
		return $q->query($sql, 'row');
	}
	
	public function getRecord($sql){
		return $this->query($sql, 'record');
	}
	
	public static function esc($text, $noquote=false){
		
		if(is_numeric($text) || is_bool($text))$noquote=true;
		$out=(!$noquote)?"'":'';
		$out.= pg_escape_string($text);
		$out.=(!$noquote)?"'":'';
		
		return $out;
	}
	
	
	private function replacePrefix($sql, $prefix = ' __')
	{
		// Initialize variables.
		$escaped = false;
		$startPos = 0;
		$quoteChar = '';
		$literal = '';
		$schema = Config::get('database')->schema;

		$sql = trim($sql);
		$n = strlen($sql);

		while ($startPos < $n){
			$ip = strpos($sql, $prefix, $startPos);
			if ($ip === false){
				break;
			}

			$j = strpos($sql, "'", $startPos);
			$k = strpos($sql, '"', $startPos);
			if (($k !== false) && (($k < $j) || ($j === false))){
				$quoteChar = '"';
				$j = $k;
			}
			else{
				$quoteChar = "'";
			}

			if ($j === false){
				$j = $n;
			}

			$literal .= str_replace($prefix, ' '.$schema.'.', substr($sql, $startPos, $j - $startPos));
			$startPos = $j;

			$j = $startPos + 1;

			if ($j >= $n){
				break;
			}

			// quote comes first, find end of quote
			while (true){
				$k = strpos($sql, $quoteChar, $j);
				$escaped = false;
				if ($k === false)
				{
					break;
				}
				$l = $k - 1;
				while ($l >= 0 && $sql{$l} == '\\')
				{
					$l--;
					$escaped = !$escaped;
				}
				if ($escaped)
				{
					$j = $k + 1;
					continue;
				}
				break;
			}
			if ($k === false)
			{
				// error in the query - no end quote; ignore it
				break;
			}
			$literal .= substr($sql, $startPos, $k - $startPos + 1);
			$startPos = $k + 1;
		}
		if ($startPos < $n)
		{
			$literal .= substr($sql, $startPos, $n - $startPos);
		}

		return $literal;
	}
}
