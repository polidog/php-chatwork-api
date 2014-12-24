<?php
namespace Polidog\Chatwork\Entity\Factory;


interface FactoryInterface 
{
    public function create(array $data = []);
}