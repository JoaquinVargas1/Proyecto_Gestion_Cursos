
<?php

if (!isset($_SESSION)) {
    session_start();
}




if (isset($_POST['action'])) {
    switch ($_POST['action']) {





        case 'addUnit':
            $tittle = $_POST['tittle'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $course_id= $_POST['course_id'];
            $inscriptioncontroller = new UnitController();
            $inscriptioncontroller->addUnit($tittle,$description, $content, $course_id);
            break;


        case 'removeUnit':
            $unitId = $_POST;
            $inscriptioncontroller = new UnitController();
            $inscriptioncontroller->removeUnit($unitId);
            break;


        case 'updateUnit':
            $unitId = $_POST['unit_id'];
            $tittle = $_POST['tittle'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $course_id= $_POST['course_id'];
            $inscriptioncontroller = new UnitController();
            $inscriptioncontroller->updateUnit($unitId, $name, $description, $category_id,$courseId);
            break;
    }
}







class UnitController
{

    public function get()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/inscriptions',
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

    public function addUnit($tittle,$description, $content, $course_id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/units',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('tittle' => $tittle, 'description' => $description, 'content' => $content,'course_id' => $course_id),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    //    echo $response;
        return json_decode($response, true);
    }



    public function updateUnit($unitId,$tittle,$description, $content, $course_id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/units/'.$unitId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => array('tittle' => $tittle, 'description' => $description, 'content' => $content,'course_id' => $course_id),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       // echo $response;
        return json_decode($response, true);
    }


    public function removeUnit($unitId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/units/' . $unitId,
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
    //    echo $response;
        return json_decode($response, true);
    }



    public function getUnitByID($unitId)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-proyecto-96t3.onrender.com/api/inscriptions/' . $unitId,
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






}
