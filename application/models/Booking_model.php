<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model
{
   public function create_booking($screening, $seats, $email)
   {
       // 1. Starting transaction in case something goes wrong.
        $this->db->trans_start();

        // 2. Depending on how many seats have been chosen, we are going to prepare an array with all the .
        if(count($seats) > 0)
        {
            $bookings = [];
            foreach($seats as $seat)
            {
                // 3. Declares a variable with all the inputted data.
                $bookings [] = [
                    'screening_id'    => $screening,
                    'seat_no'         => $seat,
                    'email'           => $email
                ];
            }
            // 4. Gives the instructions for the transaction.
            $this->db->insert_batch('tbl_bookings', $bookings);
            $insert_id = $this->db->insert_id();
        }

        // 5. End of transaction
        $this->db->trans_complete();

        // 6. If there are no errors, we can commit the transaction.
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $insert_id;
        }
   }

   // Retrieves all of the bookings in the database.
   public function get_bookings()
   {
      return $this->db->select("*, GROUP_CONCAT(a.seat_no SEPARATOR ', ') AS seat_no")
                      ->join('tbl_screenings b', 'b.screening_id = a.screening_id')
                      ->join('tbl_films c', 'c.id = b.film_id')
                      ->join('tbl_cinema d', 'd.id = b.cinema_id')
                      ->group_by('a.screening_id, a.email')
                      ->where('b.time >', time()) // Only shows entries that are not before current time.
                      ->get('tbl_bookings a')
                      ->result_array();
   }
}
