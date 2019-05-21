<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model
{
   public function create_booking($screening, $seat, $email)
   {
      $this->db->trans_start();

      $bookings = [
         'screening_id'    => $screening,
         'seat_no'         => $seat,
         'email'           => $email
      ];

      $this->db->insert('tbl_reservations', $bookings);
      $insert_id = $this->db->insert_id();

      $this->db->trans_complete();

      if($this->db->trans_status() === FALSE)
      {
         $this->db->trans_rollback();
         return FALSE;
      } else {
         $this->db->trans_commit();
         return $insert_id;
      }
   }

   public function get_bookings()
   {
      return $this->db->select('*')
                      ->get('tbl_reservations')
                      ->result_array();
   }
}
