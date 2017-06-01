<?php 
/*
Administrador de consultas motor PDO
funciones:

ADMSelect: consulta select. 3 opciones: table (para resultados en tabla), obj (para multiples usos) y col (un dato buscado).
	public function ADMSelect($_select, $_from, $whereCol = false, $wherePar = false, $whereCond = false, $_joins = false, $type = 'table')

ADMObtId: obtiene un id a partir de un dato x asociado al mismo registro.
	public function ADMObtId($table, $colum, $param)

ADMObtCol: obtiene un solo valor a partir de otro del mismo registro.
	public function ADMObtCol($_select, $table, $colum, $param)

ADMLastId: obtiene el ultimo id ingresado en una tabla.
	public function ADMLastId($table)

ADMInsert: consulta insert.
	public function ADMInsert($table, $colums, $params)
ADMUpdate: update.

	public function ADMUpdate($table, $colums, $params, $whereCol = false, $wherePar = false)
*/
class PDOadm extends DBConect
{	
	public $con;
	public $query;
	private $sql = null;
	private $result = null;
	private $debug = DEBUGadm;

	public function __construct()
	{
		$this->con=parent::conectar();
		parent::charset();
		parent::exep();
	}

	private function return_data()
	{
		if ($debug == false) 
		{
			return $result;
		}
		elseif ($debug == true)
		{
			return $sql;	
		}
	}

	private function check_param($param) //comprueba que el parámeto de entrada sea un array, si no lo es, lo devuelve como string.
	{
		if (!is_array($param)) 
		{
			$param = array($param);
			return $param;
		}
		else
		{
			return $param;
		}
	}

	public function ADMLogin($_select, $_from, $user, $pass)
	{	
		
		$rs = $this->ADMSelect($_select, $_from, array($_select[0], $_select[1]), array($user, $pass), array('= ', '= '));	
		$val = count($rs);
		if ($val == 1) 
		{
			return $rs;
		}
		else
		{
			return false;
		}
	}

	public function ADMSelect($_select, $_from, $whereCol = false, $wherePar = false, $whereCond = false, $_joins = false, $type = 'table') //consultas select generales
	{
		$_select = $this->check_param($_select);
		$_from = $this->check_param($_from);
		$whereCol = $this->check_param($whereCol);
		$wherePar = $this->check_param($wherePar);
		$whereCond = $this->check_param($whereCond);

		if ($_joins != false) 
		{
			$_joins = $this->check_param($_joins);
		}
		
		$select = '';
		foreach ($_select as $i)
		{
			$select .= "$i, ";
		}
		$select = 'SELECT '.trim($select, ', '); 

		$from = '';
		foreach ($_from as $i)
		{
			$from .= "$i, ";
		}
		$from = 'FROM '.trim($from, ', '); 

		$where = '';
		switch (true) 
		{
			case ($wherePar != false and $whereCond == false):
				foreach ($whereCol as $i)
				{
					 $where.= "$i = ? AND ";
				}
				$where = 'WHERE '.trim($where, ' AND ');
				break;

			case ($wherePar == false and $whereCond != false):
				$cond = 0;
				foreach ($whereCol as $i)
				{
					 $where.= "$i $whereCond[$cond] AND ";
					 $cond ++;
				}
				$where = 'WHERE '.trim($where, ' AND ');
				break;

			case ($wherePar != false and $whereCond != false):
				$countPar = count($wherePar);
				for ($i = 0; $i < $countPar; $i++) 
				{ 					
					$where.= "$whereCol[$i] = ? AND ";					
				}
				$countCond = count($whereCond);
				$cond = 0;
				for ($i = $countPar; $i < $countCond; $i++) 
				{ 	
					$where.= "$whereCol[$i] $whereCond[$cond] AND ";
					$cond++;
				}
				$where = 'WHERE '.trim($where, ' AND ');
				break;
		}
		
		if ($_joins != false) 
		{
			$joins= '';
			foreach ($_joins as $i)
			{
				$joins .= "INNER JOIN $i ";
			}
		}
		else
		{
			$joins = '';
		}
		
		$sql = "$select $from $joins $where;";

		if ($this->debug == true) 
		{
			return $sql;
			exit;		
		}	
						
		$query = $this->con->prepare($sql);
		switch (true) 
		{
			case ($wherePar != false and $whereCond == false):
				$query->execute($wherePar);
				break;
			case ($wherePar == false and $whereCond != false):
				$query->execute();
				break;
			case ($wherePar != false and $whereCond != false):
				$query->execute($wherePar);
				break;
			case ($wherePar == false and $whereCond == false):
				$query->execute();				
				break;
		}
				
		switch ($type) 
		{
			case 'table':
		//print_r($query->errorInfo());
				return $query->fetchAll();
				break;
			
			case 'obj':
				return $query->fetchObject();
				break;

			case 'col':
				return $query->fetchColumn();
				break;

			case 'count':
				return $query->rowCount();
				break;
		}	

	}

