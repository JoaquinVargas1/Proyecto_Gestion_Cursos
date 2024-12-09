
<?php

if (!isset($_SESSION)) {
    session_start();
}




if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addInscription':
            $date_inscription = $_POST['date_inscription'];
            $user_id = $_POST['user_id'];
            $course_id = $_POST['course_id'];
            $inscriptioncontroller = new InscriptionController();
            $inscriptioncontroller->addInscription($date_inscription,$user_id, $course_id);
            break;


        case 'removeInscription':
            $profesorId = $_POST;
            $inscriptioncontroller = new InscriptionController();
            $inscriptioncontroller->removeInscription($profesorId);
            break;


        case 'updateInscription':
            $courseId = $_POST['courseId'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $profesorId = $_POST['profesorId'];
            $inscriptioncontroller = new InscriptionController();
            $inscriptioncontroller->updateInscription($courseId, $name, $description, $category_id, $profesorId);
            break;
    }
}







class InscriptionController
{

    public function get()
    {

      
    }

    public function addInscription($date_inscription,$user_id, $course_id)
    {

       
    }



    public function updateInscription($courseId, $name, $description, $category_id, $profesorId)
    {

    }


    public function removeInscription($courseId)
    {

    }



    public function getCourseByID($courseId)
    {

       
    }
}
