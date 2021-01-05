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
    private $hou = 0;
    private $min = 0;
    private $sec = 0;

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
     * @param $user_id
     */
    public function save_the_task($task_description, $total_time, $user_id)
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
            $query = $this->query("INSERT INTO times (task_desc, time, user_id) VALUES ('$task', '$time', '$user_id')");

            echo ($query) ? "Time Successfully Logged" : "Time Log Failed " . mysqli_error($this->connection);

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

            $this->redirect('dashboard.php');

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

            case ('location' == $info):
                return $user_info['location'];
                break;

        }
    }

    /**
     * Saving profile information to the database
     * @param $name
     * @param $email
     * @param $location
     * @param $designation
     * @param $experience
     * @param $skills
     */
    public function save_the_profile($name, $email, $location, $designation, $experience, $skills)
    {

        /**
         * Escaping the input data
         */
        $escaped_name = $this->escape_string($name);
        $escaped_email = $this->escape_string($email);
        $escaped_location = $this->escape_string($location);
        $escaped_designation = $this->escape_string($designation);
        $escaped_experience = $this->escape_string($experience);
        $escaped_skills = $this->escape_string($skills);

        $username = $this->escape_string($_SESSION['user']);

        /**
         * Inserting the data into the Database
         */
        $query = $this->query("UPDATE users SET name = '$escaped_name', email = '$escaped_email', location = '$escaped_location', designation = '$escaped_designation', experience = '$escaped_experience', skills = '$escaped_skills' WHERE username = '$username'");

        echo ($query) ? "<i class='icon fa fa-check'></i> Profile Successfully Updated for " . $username : "Insertion Failed: " . mysqli_error($this->connection);

    }

    /**
     * Getting Total Number of Users registered
     * @return mixed
     */
    public function total_registrations()
    {

        $users = $this->query("SELECT COUNT(*) AS TotalRegistrations  FROM users");

        $total_users = mysqli_fetch_object($users);

        echo $total_users->TotalRegistrations;

    }

    /**
     * Getting Total Number of Tasks from the system
     * @return mixed
     */
    public function total_tasks()
    {

        $tasks = $this->query("SELECT COUNT(DISTINCT task_desc) AS TotalTasks  FROM times");

        $total_tasks = mysqli_fetch_object($tasks);

        echo $total_tasks->TotalTasks;

    }

    /**
     * Calculate total time
     * @param $times [array]
     */
    public function get_total_time($times)
    {

        if (!empty($times) && is_array($times)) {

            $length = sizeof($times);

            for ($x = 0; $x <= $length; $x++) {
                $split = explode(":", @$times[$x]);
                $this->hou += @$split[0];
                $this->min += @$split[1];
                $this->sec += @$split[2];
            }

            $seconds = $this->sec % 60;
            $minutes = $this->sec / 60;
            $minutes = (integer)$minutes;
            $minutes += $this->min;
            $hours = $minutes / 60;
            $minutes = $minutes % 60;
            $hours = (integer)$hours;
            $hours += $this->hou % 24;

            echo "$hours <sup style='font-size: 20px'>hrs</sup> $minutes <sup style='font-size: 20px'>mins</sup> $seconds <sup style='font-size: 20px'>secs</sup>";

        }

    }

    /**
     * Fetching all logged time from Database and displaying it in a good manner
     */
    public function total_time()
    {
        $all_time_values = $this->query("SELECT time FROM times");

        $total_time = array();

        if ($all_time_values->num_rows > 0) {

            while ($row = $all_time_values->fetch_array()) {

                array_push($total_time, $row[0]);

            }
        }

        $this->get_total_time($total_time);

    }

}
