
<?php
require_once 'Config.php';



if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addCourse':
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $profesorId = $_POST['profesorId'];
            $coursescontroller = new CoursesController();
            $coursescontroller->addCourse($name, $description, $category_id, $profesorId);
            break;


        case 'removeCourse':
            $courseId = $_POST['courseId'];
            $coursescontroller = new CoursesController();
            $coursescontroller->removeCourse($courseId);
            break;


        case 'updateCourse':
            $courseId = $_POST['courseId'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $profesorId = $_POST['profesorId'];
            $coursescontroller = new CoursesController();
            $coursescontroller->editCourse($courseId, $name, $description, $category_id, $profesorId);
            break;
    }
}







class CoursesController
{

    public function get()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses',
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
    
      
        return json_decode($response, true);
    }

    public function addCourse($name, $description, $category_id, $profesorId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name, 'description' => $description, 'category_id' => $category_id, 'profesor_id' => $profesorId),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
    

        if ($httpCode == 201) {
        
            header('Location: ' . BASE_PATH . 'cursos/mostrar');
        return json_decode($response, true);}
        else{

            header('Location: ' . BASE_PATH . 'cursos/mostrar?error=error');
        }
    }



    public function editCourse($courseId, $name, $description, $category_id, $profesorId)
{
    $curl = curl_init();

    // Crear el cuerpo de la solicitud en formato JSON
    $data = json_encode([
        'name' => $name,
        'description' => $description,
        'category_id' => $category_id,
        'profesor_id' => $profesorId,
    ]);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses/' . $courseId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $data, // Enviar datos como JSON
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json', // Especificar que los datos son JSON
            'Accept: application/json',       // Aceptar respuesta en formato JSON
        ),
    ));

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    // Manejar la respuesta
    if ($httpCode == 200 || $httpCode == 204) {
        header('Location: ' . BASE_PATH . 'cursos/mostrar');
        exit;
    } else {
        header('Location: ' . BASE_PATH . 'cursos/mostrar?error=error');
        exit;
    }
}



    public function removeCourse($courseId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses/' . $courseId,
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
        
            header('Location: ' . BASE_PATH . 'cursos/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . 'cursos/mostrar?error=error');
        }
    }



    public function getCourseByID($courseId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses/' . $courseId,
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
        return json_decode($response, true);
    }



    public function getCourseByProfesor($idProfesor)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses/profesor/' . $idProfesor,
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
        return json_decode($response, true);
    }



    public function getCourseByCategory($idCategory)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/courses/category/'.$idCategory,
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
        return json_decode($response, true);
    }
}

?>