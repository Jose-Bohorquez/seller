<?php 

function is_logged_in()
{
    return isset($_SESSION['user']);
}

function get_user()
{
    return $_SESSION['user'] ?? null;
}

// Validar si el usuario tiene un rol específico (acepta el ID del rol)
function has_role($role)
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] == $role;
}

// Validar si el usuario es Super-admin
function is_super_admin()
{
    return has_role(1); // Rol 1 para Super-admin
}

// Validar si el usuario es Admin
function is_admin()
{
    return has_role(2); // Rol 2 para Admin
}

// Validar si el usuario es Seller
function is_seller()
{
    return has_role(3); // Rol 3 para Seller
}

// Validar si el usuario es un usuario normal
function is_user()
{
    return has_role(4); // Rol 4 para User
}

?>
