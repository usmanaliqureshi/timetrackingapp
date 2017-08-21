<?php

require_once("configuration.php");

/**
 * Class timeApp
 */
class timeApp
{

    /**
     * @var private $connection
     */
    private $connection;

    /**
     * Construction of the MySQL Connection
     */
    function __construct()
    {

        $this->establish_connection();

    }

    /**
     * Connection to be established
     */
    public function establish_connection()
    {

        /**
         * Establishing MySQL Connection
         */
        $this->connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

        if (!$this->connection) {

            die(mysqli_error($this->connection));

        }

    }

    /**
     * Escaping the string for security
     * @param $string
     * @return string
     */
    public function escape_string($string)
    {

        $escaped_string = mysqli_real_escape_string($this->connection, $string);

        return $escaped_string;

    }

    /**
     * Sending the query to the MySQL Database
     * @param $sql_query
     * @return bool|mysqli_result
     */
    public function query($sql_query)
    {

        $sql_query = mysqli_query($this->connection, $sql_query);

        return $sql_query;

    }

    /**
     * Saving the task details for the user
     * @param $task_description
     * @param $total_time
     * @param $date
     * @param $user_id
     */
    public function save_the_task($task_description, $total_time, $date, $user_id)
    {

        /**
         * Escaping the input data
         */
        $task = $this->escape_string($task_description);
        $time = $this->escape_string($total_time);
        $user_id = $this->escape_string($user_id);
        $real_user_id = $this->escape_string($_SESSION['user_id']);

        $get_user = $this->query("SELECT * FROM users WHERE id = '" . $user_id . "'");
        $user_details = mysqli_fetch_array($get_user);

        if ($user_details['id'] == $real_user_id) {

            /**
             * Inserting the data into the Database
             */
            $query = $this->query("INSERT INTO times (date, task_desc, time, user_id) VALUES ('$date', '$task', '$time', '$user_id')");

            echo ($query) ? "Successfully Inserted" : "Insertion Failed" . mysqli_error($this->connection);

        } else {

            echo "User ID mismatched. Please refresh the page and try again.";

        }

    }

    /**
     * Processing the login, creating the session and redirecting the user depending on the username and password.
     * @param $username
     * @param $password
     */
    public function login($username, $password)
    {

        $username = $this->escape_string($username);
        $password = $this->escape_string($password);
        $password_md5 = md5($password);

        $query = $this->query("SELECT * FROM users WHERE username = '$username'");

        $user_info = mysqli_fetch_array($query);

        if ($user_info['password'] === $password_md5) {

            $_SESSION["user"] = $user_info['username'];
            $_SESSION["user_id"] = $user_info['id'];

            $this->redirect('tracktime.php');

        } else {

            session_unset();

            $this->redirect();

        }

    }

    /**
     * Checking if the session exists
     * @return bool
     */
    public function is_logged_in()
    {

        return (isset($_SESSION['user'])) ? true : false;

    }

    /**
     * Redirect to tthe $destination
     * @param $destination
     */
    public function redirect($destination = 'index.php')
    {

        header("location: " . $destination);

    }

    /**
     * Retrieve User Information from the DB and return
     * @param $info
     * @return mixed
     */
    public function get_user_info($info)
    {

        $user_id = $this->escape_string($_SESSION['user_id']);

        $query = $this->query("SELECT * FROM users WHERE id = '$user_id'");

        $user_info = mysqli_fetch_array($query);

        switch ($info) {

            case ('name' == $info):
                return $user_info['name'];
                break;

            case ('email' == $info):
                return $user_info['email'];
                break;

            case ('designation' == $info):
                return $user_info['designation'];
                break;

            case ('experience' == $info):
                return $user_info['experience'];
                break;

            case ('skills' == $info):
                return $user_info['skills'];
                break;

            case ('reg_date' == $info):
                return $user_info['reg_date'];
                break;

        }
    }

}
