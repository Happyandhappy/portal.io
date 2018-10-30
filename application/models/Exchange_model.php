<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Exchange_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get announcements
     * @param  string $id    optional id     
     * @param  string $name  name of Exchange
     * @param  string $description  description of Exchange
     * @param  string $limit limit of query
     * @return mixed
     */

    // convert format of Date from Y-m-d H-m-s to Y-m-d
    public function getDate($date){
        $timestamp = strtotime($date);
        return date('Y-m-d', $timestamp);
    }

    // get record from exchange_list table
    public function get($id='', $limit=''){
        $tableData = [];

        if ($id == ''){
            if (is_numeric($limit)){
                $this->db->limit($limit);
            }
            $tableData = $this->db->get('exchange_list')->result();
        }
        else
            $tableData = $this->db->get_where('exchange_list', array('id' => $id))->result();    

        $data = [];
        foreach ($tableData as $row) {
            $row->createdAt = $this->getDate($row->createdAt);
            array_push($data, $row);
        }
        return $data;
    }

    // update record in exchange_list table
    public function update($id, $name, $description)
    {
        $data = array(
            "name" => $name,
            "createdAt" => date('Y-m-d H:i:s'),
            "description" => $description
        );
        
        $this->db->where('id', $id);
        $this->db->update('exchange_list', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    // add new record in exchange_list table
    public function add($name, $description){
        if (!isset($name) || !isset($description)) return false;
        $this->db->select('name');
        $this->db->where('name', $name);
        $result = $this->db->get('exchange_list');
        if($result->num_rows() > 0) {
            return false;
        }

        $data = array(
            "name" => $name,
            "createdAt" => date('Y-m-d'),
            "description" => $description
        );            

        $this->db->insert('exchange_list', $data);

        $insert_id = $this->db->insert_id();
        if ($insert_id)
            return true;
        else
            return false;
    }

    // delete a record in exchange_list table
    public function delete($id){
        $this->db->delete('exchange_list', array('id' => $id));

        if ($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }
/*    public function get($id = '', $where = array(), $limit = '')
    {
        $this->db->where($where);

        if (is_numeric($id)) {
            $this->db->where('announcementid', $id);

            return $this->db->get('tblannouncements')->row();
        }

        if (count($where) == 0 && $limit == '') {
            $announcements = $this->object_cache->get('all-user-announcements');
            if (!$announcements && !is_array($announcements)) {
                $this->_annoucements_query();
                $announcements = $this->db->get('tblannouncements')->result_array();
                $this->object_cache->add('all-user-announcements', $announcements);
            }
        } else {
            $this->_annoucements_query();

            if (is_numeric($limit)) {
                $this->db->limit($limit);
            }

            $announcements = $this->db->get('tblannouncements')->result_array();
        }

        return $announcements;
    }*/
}
