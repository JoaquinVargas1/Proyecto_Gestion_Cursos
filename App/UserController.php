<?php
require_once 'Config.php';





if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addUser':
            $name = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $usercontroller = new UserController();
            $usercontroller->addUser($name, $password, $email);

            break;

        case 'removeUser':
            $userId = $_POST;
            $usercontroller = new UserController();
            $usercontroller->removeUser($userId);
            break;

        case 'updateUser':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $userId = $_POST['userId'];
            $usercontroller = new UserController();
            $usercontroller->editUser($name, $password, $email, $userId);

            break;
    }
}







class UserController
{

    public function get()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/usuarios',
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
        echo $response;
    }

    public function addUser($name,  $password, $email)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/usuarios',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name, 'email' => $email, 'password' => $password),
        ));

        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
       // list($header, $body) = explode("\r\n\r\n", $response, 2);
        //$responseData = json_decode($body, true);
        
        
        if ($httpCode == 200) {

ob_start();

ob_end_clean();
session_start();
            header('Location: ' . BASE_PATH . '/alumnos/mostrar');
        return json_decode($response, true);}
        else{

        //    return json_decode($responseData);
            header('Location: ' . BASE_PATH . '/login?error=error_desconocido');
        }
    }



    public function editUser($name, $email,  $userId)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/usuarios/' . $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => array('name' => $name, 'email' => $email),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function removeUser($userId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/usuarios/' . $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
   //     echo $response;
    }



    public function getUsersByID($userId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/usuarios/'.$userId,
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
        echo $response;
    }
}

?>
