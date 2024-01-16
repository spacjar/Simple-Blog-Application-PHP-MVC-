<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/ApiModel.php";

    /**
     * The ApiController class handles all API requests.
     */
    class ApiController extends Controller {

        /**
         * Handles the API request to check if the email or username is available for registration.
         *
         * @param Request $request The request object containing the query parameters.
         * @param Response $response The response object to send the JSON data.
         * @return void
         */
        public function handleRegisterCheck(Request $request, Response $response)
        {
            $response->setHeader("Content-Type: application/json");

            $resData = [];
            $emailParam = $request->getQueryParam('email') ?? null;
            $usernameParam = $request->getQueryParam('username') ?? null;

            if(isset($emailParam)) {
                try {
                    $isEmailParamAvailable = ApiModel::isEmailAvailable($emailParam);
                    $resData = array_merge($resData, ['isEmailAvailable' => $isEmailParamAvailable]);
                } catch (Exception $e) {
                    $resData = array_merge($resData, ['isEmailAvailable' => false]);
                }
            }

            if(isset($usernameParam)) {
                try {
                    $isUsernameParamAvailable = ApiModel::isUsernameAvailable($usernameParam);
                    $resData = array_merge($resData, ['isUsernameAvailable' => $isUsernameParamAvailable]);
                } catch (Exception $e) {
                    $resData = array_merge($resData, ['isUsernameAvailable' => false]);
                
                }
            }

            $response->writeJson($resData);
            $response->setStatusCode(200);
            return;
        }
    }
?>