<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Screening_model extends CI_Model
{
    public function create_screening($time, $film, $cinema)
    {
        // 1. Starting transaction in case something goes wrong.
        $this->db->trans_start();

        // 2. Declares a variable with all the inputted data.
        $screenings = [
            'time'           => $time,
            'film_id'        => $film,
            'cinema_id'      => $cinema
        ];

        // 3. Gives the instructions for the transaction.
        $this->db->insert('tbl_screenings', $screenings);
        $insert_id = $this->db->insert_id();

        // 4. End of transaction
        $this->db->trans_complete();

        // 5. If there are no errors, we can commit the transaction.
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $insert_id;
        }
    }

    // Retrieves all of the screenings in the database.
    public function get_screenings()
    {
        return $this->db->select('*')
                        ->join('tbl_films b', 'b.id = a.film_id')
                        ->join('tbl_cinema c', 'c.id = a.cinema_id')
                        ->where('a.time >', time()) // Only shows entries that are not before current time.
                        ->get('tbl_screenings a')
                        ->result_array();
    }

    // Retrieves the screenings of a particular film
    public function get_film_screenings($slug)
    {
        // Retrieves the film we are looking for from the slug and finds it's ID
        $film = $this->film_model->get_film($slug);
        $id = $film['id'];

        return $this->db->select('*')
                        ->join('tbl_films b', 'b.id = a.film_id')
                        ->join('tbl_cinema c', 'c.id = a.cinema_id')
                        ->order_by('a.time', 'ASC')
                        ->limit('5')
                        ->get_where('tbl_screenings a', ['a.film_id' => $id, 'a.time >' => time()])
                        ->result_array();
    }

    public function get_screening($id)
    {
        return $this->db->select('*')
                        ->get_where('tbl_screenings', ['screening_id' => $id])
                        ->row_array();
    }
}
