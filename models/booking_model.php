<?php

class Booking_Model extends Model {


	public function __construct()
	{
		parent::__construct();
	}


	public function prefixNumber()
	{
		$sth = $this->db->prepare("SELECT * FROM prefixnumber LIMIT 1");
        $sth->execute();

        return $sth->fetch( PDO::FETCH_ASSOC );
	}
	public function prefixNumberUpdate($id, $data) {
		$this->db->update('prefixnumber', $data, "`prefix_id`={$id}");
	}


	public function get($id, $options=array())
	{
		$sth = $this->db->prepare("SELECT * FROM booking WHERE book_id=:id LIMIT 1");
        $sth->execute( array( ':id' => $id ) );

        if( $sth->rowCount()==1 ){
            return $this->convert( $sth->fetch( PDO::FETCH_ASSOC ), $options );
        } return array();
	}
	public function insert(&$data){
    	$this->db->insert('booking', $data);
    	$data['id'] = $this->db->lastInsertId();
    }
    public function buildFrag($results, $options=array()) {
        $data = array();
        foreach ($results as $key => $value) {
            if( empty($value) ) continue;
            $data[] = $this->convert( $value, $options );
        }

        return $data;
    }
    public function convert($data, $options=array()){

    	// $data = $this->_cutFirstFieldName($this->_cutNamefield, $data);
        
        $booking_list = $this->db->select("SELECT * FROM booking_list WHERE `book_code`=:code ORDER BY book_list_code ASC", array(':code'=>$data['book_code']));
        $items = array();
        foreach ($booking_list as $key => $value) {
        	$items[$value['book_list_code']] = $value;
        }

        $data['items'] = $items;

        return $data;
    }


    public function detailInsert(&$data){
    	$this->db->insert('booking_list', $data);
    	$data['id'] = $this->db->lastInsertId();
    }


}