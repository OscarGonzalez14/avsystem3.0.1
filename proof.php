public function get_photo_ventas(){
  $conectar= parent::conexion();

  $sql="select id_producto,categoria as precio, categoria_producto, desc_producto from productos where categoria_producto='photosensible';";
  $sql = $conectar->prepare($sql);
  $sql->execute();
  return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
}
