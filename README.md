# 🛍️ Seller - Sistema de Gestión de Ventas

## 📋 Descripción
Seller es una aplicación web moderna para la gestión de ventas que permite administrar productos, inventarios y procesar transacciones en tiempo real. Diseñada con una interfaz intuitiva y responsive, facilita tanto la experiencia del usuario final como la del administrador.

## ✨ Características Principales
- **📱 Interfaz Responsive**: Diseño adaptable para cualquier dispositivo usando Bootstrap 5
- **🛒 Gestión de Carrito**: Sistema dinámico de carrito de compras con actualizaciones en tiempo real vía AJAX
- **💳 Procesamiento de Pagos**: Integración con pasarelas de pago (Efecty y PSE)
- **📦 Control de Inventario**: Sistema completo de gestión de stock con alertas automáticas
- **👥 Gestión de Usuarios**: Sistema de autenticación seguro con diferentes niveles de acceso
- **📊 Panel Administrativo**: Dashboard intuitivo para gestión de productos y ventas

## 🛠️ Tecnologías Utilizadas

### Frontend
- HTML5 & CSS3 para estructura y estilos
- JavaScript para interactividad del lado del cliente
- Bootstrap 5 para diseño responsive
- SweetAlert2 para notificaciones elegantes
- AJAX para actualizaciones dinámicas

### Backend
- PHP 8.0+ para la lógica del servidor
- MySQL para base de datos
- PDO para conexiones seguras a la base de datos

### Herramientas Adicionales
- Control de versiones con Git
- Composer para gestión de dependencias PHP
- PHPMyAdmin para administración de base de datos

## ⚙️ Requisitos Previos
- PHP >= 8.0
- MySQL >= 5.7
- Servidor web (Apache/Nginx)
- Composer
- Node.js y npm (opcional, para desarrollo)

## 🚀 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/aebigor/seller.git
cd seller
```

2. **Configurar la base de datos**
```bash
# Importar el archivo SQL de la base de datos
mysql -u usuario -p nombre_base_datos < database/seller.sql
```

3. **Configurar el entorno**
```bash
# Copiar el archivo de configuración
cp config/config.example.php config/config.php
# Editar config.php con tus credenciales de base de datos
```

4. **Instalar dependencias**
```bash
composer install
```

## 🔧 Configuración

1. Configura los parámetros de la base de datos en `config/config.php`
2. Ajusta las credenciales de las pasarelas de pago en `config/payments.php`
3. Configura los permisos de escritura en las carpetas:
   - `uploads/`
   - `temp/`
   - `logs/`

## 📝 Uso

### Panel Administrativo
- Accede a `/admin` con las credenciales por defecto:
  - Usuario: admin@seller.com
  - Contraseña: admin123

### Gestión de Productos
1. Navega a la sección "Productos"
2. Usa el formulario para agregar nuevos productos
3. Gestiona el inventario en tiempo real

## 🤝 Contribución
Las contribuciones son bienvenidas. Para contribuir:

1. Haz fork del proyecto
2. Crea una nueva rama (`git checkout -b feature/AmazingFeature`)
3. Realiza tus cambios
4. Commit (`git commit -m 'Add: AmazingFeature'`)
5. Push (`git push origin feature/AmazingFeature`)
6. Abre un Pull Request

## 📄 Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para más detalles.

## 📞 Contacto
Nombre - [@tutwitter](https://twitter.com/tutwitter) - email@ejemplo.com

Link del proyecto: [https://github.com/aebigor/seller](https://github.com/aebigor/seller)
```

Este README mejorado incluye:
- Emojis para mejor visualización
- Secciones más detalladas y organizadas
- Instrucciones claras de instalación y configuración
- Información sobre el uso del sistema
- Sección de contribución
- Contacto y licencia

¿Te gustaría que ajustemos alguna sección en particular o agreguemos más información específica sobre algún aspecto del proyecto?