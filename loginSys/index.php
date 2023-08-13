<?php
    //Pascal case for class name
    class UniversityStudent{
        //Data Members
        public $univID, $name, $course;

        //Member functions
        public function setValues($univID, $name, $course){
            $this->univID = $univID;
            $this->name = $name;
            $this->course = $course;
        }
    }
    class UniversityStudentConstructor{
        public $univID, $name, $course;

        //using constructor
        function __construct($univID, $name, $course){
            $this->univID = $univID;
            $this->name = $name;
            $this->course = $course;
        }
    }
    //Approach 1 to set data members using function;
    $student_1 = new UniversityStudent();
    //creating instance of UniversityStudent class.
    $student_1->setValues("028","Ram","CSE");
    echo "Welcome ".$student_1->name."! Your university ID is ".$student_1->univID." and you have enrolled in ".$student_1->course."<br><br>";

    //Approach 2 using -> operator to access data members of the instance created.
    $student_2 = new UniversityStudent();
    $student_2->univID = "121";
    $student_2->name = "Harry";
    $student_2->course = "MBA";
    echo "Welcome ".$student_2->name."! Your university ID is ".$student_2->univID." and you have enrolled in ".$student_2->course."<br><br>";

    //Approach 3 using __construct() function
    $student_3 = new UniversityStudentConstructor("041","Soham","ECE");
    echo "Welcome ".$student_3->name."! Your university ID is ".$student_3->univID." and you have enrolled in ".$student_3->course."<br><br>";

?>

