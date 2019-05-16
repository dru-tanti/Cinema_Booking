<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cinema_model extends CI_Model
{
   public function create_cinema($name, $capacity)
   {
      $this->db->trans_start();

      $cinema = [
         'name'      => $name,
         'capacity'  => $capacity
      ];

      $this->db->insert('tbl_cinema', $cinema);
      $insert_id = $this->db->insert_id();

      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE)
      {
         $this->db0>trans_rollback();
         return FALSE;
      } else {
         $this->db->trans_commit();
         return $insert_id;
      }
   }

   public function delete_cinema($id)
   {
       $this->db->delete('tbl_cinema', ['id' => $id]);
   }

   public function get_cinema($id)
   {
       return $this->db
                   ->get_where('tbl_cinema', ['id' => $id])
                   ->row_array();
   }

   public function get_cinemas()
   {
      return $this->db->select('*')
                      ->get('tbl_cinema')
                      ->result_array();
   }

   public function update_cinema($id, $name, $capacity)
   {
       $this->db->where('id', $id)
                ->update('tbl_cinema', [
                    'name'      => $name,
                    'capacity'  => $capacity
                ]);
        return $this->db->affected_rows() == 1;
   }

}