	public function ADMObtId($table, $colum, $param) //Obtiene el id de un registro a partir de otro valor dado del mismo registro
	{
		$sql = "SELECT id FROM $table WHERE $colum = ?";
		$param = array($param);
		$query = $this->con->prepare($sql);
		$query->execute($param);
		$id = $query->fetchColumn();
		return $id;
	}

	public function ADMObtCol($_select, $table, $colum, $param) //obtiene un solo campo de un registro de una tabla que cumpla con una condición determinada
	{
		$sql = "SELECT $_select FROM $table WHERE $colum = ?";
		$param = array($param);
		$query = $this->con->prepare($sql);
		$query->execute($param);
		$column = $query->fetchColumn();
		return $column;
	}

	public function ADMLastId($table) //obtiene el ultimo id ingresado a partir del nombre de la tabla
	{
		$sql = "SELECT max(id) FROM $table";
		//$param = array($table);
		$query = $this->con->prepare($sql);
		//print_r($query);
		$query->execute();
		$id = $query->fetchColumn();
		return $id;
	}

	public function ADMInsert($table, $colums, $params)
	{
		$colums = $this->check_param($colums);
		$params = $this->check_param($params);

		$inc = '';
		foreach ($colums as $i) 
		{
			$inc .= '?,';
		}	
		$inc = trim($inc, ','); //quita la ultima coma

		$colums = implode(', ', $colums); //transforma array en string separado poc comas para la consulta
		
		$sql = "INSERT INTO $table ($colums) VALUES ($inc) ";
		//echo $sql.'<br>';
		print_r($params);
		//print_r($params);
		$query = $this->con->prepare($sql);
		
		$retorno = '';
		if ($query->execute($params)) 
		{
			$retorno = 'ADMInsert';
		}
		else
		{
			$retorno = 'error_ADMInsert';
		}		
		//print_r($query);
		//print_r($query->errorInfo());
		return $retorno;					
	}

	public function ADMUpdate($table, $colums, $params, $whereCol = false, $wherePar = false)
	{		
		$colums = $this->check_param($colums);
		$params = $this->check_param($params);
		$whereCol = $this->check_param($whereCol);
		$wherePar = $this->check_param($wherePar);

		//print_r($table);

		$set = '';
		foreach ($colums as $i)
		{
			 $set.= "$i = ?, ";
		}
		$set = 'SET '.trim($set, ', ');

		$where = '';
		foreach ($whereCol as $i)
		{
			 $where.= "$i = ? AND ";
		}
		$where = 'WHERE '.trim($where, ' AND ');

		$sql = "update $table $set $where";

		$params = array_merge($params, $wherePar);

		$query = $this->con->prepare($sql);

		$retorno = '';
		if ($query->execute($params)) 
		{
			$retorno = 'ADMUpdate';
		}
		else
		{
		 $retorno = 'error_ADMUpdate';
		}
		//print_r($query);
		print_r($query->errorInfo());
		return $retorno;
	}
 }