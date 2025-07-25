<?php
require_once 'Conexion.php';
class Consulta
{

    const LINK_API = 'https://68827f5521fa24876a9b0eff.mockapi.io/api/v1/name';
    private $conexion;
    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function getDataApi()
    {
        $response = @file_get_contents(self::LINK_API);
        $data = json_decode($response, true);
        foreach ($data as $item) {
            $this->store( $item['name'], $item['avatar'], $item['country'] , $item['createdAt']) ;
        }
    }

    public function getData()
    {
        $db = $this->conexion->conectar();
        $query = "SELECT * FROM persons";
        $result = mysqli_query($db, $query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function store($name, $avatar, $country, $createdAt){
        $db = $this->conexion->conectar();
        $query = "INSERT INTO persons (name,  avatar, country, createdAt) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $db->begin_transaction();
        $stmt->bind_param('ssss', $name, $avatar, $country, $createdAt);
            if ($stmt) {
                $stmt->execute();
                $db->commit();
            } else {
                $db->rollback();
            }
    }

    public function update($id, $name, $avatar, $country)
    {
        $db = $this->conexion->conectar();
        $query = "UPDATE persons SET name = ?, avatar = ?, country = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssi', $name, $avatar, $country, $id);
        return $stmt->execute();
    }

    public function getDataById($id)
    {
        $db = $this->conexion->conectar();
        $query = "SELECT * FROM persons WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
