<?php

class Base {

    public $orderBy,
           $limit,
           $totalRows,
           $pageSize,
           $filter,
           $fields,
           $join;

	private $_lastid;

	public function __construct()
	{

		$this->db = DB::getInstance();
        $this->pageSize = 1;
	}

    public function OrderBy($field){
        if ($field){
            if (substr($field,0,1)=='-')
                $order=substr($field,1)." desc";
            else
                $order=$field." asc";
            $this->orderBy=$order;
        }
    }

    

    public function setFilter($filter = '')
    {
        $this->filter = $filter;
    }

    public function SetOrderBy($orderBy){
        if(!$orderBy) return;

        $this->orderBy = $orderBy;

    }


    public function SetLimit($limit,$start=0){
        $this->limit="LIMIT $start,$limit";
    }

    public function join($sql)
    {
        $this->join = $sql;
    }


	public function action($action, $table, $table_letter, $where)
	{


        $filter = $this->filter?" $this->filter":'';
	   

        $orderBy = $this->orderBy?" ORDER BY $this->orderBy":'';

        $join = $this->join?" LEFT JOIN $this->join":'';

		$sql = "{$action} FROM {$table} {$table_letter} {$join} WHERE 1 AND {$table_letter}.Deleted = 0 {$where} ";

        $lastSQL = "$sql $filter $orderBy $this->limit";

        $sql = "SELECT {$table_letter}.id FROM {$table} {$table_letter} {$join} WHERE 1 AND {$table_letter}.Deleted = 0 {$where}";

       // echo $lastSQL;
         $this->CalculatePagesBySQL($sql);

		//echo $lastSQL;
		if(!$this->db->query($lastSQL)){
			return $this;
		}

		return false;
	}

    public function baseQuery($sql)
    {
        $this->db->query($sql);
        return $this->db->results();
    }

    public function SetPage($pageNo){


        if($pageNo=='all'){
            $this->limit='';
            return;
        }

        $pageLimit = $this->pageSize;
        $from = ($pageNo-1) * $pageLimit;

        if($from<0) $from=0;

        //echo "limit $from,$pageLimit";

        $this->limit="LIMIT $from,$pageLimit";
    }



    public function CalculatePagesBySQL($sql) {


        //get the number of rows that match the query (without page limiting)

        

        $sql="SELECT COUNT(*) AS recCount FROM ($sql) as t";



        $this->db->query($sql);
        $this->totalRows = $this->db->first()->recCount;
        //var_dump( $sql);
        return $this->PageCount();
    }

    public function PageCount($filter='') {
        $p = ceil($this->totalRows / $this->pageSize);
        return $p;
    }

    
    
    public function updateByColumnName($table, $where, $fields) {

        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$where}";

        //var_dump($sql);exit;

        if(!$this->db->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

	public function insert($table, $fields = array()) {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;

        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(!$this->db->query($sql, $fields)->error()) {
            $this->_lastid = $this->db->_pdo->lastInsertId();
            //var_dump($this->_lastid);exit;
            return $this->_lastid;
        }

        return false;
    }

    public function update($table, $id, $fields) {

       // var_dump($fields);exit;


        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        //echo $sql;exit;
        if(!$this->db->query($sql, $fields)->error()) {
            
            return true;
        }

        return false;
    }


	public function item($table, $where = null)
	{
		$this->db->query('SELECT * FROM '. $table .' WHERE Deleted = 0 AND '. $where);
		return $this->db->first();
	}

	public function listItems($table, $where = null)
	{

        $table_letter = mb_substr($table, 0, 2);

        

        if($this->fields) {
            $this->action('SELECT '.$this->fields, $table, $table_letter, $where);
        } else {
            $this->action('SELECT *', $table, $table_letter, $where);
        }

		
		return $this->db->results();
	}

	public function delete($table, $id)
	{

       
		$this->update($table, $id, array('Deleted' => '1'));
	}


	//Permantaly delete
	public function deletePerma($table, $where)
	{

        $sql = "DELETE FROM {$table} WHERE {$where}";
        //var_dump($sql);exit;
        $this->db->query($sql);
		//$this->action('DELETE FROM ', $table, $where);
	}


}