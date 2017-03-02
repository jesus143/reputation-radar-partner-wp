<?php
/**
 * Created by PhpStorm.
 * User: C
 * Date: 9/12/2016
 * Time: 11:11 PM
 */

namespace APP;

/**
 * Class RRP_QUERIES
 * @package APP
 * @src http://wordpress.stackexchange.com/questions/1604/using-wpdb-to-connect-to-a-separate-database
 */

class RRP_QUERIES
{
    private $table_name = 'wp_reputation_radar_settings';
    private $wpdb;

    /**
     * WPDB_QUERIES constructor.
     * @param null $table_name
     */
    function __construct($table_name=null)
    {
        // set table name
        $this->table_name = $table_name;




        // database connection
        global $database;
        $this->database =  $database;
    }



    private function connect($user, $pass, $db, $host)
    {

//        return $mydb;
    }


    /**
     * @param $query_string
     * @param $output_type
     * OBJECT - result will be output as an object.
     * ARRAY_A - result will be output as an associative array.
     * ARRAY_N - result will be output as a numerically indexed array.
     * @Return $output_type
     */
    public function wpdb_get_result($query_string, $output_type=ARRAY_A) {

        return $this->database->get_results($query_string, $output_type );
    }

    /**
     *
     */
    public function wpdb_query()
    {
    }

    /**
     * @param array $data_array
     * @param array $where
     * @return bool
     */
    public function wpdb_update($data_array=array(), $where) {

        // print "<pre>";
        // print_r($data_array);
        // print "</pre>";
        $trows = $this->database->update(
            $this->table_name, 
            $data_array,
            $where,
            $this->wpdb_get_value_type($data_array),
            $this->wpdb_get_value_type($where)
        );
        if($trows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $where
     * @return bool
     */
    public function wpdb_delete($where=array()) {

        $trows = $this->database->delete(
            $this->table_name,
            $where,
            $this->wpdb_get_value_type($where)
        );
        if($trows >= 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $data_array
     * @return bool
     */
    public function wpdb_insert($data_array=array(), $conn=null)
    {
        //print_r($data_array);
        if($conn == null) {
            global $wpdb;
        } else {
            $wpdb = $conn;
        }

        $trows = $this->database->insert(
                $this->table_name,
            $data_array,
            $this->wpdb_get_value_type($data_array)
        );
        if($trows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $data_array
     * @return array|string
     */
    public function wpdb_get_value_type($data_array=array())
    {
        if(is_array($data_array)) {
            $values_type = array();
            foreach($data_array as $key => $value) {
                if(is_string($value)) {
                    $values_type[] = '%s';
                } else {
                    $values_type[] = '%d';
                }
            }
            // print_r($values_type); 
            return $values_type;
        } else {
            return "please supply array value array('rowname'=>'rowvalue')";
        }
    } 
}