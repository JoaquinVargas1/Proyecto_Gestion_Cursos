<?php
ob_start();
require_once 'Config.php';






if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addProfesor':
            $name = $_POST['name'];
            $lastname = $_POST['lastName'];
            $email = $_POST['email'];
            //   $password = $_POST['password'];
            $profesorcontroller = new ProfesorController();
            $profesorcontroller->addProfesor($name, $lastname, $email);
            break;


        case 'removeProfesor':
            $profesorId = $_POST['profesorId'];
            $profesorcontroller = new ProfesorController();
            $profesorcontroller->removeProfesor($profesorId);
            break;


        case 'updateProfesor':
            $profesorId = $_POST['profesorId'];
            $name = $_POST['name'];
            $lastname = $_POST['lastName'];
            $email = $_POST['email'];
            //       $password = $_POST['password'];
            $profesorcontroller = new ProfesorController();
            $profesorcontroller->editProfesor($profesorId, $name, $lastname, $email);
            break;
    }
}







class ProfesorController
{

    public function get()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/profesors',
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

    public function addProfesor($name, $lastname, $email)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/profesors',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name, 'lastName' => $lastname, 'email' => $email, 'password' => 'hola123'),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        // list($header, $body) = explode("\r\n\r\n", $response, 2);
        //$responseData = json_decode($body, true);


        if ($httpCode == 201) {

            header('Location: ' . BASE_PATH . 'profesores/mostrar');
            return json_decode($response, true);
        } else {

            //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . '/profesores/mostrar?error=error');
        }
    }



    public function editProfesor($profesorId, $name, $lastname, $email)
    {
        $curl = curl_init();

        
        $data = json_encode([
            'name' => $name,
            'lastName' => $lastname,
            'email' => $email,
            'password' => 'hola123', 
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/profesors/' . $profesorId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $data, 
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json', 
                'Accept: application/json',       
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Manejar la respuesta
        if ($httpCode == 200 || $httpCode == 204) {
            header('Location: ' . BASE_PATH . 'profesores/mostrar');
            exit;
        } else {
            header('Location: ' . BASE_PATH . 'profesores/mostrar?error=error');
            exit;
        }
    }


    public function removeProfesor($profesorId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/profesors/' . $profesorId,
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
        
            header('Location: ' . BASE_PATH . 'profesores/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . 'profesores/mostrar?error=error');
        }
    }



    public function getProfesorByID($profesorId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/profesors/' . $profesorId,
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


        $data = json_decode($response, true);


        if (isset($data['data'])) {

            return $data['data'];
        } else {

            echo "No se encontró el profesor con ID: " . $profesorId;
            exit;
        }
    }
}
ob_end_flush();
?>