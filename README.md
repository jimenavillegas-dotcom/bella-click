# Bella Click — Tienda en línea de maquillaje y cuidado personal

Proyecto académico de e-commerce con catálogo de productos y carrito básico.

## 📌 Descripción breve
Sitio web que permite explorar productos de maquillaje/cuidado personal y simular compras. El repositorio incluye el código del sitio y un volcado SQL para la base de datos.

## ✅ Requisitos
- **Opción A · Sitio estático**: Navegador moderno (Chrome/Firefox/Edge).
- **Opción B · PHP + MySQL/MariaDB**: XAMPP o stack equivalente (Apache, PHP 8+, MariaDB/MySQL).

## 🛠️ Instalación y ejecución

### Opción A · Sitio estático
1. Descargar/clonar este repositorio.
2. Abrir `Página web/ página/index.html` en el navegador.
   - (Opcional) Servidor local rápido:
     ```bash
     npx serve "Página web/ página"
     ```
     y abrir la URL que muestre.

### Opción B · PHP + MySQL/MariaDB
1. Instalar **XAMPP** (o similar) y activar **Apache** y **MySQL/MariaDB**.
2. **Base de datos**  
   - Entrar a **phpMyAdmin** → crear la base (ej. `mercado_libre`).  
   - Importar el archivo: `base de datos1/mercado_libre (3).sql`.
3. **Código**  
   - Copiar el contenido de `Página web/ página/` a tu servidor local (XAMPP: `C:\xampp\htdocs\bella-click\`).
4. **Configurar conexión** (ejemplo en PHP):
   ```php
   <?php
   $host = '127.0.0.1';
   $db   = 'mercado_libre'; // usa el mismo nombre que creaste/importaste
   $user = 'root';
   $pass = '';
