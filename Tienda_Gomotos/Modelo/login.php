<?php
class login {
    private $conexion;
    private $correo;
    private $clave;

    public function __construct($conexion, $correo, $clave) {
        $this->conexion = $conexion;
        $this->correo = $correo;
        $this->clave = $clave;
    }

    public function verificar() {
        $sql = "SELECT * FROM cliente WHERE correo = ? AND clave = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss", $this->correo, $this->clave);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>
