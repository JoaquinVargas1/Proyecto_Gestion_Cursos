<?php
require_once 'Config.php';





if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addCategory':
            $name = $_POST['name'];
            $categorycontroller = new CategoryController();
            $categorycontroller->addCategory($name);
            break;


        case 'removeCategory':
            $categoryId = $_POST['category_id'];
            $categorycontroller = new CategoryController();
            $categorycontroller->removeCategory($categoryId);
            break;


        case 'updateCategory':
            $categoryId = $_POST['categoryId'];
            $name = $_POST['name'];
            $categorycontroller = new CategoryController();
            $categorycontroller->editCategory($categoryId, $name);
            break;
    }
}







class CategoryController
{

    public function get()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/categories',
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
      //  echo $response;
        return json_decode($response, true);
    }

    public function addCategory($name)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/categories',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
       // list($header, $body) = explode("\r\n\r\n", $response, 2);
        //$responseData = json_decode($body, true);
        
        
        if ($httpCode == 201) {
        
            header('Location: ' . BASE_PATH . 'categorias/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . 'categorias/mostrar?error=error');
        }
    }



    public function editCategory($categoryId, $name)
    {
        $curl = curl_init();
    
        // Crear el cuerpo de la solicitud en formato JSON
        $data = json_encode(['name' => $name]);
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/categories/' . $categoryId,
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
            header('Location: ' . BASE_PATH . 'categorias/mostrar');
            exit;
        } else {
            header('Location: ' . BASE_PATH . 'categorias/mostrar?error=error');
            exit;
        }
    }
    

    public function removeCategory($categoryId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/categories/' . $categoryId,
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
        
            header('Location: ' . BASE_PATH . 'categorias/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . 'categorias/mostrar?error=error');
        }
    }



    public function getCategoryByID($categoryId)
    {
        // Llamar a la API para obtener los cursos de la categoría
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/categories/' . $categoryId,
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
    
        // Verificar si la respuesta contiene la clave 'data'
        if (isset($data['data'])) {
            // Si contiene los datos del profesor, devolverlos
            return $data['data'];
        } else {
            // Si no contiene la clave 'data', mostrar un mensaje de error
            echo "No se encontró el profesor con ID: " . $categoryId;
            exit;
        }
    }
}

?>