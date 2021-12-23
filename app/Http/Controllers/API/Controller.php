<?php

class Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Ecomm IT App Test OpenApi Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="andreadisipio@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )
     * 
     *
     * @OA\Tag(
     *     name="Ecomm IT App Test",
     *     description="API Endpoints of Ecomm IT App Test"
     * )
     */

     /**
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="bearerAuth",
     * )
     */
}

?>