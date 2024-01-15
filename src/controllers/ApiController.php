<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/ApiModel.php";

    class ApiController extends Controller {

        public function handleSignupCheck(Request $request, Response $response)
        {
            header('Content-Type: application/json');

            $resData = [];
            $emailParam = $request->getQueryParam('email') ?? null;
            $usernameParam = $request->getQueryParam('username') ?? null;

            if($emailParam != null) {
                try {
                    $isEmailParamAvailable = ApiModel::isEmailAvailable($emailParam);
                    $resData = array_merge($resData, ['isEmailAvailable' => $isEmailParamAvailable]);
                } catch (Exception $e) {
                    $resData = array_merge($resData, ['isEmailAvailable' => false]);
                }
            }

            if($usernameParam != null) {
                try {
                    $isUsernameParamAvailable = ApiModel::isUsernameAvailable($usernameParam);
                    $resData = array_merge($resData, ['isUsernameAvailable' => $isUsernameParamAvailable]);
                } catch (Exception $e) {
                    $resData = array_merge($resData, ['isUsernameAvailable' => false]);
                
                }
            }

            echo json_encode($resData);
            return;
        }
    }
?>