<?php
 require '../App/Config.php'; 

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'login':
            $email = $_POST['email'];
            $password = $_POST['password'];

            $authController = new AuthController();
            $authController->access($email, $password);
            break;


        case 'logout':

            $authController = new AuthController();
            $authController->logOut();

            break;
    }
}

class AuthController
{

    public function access($email, $password)
    {



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/usuarios/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'email' => $email,
                'password' => $password
            ),
            CURLOPT_HEADER => true, 
        ));
        

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        curl_close($curl);
        list($header, $body) = explode("\r\n\r\n", $response, 2);
        $responseData = json_decode($body, true);
        
        session_start();
        switch ($httpCode) {
            case 200:

                $_SESSION['user'] = $email;
                session_start();        

                //lo cambian al index
                header('Location: ' . BASE_PATH . '/alumnos/mostrar');
                exit;
            case 404:
            
                header('Location: ' . BASE_PATH . '/login?error=usuario_no_encontrado');
                exit;
            case 401:
                
                header('Location: ' . BASE_PATH . '/login?error=contrasena_incorrecta');
                exit;
            default:
               
                header('Location: ' . BASE_PATH . '/login?error=error_desconocido');
                exit;

    }
}





    public function logOut()
    {
        session_unset();
        session_destroy();
    }
}
