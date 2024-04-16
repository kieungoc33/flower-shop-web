<?php
namespace App\Repositories\Interfaces;

interface LanguageRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $payload=[]);
    public function delete(int $id= 0);
    
}