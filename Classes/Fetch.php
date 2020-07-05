<?php
class Fetch
{
    protected $connection;

    protected $result;

    protected $error;

    protected $count = 0;


    function __construct(PDO $connection) {
        $this->connection =  $connection;
    }



    //fetch single item
    public function getSingleItem($action, $table, $field, $field_value) {
        $query = $this->connection->prepare("{$action} FROM {$table} WHERE {$field} = ? LIMIT 1 ");
        $query->bindParam(1, $field_value, PDO::PARAM_INT);

        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return $this;
        }
    }


    //function to fetch single line data for query with where clause
    public function singleDataAction($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=', '==', '===', '!=', '!==', 'LIKE');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            if(in_array($operator, $operators)) {
                $sql_statement = "{$action} FROM {$table} WHERE {$field} {$operator} ? LIMIT 1";
                if($result = $this->query($sql_statement, array($value))) {
                    return $result;
                } else {
                    $this->error = implode(', ', $this->connection->errorInfo());
                    return $this;
                }
            }
        }

    }


    //function to fetch a single data with or without a where clause
    public function query($sql_statement, $parameters = array()) {
        if($query = $this->connection->prepare($sql_statement)) {
            $parameter_counter = 1;
            if(count($parameters)){
                foreach ($parameters as $parameter) {
                    $query->bindValue($parameter_counter, $parameter);
                    $parameter_counter++;
                }
                if ($query->execute()) {
                    $id = $this->connection->lastInsertId();
                    $result = $query->fetch(PDO::FETCH_OBJ);
                    $this->count = $query->rowCount();
                    return $result;
                } else {
                    $this->error = implode(', ', $this->connection->errorInfo());
                    return $this;
                }
            }
        }
        return $this;
    }

    
    //display single data result
    public function  getSingleData($query, $table, $where) {
        return $this->singleDataAction($query, $table, $where);
    }


    //fetch single item with joins
    public function getSigleJoinItem($action, $table, $join, $field, $field_value) {
        $query = $this->connection->prepare("{$action} FROM {$table} {$join} WHERE {$field} = ? LIMIT 1");
        $query->bindParam(1, $field_value, PDO::PARAM_INT);

        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return $this;
        }
    }


    //fetch items with limit and offset
    public function getItemsWithLimitOffset($action, $table, $join, $limit, $offset) {
        $query = $this->connection->prepare("{$action} FROM {$table} {$join} ORDER BY {$table}.id DESC LIMIT $limit OFFSET $offset");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch all items with no comparison
    public function getItemsWithNoComparison($action, $table) {
        $query = $this->connection->prepare("{$action} FROM {$table}");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch students for attendance
    public function getStudentsForAttendance($faculty_grade_id){
        $query = $this->connection->prepare("SELECT students.id, students.full_name, students.grade_id FROM students WHERE students.grade_id = '$faculty_grade_id'");
        
        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch all attendance taken by a faculty
    public function getFcultyAttendanceTaken($faculty_id, $limit, $offset){
        $query = $this->connection->prepare("SELECT student_attendance.id, student_attendance.attendance_id, student_attendance.date, students.full_name as student, users.full_name as faculty, courses.course_name as course FROM student_attendance JOIN students ON students.id = student_attendance.student_id JOIN users ON users.id = student_attendance.faculty_id JOIN courses ON courses.id = student_attendance.course_id WHERE student_attendance.faculty_id ='$faculty_id' ORDER BY student_attendance.id DESC LIMIT $limit OFFSET $offset");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch all attendance taken for Admin
    public function getAllAttendanceTakenForAdmin($limit, $offset){
        $query = $this->connection->prepare("SELECT student_attendance.id, student_attendance.attendance_id, student_attendance.date, students.full_name as student, users.full_name as faculty, courses.course_name as course, attendance_status.name AS attendance FROM student_attendance JOIN students ON students.id = student_attendance.student_id JOIN users ON users.id = student_attendance.faculty_id JOIN courses ON courses.id = student_attendance.course_id JOIN attendance_status ON attendance_status.id = student_attendance.attendance_id  ORDER BY student_attendance.id DESC LIMIT $limit OFFSET $offset");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    
    //fetch faculty course materials
    public function getFacultyCourseMaterials($faculty_id) {
        $query = $this->connection->prepare("SELECT course_materials.id, course_materials.title, course_materials.course_id, course_materials.semester_id, course_materials.academic_id, course_materials.file, course_materials.faculty_id, course_materials.created_at, courses.course_name AS course FROM course_materials JOIN courses ON courses.id = course_materials.course_id WHERE course_materials.faculty_id = '$faculty_id' GROUP BY course_materials.id, course_materials.course_id");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch course materials for students based on their grade
    public function getCourseMaterialsForStudent($student_grade_id) {
        $query = $this->connection->prepare("SELECT course_materials.id, course_materials.title, course_materials.course_id, course_materials.semester_id, course_materials.academic_id, course_materials.file, course_materials.faculty_id, course_materials.created_at, courses.course_name AS course FROM course_materials JOIN courses ON courses.id = course_materials.course_id WHERE course_materials.faculty_grade_id = '$student_grade_id' GROUP BY course_materials.id, course_materials.course_id");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch total course material for a faculty
    public function getFacultyTotalCourseMaterial($faculty_id){
        $query = $this->connection->prepare("SELECT COUNT(id) AS total FROM course_materials WHERE course_materials.faculty_id = $faculty_id");
        if($query->execute()){
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } else{
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }

    //fetch total student attendance for a faculty
    public function getFacultyTotalAttendance($faculty_id){
        $query = $this->connection->prepare("SELECT COUNT(id) AS total FROM student_attendance WHERE student_attendance.faculty_id = $faculty_id");
        if($query->execute()){
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } else{
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }

    

    //fetch total for all items
    public function getTotal($table) {
        $query = $this->connection->prepare("SELECT COUNT(id) AS total FROM $table");
        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //search for attendance list (filter by date range)
    public function searchAttendanceList($item, $faculty_id, $from, $to) {
        $query = $this->connection->prepare("SELECT student_attendance.id, student_attendance.attendance_id, student_attendance.course_id, students.full_name AS student, courses.course_name AS course, student_attendance.date FROM student_attendance JOIN students ON students.id = student_id JOIN courses ON courses.id = student_attendance.course_id WHERE student_attendance.course_id LIKE '%$item%' AND student_attendance.faculty_id = '$faculty_id' ORDER BY student_attendance.date BETWEEN '$from' AND '$to' ");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }



    //search for attendance list (filter by date range) for admin
    public function searchAttendanceListForAdmin($item, $from, $to) {
        $query = $this->connection->prepare("SELECT student_attendance.id, student_attendance.attendance_id, student_attendance.course_id, students.full_name AS student, courses.course_name AS course, student_attendance.date, users.full_name AS faculty FROM student_attendance JOIN students ON students.id = student_id JOIN courses ON courses.id = student_attendance.course_id JOIN users ON users.id = student_attendance.faculty_id WHERE student_attendance.course_id LIKE '%$item%' ORDER BY student_attendance.date BETWEEN '$from' AND '$to' ");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    // fetch total attendance for analysis
    public function getTotalAttendanceForAnalysis($value) {
        $query = $this->connection->prepare("SELECT COUNT(id) AS total FROM student_attendance WHERE attendance_id = $value");

        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch total searched attendance for analysis
    public function getTotalSearchedAttendance($course_id, $attendance_id) {
        $query = $this->connection->prepare("SELECT COUNT(id) AS total FROM student_attendance WHERE course_id = $course_id AND attendance_id = $attendance_id");

        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }
    
}