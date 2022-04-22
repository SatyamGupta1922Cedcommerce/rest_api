<?php

use Phalcon\Mvc\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class SignupController extends Controller
{
    public function indexAction()
    {
    }
    public function registerAction()
    {
        $collection = $this->mongo->demo->beers;
        $data = array(
            "name" => $this->request->getPost('name'),
            "email" => $this->request->getPost('email'),
            "password" => $this->request->getPost('password'),
            "role" => 'user'
        );
        $result = $collection->insertOne($data);
        $token = $this->token($data['name'], $data['email']);
        echo $token;
        die;
    }
    public function token($name, $email)
    {
        $key = "example_key";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "exp" => time() * 24 + 3600,
            "role" => "user",
            "name" => $name,
            "email" => $email
        );

        $jwt = JWT::encode($payload, $key, 'HS256');

        return $jwt;
    }
}
