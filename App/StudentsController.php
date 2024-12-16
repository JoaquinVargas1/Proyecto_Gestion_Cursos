<?php
require_once 'Config.php';





if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addStudent':
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
         //   $password = $_POST['password'];
            $semester = $_POST['semester'];
            $studentscontroller = new StudentsController();
            $studentscontroller->addStudent($name, $lastname, $email,$semester);
            break;


        case 'removeStudent':
            $userId = $_POST['user_id'];
            $studentscontroller = new StudentsController();
            $studentscontroller->removeStudent($userId);
            break;


        case 'updateStudent':
            $userId = $_POST['userId'];
            $name = $_POST['name'];
            $lastname = $_POST['lastName'];
            $email = $_POST['email'];
      //      $password = $_POST['password'];
            $semester = $_POST['semester'];
            $studentscontroller = new StudentsController();
            $studentscontroller->editStudent($userId, $name, $lastname, $email, $semester);
            break;
    }
}







class StudentsController
{

    public function get()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/students',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       // echo $response;
        return json_decode($response, true);
        
    }

    public function addStudent($name, $lastname, $email, $semester)
    {
        $curl = curl_init();

       
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/students',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name, 'lastName' => $lastname, 'email' => $email, 'password' => 'hola123', 'semester' => $semester),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
       // list($header, $body) = explode("\r\n\r\n", $response, 2);
        //$responseData = json_decode($body, true);
        
        
        if ($httpCode == 201) {
        
            header('Location: ' . BASE_PATH . 'alumnos/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . '/alumnos/mostrar?error=error');
        }
    }



    public function editStudent($userId, $name, $lastname, $email,  $semester)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/students/' . $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                'name' => $name,
                'lastName' => $lastname,
                'email' => $email,
                'password' => 'hola123',
                'semester' => $semester
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
       // list($header, $body) = explode("\r\n\r\n", $response, 2);
        //$responseData = json_decode($body, true);
        
        
        if ($httpCode == 200) {
        
            header('Location: ' . BASE_PATH . 'alumnos/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . 'alumnos/mostrar?error=error');
        }
    }

    public function removeStudent($studentsId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/students/' . $studentsId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
       // list($header, $body) = explode("\r\n\r\n", $response, 2);
        //$responseData = json_decode($body, true);
        
        
        if ($httpCode == 200) {
        
            header('Location: ' . BASE_PATH . 'alumnos/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . 'alumnos/mostrar?error=error');
        }
    }



    public function getStudentByID($studentsId)
    {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/students/' . $studentsId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        if (!$response) {
            echo "No se recibió respuesta de la API. La URL podría ser incorrecta o el servidor podría estar caído.";
            exit;
        }
    
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
    
        
        if (isset($data['data'])) {
            
            return $data['data'];
        } else {
           
            echo "No se encontró el alumno con ID: " . $studentsId;
            exit;
        }
    }
}
