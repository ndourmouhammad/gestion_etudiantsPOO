<?php

interface Icrud 
{
    public function create($nom, $email, $id_classe);
    public function read();
    public function update($id, $nom, $email, $id_classe);
    public function delete($id);
}